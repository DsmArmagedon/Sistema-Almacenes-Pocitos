<?php
     $canUpdate = Auth::user()->can('update',App\Models\User::class);
     $canDestroy = Auth::user()->can('destroy',App\Models\User::class);
    $index = $companyPositions->firstItem();
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
            DESCRIPCION
        </th>
        <th>
            ESTADO
        </th>
        <th>
            ACCIONES
        </th>
    </thead>
    <tbody>

        @foreach ($companyPositions as $companyPosition)
        <tr data-id="{{ $companyPosition->id }}">
            <td>
                {{ $index++ }}
            </td>
            <td>
                {{ $companyPosition->name }}
            </td>
            <td >
                {{ $companyPosition->description }}
            </td>
            <td>
                @if ($companyPosition->status == 1 )
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
                @if($canUpdate)
                <a class="btn btn-info btn-sm btn-action edit" 
                    data-url="{{route('companies-positions.edit',[$companyPosition->id])}}" data-route="{{route('companies-positions.update',[$companyPosition->id])}}">
                    <i class="fa fa-fw fa-edit"></i>
                </a>
                @endif
                @if($canDestroy)
                <a class="btn btn-danger btn-sm btn-action delete"
                    data-name="{{$companyPosition->name}}"
                    data-url="{{route('companies-positions.destroy',[$companyPosition->id])}}">
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
        @slot('pagination',$companyPositions->onEachSide(2)->links())
        @slot('currentPage', $companyPositions->currentPage())
        @slot('total', $companyPositions->total())
        @endcomponent
    </div>
</div>