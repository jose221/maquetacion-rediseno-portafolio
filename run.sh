#!/bin/bash

set -e  # Detener el script si ocurre un error

echo "📥 Haciendo pull..."
git reset --hard
git pull

# Asegurar que el script sea ejecutable en futuras ejecuciones
chmod +x "$(basename "$0")"

echo "🚀 Iniciando despliegue..."

SRC_DIR="$(dirname "$0")/src"
DEST_DIR="$(dirname "$0")/../josealvarado.herandro.lat"

# Verificar existencia de carpetas
if [ ! -d "$SRC_DIR" ]; then
    echo "❌ Error: No existe el directorio de origen: $SRC_DIR"
    exit 1
fi

if [ ! -d "$DEST_DIR" ]; then
    echo "❌ Error: No existe el directorio de destino: $DEST_DIR"
    exit 1
fi

echo "🧹 Eliminando carpetas específicas en $DEST_DIR..."
for item in "$SRC_DIR"/*; do
  name=$(basename "$item")
  rm -rf "$DEST_DIR/$name"
done

# Mover archivos
echo "📂 Moviendo archivos desde $SRC_DIR a $DEST_DIR..."
mv -v "$SRC_DIR"/* "$DEST_DIR"/

echo "✅ Despliegue completado."