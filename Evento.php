<?php

class Evento
{
    private array $costos;

    public function __construct(array $costos)
    {
        $this->costos = $costos;
    }

    public function calcularCostoTotal(): float
    {
        $total = 0;
        foreach ($this->costos as $costo) {
            $total += $costo;
        }
        return $total;
    }
}
?>