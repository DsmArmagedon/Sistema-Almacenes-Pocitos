@extends('layouts.layout')
@slot('title')
Roles
@endslot
@section('content')
<div class="box-content">
    <div class="box box-primary collapsed-box box-search">
        {{-- BEGIN BOX HEADER --}}
        <div class="box-header with-border">
            @component('components/header-search')
            @slot('title', 'Lista Roles')
            @endcomponent
        </div>
        {{-- END BOX HEADER --}}

        {{-- BEGIN BOX BODY --}}
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @component('roles/body-search')
                    @endcomponent
                </div>
            </div>
        </div>
        {{-- END BOX BODY --}}
    </div>
    <div class="box box-success">
        @can('store',App\Models\Role::class)
        <div class="box-header with-border">
            <a class="btn btn-success" id="agregar" href="{{route('roles.create')}}">
                <i class="fa fa-fw fa-plus"></i>
                Agregar
            </a>
        </div>
        @endcan
        <div class="box-body">
            <div id="table-roles">
                @component('roles/table-roles')
                @slot('roles', $roles)
                @endcomponent
            </div>
        </div>
    </div>
</div>
{{-- BEGIN MODAL SHOW --}}
@include('roles.show')
{{-- END MODAL SHOW --}}
@endsection
@section('scripts')
<script src="{{ asset('js/scripts/roles.js') }}"></script>
@endsection