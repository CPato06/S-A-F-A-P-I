from flask import Flask, request
import mysql.connector
import requests

app = Flask(__name__)

@app.route('/')
def index():
    return ""

@app.route('/compras', methods=['POST'])
def recibir_compra():
    datos_compra = request.json

    # Llamar a la función de predicción con los datos de la compra
    # Realizar la solicitud a Akkio
    akkio_url = 'https://api.akkio.com/api'
    akkio_flow_key = 'kiqxlH8TxbN8BZ8j0DzB/1'
    akkio_api_key = 'a4f56811-04dd-4ae0-9d0e-35553c345b75'

    payload = {
        'flow_key': akkio_flow_key,
        'api_key': akkio_api_key,
        'data': [datos_compra]
    }

    response = requests.get(akkio_url, params=payload)
    response_json = response.json()
    resultado_prediccion = response_json[0]

    # Establecer la conexión a la base de datos
    conexion = mysql.connector.connect(
        host='database-api.cdjnyiihv9g0.us-east-2.rds.amazonaws.com',
        user='admin',
        password='Adminpato',
        database='FFF'
    )

    # Crear un cursor para ejecutar consultas
    cursor = conexion.cursor()

    # Construir la consulta SQL para insertar los datos en la tabla
    consulta = "INSERT INTO tabla_transacciones (campo1, campo2, probabilidad_fraude) VALUES (%s, %s, %s)"
    valores = (datos_compra['campo1'], datos_compra['campo2'], resultado_prediccion['probabilidad_fraude'])

    # Ejecutar la consulta
    cursor.execute(consulta, valores)

    # Confirmar los cambios en la base de datos
    conexion.commit()

    # Cerrar la conexión y el cursor
    cursor.close()
    conexion.close()

    return "Datos de compra recibidos"

def NotFound(error):
    return "<h1>Esta pagina no existe</h1>"

if __name__ == '__main__':
    app.register_error_handler(404, NotFound)
    app.run()