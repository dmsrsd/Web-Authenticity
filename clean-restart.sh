#!/bin/bash
# Clean restart Docker - Authenticity
# Usage:
#   ./clean-restart.sh         = stop + rebuild + start (ubah Dockerfile/composer/deps)
#   ./clean-restart.sh --full  = + hapus volumes & prune images
#   ./clean-restart.sh --quick = hanya restart container (tanpa rebuild)
#
# Perubahan kode PHP/view/assets? Tidak perlu restart — volume .:/var/www/html
# sudah sync; refresh browser saja. Restart hanya jika ganti .env atau mau clear OPcache.

set -e
cd "$(dirname "$0")"

FULL_CLEAN=false
QUICK=false
[ "$1" = "--full" ] && FULL_CLEAN=true
[ "$1" = "--quick" ] && QUICK=true

if [ "$QUICK" = true ]; then
  echo '>>> Quick restart (no rebuild)...'
  docker compose restart app
  echo ''
  echo '>>> Done. App: http://localhost:8003'
  docker compose ps
  exit 0
fi

echo '>>> Stopping containers...'
docker compose down --remove-orphans

if [ "$FULL_CLEAN" = true ]; then
  echo '>>> Removing volumes...'
  docker compose down -v
  echo '>>> Pruning unused images...'
  docker image prune -f
fi

echo '>>> Rebuilding and starting...'
docker compose up -d --build

echo ''
echo '>>> Done. App: http://localhost:8003'
docker compose ps
