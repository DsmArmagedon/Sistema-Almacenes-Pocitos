<?php
     $canShow = Auth::user()->can('show',App\Models\Sale::class);
     $canUpdate = Auth::user()->can('update',App\Models\Sale::class);
     $canDestroy = Auth::user()->can('destroy',App\Models\Sale::class);
    $index = $sales->firstItem();
?>
<table class="table table-striped text-center-th">
    <thead>
        <th>
            NRO
        </th>
        <th>
            CODIGO
        </th>
        <th>
            FECHA
        </th>
        <th>
            CLIENTE
        </th>
        <th>
            TOTAL
        </th>
        <th>
            ACCIONES
        </th>
    </thead>
    <tbody>

        @foreach ($sales as $sale)
        <tr data-id="{{ $sale->code }}">
            <td class="td-number">
                {{ $index++ }}
            </td>
            <td>
                {{ $sale->code }}
            </td>
            <td>
                {{ $sale->date }}
            </td>
            <td>
                {{ $sale->client }}
            </td>
            <td align="right">
                {{  $sale->total }}
            </td>
            <td class="td-actions">
                @if($canShow)
                <a class="btn btn-warning btn-sm btn-action detail"
                    href="{{route('sales.show',[$sale->code])}}">
                    <i class="fa fa-fw fa-eye"></i>
                </a>
                @endif
                @if($sale->isUpdatedOrDeleted())
                @if($canUpdate)
                <a class="btn btn-info btn-sm btn-action edit" data-url="{{route('sales.edit',[$sale->code])}}">
                    <i class="fa fa-fw fa-edit"></i>
                </a>
                @endif
                @if($canDestroy)
                <a class="btn btn-danger btn-sm btn-action delete" data-code="{{$sale->code}}"
                    data-url="{{route('sales.destroy',[$sale->code])}}">
                    <i class="fa fa-fw fa-trash"></i>
                </a>
                @endif
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-md-12">
        @component('components/pagination')
        @slot('pagination',$sales->onEachSide(2)->links())
        @slot('currentPage', $sales->currentPage())
        @slot('total', $sales->total())
        @endcomponent
    </div>
</div>