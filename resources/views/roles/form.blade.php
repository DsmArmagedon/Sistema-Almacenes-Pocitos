
    @csrf
    <div class="col-md-3">
        <div class="box box-success">
            <input id="id" type="hidden" name="id" value="{{ $role->id ?? '' }}">
            <div class="form-group initial">
                <label for="name">Nombre *</label>
            <input type="text" class="form-control inp" id="name" name="name" value="{{$role->name ?? ''}}">
            </div>
            <div class="form-group">
                <label for="description">Descripción </label><i> (Opcional) </i>
                <textarea type="text" rows=15 style="resize:none;"
                    class="form-control inp resize-disabled" id="description"
            name="description">{{$role->description ?? ''}}</textarea>
            </div>
            <div class="form-group">
                <label for="status">Estado *</label>
                <label class="container-radio success">Habilitado
                    <input type="radio" checked id="statusH" name="status" value="1" {{ (($role->status ?? 1) == 1) ? 'checked' : '' }}
                        aria-describedby="error_status">
                    <span class="checkmark-radio"></span>
                </label>
                <label class="container-radio warning">Deshabilitado
                    <input type="radio" name="status" value="0" id="statusD" {{ (($role->status ?? 1) == 0) ? 'checked' : ''}}
                        aria-describedby="error_status">
                    <span class="checkmark-radio"></span>
                </label>
            </div>
            <button type="button" class="btn btn-primary btn-block" id="{{ $action }}">Guardar</button>
        <a type="button" href="{{route('roles.index')}}" class="btn btn-default btn-block" id="back" >Atrás</a>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-success">
            <div style="padding:5px;" class="box-header with-border initial">
                <label style="color:#333;" >Permisos *</label>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($permissions as $permission)
                        <?php 
                            $checked = '';
                            if(isset($role->permissions)){
                                $checked = $role->permissions->contains('id',$permission->id) ? 'checked' : '';
                            }
                        ?>
                        <tr>
                            <td style="padding:3px;">
                                <label class="container-checkbox primary">{{ $permission->name }}
                                    <input type="checkbox" value="{{$permission->id}}" {{ $checked }}
                                        name="permissions[]">
                                    <span class="checkmark-checkbox"></span>
                                </label>
                            </td>
                            <td style="padding:3px;">
                                <i>{{$permission->description}}</i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>