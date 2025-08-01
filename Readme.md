# 🍽️ Gestión de Restaurantes - Proyecto Full Stack con Docker

Este repositorio contiene un proyecto completo de gestión de restaurantes desarrollado con:

- **Back-End:** Laravel (PHP)
- **Front-End:** Vue 3
- **Base de Datos:** MySQL
- **Entorno de Desarrollo:** Docker (multicontenedor con `docker-compose`)

---

## 🧱 Estructura del Proyecto


gestionRestaurantes/ <br>
├── Back-End/ <br>
├── Front-End/ <br>
└── docker-compose.yml <br>


---

## 🚀 Instrucciones para levantar el proyecto

1. **Abrir una terminal** en el directorio donde querramos tener el proyecto y clonarlo.
```bash
git clone https://github.com/sudoRaul/api-restaurantes.git
```

2. **Abrir una terminal** en el directorio raíz donde se encuentra el archivo `docker-compose.yml`.

3. **Ejecutar el siguiente comando:**

```bash
docker compose up --build
```
<br>

## 🚀 Servicios desplegados

Esto iniciará tres servicios:

| Servicio       | Puerto Local |
|----------------|--------------|
| Laravel API    | `8000`       |
| MySQL          | `3307`       |
| Vue Frontend   | `5173`       |

---

## 🗂️ Migraciones de la base de datos

Una vez que el proyecto esté corriendo:

1. Abre otra terminal.
2. Entra al contenedor del backend ejecutando:

```bash
docker exec -it gestionrestaurantes-app-1 bash
```

3. Una vez dentro, ejecutamos las migraciones:
```bash
php artisan migrate
```

## 📚 Documentación de la API

Después de realizar las migraciones, puedes acceder a la documentación interactiva generada con **Laravel Scribe**:

👉 [http://localhost:8000/docs](http://localhost:8000/docs)

---

## 🖥️ Interfaz Visual

Puedes acceder a la parte visual desarrollada con **Vue 3** en:

👉 [http://localhost:5173/](http://localhost:5173/)

Desde allí podrás:

- Crear nuevos restaurantes
- Visualizar todos los restaurantes
- Ver detalles individuales
- Editarlos o eliminarlos

---

## ✅ Requisitos

- Tener **Docker** y **Docker Compose** instalados en tu sistema.

---

## 📌 Notas

- Asegúrate de que los puertos `8000`, `3307` y `5173` estén libres en tu máquina.
- Si tienes algún problema con **CORS**, se puede solucionar en el backend añadiendo los orígenes permitidos tras desplegar el frontend.

## 🧑‍💻 Autor
Este proyecto ha sido realizado por Raúl Rodríguez como un proceso de aprendizaje sobre la autodocumentación en Laravel y la dockerización de aplicaciones.