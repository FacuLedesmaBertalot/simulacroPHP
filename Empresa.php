<?php


class Empresa{

    // Atributos
    private $denominacion;
    private $direccion;
    private $objClientes;
    private $arrayObjMotos;
    private $arrayVentas;


    public function __construct($denominacion, $direccion, $objClientes, $arrayObjMotos, $arrayVentas)
    {
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->objClientes = $objClientes;
        $this->arrayObjMotos = $arrayObjMotos;
        $this->arrayVentas = $arrayVentas;
    }


    // Getters
    public function getDenominacion() {
        return $this->denominacion;
    }
    public function getDireccion() {
        return $this->direccion;
    }
    public function getObjClientes() {
        return $this->objClientes;
    }
    public function getArrayObjMotos() {
        return $this->arrayObjMotos;
    }
    public function getArrayVentas() {
        return $this->arrayVentas;
    }

    // Setters
    public function setDenominacion($denominacion) {
        $this->denominacion = $denominacion;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function setObjClientes($objClientes) {
        $this->objClientes[] = $objClientes;
    }
    public function setArrayObjMotos($arrayObjMotos) {
        $this->arrayObjMotos[] = $arrayObjMotos;
    }
    public function setArrayVentas($arrayVentas) {
        $this->arrayVentas[] = $arrayVentas;
    }


    // MÉTODOS

    // Método que recorre la colección de motos de la Empresa y retorna la referencia al objeto Moto cuyo código coincide con el recibido por parámetro
    public function retornarMoto($codigoMoto) {
        $motoEncontrada = null;
        $i = 0;
        $encontrado = false;
        $motos = $this->getArrayObjMotos();

        while ($i < count($motos) && !$encontrado) {
            $moto = $motos[$i];

            if ($moto->getCodigo() == $codigoMoto) {
                $motoEncontrada = $moto;
                $encontrado = true;
            }
            $i++;
        }
        return $motoEncontrada;
    }


    // Método que recibe por parámetro una coleccion de códigos de motos y  por cada elemento de la colección se busca el objeto moto correspondiente al código y se incorpora a la coleccion de motos de la instancia Venta que debe ser creada.
    public function registrarVenta($colCodigosMoto, $objCliente) {

        $ventaCompleta = 0;
        $motosVenta = [];
        $i = 0;
        $encontrado = false;
        $totalMotos = count($colCodigosMoto);

        while( $i < $totalMotos && !$encontrado) {
            $codigoMoto = $colCodigosMoto[$i];
            $moto = $this->retornarMoto($codigoMoto);

            if ($moto != null && $moto->getActiva() == true) {
                $motosVenta[] = $moto;
                $ventaCompleta = $ventaCompleta + $moto->darPrecioVenta();
            }
            $i++;
        }

        // Crear la venta solo si hay al menos una moto activa
        if ($motosVenta > 0) {
            $venta = new Venta(count($this->getArrayVentas()) + 1, date("d-m-Y"), $objCliente, $motosVenta, $ventaCompleta);
            $i = 0;
            while ($i < count($motosVenta)) {
                $venta->incorporarMoto($motosVenta[$i]);
                $i++;
            }
            $this->setArrayVentas($venta);
        }
        return $ventaCompleta;
    }
    

    // Método que recibe por parámetro el tipo y número de documento de un Cliente y retorna una colección con las ventas realizadas al cliente
    public function retornarVentasXCliente($tipo, $numDoc) {
        $ventasCliente = [];
        $ventas = $this->getArrayVentas(); // Obtener todas las ventas de la empresa
    
        $i = 0;
        $totalVentas = count($ventas);
        $bandera = false;
    
        while ($i < $totalVentas && !$bandera) {
            $venta = $ventas[$i];
            $clienteVenta = $venta->getCliente();
    
            // Verificar si el tipo y número de documento coinciden
            if (($clienteVenta->getTipoDocumento() == $tipo) && ($clienteVenta->getDNI() == $numDoc)) {
                $ventasCliente[] = $venta; 
            }
            $bandera = true;
            $i++;
        }
        return $ventasCliente;
    }


    // __toString
    public function __toString()
    {
        return "\nDenominación: " .$this->getDenominacion(). ".\nDirección: " .$this->getDireccion(). ".\n";
    }

}
?>