@csrf
<div class="col-md-3">
    <div class="box box-success">

        <div class="form-group initial">
            <label for="code">Código *</label>
            <input type="text" class="form-control inp" id="code" name="code" value="{{ $code ?? '' }}" readonly>
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
            <label for="description">Descripción *</label>
            <textarea style="resize:none;" rows="3" type="text" class="form-control" id="description"
                name="description">  </textarea>
        </div>
        <div class="form-group">
            <label for="client">Cliente</label> (Opcional)
            <input type="text" class="form-control" id="client" name="client">
        </div>
        <div class="form-group">
            <label for="total">Total</label>
            <input type="text" class="form-control" id="total" name="total" disabled>
        </div>
        <button type="button" class="btn btn-primary btn-block" id="{{ $action }}" data-url="{{ route('sales.show',':ID') }}">Guardar</button>
        <a type="button" href="{{route('sales.index')}}" class="btn btn-default btn-block" id="back">Atrás</a>
    </div>
</div>
<div class="col-md-9">

    <div class="box box-success">
        <div class="box-body">
            <div class="col-md-12 cell-product">
                <div class="form-group initial">
                    <label for="product">Producto * </label> 
                    <select class="form-control sel" style="width:100%" id="product"
                        data-placeholder="Seleccione un Producto | Sin inventario disponible para la venta: **">
                        <option value=""></option>
                        @foreach ($products as $product)
                            <option value="{{$product->code}}"
                                data-unit="{{$product->unit}}"
                                data-stock="{{$product->stock}}"
                                data-description="{{$product->description}}"
                                data-price="{{$product->price}}"
                                {{($product->stock === 0) ? 'disabled' : ''}}
                                >{{$product->code}} - {{$product->description}} {{($product->stock == 0 ? '| **' : '')}}</option>
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
                    <label for="price">Precio Unitario de Venta*</label>
                    <input type="number" min="0" step=",01" class="form-control" id="price">
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
        <!--<div class="col-md-12">-->
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
                        <th width="10%">
                            P.U.
                        </th>
                        <th width="5%">
                            IMPORTE
                        </th>
                        <th width="7%">
                            
                        </th>
                    </thead>
                    <tbody id="body-detail" style="font-size:13px;">

                    </tbody>
                </table>
            </div>
        <!--</div>-->
    </div>
</div>