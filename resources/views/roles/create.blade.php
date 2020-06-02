@extends('layouts.layout')
@slot('title')
Roles
@endslot
@section('content')
<div class="box-content">
    <div class="box box-primary box-search">
        <div class="box-header with-border">
            <h1 class="box-title">Crear Rol</h1>
        </div>
    </div>
    <div class="box box-container">
        <div class="box-body">
            <div class="row">
                <form data-url="{{route('roles.store')}}" id="formRole" method="POST">
                    @component('roles/form')
                    @slot('permissions',$permissions)
                    @slot('action','store')
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