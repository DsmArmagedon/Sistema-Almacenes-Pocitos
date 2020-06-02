<?php

namespace App\Repositories;

use App\Models\Code;
use App\Models\Sale;
use App\Models\Product;
use App\Models\DetailSale;
use Illuminate\Http\Request;

class SaleRepository extends BaseRepository {

    /**
     * Permite enviar una instancia de la clase SaleRepository a BaseRepository
     *
     * @return Sale Sale
     */
    public function getModel() {
        return new Sale();
    }

    /**
     * Permite crear una instancia de la clase Sale.
     *
     * @return Sale Sale
     */
    public function sale() {
        $instance = new Sale();
        return $instance;
    }

    /**
     * Permite obtener la lista de ventas
     * 
     * @param Request $request
     * return Collection $sales
     */
    public function getListSale($request, $fields = null) {
        $sales = $this->sale();

        $sales = $sales->search($request)->fields($fields)->orderBy('date', 'DESC');
        $total = $sales->sum('total');
        return array($sales->paginate($request->per_page ?? 15), number_format($total, 2, ',', '.'));
    }

    public function getEditSale($id) {
        $sale = $this->sale();
        $sale = $sale->withLoad(new DetailSale(), 'detailSales', 'product_code,price_unit,quantity')
                ->withLoad(new Product(), 'detailSales.product', 'code,description,unit');
        return $sale->findOrFail($id);
    }

    /**
     * Permite llenar los datos para crear  una nueva venta
     *
     * @param Request $request
     * @param string $id
     * @return Sale $sale
     */
    public function fillModelStore($request, $code) {
        $sale = $this->sale();
        $sale->code = Code::getGenerateCode(Code::SALE, $code);
        $sale->user_id = Auth()->id();
        return $this->fillModel($request, $sale);
    }

    /**
     * Permite llenar los datos de la venta por actualizacion
     *
     * @param Request $request
     * @param string $id
     * @return Sale $sale
     */
    public function fillModelUpdate($request, $id) {
        $sale = $this->sale()->findOrFail($id);
        return $this->fillModel($request, $sale);
    }

    /**
     * Permite llenar los datos de la Venta.
     * @param  Request $request
     * @param  Sale $sale
     * @return Sale $sale
     */
    public function fillModel($request, $sale) {
        $sale->fill($request->only([
                    'date',
                    'client',
                    'description'
        ]));
        $sale->total = $this->calculateTotalSale($request->products);
        return $sale;
    }

    public function isProductEnabled($item) {
        $product = Product::find($item->product_code);
        if (count($item->getOriginal()) === 0) {
            if ($item->quantity <= $product->stock) {
                $product = null;
            }
        } else {

            if ($item->isDirty('quantity')) {
                $stock = $product->stock + $item->getOriginal()['quantity'];
                if ($item->quantity <= $stock) {
                    $product = null;
                }
            } else {
                $product = null;
            }
        }
        return $product;
    }

}
