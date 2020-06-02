<?php
use App\Models\InputOutput;
     $canShow = Auth::user()->can('show', App\Models\InputOutput::class);
     $canUpdate = Auth::user()->can('update',App\Models\InputOutput::class);
     $canDestroy = Auth::user()->can('destroy',App\Models\InputOutput::class);
    $index = $inputsOutputs->firstItem();
?>
<table class="table table-striped text-center-th text-center-td">
    <thead>
        <th >
            NRO
        </th>
        <th>
            CODIGO
        </th>
        <th>
            FECHA
        </th>
        <th>
           MOVIMIENTO
        </th>
        <th >
            OPERACION
        </th>
        <th>
            CANTIDAD
        </th>
        <th>
            UNIDAD
        </th>
        <th>
            ACCIONES
        </th>
    </thead>
    <tbody>

        @foreach ($inputsOutputs as $inputOutput)
        <tr data-id="{{ $inputOutput->code }}" class="accordion-toggle">
            <td rowspan="2">
                {{ $index++ }}
            </td>
            <td>
                {{ $inputOutput->code }}
            </td>
            <td>
                {{ $inputOutput->date }}
            </td>
            <td>
                
                @if($inputOutput->type === InputOutput::INPUT)
                    Entrada
                @else
                    Salida
                @endif
            </td>
            <td>
                {{ $inputOutput->operation }}
            </td>
            <td align="right">
                {{  $inputOutput->quantity }}
            </td>
            <td >
                {{  $inputOutput->product->unit }}
            </td>
            <td class="td-actions" rowspan="2">
                @if($canShow)
                <a class="btn btn-warning btn-sm btn-action collapse-show" data-toggle="collapse" data-target="#collapse{{$inputOutput->code}}" aria-expanded="false">
                    <i class="fa fa-fw fa-eye"></i>
                </a>
                @endif
                @if($inputOutput->isUpdatedOrDeleted())
                @if($canUpdate)
                <a class="btn btn-info btn-sm btn-action edit" data-url="{{route('inputs-outputs.show',[$inputOutput->code])}}">
                    <i class="fa fa-fw fa-edit"></i>
                </a>
                @endif
                @if($canDestroy)
                <a class="btn btn-danger btn-sm btn-action delete" data-code="{{$inputOutput->code}}" data-type="{{$inputOutput->type}}"
                    data-url="{{route('inputs-outputs.destroy',[$inputOutput->code])}}">
                    <i class="fa fa-fw fa-trash"></i>
                </a>
                @endif
                @endif
            </td>
            <tr class="tr-hidden">
                <td colspan="5">
                    <div id="collapse{{$inputOutput->code}}" class="collapse" aria-expanded="false">
                        <b>PRODUCTO:</b> 
                        <ul style="list-style-type:none">
                            <li style="none">
                                <i>CODIGO:</i> {{ $inputOutput->product_code }}
                            </li>
                            <li>
                                <i>DESCRIPCION:</i> {{ $inputOutput->product->description }}
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-md-12">
        @component('components/pagination')
        @slot('pagination',$inputsOutputs->onEachSide(2)->links())
        @slot('currentPage', $inputsOutputs->currentPage())
        @slot('total', $inputsOutputs->total())
        @endcomponent
    </div>
</div>