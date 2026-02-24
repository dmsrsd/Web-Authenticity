# Deploy Authenticity di Ubuntu 22 dengan Nginx

## 1. Persiapan server

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y nginx php-fpm php-mysql php-mbstring php-xml php-zip php-gd php-curl php-mysqli
# Cek versi PHP: php -v (Ubuntu 22 default PHP 8.1; jika butuh 7.4: php7.4-fpm)
```

## 2. Deploy aplikasi

```bash
# Contoh: clone atau upload ke /var/www/authenticity
sudo mkdir -p /var/www/authenticity
# Upload/copy file project ke /var/www/authenticity (termasuk index.php, application/, assets/, dll.)

# Hak akses
sudo chown -R www-data:www-data /var/www/authenticity
sudo chmod -R 755 /var/www/authenticity
sudo chmod -R 775 /var/www/authenticity/application/cache /var/www/authenticity/application/logs
```

## 3. Nginx

```bash
# Copy config (sesuaikan path dan domain di dalam file)
sudo cp /var/www/authenticity/deploy/nginx.conf /etc/nginx/sites-available/authenticity

# Edit: root path, server_name, dan socket PHP-FPM (php8.1-fpm atau php7.4-fpm)
sudo nano /etc/nginx/sites-available/authenticity

# Aktifkan site
sudo ln -s /etc/nginx/sites-available/authenticity /etc/nginx/sites-enabled/

# Nonaktifkan default site (opsional)
# sudo rm /etc/nginx/sites-enabled/default

# Test dan reload
sudo nginx -t && sudo systemctl reload nginx
```

## 4. PHP-FPM

Pastikan PHP-FPM jalan dan nama socket sesuai config Nginx:

- Ubuntu 22 (PHP 8.1): `unix:/run/php/php8.1-fpm.sock`
- Jika pakai PHP 7.4: `unix:/run/php/php7.4-fpm.sock`

```bash
sudo systemctl enable php8.1-fpm   # atau php7.4-fpm
sudo systemctl start php8.1-fpm
sudo systemctl status php8.1-fpm
```

## 5. Database

- MySQL/MariaDB sudah terpasang dan jalan.
- Buat database & user, lalu isi `application/config/database.php` (atau pakai env jika ada).

## 6. HTTPS (opsional, Let's Encrypt)

```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d authenticity.id -d www.authenticity.id
```

Lalu uncomment blok `server { listen 443 ssl ... }` di config Nginx dan sesuaikan path sertifikat jika perlu (biasanya certbot sudah mengatur).

## Yang perlu disesuaikan di `deploy/nginx.conf`

| Item | Contoh |
|------|--------|
| `server_name` | `authenticity.id www.authenticity.id` |
| `root` | `/var/www/authenticity` |
| `fastcgi_pass` | `unix:/run/php/php8.1-fpm.sock` (atau php7.4-fpm) |

Setelah itu akses via `http://domain-anda` (atau https jika SSL sudah aktif).
