<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{
    /**
     * Permite enviar una instancia de la clase Product a BaseRepository
     *
     * @return Product Product
     */
    public function getModel()
    {
        return new Product();
    }

    /**
     * Permite crear una instancia de la clase Product.
     *
     * @return Product Product
     */
    public function product()
    {
        $instance = new Product();
        return $instance;
    }

    /**
     * Permite obtener la lista de productos
     * 
     * @param Request $request
     * return Collection $products
     */
    public function getListProduct($request, $fields = null)
    {
        $products = $this->product();
        $products = $products->search($request)->fields($fields)->orderBy('updated_at','DESC');
        return $products->paginate($request->per_page );
    }

    public function getListProductCreates()
    {
        $products = $this->product();
        $products = $products->fields('code,description,stock,price,unit');
        return $products->status(self::STATUS_TRUE)->get();
    }
    
    public function getListProductReport($request) {
        return $this->product()->search($request)->fields('code,description,stock,price,unit,status')->orderBy('description','DESC')->get();
    }
    public function getSaleForProducts($request) {
//        $salesForProducts = DB::table('products')
//                ->select('products.code as code_product','products.description as product_description',DB::raw('SUM(detail_sales.quantity) as quantity from sales where sales.date = 2019-09-09'), DB::raw('SUM(detail_sales.quantity * detail_sales.price_unit) as import'))
//                ->leftjoin('detail_sales','products.code','=','detail_sales.product_code')
//                ->groupBy('code_product','products.description')->leftjoin('sales','detail_sales.sale_code','=','sales.code');
        $period = '';
        switch($request->sale_date)
        {
            case Sale::DATE_DAY:
                $date = Carbon::now();
                $subQuery = 'sales.date = '. $date->format('Y-m-d');
                $period = $date->format('d-m-Y');
            break;
            case Sale::DATE_MONTH:
                $year = Carbon::now()->format('Y');
                $month = Carbon::now()->format('m');
                $subQuery = 'YEAR(sales.date) = '.$year.' AND MONTH(sales.date) = '.$month;
                $period = 'Mes: '.$this->getMonthForNumber($month).' Año: '. $year; 
            break;
            case Sale::DATE_YEAR:
                $period = Carbon::now()->format('Y');
                $subQuery = 'YEAR(sales.date) = '.$period;
            break;
            case Sale::DATE_RANGE:
                if(!is_null($request->sale_date_initial) && !is_null($request->sale_date_final))
                {
                    $dateInitial = DateTime::createFromFormat('d-m-Y', $request->sale_date_initial);
                    $dateInitial = $dateInitial->format('Y-m-d');
                    $dateFinal = DateTime::createFromFormat('d-m-Y', $request->sale_date_final);
                    $dateFinal = $dateFinal->format('Y-m-d');
                    $subQuery = 'sales.date BETWEEN "'.$dateInitial.'" AND "'.$dateFinal.'"';
                    $period = 'Desde el '. $request->sale_date_initial .' hasta el '. $request->sale_dale_final;
                }
            break;
            case Sale::DATE_YEAR_MONTH:
                if(!is_null($request->sale_month)) {
                    $year = Carbon::now()->format('Y');
                    $subQuery = 'YEAR(sales.date) = '.$year.' AND MONTH(sales.date) = '.$request->sale_month;
                    $period = 'Mes: '.$this->getMonthForNumber($request->sale_month).' Año: '. $year; 
                }
            break;
        }
        $data = DB::table('products')
                ->select('products.code','products.description','products.unit',
                        DB::raw('(SELECT SUM(detail_sales.quantity) FROM detail_sales INNER JOIN sales ON detail_sales.sale_code = sales.code WHERE (detail_sales.product_code = products.code)AND '.$subQuery.' GROUP BY detail_sales.product_code) as quantity'), 
                        DB::raw('(SELECT SUM(detail_sales.quantity * detail_sales.price_unit) FROM detail_sales INNER JOIN sales ON detail_sales.sale_code = sales.code WHERE (detail_sales.product_code = products.code) AND '.$subQuery.' GROUP BY detail_sales.product_code) as import'));
        return array($data->get(),$period);
    }
    public function getPurchaseForProducts($request) {
        $period = '';
        
        switch($request->purchase_date)
        {
            case Purchase::DATE_DAY:
                $date = Carbon::now();
                $subQuery = 'purchases.date = '. $date->format('Y-m-d');
                $period = $date->format('d-m-Y');
            break;
            case Purchase::DATE_MONTH:
                $year = Carbon::now()->format('Y');
                $month = Carbon::now()->format('m');
                $subQuery = 'YEAR(purchases.date) = '.$year.' AND MONTH(purchases.date) = '.$month;
                $period = 'Mes: '.$this->getMonthForNumber($month).' Año: '. $year; 
            break;
            case Purchase::DATE_YEAR:
                $period = Carbon::now()->format('Y');
                $subQuery = 'YEAR(purchases.date) = '.$period;
            break;
            case Purchase::DATE_RANGE:
                if(!is_null($request->purchase_date_initial) && !is_null($request->purchase_date_final))
                {
                    $dateInitial = DateTime::createFromFormat('d-m-Y', $request->purchase_date_initial);
                    $dateInitial = $dateInitial->format('Y-m-d');
                    $dateFinal = DateTime::createFromFormat('d-m-Y', $request->purchase_date_final);
                    $dateFinal = $dateFinal->format('Y-m-d');
                    $subQuery = 'purchases.date BETWEEN "'.$dateInitial.'" AND "'.$dateFinal.'"';
                    $period = 'Desde el '. $request->purchase_date_initial .' hasta el '. $request->purchase_dale_final;
                }
            break;
            case Purchase::DATE_YEAR_MONTH:
                if(!is_null($request->purchase_month)) {
                    $year = Carbon::now()->format('Y');
                    $subQuery = 'YEAR(purchases.date) = '.$year.' AND MONTH(purchases.date) = '.$request->purchase_month;
                    $period = 'Mes: '.$this->getMonthForNumber($request->purchase_month).' Año: '. $year; 
                }
            break;
        }
        $data = DB::table('products')
                ->select('products.code','products.description','products.unit',
                        DB::raw('(SELECT SUM(detail_purchases.quantity) FROM detail_purchases INNER JOIN purchases ON detail_purchases.purchase_code = purchases.code WHERE (detail_purchases.product_code = products.code)AND '.$subQuery.' GROUP BY detail_purchases.product_code) as quantity'), 
                        DB::raw('(SELECT SUM(detail_purchases.import) FROM detail_purchases INNER JOIN purchases ON detail_purchases.purchase_code = purchases.code WHERE (detail_purchases.product_code = products.code) AND '.$subQuery.' GROUP BY detail_purchases.product_code) as import'));
        return array($data->get(),$period);
    } 
    /**
     * Permite ver en detalle la informacion del producto.
     * 
     * @param Illuminate\Http\Request $request
     * @param int $id
     * @return Model $product
     */
    public function getShowProduct($id)
    {   
        return $this->product()->findOrFail($id);
    }
    /**
     * Permite llenar los datos del Producto.
     * @param  Request $request
     * @param  Product $id
     * @return Product
     */
    public function fillModel($request, $id = null) {
        $product = $this->product();
        if(!is_null($id))
        {
            $product = $product->findOrFail($id);
        } else {
            $product->stock = Product::STOCK_INITIAL;
        }

        $product->fill($request->only([
            'code',
            'description',
            'price',
            'unit',
            'status'
        ]));
        return $product;
    }
    
}