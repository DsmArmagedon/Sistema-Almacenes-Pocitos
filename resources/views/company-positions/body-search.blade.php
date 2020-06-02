<input type="hidden" data-url="{{ route('companies-positions.index')}}" id="route-url">
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="company_position_name">Nombres:</label>
            <input type="text" class="form-control" id="company_position_name" name="company_position_name">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="company_position_description">Descripción:</label>
            <input type="text" class="form-control" id="company_position_description" name="company_position_description">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="company_position_status">Estado:</label>
            <select class="form-control" id="company_position_status" name="company_position_status">
                <option value=""></option>
                <option value="1">Habilitado</option>
                <option value="0">Deshabilitado</option>
            </select>
        </div>
    </div>
    <div class="col-md-3" style="height: ">
        <div class="form-group">
            <label for="search">Listar los resultados:</label>
            <button type="submit" class="btn btn-block btn-primary btn-sm" id="search" style="margin-right: 5px;">
                Buscar
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</div>