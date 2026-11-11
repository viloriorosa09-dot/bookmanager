# Semana 1: base, plantilla y modelos

**Meta:** dejar la conexión y las interfaces funcionando, la plantilla montada y los tres modelos empezados.

## Antes de programar (todos)

- [ ] Aceptar la invitación al repositorio.
- [ ] Abrir el proyecto con Codespaces o Docker y comprobar que `http://localhost:8080` responde y phpMyAdmin muestra la base `dblibreria`.
- [ ] Leer el `README.md` y tu guía en `docs/guias/`.
- [ ] Votar la plantilla (SB Admin 2 o AdminLTE) antes de tocar `assets/`.
- [ ] Crear tu rama: `feature/...` según tu guía.

## Tareas

| Tarea | Responsable | Entrega |
| --- | --- | --- |
| `config/database.php` | Wilber | `test-conexion.php` imprime "Conectado" |
| `ListableInterface` y `CrudInterface` | Wilber | Archivos en `interfaces/`; avisa al grupo al subirlos |
| `models/Tienda.php` | Wilber | `getAll()` devuelve las tiendas |
| Plantilla en `assets/`, `includes/header.php`, `footer.php` y `app.php` con `BASE_URL` | Reyna Elizabeth | Estilos cargando sin rutas rotas |
| Menú lateral: Inicio, Tiendas, Publicadores, Títulos | Reyna Elizabeth | Menú visible en `index.php` |
| `models/Publicador.php` (primero `getAll()`) | Reyna Elizabeth | Lista de editoriales; avisa a Charlie |
| `models/Titulo.php` | Charlie | `getAll()` devuelve los títulos |
| Tres títulos reales anotados para pruebas | Charlie | Lista de IDs de prueba |

## Revisión cruzada

| Revisa | El Pull Request de |
| --- | --- |
| Wilber | Charlie |
| Charlie | Reyna Elizabeth |
| Reyna Elizabeth | Wilber |

## Listo para pasar a la semana 2

- [ ] Los tres modelos usan `prepare()` y `execute()`.
- [ ] La plantilla se ve en todas las pantallas.
- [ ] Los tres Pull Requests están revisados y unidos a `main`.
