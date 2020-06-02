<section class="sidebar" style="height: 782px; overflow: hidden; width: auto;">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu tree" data-widget="tree">
        <li class="{{request()->is('/') ? 'active' : ''}}">
            <a href="{{url('/')}}"><i class="fa fa-home"></i> <span>Inicio</span></a>
        </li>
        <li class="treeview {{request()->is('administracion/*') ? 'active' : ''}}">
            <a href="#">
                <i class="fa fa-users"></i>
                <span>Administración</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu" style="{{request()->is('administracion/*') ? 'display:block' :'display:none'}}">
                @can('index',App\Models\User::class)
                <li class="{{ request()->is('administracion/usuarios') ? 'active' : ''}}">
                    <a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i> Usuarios</a>
                </li>
                @endcan
                <li class="treeview lv {{ request()->is('administracion/roles/*') ? 'menu-open ' : ''}}">
                    <a href="#"><i class="fa fa-circle-o"></i> Roles
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu"
                        style="{{request()->is('administracion/roles/*') ? 'display:block' :'display:none'}}">
                         @can('store',App\Models\Role::class)
                        <li class="{{ request()->is('administracion/roles/crear') ? 'active' : ''}}">
                            <a href="{{route('roles.create')}}"><i class="fa fa-circle-o">
                                </i> Crear
                            </a>
                        </li>
                        @endcan
                        @can('index',App\Models\Role::class)
                        <li class="{{ request()->is('administracion/roles/listar*') ? 'active' : ''}}">
                            <a href="{{route('roles.index')}}"><i class="fa fa-circle-o">
                                </i> Listar
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                 @can('index',App\Models\User::class)
                <li class="{{ request()->is('administracion/cargos') ? 'active' : ''}}">
                    <a href="{{route('companies-positions.index')}}"><i class="fa fa-circle-o"></i> Cargos</a>
                </li>
                @endcan
            </ul>
        </li>
        @can('index',App\Models\Product::class)
        <li class="{{request()->is('productos') ? 'active' : ''}}">
            <a href="{{route('products.index')}}"><i class="fa fa-bookmark"></i> <span>Productos</span></a>
        </li>
        @endcan
        <li class="treeview {{request()->is('compras/*') ? 'active' : ''}}">
            <a href="#">
                <i class="fa fa-cubes"></i>
                <span>Compras</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu" style="{{request()->is('compras/*') ? 'display:block' :'display:none'}}">
                @can('store',App\Models\Purchase::class)
                <li class="{{ request()->is('compras/crear') ? 'active' : ''}}">
                    <a href="{{route('purchases.create')}}"><i class="fa fa-circle-o"></i> Crear</a>
                </li>
                @endcan
                @can('index',App\Models\Purchase::class)
                <li class="{{ request()->is('compras/listar') ||request()->is('compras/C-*') ? 'active' : ''}}">
                    <a href="{{route('purchases.index')}}"><i class="fa fa-circle-o"></i> Listar</a>
                </li>
                @endcan
            </ul>
        </li>
        <li class="treeview {{request()->is('ventas/*') ? 'active' : ''}}">
            <a href="#">
                <i class="fa fa-cart-plus"></i>
                <span>Ventas</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu" style="{{request()->is('ventas/*') ? 'display:block' :'display:none'}}">
                @can('store',App\Models\Sale::class)
                <li class="{{ request()->is('ventas/crear') ? 'active' : ''}}">
                    <a href="{{route('sales.create')}}"><i class="fa fa-circle-o"></i> Crear</a>
                </li>
                @endcan
                @can('index',App\Models\Sale::class)
                <li class="{{ request()->is('ventas/listar') ||request()->is('ventas/V-*') ? 'active' : ''}}">
                    <a href="{{route('sales.index')}}"><i class="fa fa-circle-o"></i> Listar</a>
                </li>
                @endcan
            </ul>
        </li>
        @can('index',App\Models\InputOutput::class)
        <li class="{{request()->is('entradas-salidas') ? 'active' : ''}}">
            <a href="{{route('inputs-outputs.index')}}"><i class="fa fa-balance-scale"></i> <span>Entradas y Salidas</span></a>
        </li>
        @endcan
        <li class="{{request()->is('kardex') ? 'active' : ''}}">
            <a href="{{route('kardexs.index')}}"><i class="fa fa-file"></i> <span>Kardex</span></a>
        </li>
        <li class="treeview {{request()->is('reportes/*') ? 'active' : ''}}">
            <a href="#">
                <i class="fa fa-file-archive-o"></i>
                <span>Reportes</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu" style="{{request()->is('reportes/*') ? 'display:block' :'display:none'}}">
<!--                @can('index',App\Models\User::class)-->
                <li class="{{ request()->is('reportes/ventas') ? 'active' : ''}}">
                    <a href="{{route('reports.sales')}}"><i class="fa fa-circle-o"></i> Ventas</a>
                </li>
                <li class="{{ request()->is('reportes/compras') ? 'active' : ''}}">
                    <a href="{{route('reports.purchases')}}"><i class="fa fa-circle-o"></i> Compras</a>
                </li>
<!--                @endcan -->
            </ul>
        </li>
    </ul>
</section>