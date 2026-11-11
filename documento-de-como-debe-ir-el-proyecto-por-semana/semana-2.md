# Semana 2: CRUD completo e interfaz uniforme

**Meta:** que los tres módulos permitan crear, editar, eliminar y listar desde el navegador, con el mismo diseño.

## Tareas

| Tarea | Responsable | Entrega |
| --- | --- | --- |
| `views/tiendas/` (listar, crear, editar, eliminar) | Wilber | CRUD de Tiendas funcionando |
| Revisión de seguridad de todo el proyecto | Wilber | Lista de verificación completa |
| Actualizar `docs/uml/diagrama-clases.puml` | Wilber | `Publicador` implementa `CrudInterface` |
| `views/publicadores/` (listar, crear, editar, eliminar) | Reyna Elizabeth | CRUD de Publicadores; no deja borrar si tiene títulos |
| Interfaz uniforme: tablas, botones, mensajes y menú resaltado | Reyna Elizabeth | Mismo estilo en los tres módulos |
| `index.php` con resumen de tiendas, publicadores y títulos | Reyna Elizabeth | Tres contadores |
| `views/titulos/` (listar, crear, editar, eliminar) | Charlie | CRUD de Títulos funcionando |
| `<select>` de editoriales con `Publicador::getAll()` | Charlie | La editorial actual aparece marcada al editar |

## Revisión de seguridad (Wilber)

- [ ] Ninguna variable va pegada dentro de un SQL.
- [ ] No hay contraseñas reales en el repositorio.
- [ ] Todos los `require` usan `__DIR__`.
- [ ] Todo lo que se imprime pasa por `htmlspecialchars()`.
- [ ] Los formularios validan campos vacíos en el servidor.

## Revisión cruzada

| Revisa | El Pull Request de |
| --- | --- |
| Wilber | Charlie |
| Charlie | Reyna Elizabeth |
| Reyna Elizabeth | Wilber |

## Listo para pasar a la semana 3

- [ ] Los tres CRUD funcionan en local.
- [ ] El diseño es el mismo en todas las pantallas.
- [ ] El UML coincide con el código.
