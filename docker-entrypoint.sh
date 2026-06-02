#!/bin/sh
set -e
# Saat pakai volume (.:/var/www/html), owner file = user host.
# Apache (www-data) butuh bisa baca .htaccess & traverse folder.
if [ -d /var/www/html ]; then
    chmod o+x /var/www/html 2>/dev/null || true
    chmod -R o+rX /var/www/html 2>/dev/null || true
    chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs 2>/dev/null || true
    chmod -R 775 /var/www/html/application/cache /var/www/html/application/logs 2>/dev/null || true

    # uploads/ tidak ada di Git (isi file di-ignore). Folder struktur dibuat di entrypoint.
    UPLOADS="/var/www/html/uploads"
    mkdir -p "$UPLOADS/soundroom/thumb"
    chown -R www-data:www-data "$UPLOADS" 2>/dev/null || true
    chmod -R 775 "$UPLOADS" 2>/dev/null || true

    # Bind mount kadang menolak chown: pastikan www-data bisa tulis (tes + fallback 777)
    WRITE_TEST="$UPLOADS/soundroom/.write_test"
    if ! su -s /bin/sh www-data -c "touch '$WRITE_TEST'" 2>/dev/null; then
        chmod -R 777 "$UPLOADS" 2>/dev/null || true
    fi
    rm -f "$WRITE_TEST" 2>/dev/null || true
fi
exec apache2-foreground
