{{-- LOGO --}}
<a href="index2.html" class="logo">
    {{-- MINI LOGO PARA MINIMIZAR EL SIDEBAR 50 X 50 PIXELES --}}
    <span class="logo-mini"><b>C</b>M</span>
    {{-- LOGO PARA EL ESTADO REGULAR Y DISPOSITIVOS MOVILES --}}
    <span class="logo-lg"><b>Comercial </b>MAXIMUS</span>
</a>
<nav class="navbar navbar-static-top">
    {{-- BOTON DE NAVEGACIÓN: MUESTRA Y OCULTA EL SIDEBAR --}}
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="hidden-xs">{{ Auth::user()->full_name}}</span>
                </a>
                <ul class="dropdown-menu">
                    {{-- DATOS DEL USUARIO --}}
                    {{-- BEGIN MENU HEADER --}}
                    <li class="user-header">
                        <p>
                            {{ Auth::user()->full_name}}
                        <small>{{Auth::user()->role->name}}</small>
                        </p>
                    </li>
                    {{-- END MENU HEADER --}}

                    {{-- BEGIN MENU BODY --}}
                    <li class="user-body">
                        <div class="row ">
                            <div class="col-xs-12 btn-div">
                                <a  class="btn btn-default btn-block btn-flat" href="{{route('users.profile')}}">
                                    <i class="fa fa-fw fa-user"></i>
                                    Perfíl
                                </a>
                            </div>
                            <div class="col-xs-12 btn-div">
                                <a type="button" class="btn btn-default btn-block" href="{{route('users.change-password-view')}}">
                                    <i class="fa fa-fw fa-key"></i>
                                    Cambiar Contraseña
                                </a>
                            </div>
                        </div>
                    </li>
                    <hr>
                    {{-- END MENU BODY --}}

                    {{-- BEGIN MENU FOOTER --}}
                    <li class="user-footer">
                        <div class="pull-center">
                        <a href="#" class="btn btn-danger btn-block btn-flat" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
                                <i class="fa fa-fw fa-sign-out"></i>
                                Desconectar
                            </a>
                        <form id="formLogout" action="{{ route('logout') }}" method="POST" style="display:none">
                            @csrf
                        </form>
                        </div>
                    </li>
                    {{-- END MENU FOOTER --}}
                </ul>
            </li>
        </ul>
    </div>
</nav>