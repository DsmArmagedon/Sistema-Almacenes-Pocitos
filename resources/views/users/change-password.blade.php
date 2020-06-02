@extends('layouts.layout')
@slot('title')
Contraseña
@endslot
@section('content')
<div class="box-content">
    <div class="box box-primary box-search">
        <div class="box-header with-border">
            <h1 class="box-title">Cambiar Contraseña</h1>
        </div>
    </div>
    <div class="box box-container">
        <div class="box-body">
            <div class="row">
                <div class="col-md-offset-3 col-md-5">
                    
                <form data-url="{{route('users.change-password')}}" id="formChangePassword" method="POST">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Password</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Contraseña Actual *</label>
                                    <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nueva Contraseña *</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Repita la Nueva Contraseña *</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-success" id="changePassword" >Cambiar Contraseña</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/scripts/users.js') }}"></script>
@endsection