<?php

namespace App\Http\Controllers\Sale;

use App\Events\DetailSaleCreatedUpdatedDeleted;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Models\Code;
use App\Repositories\DetailSaleRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MYPDF;
class SaleController extends Controller
{
    protected $saleR;
    protected $productR;
    protected $detailSaleR;

    public function __construct(SaleRepository $saleR, ProductRepository $productR, DetailSaleRepository $detailSaleR)
    {
        $this->saleR = $saleR;
        $this->productR = $productR;
        $this->detailSaleR = $detailSaleR;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        list($sales, $total) = $this->saleR->getListSale($request);
        if($request->ajax()) {
            $view = view('sales.table-sales',compact('sales'))->render();
            return response()->json(['vista'=>$view,'total'=> $total]);
        }
        return view('sales.index')->with('sales',$sales)->with('total', $total);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productR->getListProductCreates();
        $code = Code::getCode(Code::SALE);
        return view('sales.create')->with('code', $code)->with('products',$products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request)
    {
        try {
            $objectCode = Code::getObjectCode(Code::SALE);
            $sale = $this->saleR->fillModelStore($request, $objectCode->sales);
            DB::beginTransaction();
            $sale->save();
            $objectCode->save();
                foreach($request->products as $product) {
                    $item = $this->detailSaleR->fillModelStore((object) $product, $sale->code);
                    $productEnabled = $this->saleR->isProductEnabled($item);
                    if(is_null($productEnabled)) {
                        $item->save();
                        event(new DetailSaleCreatedUpdatedDeleted($item->product_code, DetailSaleRepository::CREATED,$item->quantity));
                    } else {
                        throw new CustomException('La cantidad del producto '.$productEnabled->description .', no se encuentra disponible en inventario', 400);
                    }
                }
            DB::commit();
            if($request->ajax())
            {
                $sale = $this->saleR->getEditSale($sale->code);
                $view = view('sales.show-form',compact(['sale']))->render();
                return response()->json(['vista' => $view,'message' => 'VENTA creada correctamente']);
            }
            return redirect()->route('sales.index');
        } catch(\Exception $e) {
            throw new CustomException('Error al crear la VENTA', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = $this->saleR->getEditSale($id);
        return view('sales.show')->with('sale', $sale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $sale = $this->saleR->getEditSale($id);
        $products = $this->productR->getListProductCreates();
        if($request->ajax())
        {
            $view = view('sales.edit',compact(['products']))->render();
            return response()->json(['vista' => $view, 'sale' => $sale]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, $id)
    {
         try {
            $newDetail = [];
            $sale = $this->saleR->fillModelUpdate($request, $id);
            DB::beginTransaction();
            $sale->save();
                foreach($request->products as $product) {
                    $item = $this->detailSaleR->fillModelUpdate((object) $product, $sale->code.'.'.$product['product_code']);
                    if(is_null($item)) {
                        $item = $this->detailSaleR->fillModelStore((object) $product, $sale->code);
                        $productEnabled = $this->saleR->isProductEnabled($item);
                        event(new DetailSaleCreatedUpdatedDeleted($item->product_code, DetailSaleRepository::CREATED, $item->quantity));
                    } else{
                        $productEnabled = $this->saleR->isProductEnabled($item);
                        if($item->isDirty('quantity')) {
                            event(new DetailSaleCreatedUpdatedDeleted($item->product_code, DetailSaleRepository::UPDATED, $item->quantity,$item->getOriginal()['quantity']));
                        }
                    }
                    if(is_null($productEnabled)) {
                        $item->save();
                    } else {
                        throw new CustomException('La cantidad del producto '.$productEnabled->description .', no se encuentra disponible en inventario', 400);
                    }
                    array_push($newDetail, $item->product_code);
                }
                $this->detailSaleR->deleteItems($sale->code, $newDetail);
            DB::commit();
            if($request->ajax())
            {
                return response()->json(['message' => 'VENTA actualizada correctamente']);
            }
            return redirect()->route('sales.index');
         } catch(\Exception $e) {
             throw new CustomException('Error al actualizar la VENTA', 400);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            $sale = $this->saleR->findOrFail($id);
            foreach($sale->detailSales as $item) {
                event(new DetailSaleCreatedUpdatedDeleted($item->product_code, DetailSaleRepository::DELETED, $item->quantity));
                $item->delete();
            }
            $sale->delete();
            DB::commit();
            return response()->json(['message' => 'VENTA eliminada correctamente!']);
        } catch(\Exception $e) {
            throw new CustomException('Error al eliminar la VENTA', 400);
        }
    }
    
    public function getSale($id) {
        $sale = $this->saleR->getEditSale($id);
        try {
            header('Access-Control-Allow-Origin: *');
            MYPDF::SetPrintHeader(false);
            MYPDF::SetPrintFooter(false);
            MYPDF::SetMargins(PDF_MARGIN_LEFT,7 , PDF_MARGIN_RIGHT);
            MYPDF::AddPage();
            MYPDF::SetFont('courier', 'B', 13);
            MYPDF::Cell(0, 0,'Venta', 0, 1, 'C', 0, '', 0);
            $view = \View::make('pdf.sale')->with('sale',$sale);
            $html_content = $view->render();
            MYPDF::SetFont('courier', 'I', 9);
            MYPDF::writeHTML($html_content);
            return MYPDF::OutPut('Venta','I');
        } catch (\Exception $e) {
            throw new CustomException('Error no se puede crear el reporte',400);
        }
    }
}
