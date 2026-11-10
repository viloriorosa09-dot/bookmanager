# Guía de Wilber: Tiendas, base de datos, interfaces y UML

Tu trabajo en una frase: dejar lista la base que usan los demás y hacer el CRUD de **Tiendas**.

## Antes de empezar

1. `git pull` para traer lo último.
2. Crea tu rama: `git checkout -b feature/base-tiendas`.
3. Abre phpMyAdmin (puerto 8081) y mira las columnas reales de la tabla de tiendas. Usa esos nombres exactos.

## Clases a tu cargo

| Clase o interfaz | Archivo |
| --- | --- |
| `Database` | `config/database.php` |
| `ListableInterface` | `interfaces/ListableInterface.php` |
| `CrudInterface` | `interfaces/CrudInterface.php` |
| `Tienda` | `models/Tienda.php` |

Reyna Elizabeth (`Publicador`) y Charlie (`Titulo`) esperan tu `Database` y tus interfaces. Súbelas primero y avísales por el grupo.

---

## Semana 1: la base

### 1. Conexión (`config/database.php`)
- Una clase `Database` con un método `getConexion()` que devuelve un `PDO`.
- Lee los datos de `config.local.php` o de las variables de entorno.
- Activa `ERRMODE_EXCEPTION` y `FETCH_ASSOC`.
- **Listo cuando:** un `index.php` de prueba imprime "Conectado" sin errores.

### 2. Interfaces (carpeta `interfaces/`)
```php
<?php
interface ListableInterface
{
    public function getAll(): array;
}
```
```php
<?php
interface CrudInterface extends ListableInterface
{
    public function getById(string $id): ?array;
    public function create(array $datos): bool;
    public function update(string $id, array $datos): bool;
    public function delete(string $id): bool;
}
```
- **Listo cuando:** ambos archivos existen y Reyna Elizabeth y Charlie ya los pueden usar. Avísales por el grupo.

### 3. Modelo `models/Tienda.php`
- Implementa `CrudInterface`.
- El constructor recibe el `PDO`.
- Patrón de cada método:
```php
$sql = 'SELECT * FROM nombre_tabla WHERE id_tienda = :id';
$stmt = $this->db->prepare($sql);
$stmt->execute([':id' => $id]);
return $stmt->fetch() ?: null;
```
- Reglas: siempre `prepare()` y `execute()`, nunca variables dentro del SQL. En `create()` el ID lo escribe el usuario (4 caracteres).
- **Listo cuando:** `getAll()` imprime las tiendas desde una página de prueba.

### Al terminar la semana 1
`git add .`, `git commit -m "Base y modelo Tienda"`, `git push origin feature/base-tiendas` y abre un Pull Request. Pide que lo revise alguien del equipo.

---

## Semana 2: vistas y seguridad

### 1. Vistas de Tiendas (carpeta `views/tiendas/`)
| Archivo | Qué hace |
| --- | --- |
| `listar.php` | Tabla con todas las tiendas y botones Editar y Eliminar |
| `crear.php` | Formulario con el ID, el nombre y demás campos |
| `editar.php` | Formulario cargado con los datos actuales |
| `eliminar.php` | Borra y vuelve al listado |

- Incluye el `header` y el `footer` de Reyna Elizabeth con `__DIR__`.
- Muestra un mensaje de éxito o de error al guardar.
- Valida en el servidor que no haya campos vacíos.
- Al mostrar datos en HTML usa `htmlspecialchars()`.
- **Listo cuando:** puedes crear, editar y eliminar una tienda desde el navegador.

### 2. Revisión de seguridad (a todo el proyecto)
- [ ] No hay ninguna variable pegada dentro de un SQL.
- [ ] No hay contraseñas reales en el repositorio.
- [ ] Todos los `require` usan `__DIR__`.
- [ ] Se escapa con `htmlspecialchars()` lo que se imprime.

### 3. UML (`docs/uml/diagrama-clases.puml`)
- Compáralo con el código real: nombres de clases, atributos y métodos.
- `Publicador` ahora implementa `CrudInterface`, no `ListableInterface`. Cambia esa relación en el diagrama.
- Corrige lo que haya cambiado y renderízalo en plantuml.com para comprobarlo.

---

## Semana 3: cierre

### 1. Pruebas en línea
- Cuando Charlie publique en InfinityFree, prueba el CRUD de Tiendas allí.
- Si algo falla, revisa primero las credenciales y las rutas.

### 2. Tu parte del PDF
- Base de datos: qué tablas hay y cómo se relacionan.
- Diagrama UML de clases.
- Unas 8 a 10 líneas, con una imagen del UML.

### 3. Armado final
- Recibe de Reyna Elizabeth y de Charlie sus partes.
- Únelas en un solo documento de 2 a 3 páginas.
- Exporta a PDF y revisa que se vea bien.

### 4. Repositorio limpio
- Borra archivos de prueba.
- Comprueba que `README.md` y los planes semanales estén al día.

---

## Si te bloqueas
1. Lee el mensaje de error completo. Casi siempre dice la línea.
2. Prueba la consulta SQL directo en phpMyAdmin.
3. Si pasan 30 minutos, pregunta al grupo.
