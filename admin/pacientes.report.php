<?php
require_once('sistema.controller.php');
require_once('pacientes.controller.php');
$sistema = new Sistema();
$paciente = new Paciente();
$sistema->verificarRoles('Doctor');
$datos = $paciente->read();
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {    
    $content = "
    <h1>Pacientes</h1>
    <p>Listado de pacientes</p>
    <table>
    <tr>
    <th>Id</th>
    <th>Nombre</th>    
    </tr>";
    foreach($datos as $key => $dato){
        $content .= "<tr>
        <td>".$dato['id_paciente']."</td>
        <td>".$dato['nombre']."</td>    
        </tr>"; 
    }
    $content.="
    </table>    
    ";
    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    $html2pdf->output('example00.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
