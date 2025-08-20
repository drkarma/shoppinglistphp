#!/bin/bash

echo "📦 Söker senaste version..."

LATEST_ZIP=$(ls -1t php-shopping-list-app-v*.zip 2>/dev/null | head -n 1)

if [ -z "$LATEST_ZIP" ]; then
  echo "❌ Ingen zipfil hittades som matchar php-shopping-list-app-v*.zip"
  exit 1
fi

echo "📦 Installerar: $LATEST_ZIP"

echo "🧹 Rensar befintlig mappstruktur..."
rm -rf public scripts src data

echo "📁 Skapar datamapp..."
mkdir -p data

echo "📦 Extraherar zip..."
unzip -oq "$LATEST_ZIP"

if [ ! -f scripts/init_db.php ]; then
  echo "❌ Hittade inte scripts/init_db.php efter extraktion. Något gick fel."
  exit 1
fi

echo "🗃️ Initierar databas..."
php scripts/init_db.php || { echo "❌ Fel vid initiering av databasen."; exit 1; }

echo "✅ Klar! Systemet är installerat från: $LATEST_ZIP"
# Git-autocommit för aktuell version

version=$(basename "$latest_zip" .zip)
if [ -d .git ]; then
  git add .
  git commit -m "💾 Installerad version: $version"
  echo "✅ Git commit skapad för $version"
  git tag "$version"
  echo "🏷️  Git tag skapad: $version"
else
  echo "⚠️ Git är inte initierat i denna katalog. Skipping commit."
fi
