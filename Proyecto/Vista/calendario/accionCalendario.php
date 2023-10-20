
<?php
include_once("../../configuraciones.php");

include_once("../../Util/class/spout/vendor/autoload.php");

use Box\Spout\Common\Entity\Style\Border;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\CellAlignment;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Writer\Common\Creator\Style\BorderBuilder;

$ambFunciones = new AbmFuncion();


$funciones = convert_array($ambFunciones->buscarfuncion($buscar));


$escribir = WriterEntityFactory::createXLSXWriter();//crea un escritor de archivos excel

//creamos un objeto para especificar el
$escribir->openToBrowser("Calendario.xlsx");


$styleBorde = (new BorderBuilder())
    ->setBorderRight(Color::GREEN,Border::WIDTH_MEDIUM,Border::STYLE_SOLID)
    ->setBorderBottom(Color::GREEN,Border::WIDTH_MEDIUM,Border::STYLE_SOLID)
    ->setBorderTop(Color::GREEN,Border::WIDTH_MEDIUM,Border::STYLE_SOLID)
    ->setBorderLeft(Color::GREEN,Border::WIDTH_MEDIUM,Border::STYLE_SOLID)
    ->build();

//creamos un objeto para dar estilo a las filas del excel
$styleExcel = (new StyleBuilder())
    ->setFontColor(Color::GREEN) //asignamos color a las fuentes, rgb,nombre color,etc.
    ->setFontSize(10)//le asignamos un tamaño a las celdas de las filas
    ->setShouldWrapText(true)//agustar texto
    ->setBorder($styleBorde)//asignamos la variable con el objeto styleBorde
    ->setFontBold()
    ->build();//asignamos los estilos al excel dados anteriormente

//le damos estilo a los titulos
$styleTitulos = (new StyleBuilder())
    ->setFontColor(Color::GREEN)
    ->setFontBold()//asignamos tipo de letra negrita
    ->setCellAlignment(CellAlignment::CENTER)//aliniacion de las celdas
    ->setShouldWrapText(true)//agustar texto
    ->setFontSize(14)//le asignamos un tamaño a las celdas de las filas
    ->setBorder($styleBorde)//asignamos la variable con el objeto styleBorde
    ->build();//asignamos los estilos al excel dados anteriormente

if(count($funciones) > 0){

    $titulo = [
        //creamos las celdas de los titulos
        WriterEntityFactory::createCell("lunes"),
        WriterEntityFactory::createCell("martes"),
        WriterEntityFactory::createCell("miercoles"),
        WriterEntityFactory::createCell("jueves"),
        WriterEntityFactory::createCell("viernes"),
        WriterEntityFactory::createCell("sabado"),
        WriterEntityFactory::createCell("domingo")
    ];

    //asignamos las celdas creadas anteriormente y le asignamos tambien el estilo
    $filasTitulos = WriterEntityFactory::createRow($titulo,$styleTitulos);
    $escribir->addRow($filasTitulos);
    
    $primerDiaMes = 6;//0 si empiesa en lunes, 6 domingo
    $diaMaxMes=31; //cantidad de dias del mes
    $mes=10;//el numero del mes
    
    $celdas=[];
    //dejamos vacias las primeras celdas
    for($i=0;$i<$primerDiaMes;$i++){
        $cadena=WriterEntityFactory::createCell("",$styleExcel);
            array_push($celdas,$cadena);
    };
    for ($i = 1; $i <= $diaMaxMes; $i++) {
        $fun = [];
        for ($j = 0; $j < count($funciones); $j++) {
            if ($funciones[$j]["fecha"] == ("2023-" . $mes . "-" . $i)) {
                array_push($fun, $funciones[$j]);
            }
        }
        
        if (!empty($fun)) {
            $cadena = "2023-" . $mes . "-" . $i ;
            foreach ($fun as $f) {
                $peli=dismount($f["objpeli"]);
                $cadena .= " ". $peli["nombre"]." "  . $f["hora"] ;
            }
            $ce = WriterEntityFactory::createCell($cadena ,$styleExcel);
            array_push($celdas, $ce);
        } else {
            $cadena = "2023-" . $mes . "-" . $i ;
            $ce = WriterEntityFactory::createCell($cadena,$styleExcel);
            array_push($celdas, $ce);
        }
        
        if (($i + $primerDiaMes) % 7 == 0) {
            $unaFila = WriterEntityFactory::createRow($celdas, $styleExcel);
            $escribir->addRow($unaFila);
            $celdas = [];
        }
    }
    if(count($celdas)%7 != 7){
        for($i=count($celdas);$i<7;$i++){
            $cadena=WriterEntityFactory::createCell("",$styleExcel);
            array_push($celdas,$cadena);
        }
        $unaFila = WriterEntityFactory::createRow($celdas, $styleExcel);
        $escribir->addRow($unaFila);
    }
}
$escribir->close();
?>
