@extends('layouts.layout')
@slot('title')
Usuarios
@endslot
@section('content')
<div class="box-content">
    <div class="box box-primary collapsed-box box-search">
        {{-- BEGIN BOX HEADER --}}
        <div class="box-header with-border">
            @component('components/header-search')
            @slot('title', 'Lista Usuarios')
            @endcomponent
        </div>
        {{-- END BOX HEADER --}}

        {{-- BEGIN BOX BODY --}}
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    @component('users/body-search')
                    @endcomponent
                </div>
            </div>
        </div>
        {{-- END BOX BODY --}}
    </div>
    <div class="box box-primary">
        @can('store',App\Models\User::class)
        <div class="box-header with-border">
            <button class="btn btn-success" data-toggle="modal" data-backdrop="static" data-keyboard="false"
                id="agregar" data-url="{{route('users.store')}}">
                <i class="fa fa-fw fa-plus"></i>
                Agregar
            </button>
        </div>
        @endcan
        <div class="box-body">
            <div id="table-users">
                @component('users/table-users')
                @slot('users', $users)
                @endcomponent
            </div>
        </div>
    </div>
</div>

{{-- BEGIN MODAL CREATE --}}
@component('users/create-edit')
@slot('roles', $roles)
@slot('companyPositions', $companyPositions)
@endcomponent
{{-- END MODAL CREATE --}}
{{-- BEGIN MODAL SHOW --}}
@include('users.show')
{{-- END MODAL SHOW --}}
@endsection
@section('scripts')

<script src="{{ asset('js/scripts/users.js') }}"></script>
@endsection