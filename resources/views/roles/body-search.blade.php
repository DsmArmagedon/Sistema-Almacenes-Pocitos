<input type="hidden" data-url="{{ route('roles.index')}}" id="route-url">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="role_name">Nombre:</label>
                <input type="text" class="form-control" id="role_name" name="role_name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="role_status">Estados:</label>
                <select class="form-control" id="role_status" name="role_status">
                    <option value=""></option>
                    <option value="1">Habilitado</option>
                    <option value="0">Deshabilitado</option>
                </select>
            </div>
        </div>
        <div class="col-md-3" style="height: ">
            <div class="form-group">
                <label for="search">Listar los resultados:</label>
                <button type="submit"  class="btn btn-block btn-primary btn-sm" id="search"
                style="margin-right: 5px;">
                Buscar
                <i class="fa fa-search"></i>
            </button>
            </div>
        </div>

    </div>