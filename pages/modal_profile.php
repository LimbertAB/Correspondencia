<!--ver y modificar usuarios-->
<div class="modal fade" id="updateusuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="padding-top:0;padding-bottom:0;z-index:20">
                <div class="row">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 5px;z-index:100;position:absolute"><span aria-hidden="true">&times;</span></button>
                    <div class="col-md-4" height="100%" style="margin:0px;background:#0c2544;padding-top:20px;padding-left: 0;padding-right: 2px;z-index:-50;height: 500px;">
                        <img src="../pages/images/man.png" alt="profile" class="center-block" width="110px" style="padding:10px;margin-top:0px">
                        <center class="unombre">
                            <h5 style="color: #f2fafd;margin-top:0;margin-bottom:0px;text-transform:uppercase;z-index:900">Cargando <br> Usuario</h5>
                            <p style="margin-bottom:0;color:#f7e70e;font-weight: 700;"></p>
                        </center>
                        <center>
                            <img src="../pages/images/userlogin.png" style="padding:15px 0 5px 0;margin-top:0px">
                            <br>
                            <p class="ulogin" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">usuario</p>
                        </center>
                        <center>
                            <img src="../pages/images/suitcase.png" style="padding:15px 0 5px 0;margin-top:0px">
                            <br>
                            <p class="ucargo" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">cargo</p>
                        </center>
                        <center>
                            <img src="../pages/images/marker.png" style="padding:15px 0 5px 0;margin-top:0px">
                            <br>
                            <p class="udestino" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">destinos</p>
                        </center>
                        <center>
                            <img src="../pages/images/status.png" style="padding:15px 0 5px 0;margin-top:0px">
                            <br>
                            <p class="uestado" style="line-height: .95em !important;text-transform: lowercase;color:#cde9e5">Activo</p>
                        </center>
                    </div>

                    <div class="col-md-8">
                        <center>
                            <h3 style="margin-top:20px;color: #1cd2dc;font-weight: 700;">MODIFICAR PERFIL</h3>
                        </center>
                        <form autocomplete="off">
                            <div class="form-group has-feedback has-success fila1_u" style="margin-bottom:10px">
                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRES</label>
                                <input type="text" id="inputnombre_u" class="form-control input-sm" validate="false" toggle=".fila1_u">
                                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback has-success fila2_u" style="margin-bottom:10px">
                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">APELLIDOS</label>
                                <input type="text" id="inputapellido_u" class="form-control input-sm" validate="false" toggle=".fila2_u">
                                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback has-success fila3_u" style="margin-bottom:10px">
                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NÚMERO DE CARNET</label>
                                <input type="text" autocomplete="false" id="inputci_u" class="form-control input-sm" validate="false" toggle=".fila3_u">
                                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback has-success fila4_u" style="margin-bottom:10px">
                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">NOMBRE DE USUARIO</label>
                                <input type="text" id="inputusuario_u" class="form-control input-sm" validate="false" toggle=".fila4_u">
                                <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
                                <em style="color:#cf6666;display:none" id="error_update">El nombre de usuario ya esta en uso!</em>
                            </div>
                            <div class="form-group has-feedback has-error fila5_u" style="margin-bottom:10px">
                                <label style="color:#3fd2e0;font-weight:400;font-family:arial;font-size:.8em;margin-bottom:2px">CONTRASEÑA<small> (OPCIONAL)</small></label>
                                <input type="password" autocomplete="false" autocorrect="off" class="form-control input-sm" id="inputpassword_u" validate="false" placeholder="Minimo 5 caracteres" toggle=".fila5_u">
                                <span toggle="#inputpassword_u" id="togglepassword_u" class="fa fa-fw fa-eye field-icon"></span>
                                <em style="color:#cf6666;display:none">El carnet de identidad ya esta en uso!</em>
                            </div>
                            <center>
                                <button class="btn btn-success btn-lg" style="margin:10px 0 18px 0px" id="buttonupdate" type="button" disabled>Guardar</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>