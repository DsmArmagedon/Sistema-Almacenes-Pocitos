
@extends('layouts.layout')
@slot('title')
Perfil
@endslot
@section('content')

<div class="col-md-4">
    <div class="box-content">
        <div class="box box-primary box-search">
            <div class="box-header with-border">
                <h1 class="box-title">Perfil</h1>
            </div>
        </div>
        <div class="box box-container">
            <div class="box-body box-profile">
                <h3 class="profile-username text-center">{{$user->full_name}}</h3>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Rol:</b> <a class="pull-right">{{$user->role->name}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Username:</b> <a class="pull-right">{{$user->username}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Email:</b> <a class="pull-right">{{$user->email}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Datos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i> Cargo</strong>

            <p class="text-muted">
                {{$user->companyPosition->name}}
            </p>

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i> Dirección</strong>

            <p class="text-muted">{{$user->address}}</p>

            <hr>

            <strong><i class="fa fa-file-text-o margin-r-5"></i> Teléfono</strong>

            <p>{{ $user->phone }}</p>
        </div>
        <!-- /.box-body -->
    </div>
    
</div>
<div class="col-md-3">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Permisos</h3>
        </div>
        <ul>
            @foreach($permissions as $permission)
            <li><i> {{$permission->name}}</i> </li>
            @endforeach
        </ul>
    </div>
    
</div>
@endsection
<!--@section('scripts')
<script src="{{ asset('js/scripts/users.js') }}"></script>
@endsection-->