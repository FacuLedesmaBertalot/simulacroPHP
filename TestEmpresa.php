<?php

include_once 'Cliente.php';
include_once 'Moto.php';
include_once 'Venta.php';
include_once 'Empresa.php';

function mostrarDatosColeccion($unaColeccion) {
    echo " --- Ventas --- " . "\n";
    foreach ($unaColeccion as $unElemento) {
        echo $unElemento . "\n";
    }
    echo " --- Ventas --- " . "\n";
}


//1) Cree 2 instancias de la clase Cliente: $objCliente1, $objCliente2
$objCliente1 = new Cliente("Juan", "Finochio", true, "DNI", 34120856);
$objCliente2 = new Cliente("Lourdes", "Guevara", false, "DNI", 45124659);

//2) Cree 3 objetos Motos con la informacion visualizada en la tabla
$obMoto1 = new Moto(11, 2230000, 2022, "Benelli Imperiale 400", 85, true);
$obMoto2 = new Moto(12, 584000, 2021, "Zanella Zr 150 Ohc", 70, true);
$obMoto3 = new Moto(13, 999900, 2023, "Zanella Patagonian Eagle 250", 55, false);

$colMotos = [$obMoto1, $obMoto2, $obMoto3];
$colClientes = [$objCliente1, $objCliente2];

$empresa = new Empresa("Alta Gama", "Av. Argenetine 123", $colClientes, $colMotos, []);

echo $empresa . "\n";


// Invoco al metodo registrarVenta
$resp = $empresa->registrarVenta([11, 12, 13] , $objCliente1);

if ($resp > 0) {                                                          // En el parcial esto no es necesario, pero ayuda
    echo "La venta pudo realizarse, el importe Total: $" .$resp. ".\n";
} else {
    echo "La venta no pudo realizarse.\n";
}

$resp = $empresa->registrarVenta([0] , $objCliente2);
if ($resp > 0) {                                                          // En el parcial esto no es necesario, pero ayuda
    echo "La venta pudo realizarse, el importe Total: $" .$resp. ".\n";
} else {
    echo "La venta no pudo realizarse.\n";
};

$resp = $empresa->registrarVenta([2] , $objCliente2);
if ($resp > 0) {                                                          // En el parcial esto no es necesario, pero ayuda
    echo "La venta pudo realizarse, el importe Total: $" .$resp. ".\n";
} else {
    echo "La venta no pudo realizarse.\n";
}



// Invoco al metodo retornarVentasXCliente

$colVentas = $empresa->retornarVentasXCliente("DNI", 34120856);
echo "\n";
mostrarDatosColeccion($colVentas);

$colVentas = $empresa->retornarVentasXCliente("DNI", 45124659);
echo "\n";
mostrarDatosColeccion($colVentas);


echo $empresa ."\n";


?>