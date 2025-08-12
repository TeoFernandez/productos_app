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
                <button>Ver</button>
            `;
        } else {
            div.innerHTML = '';
        }
    });
}

document.getElementById('btnBuscar').addEventListener('click', () => {
    const valor = document.getElementById('buscador').value;
    cargarProductos(valor);
});

cargarProductos();
