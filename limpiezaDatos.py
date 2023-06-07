import pandas as pd

# Leer el archivo CSV
df = pd.read_excel("transacciones_ago_2016_feb_2022.xlsx")

# Seleccionar columnas relevantes
df = df[["fecha_creacion", "monto_cargo", "email", "telefono", "ip", "banco", "marca_tarjeta", "tipo_tarjeta", "metodo_pago", "meses_sin_intereses"]]

# Eliminar desplazamiento de zona horaria en "fecha_creacion"
df["fecha_creacion"] = df["fecha_creacion"].str[:-6]

# Convertir "fecha_creacion" a datetime
df["fecha_creacion"] = pd.to_datetime(df["fecha_creacion"], format="%Y-%m-%d %H:%M:%S")

# Dividir la columna "fecha_creacion" en nuevas columnas
df["Anio_Transaccion"] = pd.to_datetime(df["fecha_creacion"]).dt.year
df["Mes_Transaccion"] = pd.to_datetime(df["fecha_creacion"]).dt.month
df["Dia_Transaccion"] = pd.to_datetime(df["fecha_creacion"]).dt.day
df["Hora_Transaccion"] = pd.to_datetime(df["fecha_creacion"]).dt.hour
df["Minutos_Transaccion"] = pd.to_datetime(df["fecha_creacion"]).dt.minute

# Convertir los correos electrónicos a minúsculas
df["email"] = df["email"].str.lower()

# Dividir la columna "email" en "Usuario_Correo_Cliente" y "Dominio_Correo_Cliente"
def verificar_correo(correo):
    dominios_validos = [".com", ".mx", ".org", ".con", ".es", ".net"]
    partes = correo.split("@")
    if len(partes) == 2:
        usuario, dominio = partes
        if dominio.endswith(tuple(dominios_validos)):
            return pd.Series([usuario, "@" + dominio], index=["Usuario_Correo_Cliente", "Dominio_Correo_Cliente"])
    return pd.Series(["", ""], index=["Usuario_Correo_Cliente", "Dominio_Correo_Cliente"])

df[["Usuario_Correo_Cliente", "Dominio_Correo_Cliente"]] = df["email"].apply(verificar_correo)

# Convertir la columna "telefono" a cadena de texto
df["telefono"] = df["telefono"].astype(str)

# Dividir la columna "telefono" en "Lada_Telefono" y "Numero_Telefono"
df["Lada_Telefono"] = df["telefono"].apply(lambda x: x[:-7] if len(x) > 7 else "")
df["Numero_Telefono"] = df["telefono"].apply(lambda x: x[-7:] if len(x) >= 7 else x)

# Filtrar los campos de la columna "metodo_pago" que contienen "CreditCardPayment"
df = df[df["metodo_pago"].str.contains("CreditCardPayment")]

# Reiniciar los índices del DataFrame filtrado
df.reset_index(drop=True, inplace=True)

# Eliminar columna "fecha_creacion"
df.drop("fecha_creacion", axis=1, inplace=True)

# Elimina la columna "email"
df.drop("email", axis=1, inplace=True)

# Eliminar la columna "telefono"
df.drop("telefono", axis=1, inplace=True)

# Renombramos columnas
df.rename(columns={"metodo_pago": "Metodo_Pago_Cliente", "meses_sin_intereses": "MSI_CreditCard_Cliente"}, inplace=True)
df.rename(columns={"monto_cargo": "Monto_Transaccion", "ip": "Direccion_IP_Cliente"}, inplace=True)
df.rename(columns={"banco": "Banco_Cliente", "marca_tarjeta": "Marca_Tarjeta_Cliente", "tipo_tarjeta": "Categoria_Tarjeta_Cliente"}, inplace=True)

# Agregar columnas "CP", "TP", "TipoDispositivo_Cliente", "Version_OS_Cliente", "Tipo_Paqueteria", "Envio_Asegurado" y "Fraude_Transaccion"
df["Codigo_Postal_Cliente"] = ""
df["Tipo_Tarjeta_Cliente"] = ""
df["TipoDispositivo_Cliente"] = ""
df["Version_OS_Cliente"] = ""
df["Tipo_Paqueteria"] = ""
df["Envio_Asegurado"] = ""
df["Fraude_Transaccion"] = ""

# Reordenar columnas
column_order = ["Anio_Transaccion", "Mes_Transaccion", "Dia_Transaccion", "Hora_Transaccion", "Minutos_Transaccion",
"Lada_Telefono", "Numero_Telefono", "Codigo_Postal_Cliente",
"Banco_Cliente", "Monto_Transaccion", "Marca_Tarjeta_Cliente", "Categoria_Tarjeta_Cliente", "Tipo_Tarjeta_Cliente", "Metodo_Pago_Cliente", "MSI_CreditCard_Cliente",
"Usuario_Correo_Cliente", "Dominio_Correo_Cliente", "Direccion_IP_Cliente", 
"TipoDispositivo_Cliente", "Version_OS_Cliente", "Tipo_Paqueteria", "Envio_Asegurado", "Fraude_Transaccion"]

df = df.reindex(columns=column_order)

# Guardar el DataFrame limpio en un nuevo archivo Excel
df.to_excel("transacciones_filtradas.xlsx", index=False)
