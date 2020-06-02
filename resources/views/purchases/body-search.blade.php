
<input type="hidden" data-url="{{ route('purchases.index')}}" id="route-url">
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><b>Datos</b></a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><b>Fecha</b></a></li>
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
                                <label for="purchase_code">Código:</label>
                                <input type="text" class="form-control" id="purchase_code" name="purchase_code">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="purchase_supplier">Proveedor:</label>
                                <input type="text" class="form-control" id="purchase_supplier" name="purchase_supplier">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="purchase_invoice">Número de Factura:</label>
                                <input type="text" class="form-control" id="purchase_invoice"
                                       name="purchase_invoice">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="purchase_description">Descripción:</label>
                                <input type="text" class="form-control" id="purchase_description"
                                       name="purchase_description">
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <label for="sale_description">Total Importe:</label>
                            <div class="input-group my-group"> 
                                <select required id="purchase_parameter_total" class="form-control" style="width: 70%" name="purchase_parameter_total">
                                    <option value="=">Igual a:</option>
                                    <option value=">">Mayor a:</option>
                                    <option value="<">Menor a:</option>
                                    <option value=">=">Mayor o igual a:</option>
                                    <option value="<=">Menor o igual a:</option>
                                </select>
                                <input type="text" class="form-control" style="width: 30%; border-left:none" id="purchase_amount_total" name="purchase_amount_total"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="purchase_date">Compras por:</label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="container-radio success">Día Actual
                                            <input type="radio" id="dateDay"  name="purchase_date" checked
                                                   value="date_day" aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="container-radio success">Mes Actual
                                            <input type="radio" id="dateMonth" name="purchase_date" value="date_month"
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">

                                        <label class="container-radio success">Año Actual
                                            <input type="radio" id="dateYear" name="purchase_date" value="date_year"
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">

                                        <label class="container-radio success">Deshabilitar
                                            <input type="radio"  name="purchase_date" value="disabled"
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">

                                        <label class="container-radio success">Rango entre fechas
                                            <input type="radio" id="dateRange" name="purchase_date" value="date_range"
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="sandbox-container" class="hidden-date" style="float:left;">
                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="text" class="form-control" id="purchase_date_initial"
                                                       value="{{date('d-m-Y')}}" name="purchase_date_initial" />
                                                <span class="input-group-addon">a</span>
                                                <input type="text" class="form-control" id="purchase_date_final"
                                                       value="{{date('d-m-Y')}}" name="purchase_date_final" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>