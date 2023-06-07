async function pagarCarrito2(carritoId) {
  try {
    await fetch(`pagar_carrito.php?carrito=${carritoId}`);
    alert("Orden realizada.");
    location.href = `venta.php?id=${carritoId}`;
  } catch (error) {
    alert("Ha ocurrido un error al realizar la orden de tu carrito.");
  }
}
