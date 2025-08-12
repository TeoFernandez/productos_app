<?php
header('Content-Type: application/json');
$conexion = new mysqli("localhost", "root", "", "tienda");

$busqueda = isset($_GET['q']) ? $_GET['q'] : '';

$sql = "SELECT p.codi, p.descri, p.precio, i.imagen, i.tipo_imagen
        FROM productos p
        JOIN imagenes i ON p.codi = i.codi
        WHERE i.id = (
            SELECT MIN(id) FROM imagenes WHERE codi = p.codi
        )";

if ($busqueda != '') {
    $sql .= " AND p.descri LIKE '%" . $conexion->real_escape_string($busqueda) . "%'";
}

$sql .= " LIMIT 3";

$resultado = $conexion->query($sql);

$productos = [];
while ($fila = $resultado->fetch_assoc()) {
    $fila['imagen'] = 'data:' . $fila['tipo_imagen'] . ';base64,' . base64_encode($fila['imagen']);
    $productos[] = $fila;
}

echo json_encode($productos);
?>
