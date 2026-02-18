#!/bin/bash
# Clean restart Docker - Authenticity
# Usage: ./clean-restart.sh [--full]
#   --full = juga remove volumes & prune unused images

set -e
cd "$(dirname "$0")"

FULL_CLEAN=false
[ "$1" = "--full" ] && FULL_CLEAN=true

echo ">>> Stopping containers..."
docker compose down --remove-orphans

if [ "$FULL_CLEAN" = true ]; then
  echo ">>> Removing volumes..."
  docker compose down -v
  echo ">>> Pruning unused images..."
  docker image prune -f
fi

echo ">>> Rebuilding and starting..."
docker compose up -d --build

echo ""
echo ">>> Done. App: http://localhost:8003"
docker compose ps
