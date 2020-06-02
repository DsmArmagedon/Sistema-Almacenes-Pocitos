<input type="hidden" data-url="{{ route('inputs-outputs.index')}}" id="route-url">
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><b>Datos</b></a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><b>Fecha</b></a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"><b>Producto</b></a></li>
                <li class="dropdown">
                    <button type="submit" class="btn btn-default" id="search">
                        Buscar
                        <i class="fa fa-search"></i>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="input_output_code">Código:</label>
                                <input type="text" class="form-control" id="input_output_code" name="input_output_code">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="input_output_operation">Operación:</label>
                                <input type="text" class="form-control" id="input_output_operation" name="input_output_operation">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="input_output_type">Tipo de Movimiento:</label>
                                <select required id="input_output_type" class="form-control" name="input_output_type">
                                    <option value=""></option>
                                    <option value="input">Entrada</option>
                                    <option value="output">Salida</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="input_output_quantity">Cantidad:</label>
                            <div class="input-group my-group"> 
                                <select required id="input_output_parameter_quantity" class="form-control" style="width: 50%" name="input_output_parameter_quantity">
                                    <option value="=">Igual a:</option>
                                    <option value=">">Mayor a:</option>
                                    <option value="<">Menor a:</option>
                                    <option value=">=">Mayor o igual a:</option>
                                    <option value="<=">Menor o igual a:</option>
                                </select>
                                <input type="text" class="form-control" style="width: 50%; border-left:none" id="input_output_amount_quantity" name="input_output_amount_quantity"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="purchase_date">Entrada o Salida por:</label>
                        </div>
                        <div class="col-md-12">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="container-radio success">Día Actual
                                            <input type="radio" id="dateDay"  name="input_output_date"
                                                   value="date_day" aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="container-radio success">Mes Actual
                                            <input type="radio" id="dateMonth" checked name="input_output_date" value="date_month"
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">

                                        <label class="container-radio success">Año Actual
                                            <input type="radio" id="dateYear" name="input_output_date" value="date_year"
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">

                                        <label class="container-radio success" >Deshabilitar
                                            <input type="radio"  name="input_output_date" value="disabled"
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">

                                        <label class="container-radio success">Rango entre fechas
                                            <input type="radio" id="dateRange" name="input_output_date" value="date_range"
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="sandbox-container" class="hidden-date" style="float:left;">
                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="text" class="form-control" id="input_output_date_initial"
                                                       value="{{date('d-m-Y')}}" name="input_output_date_initial" />
                                                <span class="input-group-addon">a</span>
                                                <input type="text" class="form-control" id="input_output_date_final"
                                                       value="{{date('d-m-Y')}}" name="input_output_date_final" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_code">Código:</label>
                                <input type="text" class="form-control" id="product_code" name="product_code">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product_description">Operación:</label>
                                <input type="text" class="form-control" id="product_description" name="product_description">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="produc">Operación:</label>
                                <input type="text" class="form-control" id="produc" name="produc">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>