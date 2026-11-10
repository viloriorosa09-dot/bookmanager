# Semana 1: estructura, conexión y CRUD de Tiendas

**Meta:** tener el proyecto organizado, la conexión PDO funcionando y el CRUD completo de tiendas.

## Antes de programar (todos)

- [ ] Aceptar la invitación al repositorio.
- [ ] Abrir el proyecto con Codespaces o Docker y comprobar que http://localhost:8080 responde y phpMyAdmin muestra la base `dblibreria`.
- [ ] Leer el `README.md` y el diagrama `docs/uml/diagrama-clases.puml`.

## Tareas

| Tarea | Responsable | Entrega |
| --- | --- | --- |
| Carpetas `assets`, `config`, `models`, `views`, `includes`, `interfaces` | Wilber | Estructura igual a la guía del profesor |
| `config/database.php`: clase `Database` con PDO | Wilber | `getConexion()` devuelve el PDO sin errores |
| `interfaces/ListableInterface.php` y `CrudInterface.php` | Wilber | Las dos interfaces con sus métodos |
| `models/Tienda.php` | Wilber | Propiedades privadas, constructor con PDO, `getAll`, `getById`, `create`, `update`, `delete` con sentencias preparadas |
| `includes/header.php`, `footer.php` y `index.php` base | Compañero 3 | Página de inicio con el menú (Inicio, Tiendas, Títulos) |
| Plantilla Bootstrap en `assets/` | Compañero 3 | Estilos cargando sin rutas rotas |
| `views/tiendas/index.php` | Wilber | Tabla con todas las tiendas |
| `views/tiendas/crear.php`, `editar.php`, `eliminar.php` | Wilber | Las tres operaciones funcionando |
| Modelo `Publicador.php` (solo `getAll`) | Compañero 2 | Lista de editoriales lista para la semana 2 |
| Adelantar el esqueleto de `models/Titulo.php` | Compañero 2 | Clase con propiedades y constructor, sin CRUD todavía |
| Capturas de pantalla de las vistas de tiendas | Compañero 3 | Una captura por vista |

## Notas importantes

- Los IDs de la base son **texto** (`id_tienda` es `varchar(4)`), no números automáticos. El formulario de crear debe pedir el ID.
- Todas las consultas usan `prepare()` y `execute()`. Nunca se concatenan variables en el SQL.
- Todos los `include` y `require` usan `__DIR__`.

## Criterios para dar la semana por terminada

- [ ] Crear, ver, editar y eliminar una tienda funciona sin errores.
- [ ] Ningún archivo del repositorio contiene contraseñas reales.
- [ ] Todo está en `main` mediante Pull Requests revisados.
- [ ] Las capturas de pantalla están guardadas para el PDF final.
