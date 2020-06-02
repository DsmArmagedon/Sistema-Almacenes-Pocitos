@extends('layouts.layout')
@slot('title')
Ventas
@endslot
@section('content')
<div class="box-content">
    <div class="box box-primary box-search">
        <div class="box-header with-border">
            <h1 class="box-title">Venta</h1>
            <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <a type='button' class="btn btn-success" href="{{ route('sales.getSale',$sale->code) }}" target="_black">Imprimir</a>
          </div>
        </div>
    </div>
    <div class="box box-container">
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-5">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>CODIGO:</b> <span>{{$sale->code}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>FECHA:</b> <span>{{ $sale->date }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>CLIENTE:</b> <span> {{ $sale->client }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>DESCRIPCION:</b> <span> {{ $sale->description }}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">

                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>COD.</th>
                    <th>PRODUCTO</th>
                    <th>UNIDAD</th>
                    <th>CANT.</th>
                    <th>P.U.</th>
                    <th>IMPORTE</th>
                </thead>
                <tbody>
                    @foreach ($sale->detailSales as $product)
                    <tr>
                        <td>
                            {{ $product->product_code }}
                        </td>
                        <td>
                            {{ $product->product->description }}
                        </td>
                        <td>
                            {{ $product->product->unit }}
                        </td>
                        <td align="center">
                            {{ $product->quantity }}
                        </td>
                        <td align="right">
                            {{ number_format($product->price_unit, 2) }}
                        </td>
                        <td align="right">
                            {{ number_format($product->quantity * $product->price_unit, 2) }}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="center"><b>TOTAL:</b> </td>
                        <td align="right"><b>{{{$sale->total}}}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
                <a type="button" href="{{route('sales.index')}}" class="btn btn-default" id="back">Atrás</a>
        </div>
    </div>
</div>

@endsection