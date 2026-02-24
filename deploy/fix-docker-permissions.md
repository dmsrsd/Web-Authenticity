# Fix Permission Setelah chown www-data di Container

## 1. Kembalikan akses di host (langsung jalan di server)

```bash
cd ~/project-web/authentic-ci2/web-authenticity
sudo chown -R $USER:$USER .
```

Sekarang `ll` / `ls` bisa lagi.

## 2. Agar Apache bisa baca file tanpa ubah owner ke www-data

Apache butuh bisa **baca** file dan **traverse** direktori. Cukup tambah permission "others" (read + execute untuk direktori):

```bash
chmod -R o+rX .
```

Artinya: semua file readable, semua folder executable (bisa masuk) oleh user lain (termasuk www-data di container).

## 3. Cache & log (writable oleh Apache)

Agar PHP/CodeIgniter bisa nulis ke `application/cache` dan `application/logs`:

```bash
chmod -R 775 application/cache application/logs
```

Di container, proses Apache biasanya jalan sebagai `www-data`. Kalau setelah `chmod 775` masih tidak bisa nulis, bisa pakai salah satu:

- **Opsi A:** Set world-writable hanya untuk dua folder itu (untuk dev saja):
  ```bash
  chmod -R 777 application/cache application/logs
  ```
- **Opsi B:** Di container, jalankan sekali (tanpa -R ke seluruh /var/www/html):
  ```bash
  docker compose exec app sh -c 'chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs'
  ```
  Hanya cache dan logs yang jadi milik www-data; folder lain tetap milik user host.

## Ringkas (copy-paste)

```bash
cd ~/project-web/authentic-ci2/web-authenticity
sudo chown -R $USER:$USER .
chmod -R o+rX .
chmod -R 775 application/cache application/logs
```

Kalau masih 403 / permission denied untuk cache atau log, tambah:

```bash
docker compose exec app sh -c 'chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs'
```

(Setelah itu jangan jalankan lagi `chown -R www-data /var/www/html` di container, supaya owner di host tidak berubah lagi.)
