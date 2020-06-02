<?php
     $canShow = Auth::user()->can('show',App\Models\Role::class);
     $canUpdate = Auth::user()->can('update',App\Models\Role::class);
     $canDestroy = Auth::user()->can('destroy',App\Models\Role::class);
    $index = $roles->firstItem();
?>
<table class="table table-striped text-center-th">
    <thead>
        <th>
            NRO
        </th>
        <th>
            NOMBRE
        </th>
        <th>
            ESTADO
        </th>
        <th>
            ACCIONES
        </th>
    </thead>
    <tbody>

        @foreach ($roles as  $rol)
        <tr data-id="{{ $rol->id }}">
            <td>
                {{ $index++ }}
            </td>
            <td>
                {{ $rol->name }}
            </td>
            <td>
                @if ($rol->status == 1 )
                <a class="btn btn-xs btn-success ">
                    Habilitado
                </a>
                @else
                <a class="btn btn-xs btn-danger">
                    Deshabilitado
                </a>
                @endif
            </td>
            <td class="td-actions">
                @if($canShow)
                    <a class="btn btn-warning btn-sm btn-action detail" data-url="{{route('roles.show',[$rol->id])}}">
                        <i class="fa fa-fw fa-eye"></i>
                    </a>
                @endif
                @if($canUpdate)
                <a class="btn btn-info btn-sm btn-action edit" 
                    href="{{route('roles.edit',[$rol->id])}}">
                    <i class="fa fa-fw fa-edit"></i>
                </a>
                @endif
                @if($canDestroy)
                <a class="btn btn-danger btn-sm btn-action delete"
                    data-name="{{$rol->name}}"
                    data-url="{{route('roles.destroy',[$rol->id])}}">
                    <i class="fa fa-fw fa-trash"></i>
                </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-md-12">
        @component('components/pagination')
        @slot('pagination',$roles->onEachSide(2)->links())
        @slot('currentPage', $roles->currentPage())
        @slot('total', $roles->total())
        @endcomponent
    </div>
</div>