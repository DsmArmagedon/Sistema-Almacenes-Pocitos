@extends('layouts.layout')
@section('content')
<div id="container">
    <div class="box-content">
        <div class="box box-primary collapsed-box box-search">
            {{-- BEGIN BOX HEADER --}}
            <div class="box-header with-border">
                <h1 class="box-title">Inicio</h1>
            </div>
            {{-- END BOX HEADER --}}

        </div>
        <div class="box box-success">
            <br>
            <br>
            <hr>
            <h3 style="margin-left: 10px">Registros del Usuario por Día</h3>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-cubes"></i></span>
                        
                        <div class="info-box-content">
                            <span class="info-box-text">Compras</span>
                            <span class="info-box-number">{{$quantityPurchases}}</span>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-cart-plus"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Ventas</span>
                            <span class="info-box-number">{{$quantitySales}}</span>
                        </div>
                    </div>
                </div>
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-usd"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Ingresos por Ventas</span>
                            <span class="info-box-number">{{number_format($amountSales,2,',','.')}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

                        <div class="info-box-content">
                             <span class="info-box-text">Egresos por Compras</span>
                            <span class="info-box-number">{{number_format($amountPurchases,2,',','.')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection