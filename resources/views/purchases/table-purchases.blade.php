<?php
     $canShow = Auth::user()->can('show',App\Models\Purchase::class);
     $canUpdate = Auth::user()->can('update',App\Models\Purchase::class);
     $canDestroy = Auth::user()->can('destroy',App\Models\Purchase::class);
    $index = $purchases->firstItem();
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
            NRO. FACTURA
        </th>
        <th>
            PROVEEDOR
        </th>
        <th>
            TOTAL IMPORTE
        </th>
        <th>
            ACCIONES
        </th>
    </thead>
    <tbody>

        @foreach ($purchases as $purchase)
        <tr data-id="{{ $purchase->code }}">
            <td class="td-number">
                {{ $index++ }}
            </td>
            <td>
                {{ $purchase->code }}
            </td>
            <td>
                {{ $purchase->date }}
            </td>
            <td>
                {{ $purchase->invoice }}
            </td>
            <td>
                {{ $purchase->supplier }}
            </td>
            <td align="right">
                {{  $purchase->total }}
            </td>
            <td class="td-actions">
                @if($canShow)
                <a class="btn btn-warning btn-sm btn-action detail"
                    href="{{route('purchases.show',[$purchase->code])}}">
                    <i class="fa fa-fw fa-eye"></i>
                </a>
                @endif
                @if($purchase->isUpdatedOrDeleted())
                @if($canUpdate)
                <a class="btn btn-info btn-sm btn-action edit" data-url="{{route('purchases.edit',[$purchase->code])}}">
                    <i class="fa fa-fw fa-edit"></i>
                </a>
                @endif
                @if($canDestroy)
                <a class="btn btn-danger btn-sm btn-action delete" data-code="{{$purchase->code}}"
                    data-url="{{route('purchases.destroy',[$purchase->code])}}">
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
        @slot('pagination',$purchases->onEachSide(2)->links())
        @slot('currentPage', $purchases->currentPage())
        @slot('total', $purchases->total())
        @endcomponent
    </div>
</div>