@extends('layouts.layout')
@section('css')
<link href="{{ asset('plugins/datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection
@slot('title')
Reporte Compras
@endslot
@section('content')
<div id="container">
    <div class="box-content">
        <div class="box box-primary ">
            {{-- BEGIN BOX HEADER --}}
            <div class="box-header">
                <h1 class="box-title">Reporte de Compras</h1>
            </div>
            {{-- END BOX HEADER --}}

            {{-- BEGIN BOX BODY --}}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('reports.purchases.search')
                    </div>
                </div>
            </div>
            {{-- END BOX BODY --}}
        </div>
        <div class="box box-success">
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ asset('js/scripts/reports.js') }}"></script>
@endsection