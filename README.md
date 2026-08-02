# Proyecto Seguridad Informática

Este repositorio incluye un laboratorio OWASP con dos versiones de una aplicación Laravel:

- `app-v1-vulnerable`: versión intencionalmente insegura con vulnerabilidades OWASP como SQL Injection, RCE, XSS y carga de archivos insegura.
- `app-v2-hardened`: versión corregida, con sanitización de entradas, protección contra inyección SQL, escaping de salida y servicio HTTPS con certificado TLS.

## Qué incluye

- Aplicación vulnerable con rutas de login, registro, dashboard, comentarios, archivos y ping de red.
- Aplicación hardening con las mismas funcionalidades pero controladas.
- Despliegue Docker con MySQL para ambas versiones y Nginx con HTTPS para la versión 2.
- Documentación de arquitectura, despliegue y pruebas de pentesting.
- Seeders de base de datos para repetir el laboratorio y capturar credenciales de ejemplo.

## Estructura del proyecto

```text
proyecto-seguridad/
├── app-v1-vulnerable/
├── app-v2-hardened/
├── certs/
├── docs/
├── docker-compose.yml
├── nginx/
└── README.md
```

## Inicio rápido con Docker

1. Clonar el repositorio:

```bash
git clone <url-del-repositorio>
cd proyecto-seguridad
```

2. Generar certificado TLS para `app-v2-hardened`:

```bash
mkdir -p certs
openssl req -x509 -nodes -newkey rsa:2048 -days 365 \
  -subj "/CN=localhost" \
  -keyout certs/v2.key \
  -out certs/v2.crt
```

3. Copiar archivos `.env`:

```bash
cp app-v1-vulnerable/.env.example app-v1-vulnerable/.env
cp app-v2-hardened/.env.example app-v2-hardened/.env
```

4. Levantar el laboratorio:

```bash
docker compose up -d --build
```

5. Ejecutar migraciones y seeders:

```bash
docker compose exec app-v1 php artisan migrate --seed
docker compose exec app-v2 php artisan migrate --seed
```

## Acceso al laboratorio

- Versión vulnerable: http://localhost:8080
- Versión hardening: https://localhost:8443

> Si el navegador muestra advertencia de certificado, acepta temporalmente el certificado autofirmado para pruebas.

## Credenciales iniciales

- Admin: `admin@test.com` / `Admin123!`
- Usuario: `alice@test.com` / `User123!`
- Usuario: `bob@test.com` / `User123!`

## Documentación adicional

- [docs/arquitectura.md](docs/arquitectura.md)
- [docs/guia-despliegue.md](docs/guia-despliegue.md)
- [docs/pentest-report.md](docs/pentest-report.md)
