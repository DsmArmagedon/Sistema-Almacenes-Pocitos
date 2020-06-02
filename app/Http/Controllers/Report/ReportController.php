<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    
    public function sales() {
        return view('reports.sales.sales');
    }
    
    public function purchases() {
        return view('reports.purchases.purchases');
    }
}
