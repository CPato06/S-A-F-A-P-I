async function agregarACarrito(carritoId, productoId) {
  try{
    await fetch(`agregar_producto_carrito.php?carrito=${carritoId}&producto=${productoId}`);
    alert("Producto agregado al carrito.");
  }
  catch(e) {
    alert("Ha ocurrido un error al agregar el producto al carrito.");
  }
}

async function eliminarProductoCarrito(carritoId, productoId) {
  event.preventDefault();
  try {
    console.log(`eliminar_producto_carrito.php?carrito=${carritoId}&producto=${productoId}` );
    console.log(await fetch(`eliminar_producto_carrito.php?carrito=${carritoId}&producto=${productoId}`)) ;
    await fetch(`eliminar_producto_carrito.php?carrito=${carritoId}&producto=${productoId}`);
    alert("Producto eliminado del carrito.");
    window.location.reload();
  } catch (error) {
    console.log(error);
    alert("Ha ocurrido un error al eliminar el producto del carrito.");
  }
}

async function pagarCarrito(carritoId) {
  try {
    await fetch(`pagar_carrito.php?carrito=${carritoId}`);
    alert("Orden realizada.");
    location.href = `venta.php?id=${carritoId}`;
  } catch (error) {
    alert("Ha ocurrido un error al realizar la orden de tu carrito.");
  }
}
