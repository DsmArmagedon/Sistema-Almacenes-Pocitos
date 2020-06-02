<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog user" role="document">
        <div class="box box-success">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel"><label id="title"></label> </h3>
                </div>
                <div class="modal-body">
                    <form autocomplete="on" id="formUser">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="first_name">Nombres *</label>
                                    <input type="text" class="form-control inp" id="first_name" name="first_name">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="last_name">Apellidos *</label>
                                    <input type="text" class="form-control inp" id="last_name" name="last_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="input-group" style="width:100%">
                                    <label for="last_name">Username *</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="username" name="username">
                                        <span class="input-group-btn" class="border-right:">
                                            <span class="btn btn-info btn-flat"
                                                style="border-top-right-radius:3px; border-bottom-right-radius:3px"
                                                data-toggle="tooltip" data-placement="right"
                                                title="Formato: El campo Username debe contener entre 7 y 10 letras mayúsculas, seguidas de 3 números. Ej: JUANES123">
                                                <i class="fa fa-info"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="text" class="form-control inp" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div>
                                    <label for="company_position_id">Cargo *</label>
                                    <select class="form-control sel" id="company_position_id" name="company_position_id"
                                        data-placeholder="Seleccione un Cargo">
                                        <option value=""></option>
                                        @foreach ($companyPositions as $companyPosition)
                                        <option value="{{$companyPosition->id}}">{{$companyPosition->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="role_id">Rol *</label>
                                    <select class="form-control sel" id="role_id" name="role_id"
                                        data-placeholder="Seleccione un Rol" aria-describedby="error_role_id">
                                        <option value=""></option>
                                        @foreach ($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="address">Dirección *</label>
                                    <input type="text" class="form-control inp" id="address" name="address">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Telefóno *</label>
                                    <input type="text" class="form-control inp" id="phone" name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label for="status">Estado *</label>
                                </div>
                                <div class="col-md-3 text-left">
                                    <label class="container-radio success">Habilitado
                                        <input type="radio" checked id="statusH" name="status" value="1"
                                            aria-describedby="error_status">
                                        <span class="checkmark-radio"></span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <label class="container-radio warning">Deshabilitado
                                        <input type="radio" name="status" value="0" id="statusD"
                                            aria-describedby="error_status">
                                        <span class="checkmark-radio"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="save">Guardar</button>
            </div>
        </div>
    </div>
</div>