async function botonMas(carritoId, productoId) {
  try{
    await fetch(`boton_mas.php?carrito=${carritoId}&producto=${productoId}`);
  }
  catch(e) {
  }
}

async function botonMenos(carritoId, productoId) {
  try{
    await fetch(`boton_menos.php?carrito=${carritoId}&producto=${productoId}`);
  }
  catch(e) {
  }
}
