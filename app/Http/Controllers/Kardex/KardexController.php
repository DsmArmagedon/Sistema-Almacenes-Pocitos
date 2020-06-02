<?php

namespace App\Http\Controllers\Kardex;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\KardexMonthRequest;
use App\Models\Balance;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MYPDF;
class KardexController extends Controller
{
    protected $productR;
    public function __construct(ProductRepository $productR) {
        $this->productR = $productR;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productR->getListProductCreates();
        return view('kardexs.index')->with('products',$products);
    }
    
    public function getMonth(KardexMonthRequest $request) {
        $balance = Balance::whereMonth('date','<',$request->monthInitial)
                ->whereYear('date','<=',$request->year)
                ->where('product_code',$request->product)
                ->sum('balance');
        $detailPurchases = DB::table('detail_purchases')
                ->join('purchases','purchases.code','=','detail_purchases.purchase_code')
                ->whereMonth('date','>=',$request->monthInitial)
                ->whereMonth('date','<=',$request->monthFinal)
                ->whereYear('date',$request->year)
                ->where('product_code',$request->product)
                ->get(['purchases.code as code','purchases.description as operation','date','product_code','purchases.created_at as created_at',DB::raw('"purchase" as type'),'quantity']);
        $detailSales = DB::table('detail_sales')
                ->join('sales','sales.code','=','detail_sales.sale_code')
                ->whereMonth('date','>=',$request->monthInitial)
                ->whereMonth('date','<=',$request->monthFinal)
                ->whereYear('date',$request->year)
                ->where('product_code',$request->product)
                ->get(['sales.code as code','sales.description as operation','date','product_code','sales.created_at as created_at',DB::raw('"sale" as type'),'quantity']);
        $inputsOutputs = DB::table('inputs_outputs')
                ->whereMonth('date','>=',$request->monthInitial)
                ->whereMonth('date','<=',$request->monthFinal)
                ->whereYear('date',$request->year)
                ->where('product_code',$request->product)
                ->get(['code','operation','date','product_code','type','quantity','created_at']);
        $detail = $detailPurchases->concat($detailSales)->concat($inputsOutputs)->sortBy('created_at');
        $monthInitial = $this->getMonthForNumber($request->monthInitial);
        $monthFinal = $this->getMonthForNumber($request->monthFinal);
        $product = Product::findOrFail($request->product);
        try {
            header('Access-Control-Allow-Origin: *');
            MYPDF::Header();
            MYPDF::Footer();
            MYPDF::SetHeaderMargin(PDF_MARGIN_HEADER);
            MYPDF::SetFooterMargin(PDF_MARGIN_FOOTER);
            MYPDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            MYPDF::AddPage();
            MYPDF::SetFont('courier', 'B', 13);
            MYPDF::Cell(0, 0,'Kardex por Fecha', 0, 1, 'C', 0, '', 0);
            $view = \View::make('pdf.kardex-month')
                    ->with('detail',$detail)
                    ->with('balance',$balance)
                    ->with('product',$product)
                    ->with('monthInitial',$monthInitial)
                    ->with('monthNumberInitial',$request->monthInitial)
                    ->with('monthFinal',$monthFinal)
                    ->with('year',$request->year);
            $html_content = $view->render();
            MYPDF::SetFont('courier', 'I', 9);
            MYPDF::writeHTML($html_content);
            return MYPDF::OutPut('Kardex por meses','I');
        } catch (\Exception $e) {
            throw new CustomException('Error no se puede crear el reporte',400);
        }
    }
    
    
    public function getProducts(Request $request) {
        $products = $this->productR->getListProductReport($request);
        try {
            header('Access-Control-Allow-Origin: *');
            MYPDF::Header();
            MYPDF::Footer();
            MYPDF::SetHeaderMargin(PDF_MARGIN_HEADER);
            MYPDF::SetFooterMargin(PDF_MARGIN_FOOTER);
            MYPDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            MYPDF::AddPage();
            MYPDF::SetFont('courier', 'B', 13);
            MYPDF::Cell(0, 0,'Kardex por Productos', 0, 1, 'C', 0, '', 0);
            $view = \View::make('pdf.kardex-products')->with('products',$products);
            $html_content = $view->render();
            MYPDF::SetFont('courier', 'I', 9);
            MYPDF::writeHTML($html_content);
            return MYPDF::OutPut('Kardex por meses','I');
        } catch (\Exception $e) {
            throw new CustomException('Error no se puede crear el reporte',400);
        }
    }
    
    
}
