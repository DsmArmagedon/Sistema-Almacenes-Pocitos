<div class="modal fade" id="modalUserShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog detail-user" role="document">
        <div class="box box-success">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="myModalLabel"><label>Rol</label> </h3>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Nombre:</b> <span class="pull-right" id="roleName"></span>
                            </li>
                            <li class="list-group-item">
                                <b>Descripción:</b> <span id="roleDescription"></span>
                            </li>
                            <li class="list-group-item">
                                <b>Estado:</b> <span class="pull-right" id="roleStatus"></span>
                            </li>
                            <li class="list-group-item">
                                <b>Permisos:</b>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div id="rolePermissions"></div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>