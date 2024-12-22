<?php

abstract class Vehiculo {
    protected string $marca;
    protected string $modelo;
    protected int $anho;
    protected int $kilometraje;

    public function __construct(
        string $marca, 
        string $modelo, 
        int $anho, 
        int $kilometraje
    ) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->anho = $anho;
        $this->kilometraje = $kilometraje;
    }

    abstract function calcularCostoMantenimiento(): float;

    abstract function describirVehiculo(): void;
}

class Auto extends Vehiculo {

    private int $cantidadPuertas = 0;
    public function __construct(int $cantidadPuertas, string $marca, string $modelo, int $anho, int $kilometraje) {
        parent::__construct($marca, $modelo, $anho, $kilometraje);
        $this->cantidadPuertas = max(0, $cantidadPuertas);
    }

    public function calcularCostoMantenimiento(): float {
        return $this->kilometraje * $this->cantidadPuertas;
    }

    public function describirVehiculo(): void {
        echo 'Marca: ' . $this->marca . PHP_EOL;
        echo 'Modelo: ' . $this->modelo . PHP_EOL;
        echo 'Año: ' . $this->anho . PHP_EOL;
        echo 'Kilometraje: ' . $this->kilometraje . PHP_EOL;
        echo 'Cantidad de puertas: ' . $this->cantidadPuertas . PHP_EOL;
    }
}

class Motocicleta extends Vehiculo {
    private string $tipoCasco;
    const COSTO_BASE_MANTENIMIENTO = 0.5;

    public function __construct(string $tipoCasco, string $marca, string $modelo, int $anho, int $kilometraje) {
        parent::__construct($marca, $modelo, $anho, $kilometraje);
        $this->tipoCasco = $tipoCasco;
    }

    public function calcularCostoMantenimiento(): float {
        return $this->kilometraje * self::COSTO_BASE_MANTENIMIENTO;
    }

    public function describirVehiculo(): void {
        echo 'Marca: ' . $this->marca . PHP_EOL;
        echo 'Modelo: ' . $this->modelo . PHP_EOL;
        echo 'Año: ' . $this->anho . PHP_EOL;
        echo 'Kilometraje: ' . $this->kilometraje . PHP_EOL;
        echo 'Tipo de casto: ' . $this->tipoCasco . PHP_EOL;
    }
}

class Camion extends Vehiculo {
    private int $capacidadCarga;

    public function __construct(int $capacidadCarga, string $marca, string $modelo, int $anho, int $kilometraje) {
        parent::__construct($marca, $modelo, $anho, $kilometraje);
        $this->capacidadCarga = $capacidadCarga;
    }

    public function calcularCostoMantenimiento(): float {
        return $this->kilometraje / $this->capacidadCarga;
    }

    public function describirVehiculo(): void {
        echo 'Marca: ' . $this->marca . PHP_EOL;
        echo 'Modelo: ' . $this->modelo . PHP_EOL;
        echo 'Año: ' . $this->anho . PHP_EOL;
        echo 'Kilometraje: ' . $this->kilometraje . PHP_EOL;
        echo 'Capacidad de carga: ' . $this->capacidadCarga . PHP_EOL;
    }
}

$auto = new Auto(cantidadPuertas: 4, marca: "Toyota", modelo: "Corolla", anho: 2020, kilometraje: 50000);
$motocicleta = new Motocicleta(tipoCasco: "Integral", marca: "Yamaha", modelo: "R15", anho: 2018, kilometraje: 20000);
$camion = new Camion(capacidadCarga: 5000, marca: "Volvo", modelo: "FH16", anho: 2015, kilometraje: 100000);

$vehiculos = [$auto, $motocicleta, $camion];

foreach ($vehiculos as $vehiculo) {
    $vehiculo->describirVehiculo();
    echo "Costo de mantenimiento: " . $vehiculo->calcularCostoMantenimiento() . " USD\n";
    echo str_repeat("-", 30) . "\n";
}
