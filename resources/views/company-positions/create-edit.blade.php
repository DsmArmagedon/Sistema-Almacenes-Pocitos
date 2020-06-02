<div class="modal fade" id="modalCompanyPosition" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog company-position" role="document">
        <div class="box box-success">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel"><label id="title"></label> </h3>
                </div>
                <div class="modal-body">
                    <form autocomplete="on" id="formCompanyPosition">
                        @csrf
                        <input type="hidden" id="id" name="id" >
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre *</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Descripcion </label>(Opcional)
                                    <textarea type="text" rows=6 style="resize:none"
                                    class="form-control resize-disabled" id="description"
                            name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="status">Estado *</label>
                                </div>
                                <div class="col-md-6 text-left col-sm-12">
                                    <label class="container-radio success">Habilitado
                                        <input type="radio" checked id="statusH" name="status" value="1"
                                            aria-describedby="error_status">
                                        <span class="checkmark-radio"></span>
                                    </label>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label class="container-radio warning">Deshabilitado
                                        <input type="radio" name="status" value="0" id="statusD" aria-describedby="error_status">
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