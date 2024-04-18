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


// Invoco al metodo registrarVenta
$precioVenta1 = $empresa->registrarVenta([11, 12, 13] , $objCliente1);
echo "Precio Venta: " .$precioVenta1. "\n";

$precioVenta2 = $empresa->registrarVenta([0] , $objCliente2);
echo "Precio Venta: " .$precioVenta2. "\n";

$precioVenta3 = $empresa->registrarVenta([2] , $objCliente2);
echo "Precio Venta: " .$precioVenta3. "\n";



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