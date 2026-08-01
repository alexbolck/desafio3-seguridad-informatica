# Arquitectura del laboratorio

## Diagrama general

```mermaid
flowchart LR
    subgraph Host[Host / Cliente]
        User[Usuario
HTTP/HTTPS]
        Attacker[Atacante externo
sqlmap]
    end

    subgraph Red[Red Docker seg-net]
        subgraph V1[Aplicación vulnerable]
            NginxV1[nginx-v1
puerto 8080]
            AppV1[app-v1
PHP-FPM 8.3]
            DBV1[db-v1
MySQL 8]
        end

        subgraph V2[Aplicación hardening]
            NginxV2[nginx-v2
puerto 8443 HTTPS]
            AppV2[app-v2
PHP-FPM 8.3]
            DBV2[db-v2
MySQL 8]
        end
    end

    User --> NginxV1
    User --> NginxV2
    Attacker --> NginxV1
    Attacker --> NginxV2
    NginxV1 --> AppV1
    AppV1 --> DBV1
    NginxV2 --> AppV2
    AppV2 --> DBV2
```

## Descripción funcional

- v1: exposición HTTP en puerto 8080, con vulnerabilidades intencionales para laboratorio.
- v2: exposición HTTPS en puerto 8443, con las mismas funcionalidades pero corregidas.
- Ambas aplicaciones comparten la misma red Docker llamada seg-net.
- El host atacante externo puede usar herramientas como sqlmap para probar la versión vulnerable.

## Tecnologías usadas

| Componente | Tecnología | Versión |
|---|---|---:|
| Runtime PHP | PHP-FPM | 8.3 |
| Framework | Laravel | 11 |
| Web server | Nginx | Alpine/latest |
| Base de datos | MySQL | 8.0 |
| Orquestación | Docker Compose | 3.8 |
| Certificados TLS | OpenSSL | 3.x |
