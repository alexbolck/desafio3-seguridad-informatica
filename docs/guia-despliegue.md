# Guía de despliegue

## Requisitos

- Docker y Docker Compose instalados.
- OpenSSL disponible para generar certificados.
- Navegador web y opcionalmente una máquina virtual Linux/Windows para pruebas más reales.

## 1. Clonar y entrar al proyecto

```bash
git clone <url-del-repositorio>
cd proyecto-seguridad
```

## 2. Escenario propuesto

Este laboratorio está pensado para ejecutarse en Docker, pero también puede usarse desde una VM o un entorno semirreal:

- Docker simula el entorno de red entre contenedores.
- `nginx-v1` expone la app vulnerable en HTTP.
- `nginx-v2` expone la app reforzada en HTTPS.
- `db-v1` y `db-v2` son bases de datos MySQL separadas.

Si deseas un entorno más cercano a la realidad, ejecuta Docker dentro de una VM Ubuntu o usa GNS3 para mapear el tráfico HTTP/HTTPS de `localhost` a una red de laboratorio.

## 3. Generar el certificado TLS para v2

```bash
mkdir -p certs
openssl req -x509 -nodes -newkey rsa:2048 -days 365 \
  -subj "/CN=localhost" \
  -keyout certs/v2.key \
  -out certs/v2.crt
```

## 4. Preparar archivos de entorno

```bash
cp app-v1-vulnerable/.env.example app-v1-vulnerable/.env
cp app-v2-hardened/.env.example app-v2-hardened/.env
```

Asegúrate de que en `app-v2-hardened/.env` `APP_URL` sea `https://localhost:8443`.

## 5. Levantar el laboratorio en Docker

```bash
docker compose up -d --build
```

## 6. Ejecutar migraciones y seeders

```bash
docker compose exec app-v1 php artisan migrate --seed
docker compose exec app-v2 php artisan migrate --seed
```

## 7. Verificar estado

```bash
docker compose ps
```

## 8. Acceder a las aplicaciones

- Versión vulnerable: http://localhost:8080
- Versión hardening: https://localhost:8443

## 9. Pruebas desde una VM o herramienta de pentest

Si trabajas en una VM o con GNS3, mapea `localhost` o configura NAT para apuntar al host donde corre Docker.

Ejemplo de pruebas desde otra máquina:

- `http://<host-ip>:8080` para v1
- `https://<host-ip>:8443` para v2

## 10. Alternativa local sin Docker

Si no deseas usar Docker, puedes ejecutar cada app con el servidor PHP incorporado en sus carpetas `public`:

```bash
cd app-v1-vulnerable
php -S 127.0.0.1:8010 -t public
```

```bash
cd app-v2-hardened
php -S 127.0.0.1:8011 -t public
```

Pero para un laboratorio cercano a la realidad, se recomienda Docker porque permite aislar servicios, usar Nginx y MySQL de forma realista.
