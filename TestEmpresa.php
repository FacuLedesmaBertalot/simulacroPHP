<?php

include_once 'Cliente.php';
include_once 'Moto.php';
include_once 'Venta.php';
include_once 'Empresa.php';

$objCliente1 = new Cliente("Juan", "Finochio", true, "DNI", 34120856);
$objCliente2 = new Cliente("Lourdes", "Guevara", false, "DNI", 45124659);

$obMoto1 = new Moto(11, 2230000, 2022, "Benelli Imperiale 400", 85, true);
$obMoto2 = new Moto(12, 584000, 2021, "Zanella Zr 150 Ohc", 70, true);
$obMoto3 = new Moto(13, 999900, 2023, "Zanella Patagonian Eagle 250", 55, false);
$empresa = new Empresa("Alta Gama", "Av. Argenetine 123", [$objCliente1, $objCliente2], [$obMoto1, $obMoto2, $obMoto3], []);
// Tengo que agregar $colCodigosMotos, para que los recorra en un foreach y luego vea si existe ese codigo, agrupar en array


// Invoco al metodo registrarVenta
$precioFinalVenta1 = $empresa->registrarVenta([11, 12, 13] , $objCliente1);
if ($precioFinalVenta1 > 0) {
    echo "---------------------------------------\n";
    echo "Venta registrada exitosamente.\n";
} else {
    echo "---------------------------------------\n";
    echo "No se pudo registrar la venta.\n";
}

$precioFinalVenta2 = $empresa->registrarVenta([0] , $objCliente2);
if ($precioFinalVenta2 > 0) {
    echo "---------------------------------------\n";
    echo "Venta registrada exitosamente.\n";
} else {
    echo "---------------------------------------\n";
    echo "No se pudo registrar la venta.\n";
}

$precioFinalVenta3 = $empresa->registrarVenta([0] , $objCliente2);
if ($precioFinalVenta3 > 0) {
    echo "---------------------------------------\n";
    echo "Venta registrada exitosamente.\n";
} else {
    echo "---------------------------------------\n";
    echo "No se pudo registrar la venta.\n";
}



// Invoco al metodo retornarVentasXCliente

$ventaCliente1 = $empresa->retornarVentasXCliente($objCliente1->getTipoDocumento(), $objCliente1->getDNI());
foreach ($ventaCliente1 as $venta1) {
    if (empty($ventaCliente1)) {
        echo "---------------------------------------\n";
        echo "El cliente ".$objCliente1->getNombre()." no tiene compras registradas.\n";
    } else {
        foreach ($ventaCliente1 as $venta1) {
            echo $venta1 ."\n";
        }
    }
}

$ventaCliente2 = $empresa->retornarVentasXCliente($objCliente2->getTipoDocumento(), $objCliente2->getDNI());
if (empty($ventaCliente2)) {
    echo "---------------------------------------\n";
    echo "El cliente ".$objCliente2->getNombre()." no tiene compras registradas.\n";
} else {
    foreach ($ventaCliente2 as $venta2) {
        echo $venta2 ."\n";
    }
}
echo "---------------------------------------\n";
echo $empresa . "\n";




?>

