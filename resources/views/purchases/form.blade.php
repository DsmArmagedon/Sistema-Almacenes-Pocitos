<?php

use App\Models\Purchase;
?>
@csrf
<div class="col-md-3">
    <div class="box box-success">

        <div class="form-group initial">
            <label for="code">Código *</label>
            <input type="text" class="form-control inp" id="code" name="code" value="{{$code ?? '' }}" readonly>
        </div>
        <div class="form-group">
            <label for="date">Fecha *</label>
            <div id="sandbox-container-date">
                <div class="input-group date">
                    <input type="text" class="form-control" name="date" id="date"
                           value="{{date('d-m-Y')}}"><span class="input-group-addon"><i
                            class="glyphicon glyphicon-th"></i></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="invoice">Número de Factura </label> (Opcional)
            <input type="text" class="form-control inp" id="invoice" name="invoice">
        </div>

        <div class="form-group">
            <label for="description">Descripción *</label>
            <textarea style="resize:none;" rows="3" type="text" class="form-control" id="description"
                      name="description"> </textarea>
        </div>
        <div class="form-group">
            <label for="supplier">Proveedor</label> (Opcional)
            <input type="text" class="form-control" id="supplier" name="supplier">
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="text" class="form-control" id="total" name="total" disabled>
        </div>
        <button type="button" class="btn btn-primary btn-block" id="{{ $action }}">Guardar</button>
        <a type="button" href="{{route('purchases.index')}}" class="btn btn-default btn-block" id="back">Atrás</a>
    </div>
</div>
<div class="col-md-9">

    <div class="box box-success">
        <div class="box-body">
            <div class="col-md-12 cell-product">
                <div class="form-group initial">
                    <label for="product">Producto * </label>
                    <select class="form-control sel" style="width:100%" id="product"
                            data-placeholder="Seleccione un Producto">
                        <option value=""></option>
                        @foreach ($products as $product)
                        <option value="{{$product->code}}"
                                data-unit="{{$product->unit}}"
                                data-stock="{{$product->stock}}"
                                data-description="{{$product->description}}" 
                                {{-- {{($product->stock == 0 ? 'disabled' : '')}} --}}
                            >{{$product->code}} - {{$product->description}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3 cell-product">
                <div class="form-group">
                    <label for="quantity">Cantidad *</label>
                    <input type="number" min="1" class="form-control" id="quantity">
                </div>
            </div>

            <div class="col-md-3 cell-product">
                <div class="form-group">
                    <label for="import">Importe por Producto *</label>
                    <input type="number" min="0" step=",01" class="form-control" id="import">
                </div>
            </div>
            <div class="col-md-3 cell-product">
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" disabled>
                </div>
            </div>
            <div class="col-md-3 cell-product">
                <button type="button" style="margin-top: 25px" class="btn btn-success btn-block" id="detail-agregar" disabled>Agregar</button>
            </div>

        </div>
    </div>
    <div class="box box-warning">
        <div class="col-md-12">
            <div class="form-group initial">
                <label for="stock">DETALLLE DE PRODUCTOS</label> <i>(Cant: Cantidad del Producto; P.U.: Precio Unitario; Importe: Cant * P.U.)</i>
                <table class="table table-striped" id="detail">
                    <thead>
                    <th width="5%">
                        COD.
                    </th>
                    <th>
                        PRODUCTO
                    </th>
                    <th width="5%">
                        UNIDAD
                    </th>
                    <th width="3%">
                        CANT.
                    </th>
                    <th width="5%">
                        P.U.
                    </th>
                    <th width="5%">
                        IMPORTE
                    </th>
                    <th width="5%">

                    </th>
                    </thead>
                    <tbody id="body-detail" style="font-size:13px;">

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" style="text-align: right;">
                                <b>TOTAL IMPORTE</b>
                            </td>
                            <td id="totalimport" style="text-align: right;">
                                0,00
                            </td>
                        </tr>

                        @component('purchases/radio-button')
                        @slot('title','I.V.A.')
                        @slot('taxes', Purchase::TAXE_IVA)
                        @slot('name','taxe_iva')
                        @endcomponent

                        @component('purchases/radio-button')
                        @slot('title','Percep. I.V.A.')
                        @slot('taxes', Purchase::TAXE_PERCEP_IVA)
                        @slot('name','taxe_percep_iva')
                        @endcomponent

                        @component('purchases/radio-button')
                        @slot('title','Percep. I.I.B.B. Salta')
                        @slot('taxes', Purchase::TAXE_PERCEP_IIBB_SALTA)
                        @slot('name','taxe_percep_iibb_salta')
                        @endcomponent

                        @component('purchases/radio-button')
                        @slot('title','Impuesto Municipal')
                        @slot('taxes', Purchase::TAXE_MUNICIPAL)
                        @slot('name','taxe_municipal')
                        @endcomponent
                        <tr>
                            <td colspan="5" style="text-align: right;">
                                <b>TOTAL</b>
                            </td>
                            <td id="detailtotal" style="text-align: right;">
                                0,00
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>