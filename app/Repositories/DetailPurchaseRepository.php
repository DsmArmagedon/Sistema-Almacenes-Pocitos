<?php

namespace App\Repositories;

use App\Events\DetailPurchaseCreatedUpdatedDeleted;
use App\Models\DetailPurchase;
use Illuminate\Http\Request;

class DetailPurchaseRepository extends BaseRepository
{
    const CREATED = 'created';
    const UPDATED = 'updated';
    const DELETED = 'deleted';
    /**
     * Permite enviar una instancia de la clase DetailPurchase a BaseRepository
     *
     * @return DetailPurchase DetailPurchase
     */
    public function getModel()
    {
        return new DetailPurchase();
    }

    /**
     * Permite crear una instancia de la clase DetailPurchase.
     *
     * @return DetailPurchase DetailPurchase
     */
    public function detailPurchase()
    {
        $instance = new DetailPurchase();
        return $instance;
    }

    /**
     * Permite llenar los datos del detalle de la compra.
     * @param  Request $requeste
     * @param DetailPurchase $item
     * @return DetailPurchase $item
     * 
     */
    public function fillModel($request, $item) {
        $item->product_code = $request->product_code;
        $item->import = $request->import;
        $item->quantity = $request->quantity;
        return $item;
    }

    public function fillModelStore($request, $purchase_code) {
        $item = $this->detailPurchase();
        $item->code = $purchase_code.'.'.$request->product_code;
        $item->purchase_code = $purchase_code;
        return $this->fillModel($request,$item);
    }

    public function fillModelUpdate($request, $id) {
        $item = $this->detailPurchase()->find($id);
        if(!is_null($item)) {
            return $this->fillModel($request, $item);
        }
        return $item;
    }

    public function deleteItems($purchaseCode, $newDetail) {
        $deleteItems = [];
        $detail = DetailPurchase::where('purchase_code', $purchaseCode)->pluck('product_code')->toArray();
        $diffDetail = array_diff($detail, $newDetail);
        foreach($diffDetail as $productCode) {
            $itemCode = $purchaseCode.'.'.$productCode;
            array_push($deleteItems, $itemCode);
            $item = DetailPurchase::findOrFail($itemCode);
            event(new DetailPurchaseCreatedUpdatedDeleted($item->product_code, DetailPurchaseRepository::DELETED, $item->quantity));
        }
        DetailPurchase::destroy($deleteItems);
    }
}