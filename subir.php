<?php
$conexion = new mysqli("localhost", "root", "", "tienda");

if (isset($_POST['codi']) && isset($_FILES['imagen'])) {
    $codi = $_POST['codi'];
    $tipo = $_FILES['imagen']['type'];
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

    $stmt = $conexion->prepare("INSERT INTO imagenes (codi, imagen, tipo_imagen) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $codi, $imagen, $tipo);
    $stmt->send_long_data(1, $imagen);
    
    if ($stmt->execute()) {
        echo "Imagen subida correctamente.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<form method="POST" enctype="multipart/form-data">
    Código producto: <input type="number" name="codi" required><br>
    Imagen: <input type="file" name="imagen" accept="image/*" required><br>
    <button type="submit">Subir</button>
</form>
