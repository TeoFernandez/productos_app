async function cargarProductos(query = '') {
    const res = await fetch(`productos.php?q=${encodeURIComponent(query)}`);
    const datos = await res.json();

    const cards = ['primer', 'segundo', 'tercero'];
    cards.forEach((id, index) => {
        const div = document.getElementById(id);
        if (datos[index]) {
            div.innerHTML = `
                <img src="${datos[index].imagen}" alt="${datos[index].descri}">
                <h3>${datos[index].descri}</h3>
                <p>Precio: $${Number(datos[index].precio).toLocaleString()}</p>
                <button onclick="verProducto(${datos[index].codi})">Ver</button>
            `;
        } else {
            div.innerHTML = '';
        }
    });
}

async function verProducto(codi) {
    const res = await fetch(`detalle.php?codi=${codi}`);
    const datos = await res.json();

    let contenido = `<h2>${datos.producto.descri}</h2>
                    <p>Precio: $${Number(datos.producto.precio).toLocaleString()}</p>
                    <div class="imagenes">`;

    datos.imagenes.forEach(img => {
        contenido += `<img src="data:${img.tipo};base64,${img.data}" alt="">`;
    });

    contenido += `</div><button onclick="cerrarModal()">Cerrar</button>`;

    document.getElementById('modal-contenido').innerHTML = contenido;
    document.getElementById('modal').style.display = 'flex';
}

function cerrarModal() {
    document.getElementById('modal').style.display = 'none';
}

document.getElementById('btnBuscar').addEventListener('click', () => {
    const valor = document.getElementById('buscador').value;
    cargarProductos(valor);
});

cargarProductos();
