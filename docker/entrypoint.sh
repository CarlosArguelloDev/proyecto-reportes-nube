#!/bin/sh
set -e

# 1) Cargar variables desde el secret laravel_env si existe
if [ -f /run/secrets/laravel_env ]; then
  echo "[entrypoint] Cargando variables de /run/secrets/laravel_env"
  set -a
  . /run/secrets/laravel_env
  set +a
fi

# 2) Cargar la password de DB desde el secret db_password (si existe)
if [ -f /run/secrets/db_password ]; then
  echo "[entrypoint] Cargando DB_PASSWORD desde /run/secrets/db_password"
  export DB_PASSWORD="$(cat /run/secrets/db_password)"
fi

echo "[entrypoint] Arrancando: $*"
exec "$@"
