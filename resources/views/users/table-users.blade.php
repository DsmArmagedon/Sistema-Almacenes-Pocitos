<?php
    $canShow = Auth::user()->can('show',App\Models\User::class);
    $canUpdate = Auth::user()->can('update',App\Models\User::class);
    $canDestroy = Auth::user()->can('destroy',App\Models\User::class);
    $index = $users->firstItem();
?>
<table class="table table-striped text-center-th">
    <thead>
        <th>
            NRO
        </th>
        <th>
            EMAIL
        </th>
        <th>
            NOMBRES
        </th>
        <th>
            APELLIDOS
        </th>
        <th>
            ROL
        </th>
        <th>
            ESTADO
        </th>
        <th>
            ACCIONES
        </th>
    </thead>
    <tbody>

        @foreach ($users as $user)
        <tr data-id="{{ $user->id }}">
            <td>
                {{ $index++ }}
            </td>
            <td>
                {{ $user->email }}
            </td>
            <td >
                {{ $user->first_name }}
            </td>
            <td >
                {{ $user->last_name }}
            </td>
            <td>
                {{ $user->role->name }}
            </td>
            <td>
                @if ($user->status == 1 )
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
                    <a class="btn btn-warning btn-sm btn-action detail" data-url="{{route('users.show',[$user->id])}}" >
                        <i class="fa fa-fw fa-eye"></i>
                    </a>
                @endif
                @if($canUpdate)
                <a class="btn btn-info btn-sm btn-action edit" 
                    data-url="{{route('users.edit',[$user->id])}}" data-route="{{route('users.update',[$user->id])}}">
                    <i class="fa fa-fw fa-edit"></i>
                </a>
                @endif
                @if($canDestroy)
                <a class="btn btn-danger btn-sm btn-action delete"
                    data-firstName="{{$user->first_name}}" data-lastName="{{$user->last_name}}"
                    data-url="{{route('users.destroy',[$user->id])}}">
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
        @slot('pagination',$users->onEachSide(2)->links())
        @slot('currentPage', $users->currentPage())
        @slot('total', $users->total())
        @endcomponent
    </div>
</div>