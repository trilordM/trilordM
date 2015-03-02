<?php 
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
spl_autoload_register('DOMPDF_autoload');
$dompdf = new DOMPDF();
$dompdf->set_paper = 'letter';
$dompdf->load_html(utf8_decode($content_for_layout), Configure::read('App.encoding'));
$dompdf->render();
$dompdf->stream($userInfo['User']['id']."-".$userInfo['User']['name'].".pdf");
echo $dompdf->output();