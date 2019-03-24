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
     public function loadPDF($empty){
          $listPOO= new ListPOO; $result=$listPOO->listHojaRuta(1);
          $this->GeneraPDF($result,'reporte','Reporte de Hojas de Ruta','landscape');
     }
     public function PrintHoja($id){
          $listPOO= new ListPOO; $result=$listPOO->verhoja($id);
          $this->GeneraPDF($result,'hojaruta','Hoja de Ruta','portrait');
     }
     function GeneraPDF($result,$view,$title,$paper){
          require '../pages/print/'.$view.'.php';
          require_once '../bower_components/dompdf/dompdf_config.inc.php';
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
