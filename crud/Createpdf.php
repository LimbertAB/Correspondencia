<?php
session_start();
include("../db/conexion.php");
include("../crud/ListPOO.php");
$enlace=conectar();
new Createpdf;

class Createpdf{
   public function __construct(){
      $urlParams = explode('/', $_SERVER['REQUEST_URI']);
      $functionName = $urlParams[4];
      $this->$functionName($urlParams[5]);

   }
   public function printreportePDF($empty){
      $listPOO= new ListPOO; $result=$listPOO->listHojaRuta();
      $this->GeneraPDF($result,'reporte','Reporte de Hojas de Ruta','landscape');
   }
   public function printmireportePDF($empty){
      $listPOO= new ListPOO; $result=$listPOO->listmiHojaRuta();
      $this->GeneraPDF($result,'reporte','Reporte de Hojas de Ruta','landscape');
   }
   public function printreporteusuarioPDF($empty){
      $listPOO= new ListPOO; $result=$listPOO->listaUsuarios();
      $this->GeneraPDF($result,'reporte_usuario','Reporte de Usuarios','portrait');
   }
   public function PrintHoja($id){
      $listPOO= new ListPOO; $result=$listPOO->verhoja($id);
      $this->GeneraPDF($result,'hojaruta','Hoja de Ruta','portrait');
   }
   public function PrintHojas($id){
      $listPOO= new ListPOO; $result=$listPOO->listHojaRuta();
      $this->GeneraPDF($result,'hojas','Hojas de Ruta','portrait');
   }
   public function PrintmisHojas($id){
      $listPOO= new ListPOO; $result=$listPOO->listmiHojaRuta();
      $this->GeneraPDF($result,'hojas','Hojas de Ruta','portrait');
   }
   public function PrintwordHojas($id){
      $listPOO= new ListPOO; $result=$listPOO->listHojaRuta();
      require '../pages/print/word.php';
   }
   public function PrintexcelHojas($id){
      $listPOO= new ListPOO; $result=$listPOO->listHojaRuta();
      require '../pages/print/excel.php';
   }
   function GeneraPDF($result,$view,$title,$paper){
      require_once '../bower_components/dompdf/dompdf_config.inc.php';
      require '../pages/print/'.$view.'.php';
      $dompdf = new DOMPDF();
      $result=utf8_encode(ob_get_clean());
      $dompdf->load_html(utf8_decode($result));
      $dompdf->set_paper('letter', $paper); //portrait
      $dompdf->render();
      ob_end_clean();
      $dompdf->stream($title.'.pdf',array('Attachment'=>0));
   }
}
?>
