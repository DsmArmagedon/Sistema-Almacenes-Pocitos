@extends('layouts.layout')
@slot('title')
Productos
@endslot
@section('content')
<div class="box-content">
    <div class="box box-primary collapsed-box box-search">
        {{-- BEGIN BOX HEADER --}}
        <div class="box-header with-border">
            @component('components/header-search')
            @slot('title', 'Lista Productos')
            @endcomponent
        </div>
        {{-- END BOX HEADER --}}

        {{-- BEGIN BOX BODY --}}
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @component('products/body-search')
                    @endcomponent
                </div>
            </div>
        </div>
        {{-- END BOX BODY --}}
    </div>
    <div class="box box-primary">
        @can('store',App\Models\Product::class)
        <div class="box-header with-border">
            <button class="btn btn-success" data-toggle="modal" data-backdrop="static" data-keyboard="false"
                id="agregar" data-url="{{ route('products.store')}}">
                <i class="fa fa-fw fa-plus"></i>
                Agregar
            </button>
        </div>
        @endcan
        <div class="box-body">
            <div id="table-products">
                @component('products/table-products')
                @slot('products', $products)
                @endcomponent
            </div>
        </div>
    </div>
</div>

{{-- BEGIN MODAL CREATE --}}
@component('products/create-edit')
@endcomponent
{{-- END MODAL CREATE --}}
@endsection
@section('scripts')
<script src="{{ asset('js/scripts/products.js') }}"></script>
@endsection