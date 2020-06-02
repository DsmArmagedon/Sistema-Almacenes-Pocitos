@extends('layouts.layout')
@slot('title')
Compras
@endslot
@section('content')
<div class="box-content">
    <div class="box box-primary box-search">
        <div class="box-header with-border">
            <h1 class="box-title">Compra</h1>
            
        </div>
    </div>
    <div class="box box-container">
        <div class="box-body">
            <div class="row">
                <div class="col-md-5 col-md-offset-3">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>CODIGO:</b> <span>{{$purchase->code}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>FECHA:</b> <span>{{ $purchase->date }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>NUMERO DE FACTURA:</b> <span>{{ $purchase->invoice }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>PROVEEDOR:</b> <span> {{ $purchase->supplier }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>DESCRIPCION:</b> <span> {{ $purchase->description }}</span>
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
                    @foreach ($purchase->detailPurchases as $product)
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
                            {{ number_format($product->import / $product->quantity, 2,',','.') }}
                        </td>
                        <td align="right">
                            {{ number_format($product->import, 2,',','.') }}
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" align="center"><b>TOTAL:</b> </td>
                        <td align="right"><b>{{{$purchase->total}}}</b></td>
                    </tr>
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
                <a type="button" href="{{route('purchases.index')}}" class="btn btn-default" id="back">Atrás</a>
        </div>
    </div>
</div>

@endsection