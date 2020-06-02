@extends('layouts.layout')
@section('css')
<link href="{{ asset('plugins/datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection
@slot('title')
Compras
@endslot
@section('content')
<div class="box-content">
    <div class="box box-primary box-search">
        <div class="box-header with-border">
            <h1 class="box-title">Crear Compra</h1>
        </div>
    </div>
    <div class="box box-container">
        <div class="box-body">
            <div class="row">
                <form data-url="{{route('purchases.store')}}" action="{{route('purchases.store')}}" id="formPurchase" method="POST">
                    @component('purchases/form')
                    @slot('code', $code)
                    @slot('products',$products)
                    @slot('action','store')
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ asset('js/scripts/purchases.js') }}"></script>
@endsection