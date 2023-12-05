let carrito = [];
let contador = 0;

// Función para agregar un producto al carrito y actualizar el contador
function agregarAlCarrito(idProducto) {
    // Debes realizar la lógica para agregar el producto al carrito aquí
    // Por ejemplo, puedes agregar el producto a la variable 'carrito'

    // Incrementar el contador y actualizar el icono del carrito
    contador++;
    document.getElementById('contador-carrito').textContent = contador;
}

// Otro código de inicialización o funciones necesarias

// Asegúrate de cargar esta función al cargar la página o cuando sea necesario
function cargarCarrito() {
    // Puedes cargar los datos del carrito desde el servidor y actualizar el contador si es necesario
    // Ejemplo: carrito = obtenerDatosDelServidor();
    // contador = carrito.length;
    document.getElementById('contador-carrito').textContent = contador;
}

// Llama a la función para cargar el carrito cuando la página se carga
cargarCarrito();