# Clean restart Docker - Authenticity
# Usage: .\clean-restart.ps1 [-Full]
#   -Full = juga remove volumes & prune unused images

param([switch]$Full)

Set-Location $PSScriptRoot

Write-Host ">>> Stopping containers..." -ForegroundColor Cyan
docker compose down --remove-orphans

if ($Full) {
    Write-Host ">>> Removing volumes..." -ForegroundColor Cyan
    docker compose down -v
    Write-Host ">>> Pruning unused images..." -ForegroundColor Cyan
    docker image prune -f
}

Write-Host ">>> Rebuilding and starting..." -ForegroundColor Cyan
docker compose up -d --build

Write-Host ""
Write-Host ">>> Done. App: http://localhost:8003" -ForegroundColor Green
docker compose ps
