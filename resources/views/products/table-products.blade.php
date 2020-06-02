<?php
     $canShow = Auth::user()->can('show',App\Models\Product::class);
     $canUpdate = Auth::user()->can('update',App\Models\Product::class);
     $canDestroy = Auth::user()->can('destroy',App\Models\Product::class);
    $index = $products->firstItem();
?>
<table class="table table-striped text-center-th">
    <thead>
        <th>
            CODIGO
        </th>
        <th>
            DESCRIPCION
        </th>
        <th>
            PRECIO
        </th>
        <th>
            STOCK
        </th>
        <th>
            UNIDAD
        </th>
        <th>
            ESTADO
        </th>
        <th>
            ACCIONES
        </th>
    </thead>
    <tbody>

        @foreach ($products as $product)
        <tr data-id="{{ $product->code }}">
            <td>
                {{ $product->code }}
            </td>
            <td>
                {{ $product->description }}
            </td>
            <td >
                {{ $product->price }}
            </td>
            <td >
                {{ $product->stock }}
            </td>
            <td>
                {{ $product->unit }}
            </td>
            <td>
                @if ($product->status == 1 )
                <a class="btn btn-xs btn-success ">
                    Habilitado
                </a>
                @else
                <a class="btn btn-xs btn-danger">
                    Deshabilitado
                </a>
                @endif
            </td>
            <td class="td-actions">

                @if($canUpdate)
                <a class="btn btn-info btn-sm btn-action edit" 
                    data-url="{{route('products.edit',[$product->code])}}"  data-route="{{route('products.update',[$product->code])}}">
                    <i class="fa fa-fw fa-edit"></i>
                </a>
                @endif
                @if($canDestroy)
                <a class="btn btn-danger btn-sm btn-action delete"
                    data-description="{{$product->description}}"
                    data-url="{{route('products.destroy',[$product->code])}}">
                    <i class="fa fa-fw fa-trash"></i>
                </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-md-12">
        @component('components/pagination')
        @slot('pagination',$products->onEachSide(2)->links())
        @slot('currentPage', $products->currentPage())
        @slot('total', $products->total())
        @endcomponent
    </div>
</div>