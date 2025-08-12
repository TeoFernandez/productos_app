<?php
header('Content-Type: application/json');
$conexion = new mysqli("localhost", "root", "", "tienda");

if ($conexion->connect_error) {
    die(json_encode(["error" => "Error de conexión"]));
}

$codi = isset($_GET['codi']) ? intval($_GET['codi']) : 0;

// Datos del producto
$sqlProducto = "SELECT * FROM productos WHERE codi = $codi LIMIT 1";
$resProducto = $conexion->query($sqlProducto);
$producto = $resProducto->fetch_assoc();

// Todas las imágenes
$sqlImagenes = "SELECT imagen, tipo_imagen FROM imagenes WHERE codi = $codi";
$resImagenes = $conexion->query($sqlImagenes);

$imagenes = [];
while ($fila = $resImagenes->fetch_assoc()) {
    $imagenes[] = [
        "tipo" => $fila['tipo_imagen'],
        "data" => base64_encode($fila['imagen'])
    ];
}

echo json_encode([
    "producto" => $producto,
    "imagenes" => $imagenes
]);
?>
