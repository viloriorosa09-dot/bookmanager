# Semana 2: CRUD de Títulos y menú unificado

**Meta:** tener el CRUD completo de títulos con el `<select>` de editoriales, y un menú lateral que una Inicio, Tiendas y Títulos.

## Tareas

| Tarea | Responsable | Entrega |
| --- | --- | --- |
| `models/Titulo.php` completo | Compañero 2 | Implementa `CrudInterface`; propiedades privadas; sentencias preparadas |
| `views/titulos/index.php` | Compañero 2 | Tabla de títulos con el nombre de la editorial |
| `views/titulos/crear.php` y `editar.php` | Compañero 2 | Formulario con `<select>` de editoriales cargado desde `Publicador::getAll()` |
| `views/titulos/eliminar.php` | Compañero 2 | Eliminación con confirmación |
| Menú lateral unificado (Inicio, Tiendas, Títulos) | Compañero 3 | El mismo menú en todas las páginas desde `includes/header.php` |
| Mejoras de interfaz: tablas legibles, mensajes de éxito y de error | Compañero 3 | Interfaz uniforme en tiendas y títulos |
| Revisión de seguridad PDO en todos los modelos | Wilber | Ninguna consulta concatena variables |
| Revisión de POO: encapsulamiento, interfaces, constructores | Wilber | Lista de correcciones resuelta |
| Actualizar el diagrama UML si cambió alguna clase | Wilber | `docs/uml/diagrama-clases.puml` al día |
| Capturas de pantalla de las vistas de títulos y del menú | Compañero 3 | Una captura por vista |

## Notas importantes

- `id_titulo` es `varchar(6)` e `id_pub` es `varchar(4)`: los dos son texto.
- `precio`, `avance` y `total_ventas` pueden ser nulos en la base; el formulario debe aceptarlo.
- `fecha_pub` es un `datetime`; usa un campo de fecha en el formulario.

## Criterios para dar la semana por terminada

- [ ] Crear, ver, editar y eliminar un título funciona sin errores.
- [ ] El `<select>` muestra las editoriales y guarda la elegida.
- [ ] El menú lleva a Inicio, Tiendas y Títulos desde cualquier página.
- [ ] Los modelos cumplen la rúbrica de POO y de seguridad PDO.
