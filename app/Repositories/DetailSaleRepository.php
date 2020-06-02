<?php

namespace App\Repositories;

use App\Events\DetailSaleCreatedUpdatedDeleted;
use App\Models\DetailSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailSaleRepository extends BaseRepository
{
    const CREATED = 'created';
    const UPDATED = 'updated';
    const DELETED = 'deleted';
    /**
     * Permite enviar una instancia de la clase DetailSaleRepository a BaseRepository
     *
     * @return DetailSale DetailSale
     */
    public function getModel()
    {
        return new DetailSale();
    }

    /**
     * Permite crear una instancia de la clase DetailSale.
     *
     * @return DetailSale DetailSale
     */
    public function detailSale()
    {
        $instance = new DetailSale();
        return $instance;
    }

        /**
     * Permite llenar los datos del detalle de la venta.
     * @param  Request $request
     * @param DetailSale $item
     * @return DetailSale $item
     * 
     */
    public function fillModel($request, $item) {
        $item->product_code = $request->product_code;
        $item->price_unit = $request->price_unit;
        $item->quantity = $request->quantity;
        return $item;
    }
    
    public function fillModelStore($request, $sale_code) {
        $item = $this->detailSale();
        $item->code = $sale_code.'.'.$request->product_code;
        $item->sale_code = $sale_code;
        return $this->fillModel($request,$item);
    }

    public function fillModelUpdate($request, $id) {
        $item = $this->detailSale()->find($id);
        if(!is_null($item)) {
            return $this->fillModel($request, $item);
        }
        return $item;
    }

    public function deleteItems($saleCode, $newDetail) {
        $deleteItems = [];
        $detail = DetailSale::where('sale_code', $saleCode)->pluck('product_code')->toArray();
        $diffDetail = array_diff($detail, $newDetail);
        foreach($diffDetail as $productCode) {
            $itemCode = $saleCode.'.'.$productCode;
            array_push($deleteItems, $itemCode);
            $item = DetailSale::findOrFail($itemCode);
            event(new DetailSaleCreatedUpdatedDeleted($item->product_code, DetailSaleRepository::DELETED, $item->quantity));
        }
        DetailSale::destroy($deleteItems);
    }
}