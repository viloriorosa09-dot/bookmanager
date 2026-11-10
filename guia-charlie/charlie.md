# Guía de Charlie: Títulos y despliegue en línea

Tu trabajo en una frase: hacer el CRUD de **Títulos** (libros) y publicar el proyecto en internet para que funcione en línea.

## Antes de empezar

1. `git pull` para traer lo último.
2. Crea tu rama: `git checkout -b feature/titulos`.
3. Abre phpMyAdmin (puerto 8081) y mira las columnas reales de la tabla de títulos. Usa esos nombres exactos.
4. Lo que necesitas de tus compañeros:
   - De Wilber: la clase `Database` y las interfaces (semana 1).
   - De Reyna Elizabeth: `Publicador::getAll()` y `BASE_URL` (semana 1).
   - Mientras no estén, lee la guía de ellos para saber qué viene y empieza por la lectura de la tabla.

---

## Semana 1: modelo de Títulos

### 1. Modelo `models/Titulo.php`
- Implementa `CrudInterface` y su constructor recibe el `PDO`.
- Métodos: `getAll()`, `getById()`, `create()`, `update()` y `delete()`.
- Copia el patrón de `models/Tienda.php` de Wilber:
```php
$sql = 'SELECT * FROM nombre_tabla WHERE id_titulo = :id';
$stmt = $this->db->prepare($sql);
$stmt->execute([':id' => $id]);
return $stmt->fetch() ?: null;
```
- Reglas: siempre `prepare()` y `execute()`, nunca variables dentro del SQL.
- El ID es de texto y tiene 6 caracteres. El usuario lo escribe en el formulario.
- El precio es un número con decimales. Conviértelo antes de guardar.
- **Listo cuando:** `getAll()` devuelve los títulos desde una página de prueba.

### 2. Datos de prueba
- Anota 3 títulos reales de la base para usarlos en tus pruebas.

### Al terminar la semana 1
`git add .`, `git commit -m "Modelo Titulo"`, `git push origin feature/titulos` y abre un Pull Request. Pide que lo revise alguien del equipo.

---

## Semana 2: vistas y editoriales

### 1. Vistas de Títulos (carpeta `views/titulos/`)
| Archivo | Qué hace |
| --- | --- |
| `listar.php` | Tabla con todos los títulos y botones Editar y Eliminar |
| `crear.php` | Formulario con ID, título, editorial, precio y demás campos |
| `editar.php` | Formulario cargado con los datos actuales |
| `eliminar.php` | Borra y vuelve al listado |

- Incluye `header.php` y `footer.php` de Reyna Elizabeth con `__DIR__`.
- Valida en el servidor que no haya campos vacíos y que el precio sea un número.
- Al mostrar datos en HTML usa `htmlspecialchars()`.

### 2. El `<select>` de editoriales
- En `crear.php` y `editar.php` pide la lista con `Publicador::getAll()`.
- Recórrela con un `foreach` y crea una `<option>` por cada editorial.
- En `editar.php` marca con `selected` la editorial actual del título.
- **Listo cuando:** puedes crear, editar y eliminar un título eligiendo su editorial de la lista.

### 3. Si salen mal las tildes
- Los datos viejos pueden estar en `latin1`. Avisa a Wilber para que revise el charset en `Database`. No lo cambies tú.

---

## Semana 3: publicar en línea

### 1. Cuenta en InfinityFree
- Crea una cuenta en https://www.infinityfree.com y un hosting gratuito.
- Anota el dominio, el usuario y la contraseña de FTP. No los pongas en el repositorio.

### 2. Base de datos en línea
- En el panel, entra a **MySQL Databases** y crea una base. Anota el host, el nombre, el usuario y la clave.
- Abre phpMyAdmin desde el panel y selecciona tu base.
- Importa `database/dblibreria.sql`. Si falla, borra del archivo las líneas `CREATE DATABASE` y `USE`, porque el hosting ya te dio la base.
- **Listo cuando:** ves las tablas con sus datos.

### 3. Subir los archivos
- Con el **Administrador de archivos** del panel o con FileZilla, sube el proyecto a la carpeta `htdocs`.
- No subas `.git`, `.devcontainer`, `Dockerfile` ni `docker-compose.yml`.
- Borra el `index2.html` que trae el hosting.

### 4. Configuración en el servidor
- En `config/`, crea el archivo `config.local.php` a mano en el servidor con los datos de tu base en línea (usa `config.example.php` como guía).
- En `includes/app.php` revisa que `BASE_URL` sea `'/'`.
- **Listo cuando:** abres tu dirección y ves la plantilla con los datos.

### 5. Pruebas
- Prueba crear, editar y eliminar en Tiendas, Publicadores y Títulos.
- Si algo falla: revisa primero las credenciales, luego las rutas y luego los mayúsculas y minúsculas de los nombres de archivos (el servidor distingue).
- Pasa el enlace a Wilber y a Reyna Elizabeth para que también prueben.

### 6. Tu parte del PDF
- Arquitectura POO: qué interfaces y clases hay, qué implementa cada una y cómo se usan con PDO. Puedes apoyarte en el diagrama UML de Wilber.
- Capturas de los tres CRUD funcionando y el enlace del sitio en línea.
- Unas 8 a 10 líneas y 3 o 4 capturas.
- Pásala a Wilber para el armado final.

---

## Si te bloqueas
1. Lee el mensaje de error completo. Casi siempre dice la línea.
2. Prueba la consulta SQL directo en phpMyAdmin.
3. Si pasan 30 minutos, pregunta al grupo.
