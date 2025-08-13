# 📦 Proyecto Web con PHP, MySQL, JavaScript y CSS

Este proyecto fue desarrollado como parte de las actividades académicas del **Instituto Superior de Formación Técnica N°232 (ISFT N°232)**, para **3er año de la carrera Técnico Superior en Desarrollo de Software** en la materia **Programación Web**.

## 📖 Descripción
La aplicación permite:
- Almacenar información de productos en una **base de datos MySQL**, incluyendo imágenes guardadas en formato **BLOB**.
- Mostrar en una página web hasta **3 productos** con:
  - Imagen
  - Precio
  - Descripción
- Filtrar productos mediante un **buscador dinámico** implementado en **JavaScript**.
- Visualizar el detalle de un producto con todas sus imágenes y descripciones en un **modal interactivo**.

## 🛠 Tecnologías utilizadas
- **PHP**: para la lógica de servidor y conexión con MySQL.
- **MySQL**: para almacenar la información de los productos y sus imágenes.
- **JavaScript**: para actualizar dinámicamente el contenido y realizar búsquedas sin recargar la página.
- **CSS**: para el diseño visual y el modal de detalle.

## 📂 Estructura de archivos
/index.html -> Página principal.

/estilos.css -> Estilos principales de la página.

/script.js -> Lógica de búsqueda y carga de productos.

/productos.php -> Devuelve la lista de productos en formato JSON.

/detalle.php -> Devuelve el detalle de un producto.

/subir.php -> Formulario y script para subir imágenes a la base de datos.

## 🗄 Estructura de la base de datos
Base de datos: `tienda`
```sql
CREATE TABLE productos (
    codi INT PRIMARY KEY,
    descri VARCHAR(100),
    precio DECIMAL(10,2)
);

CREATE TABLE imagenes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    codi INT,
    imagen LONGBLOB,
    tipo_imagen VARCHAR(50),
    FOREIGN KEY (codi) REFERENCES productos(codi)
);
```

