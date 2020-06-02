<div class="modal fade" id="modalInputOutput" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="box box-success">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel"><label id="title"></label> </h3>
                </div>
                <div class="modal-body">
                    <form autocomplete="on" id="formInputOutput">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="code">Código *</label>
                                    <input type="text" class="form-control" id="code" name="code" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="type">Tipo de Movimiento:</label>
                                    <select class="form-control sel" style="width:100%" id="type" name="type"
                                            data-placeholder="Seleccione un Tipo">
                                        <option value=""></option>
                                        <option value="input">Entrada</option>
                                        <option value="output">Salida</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label for="operation">Operación *</label>
                                    <input type="text" class="form-control" id="operation" name="operation">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group initial">
                                    <label for="productCode">Producto * </label>
                                    <select class="form-control sel" style="width:100%" id="productCode" name="productCode"
                                            data-placeholder="Seleccione un Producto">
                                        <option value=""></option>
                                        @foreach ($products as $product)
                                        <option 
                                            id="P{{$product->code}}"
                                            value="{{$product->code}}"
                                            data-unit="{{$product->unit}}"
                                            data-stock="{{$product->stock}}"
                                            >{{$product->code}} - {{$product->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="text" class="form-control" id="stock" name="stock" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="unit">Unidad</label>
                                    <input type="text" class="form-control" id="unit" name="unit" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="quantity">Cantidad *</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="save">Guardar</button>
            </div>
        </div>
    </div>
</div>
