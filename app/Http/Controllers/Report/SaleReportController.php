<?php

namespace App\Http\Controllers\Report;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Repositories\DetailSaleRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use App\Http\Requests\DateSaleReportRequest;
use MYPDF;
class SaleReportController extends Controller
{
    protected $saleR;
    protected $productR;
    protected $detailSaleR;
    public function __construct(SaleRepository $saleR, ProductRepository $productR, DetailSaleRepository $detailSaleR) {
        $this->saleR = $saleR;
        $this->productR = $productR;
        $this->detailSaleR = $detailSaleR;
    }
    public function getSaleForProducts(DateSaleReportRequest $request) {
        list($saleForProducts,$period) = $this->productR->getSaleForProducts($request);
        try {
            header('Access-Control-Allow-Origin: *');
            MYPDF::Header();
            MYPDF::Footer();
            MYPDF::SetHeaderMargin(PDF_MARGIN_HEADER);
            MYPDF::SetFooterMargin(PDF_MARGIN_FOOTER);
            MYPDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            MYPDF::AddPage();
            MYPDF::SetFont('courier', 'B', 13);
            MYPDF::Cell(0, 0,'Reporte de Ventas por Productos', 0, 1, 'C', 0, '', 0);
            $view = \View::make('pdf.sales-products')
                    ->with('period', $period)
                    ->with('saleForProducts',$saleForProducts);
            $html_content = $view->render();
            MYPDF::SetFont('courier', 'I', 9);
            MYPDF::writeHTML($html_content);
            MYPDF::OutPut('venta-por-productos.pdf','D');
        } catch (\Exception $e) {
            throw new CustomException('Error no se puede crear el reporte',400);
        }
        }
}
