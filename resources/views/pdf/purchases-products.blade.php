<?php
$index = 1;
$total = 0;
?>
@extends('pdf.layout')
@section('content')
<div>
    <b>Reporte:</b> Compra de Productos<br>
    <b>Descripción:</b>Reporte de productos comprados en un período.<br>
    <b>Periodo:</b>{{ $period }} <br>
</div>
<table class="table table-pruebas" >
    <thead>
        <tr>
            <th class="col-nro">NRO.</th>
            <th class="col-date">CODIGO</th>
            <th class="col-operation">DESCRIPCION PRODUCTO</th>
            <th class="col-saldo" >UNIDAD</th>
            <th class="col-12">CANTIDAD</th>
            <th class="col-15" >IMPORTE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($purchaseForProducts as $item)
        <?php $total += $item->import; ?>
        <tr>
            <td class="col-nro">{{ $index++ }}</td>
            <td class="col-date">{{ $item->code }}</td>
            <td class="col-operation">{{ $item->description }}</td>
            <td class="col-saldo">{{ $item->unit }}</td>
            <td class="col-12">
                {{ $item->quantity ?? 0 }}
            </td>
            <td class="col-15">
                {{ number_format($item->import,2,',','.') ?? '0,00' }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5"><b>TOTAL VENDIDO</b></td>
            <td style="text-align: right;">{{ number_format($total,2,',','.') }}</td>
        </tr>
    </tbody>
</table>
<sup><i>CANTIDAD: Cantidad comprada del producto durante el período; IMPORTE: Importe pagado por la compra de los productos</i></sup>
@stop