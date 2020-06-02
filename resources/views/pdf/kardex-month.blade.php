<?php
$index = 1;
$saldo = $balance;
?>
@extends('pdf.layout')
@section('content')
<div>
    <b>Código:</b> {{$product->code}}<br>
    <b>Producto:</b> {{$product->description}}<br>
    <b>Unidad:</b>{{$product->unit}}<br>
    <b>Año:</b>{{$year}}<br>
    @if($monthInitial === $monthFinal)
    <b>Periodo:</b>{{$monthInitial}}<br>
    @else
    <b>Periodo:  </b> Desde {{$monthInitial}} Hasta {{$monthFinal}}<br>
    @endif
</div>
<table class="table table-pruebas" >
    <thead>
        <tr>
            <th class="col-nro">NRO.</th>
            <th class="col-date">FECHA</th>
            <th class="col-operation">DESCRIPCION MOVIMIENTO</th>
            <th class="col-type">T.M.</th>
            <th class="col-input">ENTRADA</th>
            <th class="col-output">SALIDA</th>
            <th class="col-saldo" >SALDO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="col-nro">{{ $index++ }}</td>
            <td class="col-date">{{$year}}-{{str_pad($monthNumberInitial,2,0,STR_PAD_LEFT)}}-01</td>
            <td class="col-operation">Saldo Inicial</td>
            <td class="col-type">E</td>
            <td class="col-input">{{ $balance }}</td>
            <td class="col-output">0</td>
            <td class="col-saldo">{{ $saldo }}</td>
        </tr>
        @foreach($detail as $item)
        <tr>
            <td class="col-nro">{{ $index++ }}</td>
            <td class="col-date">{{ $item->date }}</td>
            <td class="col-operation">{{ $item->operation }}</td>
            <td class="col-type">
            @switch($item->type)
            @case('purchase' )
                C
            @break

            @case('input')
            E
            @break
            @case('output')
            S
            @break
            @case('sale')
            V
            @break
            @endswitch
            </td>
            <td class="col-input">
                @if($item->type === 'input' ||$item->type === 'purchase')
                    {{ $item->quantity }}
                    <?php $saldo += $item->quantity  ?>
                @else 
                 0
                @endif
            </td>
            <td class="col-output">
                @if($item->type === 'output' ||$item->type === 'sale')
                <?php $saldo -= $item->quantity  ?>
                    {{ $item->quantity }}
                @else 
                 0
                @endif
            </td>
            <td class="col-saldo">
                {{ $saldo }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="6"><b>Saldo Final</b></td>
            <td style="text-align:right"><b>{{ $saldo }}</b></td>
        </tr>
    </tbody>
</table>
@stop