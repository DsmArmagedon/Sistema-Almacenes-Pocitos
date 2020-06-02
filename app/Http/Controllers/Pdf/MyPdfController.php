<?php
namespace App\Http\Controllers\Pdf;

use PDF;
class MyPdfController extends PDF
{
    public static function Header() {
        PDF::setHeaderCallback(function ($pdf) {
            // Logotipo
//            $image_file = 'images/logo.jpg';
//            $pdf->Image($image_file, 20, 10, 26, '', 'JPG', '', 'T', false, 400, '', false, false, 0, false, false, false);
            // Fuente
            $pdf->SetFont('helvetica', 'B', 13);
            // Titulo
            $pdf->Cell(0, 0, 'COMERCIAL MAXIMUS', 0, 1, 'R', 0, '', 0);
            // Fuente
            $pdf->SetFont('times', 'B', 9);
            // Datos Adicionales
//            $pdf->Cell(0, 0, 'Calle: La madrid 224 - Telf: 6633870 Laboratorio - Emergencias Cel.: 70220584 - 72944483', 0, 1, 'R', 0, '', 0);
            $pdf->Cell(0, 0, 'POCITOS - ARGENTINA', 0, 1, 'R', 0, '', 0);
            // Linea
            $style2 = array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
            $pdf->Line(15, 15, 195, 15, $style2);
        });
    }
    public static function Footer() {
        PDF::setFooterCallback(function ($pdf) {
        // Position at 15 mm from bottom
        $pdf->SetY(-15);
        // Set font
        $pdf->SetFont('helvetica', 'I', 8);
        // Page number
        $pdf->Cell(0, 10, 'Página '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });
    }
}
