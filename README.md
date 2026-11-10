# BookManager

Sistema web de gestión de librería hecho en **PHP 8.2 con POO y PDO**. Proyecto final de Programación Orientada a Objetos, UASD.

## Objetivo

Administrar tres tablas de la base de datos `dblibreria` con un CRUD completo: **Tiendas**, **Publicadores** (editoriales) y **Títulos** (libros).

## Equipo

| Integrante | Rol |
| --- | --- |
| Wilber Vilorio Rosa | Líder, base de datos, seguridad y UML |
| Integrante 2 | Modelos y CRUD de Títulos |
| Integrante 3 | Plantilla, interfaz y despliegue |

## Tecnologías

- PHP 8.2 (POO estricta) y PDO con consultas preparadas
- MySQL 8 (`dblibreria`)
- Bootstrap (plantilla SB Admin 2)
- Docker, Codespaces y PlantUML

## Qué debe tener el sistema

- [ ] Clase `Database` que crea la conexión PDO
- [ ] Interfaces `ListableInterface` y `CrudInterface`
- [ ] Modelos `Tienda`, `Publicador` y `Titulo`
- [ ] CRUD completo de Tiendas y Títulos (listar, crear, editar, eliminar)
- [ ] Listado de Publicadores, usado en un `<select>` al crear títulos
- [ ] Interfaz con la plantilla, menú único y diseño uniforme
- [ ] Sitio publicado en InfinityFree
- [ ] Diagrama UML de clases
- [ ] Documentación en PDF (2 a 3 páginas)

## Cómo se evalúa

| Criterio | Puntos |
| --- | --- |
| Programación orientada a objetos | 25 |
| Seguridad con PDO | 20 |
| CRUD | 25 |
| Interfaz y experiencia de usuario | 15 |
| Despliegue y entrega | 15 |

## Estructura

```text
bookmanager/
├── .devcontainer/      Codespaces
├── config/             conexión a la base de datos
├── database/           dblibreria.sql
├── docs/               UML, planes semanales, reparto y PDF
├── interfaces/         ListableInterface, CrudInterface
├── models/             Tienda, Publicador, Titulo
├── views/              pantallas de cada módulo
├── includes/           header y footer comunes
├── assets/             plantilla (css, js, img)
├── index.php
├── Dockerfile
└── docker-compose.yml
```

## Cómo ejecutarlo

### Opción 1: Codespaces
1. Botón verde **Code** > pestaña **Codespaces** > **Create codespace**.
2. Espera a que termine de construir.
3. App en el puerto **8080**, phpMyAdmin en el **8081**.

### Opción 2: Docker local
```bash
git clone <URL-del-repo>
cd bookmanager
docker compose up --build
```
App en `http://localhost:8080` y phpMyAdmin en `http://localhost:8081` (usuario `root`, clave `rootpass`).

### Opción 3: instalación manual
1. Instala PHP 8.2, MySQL 8 y Apache (o Laragon).
2. Importa `database/dblibreria.sql` en phpMyAdmin.
3. Copia `config/config.example.php` como `config/config.local.php` y pon tus datos.
4. Coloca el proyecto en la carpeta del servidor y abre `http://localhost/bookmanager`.

## Reglas del código

- Todas las consultas con `prepare()` y `execute()`. Nunca concatenar variables en el SQL.
- Usar `__DIR__` en los `require`.
- No subir contraseñas reales. `config.local.php` está ignorado por Git.
- Los IDs son texto: `id_tienda` (4), `id_titulo` (6) e `id_pub` (4). Los formularios deben pedir el ID.

## Cómo trabajamos

1. Nadie trabaja directo en `main`. Cada tarea va en su rama (`feature/titulos`, `feature/plantilla`).
2. Al terminar, se abre un **Pull Request** y otro integrante lo revisa.
3. Commits cortos y claros, en español.
4. Si te bloqueas más de 30 minutos, avisa al grupo.

## Calendario

| Semana | Meta | Archivo |
| --- | --- | --- |
| 1 | Base: conexión, interfaces, modelos y plantilla | `docs/semanas/semana-1.md` |
| 2 | CRUD completo, menú y revisión de seguridad | `docs/semanas/semana-2.md` |
| 3 | Despliegue, pruebas y PDF | `docs/semanas/semana-3.md` |

## Documentación PDF

Cada integrante redacta la parte de lo que construyó y uno solo lo arma al final. Contiene: portada, descripción, base de datos y UML, arquitectura POO, capturas del CRUD con el enlace en línea, y conclusiones.

## Lista final de entrega

- [ ] CRUD funcionando en línea
- [ ] Repositorio limpio, sin contraseñas
- [ ] UML actualizado
- [ ] PDF terminado
- [ ] Cada integrante puede explicar su parte
