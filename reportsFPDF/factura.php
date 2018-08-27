<?php
$idSale = $_GET['idSale'];
require 'Libreria/fpdf.php';
require "conversor.php";
include_once '../funciones/bd_conexion.php';

class PDF extends FPDF
{

} // FIN Class PDF

try {
    $sql = "SELECT dateEnd, totalSale,
                    (select sellerCode from seller where idSeller = S._idSeller) as sellercode,
                    (select name from town where idTown = C._idTown) as municipio,
                    (select name from village where idVillage = C._idVillage) as aldea,
                    (select name from deparment where idDeparment = C._idDeparment) as departamento,
                    C.customerCode, C.customerName, C.customerNit, C.customerAddress, C.customerTel
                    FROM sale S INNER JOIN customer C ON C.idCustomer = S._idCustomer WHERE idSale = $idSale";
    $resultado = $conn->query($sql);
} catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
}

while ($sale = $resultado->fetch_assoc()) {
    $fecha = date_create($sale['dateEnd']);
    setlocale(LC_ALL, "es_ES");
    $fec = date_format($fecha, 'd/m/Y');
    $date = DateTime::createFromFormat("d/m/Y", $fec);

    $pdf = new PDF('P', 'mm', array(163, 212));
#Establecemos los márgenes izquierda, arriba y derecha:
    $pdf->SetMargins(0, 0, 0);

#Establecemos el margen inferior:
    $pdf->SetAutoPageBreak(true, 0);
    $str = iconv('UTF-8', 'windows-1252', convertir($sale['totalSale']));

    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 8);

    $pdf->SetXY(20, 36);
//primera linea de factura
    $pdf->Cell(50, 3, $sale['municipio'], 0, 0, 'L');
    $pdf->Cell(15);
    $pdf->Cell(9, 3, $sale['sellercode'], 0, 0, 'L');
    $pdf->Cell(12);
    $pdf->Cell(10, 3, $sale['customerCode'], 0, 0, 'L');
    $pdf->Cell(22);
    $pdf->Cell(17, 3, strftime("%d %b %g", $date->getTimestamp()), 0, 1, 'L');

    $pdf->SetXY(23, 42);
//Nombre
    $pdf->Cell(120, 3, $sale['customerName'], 0, 0, 'L');

    $pdf->SetXY(17, 48);
//NIT
    $pdf->Cell(30, 3, $sale['customerNit'], 0, 0, 'L');

    $pdf->SetXY(25, 54);
//Direccion
    $pdf->MultiCell(120, 3, $sale['customerAddress'] . ' ' . $sale['aldea'] . ' ' . $sale['municipio'] . ' ' . $sale['departamento'], 0, 'L', 0);

    $pdf->SetXY(23, 70);
//Telefono
    $pdf->Cell(30, 3, $sale['customerTel'], 0, 0, 'L');

//DETALLE DE FACTURA
    $pdf->SetXY(0, 82);
    try {
        $sql = "SELECT D.quantity, TRUNCATE((D.priceS - D.discount) ,2) as precio,
    TRUNCATE((TRUNCATE((D.priceS - D.discount) ,2) * D.quantity) ,2) as total,
    (select productCode from product where idProduct = D._idProduct) as codigo,
    (select productName from product where idProduct = D._idProduct) as nombre
    from details D WHERE _idSale = $idSale";
        $resultado = $conn->query($sql);
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo $error;
    }
    while ($detailS = $resultado->fetch_assoc()) {
        $COD = iconv('UTF-8', 'windows-1252', $detailS['codigo']);
        $NOMBRE = iconv('UTF-8', 'windows-1252', $detailS['nombre']);
        $pdf->Cell(7);
        $pdf->Cell(17, 3, $detailS['quantity'], 0, 0, 'L');
        $pdf->Cell(15, 3, $COD, 0, 0, 'L');
        $pdf->Cell(69, 3, $NOMBRE, 0, 0, 'C');
        $pdf->Cell(21, 3, 'Q.'.$detailS['precio'], 0, 0, 'C');
        $pdf->Cell(28, 3, $detailS['total'], 0, 1, 'C');
    }

//TOTAL-LETRAS
    $pdf->SetXY(26, 188);
    $pdf->MultiCell(85, 5, $str, 1,'L',0);

//TOTAL
    $pdf->SetXY(130, 192);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(28, 5, $sale['totalSale'], 0, 0, 'L');
}

$pdf->Output(); //Salida al navegador