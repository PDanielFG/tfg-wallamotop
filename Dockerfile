# Usa la imagen base de Laravel con PHP ya listo
FROM bitnami/laravel:10

# Copia el contenido del proyecto Laravel
COPY app/ /opt/bitnami/laravel

# Copia el script de entrada desde app/
COPY app/entrypoint.sh /entrypoint.sh

# Establece el directorio de trabajo
WORKDIR /opt/bitnami/laravel

# Instala dependencias de PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Da permisos de ejecución al script
RUN chmod +x /entrypoint.sh

# Expón el puerto de la aplicación
EXPOSE 8000

# Usa el script como entrypoint
ENTRYPOINT ["/entrypoint.sh"]

# Comando por defecto (se ejecuta al final del entrypoint)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
