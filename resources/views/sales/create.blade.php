@extends('layouts.layout')
@section('css')
<link href="{{ asset('plugins/datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection
@slot('title')
Ventas
@endslot
@section('content')
<div id="container">
<div class="box-content">
    <div class="box box-primary box-search">
        <div class="box-header with-border">
            <h1 class="box-title">Crear Venta</h1>
        </div>
    </div>
    <div class="box box-container">
        <div class="box-body">
            <div class="row">
                <form data-url="{{route('sales.store')}}" id="formSale" method="POST">
                    @component('sales/form')
                    @slot('code', $code)
                    @slot('products',$products)
                    @slot('action','store')
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ asset('js/scripts/sales.js') }}"></script>
@endsection