<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><b>Compras por Producto</b></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <!-- BEGIN ERRORES DE VALIDACION -->
                    @component('components/validation')
                    @slot('errors', $errors)
                    @endcomponent
                    <!-- END ERRORES DE VALIDACION -->
                    <form id="formPurchaseForProducts" action="{{route('reports.purchases.products')}}" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="purchase_date">Fecha:</label>

                        </div>
                        <div class="col-md-12">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="container-radio success middle">Día Actual
                                            <input type="radio" id="dateDay"  name="purchase_date" checked
                                                   value="date_day" aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="container-radio success middle">Mes Actual
                                            <input type="radio" id="dateMonth" name="purchase_date" value="date_month"
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-2">

                                        <label class="container-radio success middle">Año Actual
                                            <input type="radio" id="dateYear" name="purchase_date" value="date_year"
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>

                                    <div class="col-md-2">

                                        <label class="container-radio success middle">Rango de fechas
                                            <input type="radio" id="dateRange" name="purchase_date" value="date_range"
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-3">
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
                                <div class="row">
                                    <div class="col-md-2">
                                        <label class="container-radio success middle">Mes del año en curso
                                            <input type="radio" id="dateYearMonth" name="purchase_date" value="date_year_month" @if(old('purchase_date')=== 'date_year_month')) checked @endif
                                                   aria-describedby="error_status">
                                            <span class="checkmark-radio"></span>
                                        </label>

                                    </div>
                                    <div class="col-md-2">
                                        <select id="saleMonth" class="form-control sel {{ (old('purchase_date') === 'date_year_month') ? '' : 'hidden' }}" name="sale_month" data-placeholder="Seleccione un Mes">
                                            <option value=""><option>
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
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-success" type="submit" style="margin-top: 24px;"> Generar Reporte</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
