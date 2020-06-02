<?php

namespace App\Http\Controllers\Report;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Http\Requests\DatePurchaseReportRequest;
use MYPDF;

class PurchaseReportController extends Controller {

    protected $productR;

    public function __construct(ProductRepository $productR) {
        $this->productR = $productR;
    }

    public function getPurchaseForProducts(DatePurchaseReportRequest $request) {
        list($purchaseForProducts, $period) = $this->productR->getPurchaseForProducts($request);
        try {
            header('Access-Control-Allow-Origin: *');
            MYPDF::Header();
            MYPDF::Footer();
            MYPDF::SetHeaderMargin(PDF_MARGIN_HEADER);
            MYPDF::SetFooterMargin(PDF_MARGIN_FOOTER);
            MYPDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            MYPDF::AddPage();
            MYPDF::SetFont('courier', 'B', 13);
            MYPDF::Cell(0, 0, 'Reporte de Compras por Productos', 0, 1, 'C', 0, '', 0);
            $view = \View::make('pdf.purchases-products')
                    ->with('period', $period)
                    ->with('purchaseForProducts', $purchaseForProducts);
            $html_content = $view->render();
            MYPDF::SetFont('courier', 'I', 9);
            MYPDF::writeHTML($html_content);
            MYPDF::OutPut('compra-por-productos.pdf', 'D');
        } catch (\Exception $e) {
            throw new CustomException('Error no se puede crear el reporte', 400);
        }
    }

}
