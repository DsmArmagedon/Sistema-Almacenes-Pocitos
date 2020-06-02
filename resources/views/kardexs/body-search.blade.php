

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><b>Saldos por Meses</b></a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><b>Saldo por producto</b></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <form action="{{ route('kardexs.getMonth') }}" id="formMonth" target="_blank">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="product">Producto</label>
                                    <select class="form-control sel" style="width:100%" id="product" name="product"
                                            data-placeholder="Seleccione un Producto">
                                        <option value=""></option>
                                        @foreach ($products as $product)
                                        <option value="{{$product->code}}">{{$product->code}} - {{$product->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="year">Año:</label>
                                    <input type="text" class="form-control" id="year" name="year" placeholder="2019">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="monthInitial">Desde:</label>
                                <select required id="monthInitial" class="form-control sel" name="monthInitial">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="monthFinal">Hasta:</label>
                                <select required id="monthFinal" class="form-control sel" name="monthFinal">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12" selected>Diciembre</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <input class="btn btn-success" id="generateMonth" style="margin-top: 24px;" value="Generar Reporte"> 
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="tab_2">
                    <form action="{{ route('kardexs.getProducts') }}" id="formProducts" target="_blank">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="product_code">Código:</label>
                                    <input type="text" class="form-control" id="product_code" name="product_code">
                                </div>
                            </div>
                            <div class="col-md-7">
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="product_status">Estado:</label>
                                    <select class="form-control" id="product_status" name="product_status">
                                        <option value=""></option>
                                        <option value="1">Habilitado</option>
                                        <option value="0">Deshabilitado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input class="btn btn-success" id="generateProducts" style="margin-top: 24px;" value="Generar Reporte"> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>