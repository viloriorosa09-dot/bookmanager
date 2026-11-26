# BookManager

Sistema web de gestión de librería hecho en **PHP 8.2 con POO y PDO**. Proyecto final de Programación Orientada a Objetos, UASD.

## Objetivo

Administrar tres tablas de la base de datos `dblibreria` con un CRUD completo: **Tiendas**, **Publicadores** (editoriales) y **Títulos** (libros).

## Equipo

| Integrante | CRUD | Apoyo |
| --- | --- | --- |
| **Wilber Vilorio Rosa** | Tiendas | Base de datos, interfaces y UML |
| **Reyna Elizabeth** | Publicadores | Plantilla, menú e interfaz |
| **Charlie** | Títulos | Despliegue en InfinityFree |

## Empieza aquí

Cada integrante tiene su guía con pasos por semana:

| Integrante | Guía |
| --- | --- |
| Wilber | [`docs/guias/wilber.md`](docs/guias/wilber.md) |
| Reyna Elizabeth | [`docs/guias/reyna-elizabeth.md`](docs/guias/reyna-elizabeth.md) |
| Charlie | [`docs/guias/charlie.md`](docs/guias/charlie.md) |

Los planes semanales están en [`docs/semanas/`](docs/semanas/).

## Tecnologías

- PHP 8.2 (POO estricta) y PDO con consultas preparadas
- MySQL 8 (`dblibreria`)
- Bootstrap 4 (plantilla StartBootstrap SB Admin 2)
- Docker, Codespaces y PlantUML

## Qué debe tener el sistema

| Entregable | Responsable |
| --- | --- |
| Clase `Database` (conexión PDO) | Wilber |
| Interfaces `ListableInterface` y `CrudInterface` | Wilber |
| CRUD de Tiendas | Wilber |
| Diagrama UML de clases | Wilber |
| CRUD de Publicadores | Reyna Elizabeth |
| Plantilla, menú e interfaz uniforme | Reyna Elizabeth |
| CRUD de Títulos con `<select>` de editoriales | Charlie |
| Sitio publicado en InfinityFree | Charlie |
| PDF: base de datos y UML | Wilber |
| PDF: descripción y diseño | Reyna Elizabeth |
| PDF: arquitectura POO y capturas | Charlie |
| PDF: armado final y revisión | Wilber |

## Clases por persona

| Clase o interfaz | Archivo | Responsable |
| --- | --- | --- |
| `Database` | `config/database.php` | Wilber |
| `ListableInterface` | `interfaces/ListableInterface.php` | Wilber |
| `CrudInterface` | `interfaces/CrudInterface.php` | Wilber |
| `Tienda` | `models/Tienda.php` | Wilber |
| `Publicador` | `models/Publicador.php` | Reyna Elizabeth |
| `Titulo` | `models/Titulo.php` | Charlie |

`Titulo` usa `Publicador::getAll()` para el `<select>` de editoriales, así que Reyna Elizabeth sube primero ese método.

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
├── docs/
│   ├── guias/          guía de cada integrante
│   ├── semanas/        plan de las semanas 1, 2 y 3
│   └── uml/            diagrama de clases
├── interfaces/         ListableInterface, CrudInterface
├── models/             Tienda, Publicador, Titulo
├── views/              pantallas de cada módulo
├── includes/           app.php, header.php y footer.php
├── assets/             plantilla SB Admin 2 (css, js, vendor, img)
├── index.php           página de inicio con resumen
├── test-conexion.php   temporal; se borra en la semana 3
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
git clone https://github.com/viloriorosa09-dot/bookmanager.git
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

El profesor pidió un PDF de 2 a 3 páginas. Cada integrante redacta la parte de lo que construyó y Wilber lo arma al final. Contiene: portada, descripción, base de datos y UML, arquitectura POO, capturas del CRUD con el enlace en línea, y conclusiones.

## Lista final de entrega

- [ ] CRUD funcionando en línea
- [ ] Repositorio limpio, sin contraseñas
- [ ] UML actualizado
- [ ] PDF terminado
- [ ] Cada integrante puede explicar su parte
