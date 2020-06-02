@extends('layouts.layout')
@section('css')
<link href="{{ asset('plugins/datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@endsection
@slot('title')
Entradas y Salidas
@endslot
@section('content')
<div id="container">
    <div class="box-content">
        <div class="box box-primary collapsed-box box-search">
            {{-- BEGIN BOX HEADER --}}
            <div class="box-header with-border">
                @component('components/header-search')
                @slot('title', 'Lista Entradas y Salidas de Inventario')
                @endcomponent
            </div>
            {{-- END BOX HEADER --}}

            {{-- BEGIN BOX BODY --}}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="formSearch">
                            @component('inputs-outputs/body-search')
                            @endcomponent
                        </form>
                    </div>
                </div>
            </div>
            {{-- END BOX BODY --}}
        </div>
        <div class="box box-success">
            @can('store',App\Models\InputOutput::class)
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-2">
                        <a class="btn btn-success" id="agregar" data-toggle="modal" data-url="{{route('inputs-outputs.store')}}" data-create="{{route('inputs-outputs.create')}}">
                            <i class="fa fa-fw fa-plus"></i>
                            Agregar
                        </a>
                    </div>
                </div>
            </div>
            @endcan
            <div class="box-body">
                <div id="table-inputs-outputs">
                    @component('inputs-outputs/table-inputs-outputs')
                    @slot('inputsOutputs',$inputsOutputs)
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
{{-- BEGIN MODAL CREATE --}}
@component('inputs-outputs/create-edit')
@slot('products',$products)
@endcomponent
{{-- END MODAL CREATE --}}
@endsection
@section('scripts')
<script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>
<script src="{{ asset('js/scripts/inputs-outputs.js') }}"></script>
@endsection