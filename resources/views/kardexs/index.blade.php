@extends('layouts.layout')
@slot('title')
Kardex
@endslot
@section('content')
<div id="container">
    <div class="box-content">
        <div class="box box-primary ">
            {{-- BEGIN BOX HEADER --}}
            <div class="box-header">
                @component('kardexs/header-search')
                @slot('title', 'Kardex')
                @endcomponent
            </div>
            {{-- END BOX HEADER --}}

            {{-- BEGIN BOX BODY --}}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        @component('kardexs/body-search')
                        @slot('products',$products)
                        @endcomponent
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
<script src="{{ asset('js/scripts/kardexs.js') }}"></script>
@endsection