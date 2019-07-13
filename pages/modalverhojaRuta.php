<style>
   #verhojarutaModal .estilo {
      line-height: .95em !important;
      text-transform: lowercase;
      color: #828282;
      margin: 1px;
      font-weight: 200;
      font-size: 1.2em;
   }

   #verhojarutaModal .estilo0 {
      line-height: .95em !important;
      color: #fff;
      margin: 1px;
      font-weight: 700;
      font-size: 1.3em;
   }

   * {
      font-family: calibri, arial
   }

   .row.row-eq-height {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      width: 100%;
   }

   .form-steps {
      width: 100%;
      position: relative;
      display: flex;
      flex: 0 1 auto;
   }

   .form-steps__item {
      padding: 0;
      position: relative;
      display: block;
      float: left;
      width: 20%;
      text-align: center;
   }

   .form-steps__item-content {
      display: inline-block;
   }

   .form-steps__item-icon {
      background: #6f6f6f;
      color: #000;
      display: block;
      border-radius: 100%;
      text-align: center;
      width: 27px;
      height: 26px;
      line-height: 25px;
      margin: 0 auto 0px auto;
      position: relative;
      font-size: 16px;
      font-weight: 500;
      z-index: 2;
   }

   .form-steps__item-text {
      font-size: 13px;
      color: #888888;
      font-weight: 500;
   }

   .form-steps__item-line {
      display: inline-block;
      height: 2px;
      width: 100%;
      background: #6f6f6f;
      position: absolute;
      left: -50%;
      top: 12px;
      z-index: 1;
   }

   .form-steps__item--completed .form-steps__item-text,.form-steps__item--nocompleted .form-steps__item-text,.form-steps__item--proceso .form-steps__item-text {
      color: #fff;
   }

   .form-steps__item--completed .form-steps__item-icon {
      background: #0ca534;
   }
   .form-steps__item--completed .form-steps__item-line {
      background: #0ca534;
   }
   .form-steps__item--proceso .form-steps__item-icon {
      background: #e6c824;
   }
   .form-steps__item--proceso .form-steps__item-line {
      background: #e6c824;
   }

   .form-steps__item--nocompleted .form-steps__item-icon {
      background: #ff0101;
   }
   .form-steps__item--nocompleted .form-steps__item-line {
      background: #ff0101;
   }

   .main-timeline-section {
      position: relative;
      width: 100%;
      margin: 0;
   }

   /* punto rojo inicio y final */
   .main-timeline-section .timeline-start,
   .main-timeline-section .timeline-end {

      border-radius: 100px;
      left: 15px;
      margin: 0;
      height: 40px;
   }

   /* linea central roja */
   .main-timeline-section .conference-center-line {
      position: absolute;
      width: 4px;
      height: 100%;
      top: 0;
      left: 35px;
      margin-left: -2px;
      background: #a5a5a5;
   }

   /* circulo banco medio */
   .timeline-article .meta-date {
      position: absolute;
      top: 50%;
      left: 35px;
      width: 20px;
      height: 20px;
      transform: translateY(-50%);
      margin-left: -11px;
      border-radius: 100%;
      background: #a5a5a5;
      border: 1px solid #fff;
   }

   /* mensaje verde cuadrado en linea */
   .hedding-title {
      position: relative;
      left: 50px;
      top: -30px;
      transform: translateX(-50%);
      border-radius: 5px;
      background-color: #08c;
      color: #fff;
      border: 1px solid #fff;
      padding: 5px 15px;
      float: left;
   }

   /* linea central roja tamaño */
   .timeline-article {
      width: 100%;
      position: relative;
      margin: 0px;
      min-height: 135px;
      z-index: 0;
   }

   /* caja contenido de cuadros derechos */
   .timeline-article .content-box {
      position: absolute;
      background-color: #fff;
      width: 90%;
      top: 50%;
      transform: translateY(-50%);
      padding: 0px;
      left: 70px;
      margin-right: 20px;
   }

   .terminado h1 {
      color: #6ac259;
      margin: 5px 0 0 0;
   }
   .terminado .colorside {
      background: #6ac259;
   }

   .error h1 {
      color: #f1432f;
      margin: 5px 0 0 0;
   }
   .error .colorside {
      background: #f1432f;
   }

   .espera h1 {
      color: #888888;
      margin: 5px 0 0 0;
   }
   .espera .colorside {
      background: #888888;
   }
   .proceso h1 {
      color: #e6c824;
      margin: 5px 0 0 0;
   }
   .proceso .colorside {
      background: #e6c824;
   }
   .terminado img {
      height: 20px;
      width: 20px;
      background: url('../pages/images/checkedok.png') center no-repeat;
      background-size: 100%;
      padding: 8px;
      border: 1px solid #fff;
   }

   .error img {
      height: 20px;
      width: 20px;
      background: url('../pages/images/destinoerror.png') center no-repeat;
      background-size: 100%;
      padding: 8px;
      border: 1px solid #fff;
   }

   .espera img,.proceso img {
      height: 20px;
      width: 20px;
      background: url('../pages/images/esperadestino.png') center no-repeat;
      background-size: 100%;
      padding: 8px;
      border: 1px solid #fff;
   }

   .timeline-article .colorside h1 {
      font-size: 8em;
      margin: 40px 0 0 0;
      line-height: 15px;
      color: #fff;
      text-align: center;
   }

   .timeline-article .colorside small {
      font-size: .11em;
      color: #fff;
      margin: 0;
      line-height: 0px;
      text-align: center;
   }

   .timeline-article h5 {
      font-weight: 200;
      margin: 0px;
   }

   /* tringulo de direccion de la caja */
   .content-right-container .content-box:before {
      content: " ";
      position: absolute;
      left: -10px;
      top: 40%;
      transform: translateX(-50%);
      border: 10px solid transparent;
      display: block;
   }

   .terminado .content-box:before {
      border-right-color: #6ac259;
   }

   .error .content-box:before {
      border-right-color: #f1432f;
   }

   .espera .content-box:before {
      border-right-color: #888888;
   }
   .proceso .content-box:before {
      border-right-color: #e6c824;
   }
   .btn_validar_success{
      margin:0 0 5px 5px;border:1px solid #02bd47;color:#02bd47;background:#fff
   }
   .btn_validar_error{
      margin:0 0 5px 5px;border:1px solid #d52e2e;color:#d52e2e;background:#fff
   }
   .btn_validar_proceso{
      margin:0 0 5px 5px;border:1px solid #e6c824;color:#b19811;background:#fff
   }
