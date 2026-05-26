#!/usr/bin/env bash

set -euo pipefail

if [[ $# -lt 2 ]]; then
    echo "Uso: $0 <project_root> <public_html_path> [php_bin]"
    echo "Ejemplo: $0 /home/u195785990/apps/pollofeliz /home/u195785990/domains/tudominio.com/public_html php"
    exit 1
fi

project_root="$1"
public_html_path="$2"
php_bin="${3:-php}"

if [[ ! -d "$project_root" ]]; then
    echo "No existe el project_root: $project_root"
    exit 1
fi

if [[ ! -d "$public_html_path" ]]; then
    echo "No existe el public_html_path: $public_html_path"
    exit 1
fi

echo "[1/6] Instalando dependencias PHP de produccion"
cd "$project_root"
composer install --no-dev --optimize-autoloader --no-interaction

echo "[2/6] Ejecutando optimizacion Laravel"
"$php_bin" artisan migrate --force
"$php_bin" artisan optimize:clear
"$php_bin" artisan config:cache
"$php_bin" artisan route:cache
"$php_bin" artisan view:cache

echo "[3/6] Preparando directorio publico"
find "$public_html_path" -mindepth 1 -maxdepth 1 \
    ! -name '.well-known' \
    ! -name 'cgi-bin' \
    -exec rm -rf {} +

echo "[4/6] Copiando archivos publicos"
cp -R "$project_root/public/." "$public_html_path/"

echo "[5/6] Generando index.php para Hostinger"
cat > "$public_html_path/index.php" <<PHP
<?php

use Illuminate\\Foundation\\Application;
use Illuminate\\Http\\Request;

define('LARAVEL_START', microtime(true));

if (file_exists(
    \$maintenance = '$project_root/storage/framework/maintenance.php'
)) {
    require \$maintenance;
}

require '$project_root/vendor/autoload.php';

/** @var Application \$app */
\$app = require_once '$project_root/bootstrap/app.php';

\$app->handleRequest(Request::capture());
PHP

echo "[6/6] Validando index.php generado"
"$php_bin" -l "$public_html_path/index.php"

echo "Deploy completado. Revisa tambien: chmod -R 775 $project_root/storage $project_root/bootstrap/cache"
