<?php


class Venta{

    // Atributos
    private $numero;
    private $fecha;
    private $cliente;
    private $arrayMotos;
    private $precioFinal;

    public function __construct($numero, $fecha, $cliente, $arrayMotos, $precioFinal)
    {
        $this->numero= $numero;
        $this->fecha = $fecha;
        $this->cliente = $cliente;
        $this->arrayMotos = $arrayMotos;
        $this->precioFinal= $precioFinal;
    }

    // Getters
    public function getNumero() {
        return $this->numero;
    }
    public function getFecha() {
        return $this->fecha;
    }
    public function getCliente() {
        return $this->cliente;
    }
    public function getArrayMotos() {
        return $this->arrayMotos;
    }
    public function getPrecioFinal() {
        return $this->precioFinal;
    }

    // Setters
    public function setNumero($numero) {
        $this->numero = $numero;
    }
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }
    public function setArrayMotos($arrayMotos) {
        $this->arrayMotos = $arrayMotos;
    }
    public function setPrecioFinal($precioFinal) {
        $this->precioFinal = $precioFinal;
    }


    // MÉTODOS

    // Método que incorpora una moto a la venta 
    public function incorporarMoto($objMoto) {
        $i = 0;
        $encontrado = false;
        $arrayMotos = $this->getArrayMotos();

        while ($i < count($arrayMotos) && !$encontrado) {
            if ($arrayMotos[$i]->getActiva()) {
                $arrayMotos[] = $objMoto; // array_push($arrayMotos, $objMoto); otra forma de escribir 
                $this->setPrecioFinal($this->getPrecioFinal() + $objMoto->darPrecioVenta());
                $encontrado = true;
            }
            $i++;
        }
        return $arrayMotos;
    }




    // __toString
    public function __toString()
    {
        $info = "Número de venta: " . $this->getNumero() . "\nFecha: " .$this->getFecha(). ".\nCliente: " . $this->getCliente() . ".\nPrecio final: $" . $this->getPrecioFinal() . ".\nMotos en la venta:\n";

        $motos = $this->getArrayMotos(); // Obtiene el array de motos
        $i = 0;
        while ($i < count($motos)) {
            $info .= $motos[$i] . "\n";
            $i++;
        }
        return $info;
    }
    



}

?>