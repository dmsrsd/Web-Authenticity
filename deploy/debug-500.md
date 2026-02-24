# Debug HTTP 500 di Docker

## 1. Lihat isi response (pesan error PHP)

```bash
curl -s http://localhost:8003 | head -80
```

Atau buka di browser: `http://SERVER_IP:8003` — kalau ENVIRONMENT development, error sering tampil di halaman.

## 2. Log error Apache/PHP di container

```bash
docker compose exec app tail -50 /var/log/apache2/error.log
```

## 3. Log CodeIgniter

```bash
docker compose exec app tail -100 /var/www/html/application/logs/log-$(date +%Y-%m-%d).php
# atau di host:
tail -100 application/logs/log-$(date +%Y-%m-%d).php
```

## 4. Penyebab umum: database

Container pakai `DB_HOST=host.docker.internal`. Pastikan:

- MySQL di **host** jalan: `sudo systemctl status mysql`
- MySQL boleh koneksi dari luar: user punya akses dari host (bukan hanya localhost), atau bind-address = 0.0.0.0.
- Cek dari dalam container:
  ```bash
  docker compose exec app php -r "
  \$h = getenv('DB_HOST') ?: 'localhost';
  \$c = @fsockopen(\$h, 3306, \$e, \$m, 2);
  echo \$c ? 'MySQL reachable' : \"MySQL NOT reachable: \$e \$m\n\";
  "
  ```

## 5. Cek env di container

```bash
docker compose exec app env | grep -E 'DB_|APP_'
```

Sesuaikan di `.env` atau `docker-compose.yml` kalau salah.
