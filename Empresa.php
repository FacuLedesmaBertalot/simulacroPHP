<?php


class Empresa{

    // Atributos
    private $denominacion;
    private $direccion;
    private $colClientes;
    private $colMotos;
    private $colVentas;


    public function __construct($denominacion, $direccion, $colClientes, $colMotos, $colVentas)
    {
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->colClientes = $colClientes;
        $this->colMotos = $colMotos;
        $this->colVentas = $colVentas;
    }


    // Getters
    public function getDenominacion() {
        return $this->denominacion;
    }
    public function getDireccion() {
        return $this->direccion;
    }
    public function getColClientes() {
        return $this->colClientes;
    }
    public function getColMotos() {
        return $this->colMotos;
    }
    public function getColVentas() {
        return $this->colVentas;
    }

    // Setters
    public function setDenominacion($denominacion) {
        $this->denominacion = $denominacion;
    }
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
    public function setColClientes($colClientes) {
        $this->colClientes[] = $colClientes;
    }
    public function setColMotos($colMotos) {
        $this->colMotos[] = $colMotos;
    }
    public function setColVentas($colVentas) {
        $this->colVentas[] = $colVentas;
    }


    // MÉTODOS

    // Método que recorre la colección de motos de la Empresa y retorna la referencia al objeto Moto cuyo código coincide con el recibido por parámetro
    public function retornarMoto($codigoMoto) {
        //boolean $motoEncontrada
        //int $i
        //array $motoObtenida
        $motoObtenida = null;
        $i = 0;
        $motoEncontrada = false;
        $colMotos = $this->getColMotos();

        while ($i < count($colMotos) && !$motoEncontrada) {
            $moto = $colMotos[$i];

            if ($moto->getCodigo() == $codigoMoto) {
                $motoObtenida = $colMotos[$moto];
                $motoEncontrada = true;
            }
            $i++;
        }
        return $motoObtenida;
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
        if (count($motosVenta) > 0) {
            $venta = new Venta(count($this->getColVentas()) + 1, date("d-m-Y"), $objCliente, $motosVenta, $ventaCompleta);
            $i = 0;
            while ($i < count($motosVenta)) {
                $venta->incorporarMoto($motosVenta[$i]);
                $i++;
            }
            $this->setColVentas($venta);
        }
        return $ventaCompleta;
    }
    

    // Método que recibe por parámetro el tipo y número de documento de un Cliente y retorna una colección con las ventas realizadas al cliente
    public function retornarVentasXCliente($tipo, $numDoc) {
        $ventasCliente = [];
        $ventas = $this->getColVentas(); // Obtener todas las ventas de la empresa
    
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