#!/bin/sh
set -e
# Saat pakai volume (.:/var/www/html), owner file = user host.
# Apache (www-data) butuh bisa baca .htaccess & traverse folder.
# Hanya tambah permission baca + traverse, dan set owner cache/logs ke www-data.
if [ -d /var/www/html ]; then
    chmod o+x /var/www/html 2>/dev/null || true
    chmod -R o+rX /var/www/html 2>/dev/null || true
    chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs 2>/dev/null || true
    chmod -R 775 /var/www/html/application/cache /var/www/html/application/logs 2>/dev/null || true
    # Agar upload (podcast, dll) bisa ditulis Apache
    if [ -d /var/www/html/uploads ]; then
        chown -R www-data:www-data /var/www/html/uploads 2>/dev/null || true
        chmod -R 775 /var/www/html/uploads 2>/dev/null || true
    fi
fi
exec apache2-foreground
