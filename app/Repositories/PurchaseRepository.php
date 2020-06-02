<?php

namespace App\Repositories;

use App\Models\Code;
use App\Models\DetailPurchase;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;

class PurchaseRepository extends BaseRepository
{
    /**
     * Permite enviar una instancia de la clase Purchase a BaseRepository
     *
     * @return Purchase Purchase
     */
    public function getModel()
    {
        return new Purchase();
    }

    /**
     * Permite crear una instancia de la clase Purchase.
     *
     * @return Purchase Purchase
     */
    public function purchase()
    {
        $instance = new Purchase();
        return $instance;
    }

    /**
     * Permite obtener la lista de compras
     * 
     * @param Request $request
     * return Collection $purchases
     */
    public function getListPurchase($request, $fields = null)
    {
        $purchases = $this->purchase();

        $purchases = $purchases->search($request)->fields($fields)->orderBy('date','DESC');
        $total = $purchases->sum('total');
        return array($purchases->paginate($request->per_page ?? 15 ) , number_format($total,2,',','.'));
    }

    public function getEditPurchase($id) {
        $purchase = $this->purchase();
        $purchase = $purchase->withLoad(new DetailPurchase(), 'detailPurchases','product_code,import,quantity')
        ->withLoad(new Product(),'detailPurchases.product','code,description,unit');
        return $purchase->findOrFail($id);
    }
    /**
     * Permite llenar los datos para crear  una nueva compra
     *
     * @param Request $request
     * @param string $code
     * @return Purchase $purchase
     */
    public function fillModelStore($request, $code) {
        $purchase = $this->purchase();
        $purchase->code = Code::getGenerateCode(Code::PURCHASE, $code);
        $purchase->user_id = Auth()->id();
        return $this->fillModel($request, $purchase);
    }

    /**
     * Permite llenar los datos de la compra por actualizacion
     *
     * @param Request $request
     * @param string $id
     * @return Purchase $purchase
     */
    public function fillModelUpdate($request, $id) {
        $purchase = $this->purchase()->findOrFail($id);
        return $this->fillModel($request, $purchase);
    }

    /**
     * Permite llenar los datos de la Compra.
     * @param  Request $request
     * @param  Purchase $purchase
     * @return Purchase $purchase
     */
    public function fillModel($request, $purchase) {
        $purchase->fill($request->only([
            'date',
            'supplier',
            'description',
            'invoice',
            'taxe_iva',
            'taxe_percep_iva',
            'taxe_iibb_salta',
            'taxe_municipal'
        ]));
        $purchase->total = $this->calculateTotalPurchase($request->products);
        return $purchase;
    }
}