#!/usr/bin/env bash

set -e


command -v zip || {
	>&2 echo "zip is required"
	exit 1
}
command -v composer || {
	>&2 echo "composer is required"
	exit 1
}
command -v git || {
	>&2 echo "git is required"
	exit 1
}

PLUGIN_DIR=`pwd`
RELEASE_ZIP_FILENAME="crowdsignal-forms.$(git rev-parse --abbrev-ref HEAD | sed 's/\//-/g' | tr -d '\n').zip"
RELEASE_FOLDER="/tmp/crowdsignal-forms-release"
RELEASE_BUILD_FOLDER="$RELEASE_FOLDER/crowdsignal-forms"

rm -rf "$RELEASE_FOLDER"
mkdir -p "$RELEASE_BUILD_FOLDER"

cp -r "$PLUGIN_DIR/includes" "$RELEASE_BUILD_FOLDER"
cp -r "$PLUGIN_DIR/build" "$RELEASE_BUILD_FOLDER"
cp -r "$PLUGIN_DIR/languages" "$RELEASE_BUILD_FOLDER"
cp -r "$PLUGIN_DIR/changelog.txt" "$RELEASE_BUILD_FOLDER"
cp -r "$PLUGIN_DIR/index.php" "$RELEASE_BUILD_FOLDER"
cp -r "$PLUGIN_DIR/LICENSE.TXT" "$RELEASE_BUILD_FOLDER"
cp -r "$PLUGIN_DIR/README.TXT" "$RELEASE_BUILD_FOLDER"
cp -r "$PLUGIN_DIR/crowdsignal-forms.php" "$RELEASE_BUILD_FOLDER"
cp -r "$PLUGIN_DIR/uninstall.php" "$RELEASE_BUILD_FOLDER"

rm -f "$RELEASE_BUILD_FOLDER/includes/gateways/class-canned-api-gateway.php"

mkdir -p "$PLUGIN_DIR/release"
cd "$RELEASE_FOLDER" && zip -r "$PLUGIN_DIR/release/$RELEASE_ZIP_FILENAME" "crowdsignal-forms"

echo "Release zip: $PLUGIN_DIR/release/$RELEASE_ZIP_FILENAME"
rm -rf "$RELEASE_BUILD_FOLDER"
