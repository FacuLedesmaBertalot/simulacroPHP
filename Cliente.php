<?php

class Cliente{

    // Atributos
    private $nombre;
    private $apellido;
    private $baja;
    private $tipoDocumento;
    private $DNI;

    public function __construct($nombre, $apellido, $baja, $tipoDocumento, $DNI)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->baja = $baja;
        $this->tipoDocumento = $tipoDocumento;
        $this->DNI = $DNI;
    }


    // Getters
    public function getNombre() {
        return $this->nombre;
    }
    public function getApellido() {
        return $this->apellido;
    }
    public function getBaja() {
        return $this->baja;
    }
    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }
    public function getDNI() {
        return $this->DNI;
    }

    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    public function setBaja($baja) {
        $this->baja = $baja;
    }
    public function setTipoDocumento($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }
    public function setDNI($DNI) {
        $this->DNI = $DNI;
    }


    // __toString
    public function __toString()
    {
        $estado = $this->baja ? "Activo" : "Dado de Baja";
        return "\nNombre: " .$this->getNombre(). ".\nApellido: " .$this->getApellido(). "\nEstado: " .$estado. ".\nTipo Documento: " .$this->getTipoDocumento(). ".\nNúmero de Documento: " .$this->getDNI(). ".\n";
    }

}
?>