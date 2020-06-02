@extends('pdf.layout')
@section('content')
<table>
    <tr>
        <td>
            <b>Código:</b> {{$sale->code}}
        </td>
        <td>
            <b>Fecha:</b> {{$sale->date}}
        </td>
    </tr>
    <tr>
        <td>
            <b>Cliente:</b>{{$sale->client}}
        </td>
        <td>
            <b>Descripción:</b>{{$sale->description}}
        </td>
    </tr>
</table>
<table class="table" >
    <thead>
        <tr>
            <th class="col-58">PRODUCTO</th>
            <th class="col-date">UNIDAD</th>
            <th class="col-input">CANT.</th>
            <th class="col-output">P.U.</th>
            <th class="col-saldo">IMPORTE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sale->detailSales as $product)
        <tr>
            <td class="col-58">
                {{ $product->product->description }}
            </td>
            <td class="col-date">
                {{ $product->product->unit }}
            </td>
            <td class="col-input">
                {{ $product->quantity }}
            </td>
            <td class="col-output">
                {{ number_format($product->price_unit, 2) }}
            </td>
            <td class="col-saldo">
                {{ number_format($product->quantity * $product->price_unit, 2) }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4" ><b>TOTAL:</b> </td>
            <td align="right"><b>{{{$sale->total}}}</b></td>
        </tr>
    </tbody>
</table>
<h3>Almacenes</h3>
<table class="table" >
    <thead>
        <tr>
            <th class="col-78">PRODUCTO</th>
            <th class="col-input">CANT.</th>
            <th class="col-date">UNIDAD</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sale->detailSales as $product)
        <tr>
            <td class="col-78">
                {{ $product->product->description }}
            </td>
            <td class="col-input">
                {{ $product->quantity }}
            </td>
            <td class="col-date">
                {{ $product->product->unit }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop