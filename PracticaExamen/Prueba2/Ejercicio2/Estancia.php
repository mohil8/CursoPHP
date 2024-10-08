<?php

class Estancia {
    public $dni;
    public $cliente;
    public $habitacion;
    public $noches;
    public $estancia;
    public $pago;
    public $cuna;
    public $cama;
    public $lavanderia;

    public function __construct($dni, $cliente, $habitacion, $noches, $estancia, $pago, $opc) {
        $this->dni = $dni;
        $this->cliente = $cliente;
        $this->habitacion = $habitacion;
        $this->noches = $noches;
        $this->estancia = $estancia;
        $this->pago = $pago;
        $this->cuna = in_array('Cuna', $opc);
        $this->cama = in_array('Cama', $opc);
        $this->lavanderia = in_array('Lavanderia', $opc);
    }

    public function guardar() {
        // Crear una línea separada por ; con los datos de la estancia
        $linea = implode(';', [
            $this->dni,
            $this->cliente,
            $this->habitacion,
            $this->noches,
            $this->estancia,
            $this->pago,
            $this->cuna ? '1' : '0', // 1 si está seleccionada, 0 si no
            $this->cama ? '1' : '0',
            $this->lavanderia ? '1' : '0'
        ]);
        
        // Guardar la línea en el archivo estancias.txt
        file_put_contents('estancias.txt', $linea . PHP_EOL, FILE_APPEND);
    }
}
