# 🧬 Explicación del Proyecto X-Men Professional

He rediseñado tu práctica para que no solo se vea increíble (estilo tarjetas de los 90), sino que también siga estándares profesionales de desarrollo web con PHP. Aquí tienes el desglose de por qué se hizo cada cosa:

## 1. Conexión Segura (`db.php`)
**¿Por qué está aquí?**
En tu práctica anterior usabas `mysqli_connect`. Los profesionales prefieren **PDO (PHP Data Objects)**.
- **Seguridad**: Permite usar "sentencias preparadas", lo que hace casi imposible que alguien te hackee con inyecciones SQL.
- **Portabilidad**: Si el día de mañana decides moverte de MySQL a PostgreSQL, solo cambias una línea de código.

## 2. Página de Inicio (`index.php`)
**¿Por qué está aquí?**
Toda aplicación profesional necesita una "Landing Page" o página de bienvenida. Sirve para contextualizar al usuario y dar una navegación clara. He usado una estética tipo **Cerebro** (la computadora de Xavier) con colores azul y amarillo clásicos para dar esa sensación "premium".

## 3. El Formulario de Registro (`form.php`)
**¿Por qué está aquí?**
Aquí es donde ocurre la entrada de datos. Cosas clave:
- `enctype="multipart/form-data"`: Este atributo es crucial. Sin él, el navegador solo envía el *nombre* del archivo de imagen, pero no el archivo real.
- `method="POST"`: Se usa POST porque vamos a enviar mucha información y archivos. GET no sirve para esto porque los datos se verían en la URL y tienen límite de tamaño.

## 4. El Procesador de Lógica (`process.php`)
**¿Por qué está aquí?**
Es el cerebro del sistema. Su trabajo es recibir los datos y guardarlos.
- **Manejo de Imágenes**: A diferencia de guardar solo la ruta, aquí leemos el contenido binario real del archivo (`file_get_contents`) y lo guardamos como un **BLOB** en la base de datos, tal como lo hacías en tu código original pero de forma más limpia.
- **Redirección**: Al final, usamos `header("Location: cards.php")`. Esto es una práctica profesional para redirigir automáticamente al usuario a ver los resultados después de guardar, evitando que si recarga la página se dupliquen los datos.

## 5. Visualización: Tarjetas de los 90 (`cards.php`)
**¿Por qué está aquí?**
Es la salida de datos. He implementado un diseño de cuadrícula (Grid) que muestra las tarjetas como los coleccionables clásicos de **Fleer Ultra X-Men** de los años 90.
- **Codificación Base64**: Como la imagen está guardada en binario dentro de la base de datos, PHP la convierte a una cadena de texto Base64 para que el navegador pueda dibujarla directamente.
- **Diseño Responsivo**: He configurado que se vean **3 tarjetas por fila** en computadoras, pero si lo abres en un celular se ajustará automáticamente a una por fila para que no se vea amontonado.

---

### ⚠️ Acción Requerida en tu Base de Datos
Para que el campo de **Altura** (que pediste) funcione, necesitas agregar una columna a tu tabla actual. Ejecuta este código SQL en tu phpMyAdmin:

```sql
USE xmen;
ALTER TABLE equipoazul ADD COLUMN altura VARCHAR(50) AFTER poderes;
```
