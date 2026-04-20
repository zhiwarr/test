# Products API (Laravel 13)

This project is a Laravel 13 API for managing products and categories, with Laravel Sanctum authentication for protected routes.

## Requirements

- PHP 8.3+
- Composer
- Node.js 20+ and npm
- A database connection configured in `.env` (MySQL, MariaDB, PostgreSQL, SQLite, etc.)

## Quick Start

1. Install PHP dependencies:

```bash
composer install
```

2. Create your environment file:

```bash
cp .env.example .env
```

On Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

3. Generate app key:

```bash
php artisan key:generate
```

4. Configure database values in `.env`, then run migrations and seeders:

```bash
php artisan migrate --seed
```

5. Install frontend dependencies (optional for API usage, needed for Vite assets):

```bash
npm install
```

6. Start the app:

```bash
php artisan serve
```

API base URL (default):

```text
http://127.0.0.1:8000/api
```

## Seeded Login User

After `php artisan migrate --seed`, this user is created:

- Email: `zhiwar@test.com`
- Password: `password`

## Authentication Flow (Sanctum Token)

1. Login with `POST /api/login`.
2. Copy token from response: `data.token`.
3. Call protected endpoints using:

```http
Authorization: Bearer YOUR_TOKEN
Accept: application/json
```

4. Logout with `DELETE /api/logout` to revoke current token.

## API Endpoints

### Public

- `POST /api/login`
- `GET /api/products` (public product list)

### Protected (`auth:sanctum`)

- `GET /api/user`
- `DELETE /api/logout`
- `GET /api/categories`
- `POST /api/categories`
- `GET /api/categories/{id}`
- `PUT /api/categories/{id}`
- `PATCH /api/categories/{id}`
- `DELETE /api/categories/{id}`
- `POST /api/products`
- `GET /api/products/{id}`
- `PUT /api/products/{id}`
- `PATCH /api/products/{id}`
- `DELETE /api/products/{id}`

Note: `GET /api/products` is public and handled by `ProductsListController`. The protected products resource excludes `index`.

## Request Validation

### Login

`POST /api/login`

```json
{
	"email": "zhiwar@test.com",
	"password": "password"
}
```

### Category Create/Update

```json
{
	"name": "Electronics"
}
```

### Product Create/Update

```json
{
	"name": "Laptop",
	"price_in_usd": 700,
	"price_in_iqd": 917000,
	"quantity": 2,
	"category_id": 1
}
```

## Response Shape

Some endpoints return API resources directly (for example category/product resources and paginated lists), while auth and action endpoints use the base controller wrapper.

Wrapped success example:

```json
{
	"success": true,
	"data": {
		"message": "Login successful",
		"token": "...",
		"user": {}
	}
}
```

Wrapped error example:

```json
{
	"success": false,
	"message": "Invalid credentials"
}
```

## Useful Commands

- Run tests:

```bash
php artisan test
```

- Run formatter:

```bash
./vendor/bin/pint
```

- Optional all-in-one dev command:

```bash
composer run dev
```

## Postman / API Client Tips

- Set `Accept: application/json` on all API requests.
- For protected routes, include `Authorization: Bearer <token>`.
- Login once, then reuse token until logout.