</style>
<div class="modal fade bs-example-modal-lg" id="verhojarutaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-body" style="padding:0;z-index:20">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="right: 5px;z-index:100;position:absolute"><span aria-hidden="true">&times;</span></button>
            <div class="row" style="margin:0px;background:#08c;">
               <h3 style="20px 0 10px 0;text-align:center;color:#fff;font-weight:800;line-height:10px">INFORMACION DE LA HOJA DE RUTA <small class="vproveido" style="color:#fff;font-weight:300"><br> gdfgdfgfdgfh</small></h3>
            </div>
            <div class="row" style="margin:0px;background:#3b4579;" id="row_admin">
               <div class="col-md-12" style="padding:5px 0 5px 0;">
                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="col-md-3 col-sm-3 col-xs-3">
                        <img src="../pages/images/creado.png" width="65px">
                     </div>
                     <div class="col-md-9 col-sm-9 col-xs-9" style="padding:0">
                        <h4 style="font-weight:800;margin:6px 0 0 0;color:#a36aef">CREADO</h4>
                        <h5 style="margin:0;font-style: bold;color:#fff">Usuario: <small class="vnombrer" style="margin:0;font-style: italic;color:#d1b7f3;font-size:.9em;"></small></h5>
                        <h5 style="margin:0;font-style: bold;color:#fff">Fecha: <small class="vcir" style="margin:0;font-style: italic;color:#d1b7f3;font-size:.9em;"></small></h5>
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12">
                     <div class="col-md-3 col-sm-3 col-xs-3">
                        <img src="../pages/images/modificado.png" width="65px">
                     </div>
                     <div class="col-md-9 col-sm-9 col-xs-9" style="padding:0">
                        <h4 style="font-weight:800;margin:6px 0 0 0;color:#a36aef">MODIFICADO</h4>
                        <h5 style="margin:0;font-style: bold;color:#fff">Usuario: <small class="vnombreu" style="margin:0;font-style: italic;color:#d1b7f3;font-size:.9em;"></small></h5>
                        <h5 style="margin:0;font-style: bold;color:#fff">Fecha: <small class="vfechau" style="margin:0;font-style: italic;color:#d1b7f3;font-size:.9em;"></small></h5>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row row-eq-height" style="margin:0px;background:#141625;padding:0 10px 0 0;">
               <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4" style="margin:0px;padding:0 0 15px 0;">
                  <center>
                     <img src="../pages/images/manager.png" style="padding:15px 0 5px 0;margin:0">
                     <br>
                     <p class="estilo0">REMITENTE</p>
                     <p class="vnombre estilo"></p>
                  </center>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4" style="margin:0px;padding:0 0 15px 0;">
                  <center>
                     <img src="../pages/images/home.png" style="padding:15px 0 5px 0;margin-top:0px">
                     <br>
                     <p class="estilo0">PROCEDENCIA</p>
                     <p class="vprocedencia estilo"></p>
                  </center>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4" style="margin:0px;padding:0 0 15px 0;">
                  <center>
                     <img src="../pages/images/document.png" style="padding:17px 0 5px 0;margin-top:0px;">
                     <br>
                     <p class="estilo0">Nº CITE</p>
                     <p class="vcite estilo"></p>
                  </center>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4" style="margin:0px;padding:0 0 15px 0;">
                  <center>
                     <img src="../pages/images/identification.png" style="padding:15px 0 5px 0;margin-top:0px">
                     <br>
                     <p class="estilo0">Nº TRAMITE</p>
                     <p class="vtramite estilo"></p>
                  </center>
               </div>
            </div>
            <div class="row row-eq-height" style="margin:0px;background:#141625;padding:0 10px 0 0;">
               <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4" style="margin:0px;padding:0 0 15px 0;">
                  <center>
                     <img src="../pages/images/numbered.png" style="padding:17px 0 5px 0;margin:0">
                     <br>
                     <p class="estilo0">PRIORIDAD</p>
                     <p class="vprioridad estilo"></p>
                  </center>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4" style="margin:0px;padding:0 0 15px 0;">
                  <center>
                     <img src="../pages/images/hourglass.png" style="padding:15px 0 5px 0;margin-top:0px">
                     <br>
                     <p class="estilo0">PLAZO</p>
                     <p class="vplazo estilo"></p>
                  </center>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4" style="margin:0px;padding:0 0 15px 0;">
                  <center>
                     <img src="../pages/images/elaborado.png" style="padding:15px 0 5px 0;margin-top:0px">
                     <br>
                     <p class="estilo0">FECHA CITE</p>
                     <p class="vfecha estilo"></p>
                  </center>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4" style="margin:0px;padding:0 0 15px 0;">
                  <center>
                     <img src="../pages/images/status.png" style="padding:15px 0 5px 0;margin-top:0px">
                     <br>
                     <p class="estilo0">ESTADO</p>
                     <p class="vestado estilo"></p>
                  </center>
               </div>
            </div>
            <div class="row row-eq-height" style="margin:0 auto;background:#0a0b13;padding:10px 0 5px 0;">
               <nav class="form-steps" id="navrecorrido"></nav>
            </div>
            <ul role="tablist" style="padding:0px;" class="nav nav-tabs nav-justified" id="myTab">
               <li role="presentation" class="active"><a style="padding:0 15px 0 15px" href="#destino_moda_v" aria-controls="destino_moda_v" role="tab" data-toggle="tab">DESTINOS<h5 class="badge" style="background:#e8be47;margin-left:10px"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></h5></a></li>
               <li role="presentation"><a style="padding:0 15px 0 15px" href="#general_modal_v" aria-controls="general_modal_v" role="tab" data-toggle="tab">GENERAL<h5 class="badge" style="background:#e8be47;margin-left:10px"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></h5></a></li>
               <li role="presentation"><a style="padding:0 15px 0 15px" href="#accion_modal_v" aria-controls="accion_modal_v" role="tab" data-toggle="tab">ACCIONES<h5 class="badge" style="background:#e8be47;margin-left:10px"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></h5></a></li>
               <li role="presentation"><a style="padding:0 15px 0 15px" href="#archivo_modal_v" aria-controls="archivo_modal_v" role="tab" data-toggle="tab">VER ARCHIVO<h5 class="badge" style="background:#e8be47;margin-left:10px"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></h5></a></li>
            </ul>
            <div class="row">
               <div class="row tab-content" style="margin:0px 15px 0px 15px">
                  <div id="destino_moda_v" role="tabpanel" class="tab-pane active main-timeline-section">
                     <section class="main-timeline-section" style="background:#d2d6de;padding:0">
                        <div class="timeline-start"></div>
                        <div class="conference-center-line"></div>
                        <div class="conference-timeline-content" id="seccion_destino"></div>
                        <div class="timeline-end"></div>
                     </section>
                  </div>
                  <div id="general_modal_v" role="tabpanel" class="tab-pane">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:30px">
                        <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6" style="margin-bottom:20px;">
                           <div class="col-md-2 col-sm-2 col-xs-4">
                              <img src="../pages/images/folder.png" alt="transferencia">
                           </div>
                           <div class="col-md-10 col-sm-10 col-xs-8">
                              <h4 style="font-weight:800;margin:10px;margin-bottom:0">TIPO DE DOCUMENTO</h4>
                              <h5 style="margin-left: 15px;margin-top:0;font-style: italic" class="vtipo"></h5>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6" style="margin-bottom:20px;">
                           <div class="col-md-2 col-sm-2 col-xs-4">
                              <img src="../pages/images/curriculum.png" alt="transferencia">
                           </div>
                           <div class="col-md-10 col-sm-10 col-xs-8">
                              <h4 style="font-weight:800;margin:10px;margin-bottom:0">ADJUNTO</h4>
                              <h5 style="margin-left: 15px;margin-top:0;font-style: italic" class="vadjunto"></h5>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6" style="margin-bottom:20px;">
                           <div class="col-md-2 col-sm-2 col-xs-4">
                              <img src="../pages/images/sheets.png" alt="transferencia">
                           </div>
                           <div class="col-md-10 col-sm-10 col-xs-8">
                              <h4 style="font-weight:800;margin:10px;margin-bottom:0">NUMERO DE HOJAS</h4>
                              <h5 style="margin-left: 15px;margin-top:0;font-style: italic" class="vhojas"></h5>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6" style="margin-bottom:20px;">
                           <div class="col-md-2 col-sm-2 col-xs-4">
                              <img src="../pages/images/filepdf.png" alt="transferencia">
                           </div>
                           <div class="col-md-10 col-sm-10 col-xs-8">
                              <h4 style="font-weight:800;margin:10px;margin-bottom:0">NOMBRE DEL ARCHIVO</h4>
                              <h5 style="margin-left: 15px;margin-top:0;font-style: italic" class="varchivo"></h5>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="accion_modal_v" role="tabpanel" class="tab-pane" style="padding:0;margin:0">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:30px;margin:0" id="seccion_accion">
                     </div>
                  </div>
                  <div id="archivo_modal_v" role="tabpanel" class="tab-pane" style="padding:0;margin:0">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:0;margin:0">
                        <div id="archivopdf" height="10%"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer" style="border-left:10px solid  #84da92;margin-top: 0px;padding:10px 0 10px 0">
            
               <h4 class="vobservacion" style="font-weight:700;color:#14c373;margin:0 0 0 10px;text-align:left">REFERENCIA<span style="font-size:0.8em;font-style: italic;color:#777575;margin-left:15px"></span></h4>
            
            
         </div>
      </div>
   </div>
</div>