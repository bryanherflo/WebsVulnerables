FROM php:8.2-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# CORRECCIÓN: endurecimiento de PHP (oculta la versión y fuerza cookies seguras).
# expose_php es PHP_INI_SYSTEM, por lo que se configura aquí y no con php_flag.
RUN printf '%s\n' \
    'expose_php = Off' \
    'display_errors = Off' \
    'display_startup_errors = Off' \
    'log_errors = On' \
    'session.cookie_httponly = 1' \
    'session.cookie_samesite = Lax' \
    'session.use_strict_mode = 1' \
    'session.use_only_cookies = 1' \
    'session.sid_length = 48' \
    'session.sid_bits_per_character = 6' \
    > /usr/local/etc/php/conf.d/zz-security.ini

# CORRECCIÓN: mod_headers para las cabeceras de seguridad y configuración
# global de endurecimiento (CSP, anti-clickjacking, bloqueo de PHP en uploads).
RUN a2enmod headers
COPY apache-security.conf /etc/apache2/conf-enabled/zz-security.conf
