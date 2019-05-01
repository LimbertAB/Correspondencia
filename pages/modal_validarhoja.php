<style>
    .file-upload {
        display: block;
        text-align: center;
        font-family: Helvetica, Arial, sans-serif;
        font-size: 12px;
    }

    .file-upload .file-select {
        display: block;
        border: 2px solid #dce4ec;
        color: #34495e;
        cursor: pointer;
        height: 40px;
        line-height: 40px;
        text-align: left;
        background: #FFFFFF;
        overflow: hidden;
        position: relative;
    }

    .file-upload .file-select .file-select-button {
        background: #dce4ec;
        padding: 0 10px;
        display: inline-block;
        height: 40px;
        line-height: 40px;
    }

    .file-upload .file-select .file-select-name {
        line-height: 40px;
        display: inline-block;
        padding: 0 10px;
    }

    .file-upload .file-select:hover {
        border-color: #34495e;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload .file-select:hover .file-select-button {
        background: #34495e;
        color: #FFFFFF;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload.active .file-select {
        border-color: #3fa46a;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload.active .file-select .file-select-button {
        background: #3fa46a;
        color: #FFFFFF;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    .file-upload .file-select input[type=file] {
        z-index: 100;
        cursor: pointer;
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        filter: alpha(opacity=0);
    }

    .file-upload .file-select.file-select-disabled {
        opacity: 0.65;
    }

    .file-upload .file-select.file-select-disabled:hover {
        cursor: default;
        display: block;
        border: 2px solid #dce4ec;
        color: #34495e;
        cursor: pointer;
        height: 40px;
        line-height: 40px;
        margin-top: 5px;
        text-align: left;
        background: #FFFFFF;
        overflow: hidden;
        position: relative;
    }

    .file-upload .file-select.file-select-disabled:hover .file-select-button {
        background: #dce4ec;
        color: #666666;
        padding: 0 10px;
        display: inline-block;
        height: 40px;
        line-height: 40px;
    }

    .file-upload .file-select.file-select-disabled:hover .file-select-name {
        line-height: 40px;
        display: inline-block;
        padding: 0 10px;
    }
</style>
<div class="modal fade" id="modalvalidarhoja">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formvalidarhoja" name="formvalidarhoja" method="POST" enctype="multipart/form-data">
                <div class="modal-header" style="background: #0a55ff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" align="center" style="color:#fff;font-weight:600">RECEPCIONAR HOJA DE RUTA</h4>
                </div>
                <div class="box box-primary" style="border:0">
                    <div class="modal-body" style="background: #fff">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Observaciones</label>
                                <input type="text" class="form-control" id="inputvalidarhoja" placeholder="Ejemplo: hoja de ruta recepcionada sin problemas" name="observacion">
                            </div>
                            <div class="form-group">
                                <div class="file-upload">
                                    <div class="file-select">
                                        <div class="file-select-button" id="fileName">Seleccione Archivo</div>
                                        <div class="file-select-name" id="noFile">Ningun archivo Seleccionado</div>
                                        <input type="file" name="archivo" id="chooseFile" accept="application/pdf" onchange="displayPreview(this.files,true);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_validarhoja" disabled>Recepcionar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalvalidarhoja_u">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formvalidarhoja_u" name="formvalidarhoja" method="POST" enctype="multipart/form-data">
                <div class="modal-header" style="background: #0a55ff;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" align="center" style="color:#fff;font-weight:600">MODIFICAR RESPUESTA</h4>
                </div>
                <div class="box box-primary" style="border:0">
                    <div class="modal-body" style="background: #fff">
                        <div class="box-body">
                            <div class="alert alert-warning alert-dismissible col-md-12" role="alert" style="background-color:#f3e47f !important">
                                <h5 style="color:#000" id="observacion_superior"></h5>
                            </div>
                            <div class="form-group">
                                <label>Observaciones</label>
                                <input type="text" class="form-control" id="inputvalidarhoja_u" placeholder="Ejemplo: hoja de ruta recepcionada sin problemas" name="observacion">
                            </div>
                            <div class="form-group">
                                <div class="file-upload active">
                                    <div class="file-select">
                                        <div class="file-select-button" id="fileName_u">Archivo seleccionado</div>
                                        <div class="file-select-name" id="noFile_u">Archivo.pdf</div>
                                        <input type="file" name="archivo" id="chooseFile_u" accept="application/pdf" onchange="displayPreview(this.files,false);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_validarhoja_u">Modificar Respuesta</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>