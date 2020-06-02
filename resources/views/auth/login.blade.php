<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  @include('layouts.components.head')
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="{{route('login')}}"><b>Comercial </b>MAXIMUS</a>
    </div>
    <div class=" login-box-body">
      <h3 class="login-box-msg">INICIO DE SESION</h3>
      <form action="{{route('login')}}" method="post">
        @csrf
        <div class="form-group has-feedback {{ $errors->has('username') ? 'has-error' : '' }} ">
          <label class="control-label" for="inputError2">Username</label>
          <input type="text" class="form-control" name="username" id="username" aria-describedby="inputError2Status"
            value="{{old('username')}}">
          <span class="glyphicon glyphicon-user form-control-feedback" aria-hidden="true"></span>
          @if($errors->has('username'))
          <span id="hpUsername" class="help-block">{!! $errors->first('username') !!}</span>
          @endif
        </div>
        <div class="form-group has-feedback  {{ $errors->has('password') ? 'has-error' : '' }} ">
          <label class="control-label" for="inputError2">Contraseña</label>
          <input type="password" class="form-control" id="password" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @if($errors->has('password'))
          <span id="hpPassword" class="help-block">{!! $errors->first('password') !!}</span>
          @endif
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  @include('layouts.components.scripts')
  <script src="{{ asset('js/scripts/login.js') }}"></script>

</html>