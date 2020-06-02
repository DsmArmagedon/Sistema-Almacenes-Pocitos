<?php

namespace App\Http\Controllers\Purchase;

use App\Events\DetailPurchaseCreatedUpdatedDeleted;
use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Repositories\ProductRepository;
use App\Repositories\PurchaseRepository;
use App\Repositories\DetailPurchaseRepository;

class PurchaseController extends Controller {

    protected $purchaseR;
    protected $productR;
    protected $detailPurchaseR;

    public function __construct(PurchaseRepository $purchaseR, ProductRepository $productR, DetailPurchaseRepository $detailPurchaseR) {
        $this->purchaseR = $purchaseR;
        $this->productR = $productR;
        $this->detailPurchaseR = $detailPurchaseR;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        list($purchases, $total) = $this->purchaseR->getListPurchase($request);
        if ($request->ajax()) {
            $view = view('purchases.table-purchases', compact('purchases'))->render();
            return response()->json(['vista' => $view, 'total' => $total]);
        }
        return view('purchases.index')->with('purchases', $purchases)->with('total', $total);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $products = $this->productR->getListProductCreates();
        $code = Code::getCode(Code::PURCHASE);
        return view('purchases.create')->with('code', $code)->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request) {
        try {
            $objectCode = Code::getObjectCode(Code::PURCHASE);
            $purchase = $this->purchaseR->fillModelStore($request, $objectCode->purchases);
            DB::beginTransaction();
            $purchase->save();
            $objectCode->save();
            foreach ($request->products as $product) {
                $item = $this->detailPurchaseR->fillModelStore((object) $product, $purchase->code);
                $item->save();
                event(new DetailPurchaseCreatedUpdatedDeleted($item->product_code, DetailPurchaseRepository::CREATED, $item->quantity));
            }
            DB::commit();
            if ($request->ajax()) {
                $code = Code::getCode(Code::PURCHASE);
                return response()->json(['message' => 'COMPRA creada correctamente', 'code' => $code]);
            }
            return redirect()->route('purchases.index');
        } catch (\Exception $e) {
            throw new CustomException('Error al crear la COMPRA', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $purchase = $this->purchaseR->getEditPurchase($id);
        return view('purchases.show')->with('purchase', $purchase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
        $purchase = $this->purchaseR->getEditPurchase($id);
        $products = $this->productR->getListProductCreates();
        if ($request->ajax()) {
            $view = view('purchases.edit', compact(['products']))->render();
            return response()->json(['vista' => $view, 'purchase' => $purchase]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequest $request, $id) {
        try {
            $newDetail = [];
            $purchase = $this->purchaseR->fillModelUpdate($request, $id);
            DB::beginTransaction();
            $purchase->save();
            foreach ($request->products as $product) {
                $item = $this->detailPurchaseR->fillModelUpdate((object) $product, $purchase->code . '.' . $product['product_code']);
                if (is_null($item)) {
                    $item = $this->detailPurchaseR->fillModelStore((object) $product, $purchase->code);
                    event(new DetailPurchaseCreatedUpdatedDeleted($item->product_code, DetailPurchaseRepository::CREATED, $item->quantity));
                } else {
                    if ($item->isDirty('quantity')) {
                        event(new DetailPurchaseCreatedUpdatedDeleted($item->product_code, DetailPurchaseRepository::UPDATED, $item->quantity, $item->getOriginal()['quantity']));
                    }
                }
                $item->save();

                array_push($newDetail, $item->product_code);
            }
            $this->detailPurchaseR->deleteItems($purchase->code, $newDetail);
            DB::commit();
            if ($request->ajax()) {
                return response()->json(['message' => 'COMPRA actualizada correctamente']);
            }
            return redirect()->route('purchases.index');
        } catch (\Exception $e) {
            throw new CustomException('Error al actualizar la COMPRA', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            DB::beginTransaction();
            $purchase = $this->purchaseR->findOrFail($id);
            foreach ($purchase->detailPurchases as $item) {
                event(new DetailPurchaseCreatedUpdatedDeleted($item->product_code, DetailPurchaseRepository::DELETED, $item->quantity));
                $item->delete();
            }
            $purchase->delete();
            DB::commit();
            return response()->json(['message' => 'COMPRA eliminada correctamente!']);
        } catch (\Exception $e) {
            throw new CustomException('Error al eliminar la COMPRA', 400);
        }
    }

}
