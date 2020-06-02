@extends('layouts.layout')
@slot('title')
Roles
@endslot
@section('content')
<div class="box-content">
    <div class="box box-primary box-search">
        <div class="box-header with-border">
            <h1 class="box-title">Editar Rol</h1>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <form data-url="{{route('roles.update',['id'=> $role->id])}}" id="formRole" method="POST">
                    @component('roles/form')
                    @slot('role',$role)
                    @slot('permissions',$permissions)
                    @slot('action','update')
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/scripts/roles.js') }}"></script>
@endsection