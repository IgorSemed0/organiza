#!/bin/bash

# Define models based on User model relationships
MODELS=(
  "User"
  "TipoUser"
  "Workplace"
  "Quadro"
  "Cartao"
  "Anexo"
  "Comentario"
  "MembroQuadro"
  "ChatMensagem"
  "ChatAnexo"
  "MembroCartao"
  "MembroWorkplace"
  "MembroQuadroConvite"
  "MembroWorkplaceConvite"
)

# Base directories
CONTROLLER_DIR="app/Http/Controllers/Admin"
PAGES_DIR="resources/js/pages/Admin"

# Create directories if they don't exist
mkdir -p "$CONTROLLER_DIR"
mkdir -p "$PAGES_DIR"

# Loop through each model
for MODEL in "${MODELS[@]}"; do
  # Create controller file
  CONTROLLER_FILE="${CONTROLLER_DIR}/${MODEL}Controller.php"
  touch "$CONTROLLER_FILE"
  echo "Created $CONTROLLER_FILE"

  # Create directory for React pages
  MODEL_PAGES_DIR="${PAGES_DIR}/${MODEL}"
  mkdir -p "$MODEL_PAGES_DIR"
  echo "Created directory $MODEL_PAGES_DIR"

  # Create React page files
  for PAGE in "Index.tsx" "Create.tsx" "Edit.tsx" "Show.tsx" "Trash.tsx"; do
    PAGE_FILE="${MODEL_PAGES_DIR}/${PAGE}"
    touch "$PAGE_FILE"
    echo "Created $PAGE_FILE"
  done
done

echo "All CRUD files created successfully."