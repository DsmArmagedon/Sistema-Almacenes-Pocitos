<input type="hidden" data-url="{{ route('users.index')}}" id="route-url">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="user_first_name">Nombres:</label>
                <input type="text" class="form-control" id="user_first_name" name="user_first_name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="user_last_name">Apellidos:</label>
                <input type="text" class="form-control" id="user_last_name" name="user_last_name">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="user_email">Email:</label>
                <input type="email" class="form-control" id="user_email" name="user_email">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                    <label for="role_name">Rol:</label>
                    <input type="text" class="form-control" id="role_name" name="role_name">
                </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="user_status">Estado:</label>
                <select class="form-control" id="user_status" name="user_status">
                    <option value=""></option>
                    <option value="1">Habilitado</option>
                    <option value="0">Deshabilitado</option>
                </select>
            </div>
        </div>
        <div class="col-md-4" style="height: ">
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