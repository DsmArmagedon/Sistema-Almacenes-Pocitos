<div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog company-position" role="document">
        <div class="box box-success">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel"><label id="title"></label> </h3>
                </div>
                <div class="modal-body">
                    <form autocomplete="on" id="formProduct">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="code">Codigo *</label>
                                    <input type="text" class="form-control inp" id="code" name="code">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="description">Descripción *</label>
                                    <textarea type="text" style="resize:none" class="form-control inp" id="description" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="input-group">
                                    <div class="form-group">
                                        <label for="unit">Unidad *</label>
                                        <input type="text" class="form-control inp" id="unit" name="unit">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="price">Precio unitario de venta *</label>
                                    <input type="text" class="form-control inp" id="price" name="price">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="status">Estado *</label>
                                </div>
                                <div class="col-md-6 ">
                                    <label class="container-radio success">Habilitado
                                        <input type="radio" checked id="statusH" name="status" value="1"
                                            aria-describedby="error_status">
                                        <span class="checkmark-radio"></span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="container-radio warning">Deshabilitado
                                        <input type="radio" name="status" value="0" id="statusD"
                                            aria-describedby="error_status">
                                        <span class="checkmark-radio"></span>
                                    </label>
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