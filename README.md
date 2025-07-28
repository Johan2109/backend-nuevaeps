# 📦 Sistema de Solicitudes de Medicamentos

Este proyecto es una API RESTful construida con **Laravel 12.x**, diseñada para la gestión de solicitudes de medicamentos. Incluye autenticación con Sanctum, validaciones condicionales, relaciones entre modelos y paginación.

## 🚀 Tecnologías

-   PHP 8.2+
-   Laravel 12.21
-   Laravel Sanctum (autenticación)
-   PostgreSQL (base de datos)
-   Eloquent ORM

---

## 🧱 Estructura principal

### 🧑‍⚕️ Usuarios (`users`)

Autenticación y consulta de usuarios.

### 💊 Medicamentos (`medicines`)

Catálogo básico de medicamentos. No contiene información de tipo POS o NO POS.

### 📋 Solicitudes (`requests`)

Solicitud de medicamentos. Si el medicamento es NO POS, se requiere más información.

---

## 📥 Instalación

1. Clona el repositorio:

    ```bash
    git clone https://github.com/tuusuario/nombre-proyecto.git
    cd nombre-proyecto
    ```

2. Instala dependencias:

    ```bash
    composer install
    ```

3. Configura `.env`:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    Asegúrate de configurar tu base de datos PostgreSQL.

4. Ejecuta migraciones:

    ```bash
    php artisan migrate
    ```

5. Arranca el servidor:
    ```bash
    php artisan serve
    ```

---

## 🔐 Autenticación

Se utiliza Laravel Sanctum. Para acceder a las rutas protegidas, primero debes registrarte o iniciar sesión para obtener el token.

### 🔸 Registro

`POST /api/auth/register`

```json
{
    "name": "Juan",
    "email": "juan@example.com",
    "password": "123456",
    "password_confirmation": "123456"
}
```

### 🔸 Login

`POST /api/auth/login`

```json
{
    "email": "juan@example.com",
    "password": "123456"
}
```

**Respuesta:**

```json
{
    "user": {
        "id": 1,
        "name": "Juan",
        "email": "juan@example.com"
    },
    "token": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6..."
}
```

Usa ese token en tus peticiones autenticadas:

```http
Authorization: Bearer <token>
```

---

## 📚 Endpoints disponibles

> ⚠️ Todos estos requieren autenticación (`auth:sanctum`)

### 🔹 Usuarios

-   `GET /api/users`: Lista de usuarios
-   `GET /api/users/{id}`: Detalles de usuario

### 🔹 Medicamentos

-   `GET /api/medicines`: Lista de medicamentos
-   `POST /api/medicines`: Crear medicamento

**Ejemplo POST:**

```json
{
    "name": "Ibuprofeno"
}
```

### 🔹 Solicitudes

-   `GET /api/requests`: Lista paginada de solicitudes
-   `POST /api/requests`: Crear solicitud

**Ejemplo POST (NO POS):**

```json
{
    "medicine_id": 1,
    "is_no_pos": true,
    "order_number": "ORD-00234",
    "address": "Calle 123",
    "phone": "3001234567",
    "email": "paciente@correo.com"
}
```

**Ejemplo POST (POS):**

```json
{
    "medicine_id": 1,
    "is_no_pos": false
}
```

---

## 🧪 Tests

Puedes usar herramientas como **Postman** para probar los endpoints.

---

## 🧑‍💻 Autor

-   **Johan Ronaldo López Montes**

---

## ✅ Estado

Este backend está completamente funcional, validado y listo para integrarse con un frontend (React o Angular).
