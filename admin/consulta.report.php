<?php
    require_once('sistema.controller.php');
    require_once('consulta.controller.php');
    require_once('pacientes.controller.php');
    $sistema = new Sistema();
    $consulta = new Consulta();
    $pacientes = new Paciente();
    $sistema->verificarRoles('Doctor');    
    $receta = $consulta->readReceta($_GET['id_consulta']);
    $paciente = $pacientes->readOne($_GET['id_paciente']);
  
    use Spipu\Html2Pdf\Html2Pdf;
    use Spipu\Html2Pdf\Exception\Html2PdfException;
    use Spipu\Html2Pdf\Exception\ExceptionFormatter;

    try {    
        $content = "
        <h1>Receta Médica Sanlao</h1>
        <p>Doctor: ".$receta[0]['doctor']."</p>
        <p>".$paciente[0]['nombre']." ".$paciente[0]['apaterno']." ".$paciente[0]['amaterno']."</p>
        <p>Padecimiento: ".$receta[0]['padecimiento']."</p>
        <p>Tratamiento: ".$receta[0]['tratamiento']."</p>";
        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);        
        $html2pdf->output('RecetaMedica.pdf');
    } catch (Html2PdfException $e) {
        $html2pdf->clean();    
        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
    }
?>