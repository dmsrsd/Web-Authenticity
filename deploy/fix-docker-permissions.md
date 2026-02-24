# Fix Permission Setelah chown www-data di Container

## Solusi utama: chmod di host (paling pasti)

Saat pakai volume `.:/var/www/html`, permission yang dipakai Apache = permission file **di host**. Jadi harus diatur **di host**:

```bash
cd ~/project-web/authentic-ci2/web-authenticity

# (Opsional) Kembalikan owner kalau tadi sempat chown www-data
sudo chown -R $USER:$USER .

# Wajib: agar Apache (www-data di container) bisa baca .htaccess dan traverse folder
chmod o+x .
chmod -R o+rX .

# Agar PHP bisa nulis cache & log
chmod -R 775 application/cache application/logs
```

Lalu restart container: `docker compose restart app`. Setelah itu 403 karena .htaccess seharusnya hilang.

## Kalau cache/log masih tidak bisa nulis

Jalankan sekali di container (hanya ubah owner cache & logs, bukan seluruh project):

```bash
docker compose exec app sh -c 'chown -R www-data:www-data /var/www/html/application/cache /var/www/html/application/logs'
```

Jangan jalankan `chown -R www-data /var/www/html` di container (folder project di host jadi milik www-data dan `ls` di host kena permission denied).

## Ringkas (copy-paste di server)

```bash
cd ~/project-web/authentic-ci2/web-authenticity
sudo chown -R $USER:$USER .
chmod o+x .
chmod -R o+rX .
chmod -R 775 application/cache application/logs
docker compose restart app
```
