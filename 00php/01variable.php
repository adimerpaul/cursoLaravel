<?php
$name="Adimer Paul";
$age=25;
$price=19.99;
$active=false;

$array =['nombre'=>$name, 'edad'=>$age, 'precio'=>$price, 'activo'=>$active, 'limit' => 98];

$limit = $array['limit'] ?? 10;

$array[] = 'manzana';

// var_dump ("5"==5);

$stock = 100;
$cantidad = 500;

// if ($stock == $cantidad) {
//     echo "existe la cantidad exacta";
// } else if( $stock > $cantidad){
//     echo "existe la cantidad para venta";
// }else{
//     echo "no exite la cantidad";
// }

// $diaSemana = date('w');

// echo "Hoy es el dia: $diaSemana";

// switch ($diaSemana) {
//     case 1:
//         echo " Domingo";
//         break;
//     case 2:
//         echo " Lunes";
//         break;
//     case 3:
//         echo " Martes";
//         break;
//     case 4:
//         echo " Miercoles";
//         break;
//     case 5:
//         echo " Jueves";
//         break;
//     case 6:
//         echo " Viernes";
//         break;
//     case 7:
//         echo " Sabado";
//         break;
// }
// $numero = 9;
// for ($i = 1; $i <= 10; $i++) {
//     echo "$numero * $i = " . ($numero * $i) . "<br>";
// }

// $personas = [
//     ['nombre' => 'Adimer', 'edad' => 25],
//     ['nombre' => 'Paul', 'edad' => 30],
//     ['nombre' => 'Maria', 'edad' => 22],
//     ['nombre' => 'Juan', 'edad' => 28]
// ];

// foreach ($personas as $persona) {
//     echo "Nombre: " . $persona['nombre'] . ", Edad: " . $persona['edad'] . "<br>";
// }


class Producto {
    private $nombre;
    private $precio;

    // public function __construct($nombre, $precio) {
    //     $this->nombre = $nombre;
    //     $this->precio = $precio;
    // }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }
}

// $producto = new Producto;

// $producto->setNombre("Laptopxxx");
// $producto->setPrecio(1200.00);

// echo "Nombre: " . $producto->getNombre() . ", Precio: " . $producto->getPrecio();
// $num1 = 0;
// $num2 = 1;

// echo $num1."<br>";
// echo $num2."<br>";

// foreach (range(1, 1000) as $i) {
//     $sum = $num1 + $num2;
//     echo $sum . "<br>";
//     $num1 = $num2;
//     $num2 = $sum;
// }

$decimalNumber = 255.5;
$bool = true;

$bool= "hola";

echo $decimalNumber . "<br>";
echo $bool . "<br>";
