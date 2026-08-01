# Guía de despliegue

## 1. Clonar y entrar al proyecto

```bash
git clone <url-del-repositorio>
cd proyecto-seguridad
```

## 2. Generar el certificado TLS para v2

```bash
mkdir -p certs
openssl req -x509 -nodes -newkey rsa:2048 -days 365 \
  -subj "/CN=localhost" \
  -keyout certs/v2.key \
  -out certs/v2.crt
```

## 3. Copiar los archivos de entorno

Cada aplicación necesita su archivo .env a partir del ejemplo:

```bash
cp app-v1-vulnerable/.env.example app-v1-vulnerable/.env
cp app-v2-hardened/.env.example app-v2-hardened/.env
```

## 4. Levantar los servicios

```bash
docker compose up -d --build
```

## 5. Ejecutar migraciones y seeders

```bash
docker compose exec app-v1 php artisan migrate --seed
```

```bash
docker compose exec app-v2 php artisan migrate --seed
```

## 6. Verificar estado

```bash
docker compose ps
```

## 7. URLs de acceso

- Versión vulnerable: http://localhost:8080
- Versión hardening: https://localhost:8443

> Para HTTPS, si el navegador muestra una advertencia por el certificado self-signed, se puede aceptar de forma temporal para pruebas de laboratorio.
