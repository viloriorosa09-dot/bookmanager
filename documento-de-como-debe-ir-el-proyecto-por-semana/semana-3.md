# Semana 3: despliegue, repositorio y entrega

**Meta:** publicar BookManager en InfinityFree con la base de datos remota, y entregar el PDF final.

## Tareas

| Tarea | Responsable | Entrega |
| --- | --- | --- |
| Crear la cuenta y el hosting en InfinityFree | Compañero 3 | Dominio o subdominio activo |
| Crear la base de datos en el panel y anotar host, usuario y nombre | Compañero 3 | Datos guardados fuera del repositorio |
| Importar `database/dblibreria.sql` en el phpMyAdmin de InfinityFree | Compañero 3 | Todas las tablas con sus datos |
| Crear `config/config.local.php` en el servidor con los datos remotos | Compañero 3 | Conexión funcionando en línea |
| Subir el proyecto a la carpeta `htdocs` | Compañero 3 | Archivos publicados, sin `config.local.php` en GitHub |
| Probar todas las rutas en línea (`__DIR__`, mayúsculas, rutas relativas) | Compañero 2 | Lista de errores corregida |
| Probar el CRUD completo de tiendas y títulos en la URL pública | Wilber | Sin errores en ninguna vista |
| Revisar que el repositorio no tenga contraseñas y que `main` esté al día | Wilber | Repositorio limpio |
| Capturas finales de la aplicación en línea | Compañero 3 | Una por módulo |
| PDF de 2 a 3 páginas | Todos | Capturas, URL pública y explicación de la arquitectura POO |

## Qué lleva el PDF

1. Capturas de pantalla de las vistas principales.
2. La URL pública de la aplicación y la URL del repositorio.
3. La explicación de la arquitectura POO: la clase `Database`, las interfaces, los modelos `Tienda`, `Titulo` y `Publicador`, y cómo se usan las sentencias preparadas.
4. El diagrama de clases.

## Notas importantes

- El archivo de la base viene en `latin1`; si importas con errores de acentos, elige esa codificación al importar.
- Los datos de InfinityFree son secretos: ni en el repositorio, ni en el PDF, ni en capturas.
- Si hay "File not found", casi siempre es una ruta sin `__DIR__`.

## Criterios para dar el proyecto por terminado

- [ ] La URL pública abre la aplicación y todo el CRUD funciona.
- [ ] La base de datos remota está importada.
- [ ] El repositorio está en GitHub, limpio y con README actualizado.
- [ ] El PDF está entregado con todos los puntos de arriba.
