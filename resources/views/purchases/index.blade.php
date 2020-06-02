@extends('layouts.layout')
@section('css')
<link href="{{ asset('plugins/datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection
@slot('title')
Compras
@endslot
@section('content')
<div id="container">
    <div class="box-content">
        <div class="box box-primary collapsed-box box-search">
            {{-- BEGIN BOX HEADER --}}
            <div class="box-header with-border">
                @component('components/header-search')
                @slot('title', 'Lista Compras')
                @endcomponent
            </div>
            {{-- END BOX HEADER --}}

            {{-- BEGIN BOX BODY --}}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="formSearch">
                            @component('purchases/body-search')
                            @endcomponent
                        </form>
                    </div>
                </div>
            </div>
            {{-- END BOX BODY --}}
        </div>
        <div class="box box-success">
            @can('store',App\Models\Purchase::class)
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-2">
                        <a class="btn btn-success" id="agregar" href="{{route('purchases.create')}}">
                            <i class="fa fa-fw fa-plus"></i>
                            Agregar
                        </a>
                    </div>
                    <div class="col-md-6">
                        <span style="font-size: 25px"> Total Compras: <span style="background-color: #00c0ef; border-radius: 5px; color:white; margin: 3px;padding:3px;" id="totale">$ {{$total}}</span></span>
                    </div>
                </div>
            </div>
            @endcan
            <div class="box-body">
                <div id="table-purchases">
                    @component('purchases/table-purchases')
                    @slot('purchases',$purchases)
                    @endcomponent
                </div>
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