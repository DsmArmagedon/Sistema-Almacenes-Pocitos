<input type="hidden" data-url="{{ route('products.index')}}" id="route-url">
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="product_code">Código:</label>
            <input type="text" class="form-control" id="product_code" name="product_code">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="product_description">Descripción:</label>
            <input type="text" class="form-control" id="product_description" name="product_description">
        </div>
    </div>
    <div class="col-md-3">
        <label for="product_stock">Stock:</label>
        <div class="input-group my-group"> 
            <select required id="product_parameter_stock" class="form-control" style="width: 50%" name="product_parameter_stock">
                <option value="=">Igual a:</option>
                <option value=">">Mayor a:</option>
                <option value="<">Menor a:</option>
                <option value=">=">Mayor o igual a:</option>
                <option value="<=">Menor o igual a:</option>
            </select>
            <input type="text" class="form-control" style="width: 50%; border-left:none" id="product_amount_stock" name="product_amount_stock"/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <label for="product_price">Precio:</label>
        <div class="input-group my-group"> 
            <select required id="product_parameter_price" class="form-control" style="width: 50%" name="product_parameter_price">
                <option value="=">Igual a:</option>
                <option value=">">Mayor a:</option>
                <option value="<">Menor a:</option>
                <option value=">=">Mayor o igual a:</option>
                <option value="<=">Menor o igual a:</option>
            </select>
            <input type="text" class="form-control" style="width: 50%; border-left:none" id="product_amount_price" name="product_amount_price"/>
        </div>
    </div>
    <div class="col-md-3">
            <div class="form-group">
                <label for="product_unit">Unidad:</label>
                <input type="text" class="form-control" id="product_unit" name="product_unit">
            </div>
        </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="product_status">Estado:</label>
            <select class="form-control" id="product_status" name="product_status">
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