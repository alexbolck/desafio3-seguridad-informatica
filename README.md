# Proyecto Seguridad Informática

Este repositorio contiene un laboratorio académico para comparar dos versiones de una misma aplicación Laravel:

- v1: aplicación vulnerable, expuesta en HTTP en el puerto 8080.
- v2: aplicación hardening, expuesta en HTTPS en el puerto 8443.

## Estructura del proyecto

```text
proyecto-seguridad/
├── app-v1-vulnerable/
├── app-v2-hardened/
├── certs/
├── docs/
├── docker-compose.yml
└── README.md
```

## Inicio rápido

1. Generar el certificado TLS para v2:

```bash
mkdir -p certs
openssl req -x509 -nodes -newkey rsa:2048 -days 365 \
  -subj "/CN=localhost" \
  -keyout certs/v2.key \
  -out certs/v2.crt
```

2. Copiar los archivos de entorno:

```bash
cp app-v1-vulnerable/.env.example app-v1-vulnerable/.env
cp app-v2-hardened/.env.example app-v2-hardened/.env
```

3. Levantar los servicios:

```bash
docker compose up -d --build
```

4. Ejecutar migraciones y seeders:

```bash
docker compose exec app-v1 php artisan migrate --seed
docker compose exec app-v2 php artisan migrate --seed
```

## URLs de acceso

- Versión vulnerable: http://localhost:8080
- Versión hardening: https://localhost:8443

## Documentación

- [docs/arquitectura.md](docs/arquitectura.md)
- [docs/guia-despliegue.md](docs/guia-despliegue.md)
- [docs/pentest-report.md](docs/pentest-report.md)
