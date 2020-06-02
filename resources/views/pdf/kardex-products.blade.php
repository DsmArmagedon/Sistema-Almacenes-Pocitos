<?php
$index = 1;
?>
@extends('pdf.layout')
@section('content')

<table class="table table-pruebas" >
    <thead>
        <tr>
            <th class="col-nro">NRO.</th>
            <th class="col-date">CODIGO</th>
            <th class="col-operation">DESCRIPCION</th>
            <th class="col-input">STOCK</th>
            <th class="col-saldo" >UNIDAD</th>
            <th class="col-output">PRECIO</th>
            <th class="col-type">E*</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td class="col-nro">{{ $index++ }}</td>
            <td class="col-date">{{ $product->code }}</td>
            <td class="col-operation">{{ $product->description }}</td>
            <td class="col-input">{{ $product->stock }}</td>
            <td class="col-saldo">{{ $product->unit }}</td>
            <td class="col-output">{{ $product->price }}</td>
            <td class="col-type">
                @if($product->status == 1)
                    H
                @else
                D
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<sub>* H: Habilitado D: Deshabilitado</sub>
@stop