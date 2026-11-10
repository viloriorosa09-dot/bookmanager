# Guía de Reyna Elizabeth: Publicadores, plantilla e interfaz

Tu trabajo en una frase: hacer que todo el proyecto se vea bien y funcione igual en todas las pantallas, y hacer el CRUD de **Publicadores**.

## Antes de empezar

1. `git pull` para traer lo último.
2. Crea tu rama: `git checkout -b feature/plantilla-publicadores`.
3. Abre phpMyAdmin (puerto 8081) y mira las columnas reales de la tabla de publicadores. Usa esos nombres exactos.

---

## Semana 1: plantilla y primer modelo

### 1. Descargar la plantilla
- Entra en https://github.com/StartBootstrap/startbootstrap-sb-admin-2
- **Code > Download ZIP** y descomprime.
- Copia las carpetas `css`, `js`, `vendor` e `img` dentro de `assets/` del proyecto.
- **Listo cuando:** existe `assets/css/sb-admin-2.min.css`.

### 2. Header y footer (carpeta `includes/`)
- Abre `index.html` de la plantilla.
- Corta desde el inicio hasta donde empieza el contenido (menú lateral y barra superior) y pégalo en `includes/header.php`.
- Corta desde donde termina el contenido hasta el final (pie y scripts) y pégalo en `includes/footer.php`.
- Cambia las rutas de los `href` y `src` para que apunten a `assets/`.
- Las rutas deben funcionar desde cualquier carpeta. Lo más simple es una constante:
```php
<?php
define('BASE_URL', '/');
```
y usar `<?= BASE_URL ?>assets/css/sb-admin-2.min.css`. Ponla en `includes/app.php`. Charlie la cambiará al publicar en línea.
- Cambia el título del menú a "BookManager".
- **Listo cuando:** `index.php` incluye header y footer y se ve la plantilla con estilos.

### 3. Menú
- Enlaces en el menú lateral: Inicio, Tiendas, Publicadores, Títulos.
- Quita lo que no se use (gráficas, páginas de ejemplo).

### 4. Modelo `models/Publicador.php`
- **Importante:** Charlie lo necesita para el `<select>` de editoriales. Haz primero `getAll()` y avísale por el grupo.
- Implementa `CrudInterface` (Wilber la sube esta semana). Mientras no esté, empieza solo con `getAll()`.
- Copia el patrón de `models/Tienda.php` de Wilber:
```php
$sql = 'SELECT * FROM nombre_tabla WHERE id_pub = :id';
$stmt = $this->db->prepare($sql);
$stmt->execute([':id' => $id]);
return $stmt->fetch() ?: null;
```
- Reglas: siempre `prepare()` y `execute()`, nunca variables dentro del SQL. En `create()` el ID lo escribe el usuario (4 caracteres).
- **Listo cuando:** `getAll()` devuelve los publicadores.

### Al terminar la semana 1
`git add .`, `git commit -m "Plantilla y modelo Publicador"`, `git push origin feature/plantilla-publicadores` y abre un Pull Request. Pide que lo revise alguien del equipo.

---

## Semana 2: CRUD y diseño uniforme

### 1. Vistas de Publicadores (carpeta `views/publicadores/`)
| Archivo | Qué hace |
| --- | --- |
| `listar.php` | Tabla con todos los publicadores y botones Editar y Eliminar |
| `crear.php` | Formulario con el ID, el nombre y demás campos |
| `editar.php` | Formulario cargado con los datos actuales |
| `eliminar.php` | Borra y vuelve al listado |

- Incluye `header.php` y `footer.php` con `__DIR__`.
- Antes de eliminar, comprueba que el publicador no tenga títulos. Si los tiene, muestra un mensaje y no lo borres.
- Valida en el servidor que no haya campos vacíos.
- Al mostrar datos en HTML usa `htmlspecialchars()`.
- **Listo cuando:** puedes crear, editar y eliminar un publicador desde el navegador.

### 2. Interfaz uniforme (todo el proyecto)
- Las tres pantallas de listado usan el mismo estilo de tabla de la plantilla.
- Los botones tienen los mismos colores: verde para guardar, amarillo para editar, rojo para eliminar.
- Los mensajes de éxito y de error se ven igual en todos los módulos.
- El menú resalta la sección donde estás.
- Revisa que se vea bien en el celular.

### 3. Página de inicio
- `index.php` con un resumen sencillo: número de tiendas, de publicadores y de títulos.

---

## Semana 3: cierre

### 1. Revisión visual
- Recorre todas las pantallas buscando textos cortados, botones desalineados y enlaces rotos.
- Cuando Charlie publique en línea, revisa que los estilos carguen bien allí.

### 2. Tu parte del PDF
- Descripción del proyecto: qué es, para qué sirve y qué tecnologías usa.
- Diseño: por qué se eligió la plantilla y cómo se organiza el menú.
- Unas 8 a 10 líneas y 1 o 2 capturas de la interfaz.
- Pásala a Wilber para el armado final.

### 3. Revisión final
- Comprueba que `README.md` describe bien la plantilla usada.
- Verifica que no quedan archivos sin usar en `assets/`.

---

## Si te bloqueas
1. Lee el mensaje de error completo. Casi siempre dice la línea.
2. Abre el navegador, tecla F12 y mira la pestaña **Consola** si los estilos no cargan.
3. Si pasan 30 minutos, pregunta al grupo.
