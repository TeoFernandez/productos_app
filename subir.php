<?php
$conexion = new mysqli("localhost", "root", "", "tienda");

if ($conexion->connect_error) {
    die("Error de conexión");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['codi'], $_POST['descri'], $_POST['precio'], $_FILES['imagen'])) {
        $codi = $_POST['codi'];
        $descri = $_POST['descri'];
        $precio = $_POST['precio'];
        $tipo = $_FILES['imagen']['type'];
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

        // Insertar producto
        $conexion->query("INSERT IGNORE INTO productos (codi, descri, precio) VALUES ($codi, '$descri', $precio)");

        // Insertar imagen
        $stmt = $conexion->prepare("INSERT INTO imagenes (codi, imagen, tipo_imagen) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $codi, $imagen, $tipo);
        $stmt->send_long_data(1, $imagen);

        if ($stmt->execute()) {
            echo "<p class='ok'>Producto e imagen guardados.</p>";
        } else {
            echo "<p class='error'>Error: " . $stmt->error . "</p>";
        }
    }
}
?>
<link rel="stylesheet" href="subir.css">
<form method="POST" enctype="multipart/form-data">
    <h2>Subir Producto</h2>
    Código: <input type="number" name="codi" required><br>
    Descripción: <input type="text" name="descri" required><br>
    Precio: <input type="number" name="precio" required><br>
    Imagen: <input type="file" name="imagen" accept="image/*" required><br>
    <button type="submit">Subir</button>
</form>
