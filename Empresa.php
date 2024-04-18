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
        $this->colClientes = $colClientes;
    }
    public function setColMotos($colMotos) {
        $this->colMotos = $colMotos;
    }
    public function setColVentas($colVentas) {
        $this->colVentas = $colVentas;
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

            if ($colMotos[$i]->getCodigo() == $codigoMoto) {
                $motoObtenida = $colMotos[$i];
                $motoEncontrada = true;
            }
            $i++;
        }
        return $motoObtenida;
    }


/**
 * Metodo registrarVenta($colCodigosMoto, $objCliente) metodo que recibe por parametro una coleccion de codigos de motos, la cual es recorrida, y por cada elemento de la coleccion la instancia Venta que debe ser creada. Recordar que no todos los clientes ni todas las motos, estan disponibles para registrar una venta en un momento determinado.
 * El metodo debe setear los variables instancias de venta que corresponda y retornar el importe final de la venta.
 * 
 * @param array $colCodigosMoto
 * @param Cliente $objCliente
 * @return float
 */
    public function registrarVenta($colCodigosMoto, $objCliente) {

        $importeFinal = 0;

        if ($objCliente->getEstado() == true ) {
            $motosAVender = [];
            $colMotos = $this->getColMotos();

            foreach ($colCodigosMoto as $unCodigoMoto) {
                $unObjMoto = $this->retornarMoto($unCodigoMoto);

                if ($unObjMoto != null && $unObjMoto->getActiva()) {
                    array_push($motosAVender, $unObjMoto);
                    $importeFinal = $importeFinal + $unObjMoto->darPrecioVenta();
                }
            }
            if (count($motosAVender) > 0) {
                $copiaColVentas = $this->getColVentas();
                $idVenta = count($copiaColVentas) + 1;
                $nuevaVenta = new Venta($idVenta, date("d-m-Y"), $objCliente, $motosAVender, $importeFinal);
                array_push($copiaColVentas, $nuevaVenta);
    
                $this->setColVentas($copiaColVentas);
            }
        }
        return $importeFinal;
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