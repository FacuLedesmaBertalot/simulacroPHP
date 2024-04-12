<?php

class Moto{

    // Atributos
    private $codigo;
    private $costo;
    private $anioFabricacion;
    private $descripcion;
    private $porcIncrAnual;
    private $activa;


    public function __construct($codigo, $costo, $anioFabricacion, $descripcion, $porcIncrAnual, $activa)
    {
        $this->codigo = $codigo;
        $this->costo = $costo;
        $this->anioFabricacion = $anioFabricacion;
        $this->descripcion = $descripcion;
        $this->porcIncrAnual = $porcIncrAnual;
        $this->activa = $activa;
    }

    // Getters
    public function getCodigo() {
        return $this->codigo;
    }
    public function getCosto() {
        return $this->costo;
    }
    public function getAnioFabricacion() {
        return $this->anioFabricacion;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }
    public function getPorcIncrAnual() {
        return $this->porcIncrAnual;
    }
    public function getActiva() {
        return $this->activa;
    }

    // Setters
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
    public function setCosto($costo) {
        $this->costo = $costo;
    }
    public function setAnioFabricacion($anioFabricacion) {
        $this->anioFabricacion = $anioFabricacion;
    }
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function setPorcIncrAnual($porcIncrAnual) {
        $this->porcIncrAnual = $porcIncrAnual;
    }
    public function setActiva($activa) {
        $this->activa = $activa;
    }


    // MÉTODOS

    // Método que calcula el valor por el cual puede ser vendida una moto
    public function darPrecioVenta() {
        $precio = null;
        if(!$this->getActiva()) {
            $precio = -1;
        } else {
            $anioActual = date("Y");
            $aniosTranscurridos = $anioActual - $this->anioFabricacion;
            $precio = $this->getCosto() + $this->getCosto() * ($aniosTranscurridos * $this->getPorcIncrAnual() / 100);
        }
        return $precio;
    }



    // __toString
    public function __toString() {
        $estado = $this->getActiva() ? "Disponible" : "Fuera de Stock";
        return "Código: " .$this->getCodigo(). ".\nCosto: $" .$this->getCosto(). ".\nAño de Fabricación: " .$this->getAnioFabricacion(). "\nDescripcion: " .$this->getDescripcion(). ".\nPorcentaje Incremento Anual: " .$this->getPorcIncrAnual(). ".\nEstado: ".$estado. ".\n";
    }



}
?>