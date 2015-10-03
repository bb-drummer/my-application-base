mkdir -p public/assets/themes/zf2-basic
mkdir -p themes/zf2-basic

rm -rf public/assets/themes/zf2-basic/*
cp -r vendor/themes/zf2-basic/assets/* public/assets/themes/zf2-basic/
cp -r vendor/themes/zf2-basic/view themes/zf2-basic/

mkdir -p public/assets/themes/zf2-basic/js/modernizr
cp -r vendor/components/modernizr/modernizr.js public/assets/themes/zf2-basic/js/modernizr/

mkdir -p public/assets/themes/zf2-basic/js/jquery
cp -r vendor/components/jquery/jquery.min.js public/assets/themes/zf2-basic/js/jquery/
cp -r vendor/components/jquery/jquery.min.map public/assets/themes/zf2-basic/js/jquery/
cp -r vendor/components/jquery/jquery-migrate.min.js public/assets/themes/zf2-basic/js/jquery/
mkdir -p public/assets/themes/zf2-basic/js/jquery-ui
mkdir -p public/assets/themes/zf2-basic/css/jquery-ui
cp -r vendor/components/jqueryui/jquery-ui.min.js public/assets/themes/zf2-basic/js/jquery-ui/
cp -r vendor/components/jqueryui/ui public/assets/themes/zf2-basic/js/jquery-ui/
cp -r vendor/components/jqueryui/themes public/assets/themes/zf2-basic/css/jquery-ui/

mkdir -p public/assets/themes/zf2-basic/js/foundation
mkdir -p public/assets/themes/zf2-basic/css/foundation
cp -r vendor/components/foundation/js/foundation.min.js public/assets/themes/zf2-basic/js/foundation/
cp -r vendor/components/foundation/js/vendor public/assets/themes/zf2-basic/js/foundation/
cp -r vendor/components/foundation/css/foundation.min.css public/assets/themes/zf2-basic/css/foundation/
cp -r vendor/components/foundation/css/normalize.min.css public/assets/themes/zf2-basic/css/foundation/
rm -rf public/assets/themes/zf2-basic/js/foundation/vendor/jquery.js
rm -rf public/assets/themes/zf2-basic/js/foundation/vendor/modernizr.js

mkdir -p public/assets/themes/zf2-basic/js/bootstrap
mkdir -p public/assets/themes/zf2-basic/css/bootstrap
cp -r vendor/twitter/bootstrap/dist/js/bootstrap.min.js public/assets/themes/zf2-basic/js/bootstrap/
cp -r vendor/twitter/bootstrap/dist/css public/assets/themes/zf2-basic/css/bootstrap/
cp -r vendor/twitter/bootstrap/dist/fonts public/assets/themes/zf2-basic/css/bootstrap/

mkdir -p public/assets/themes/zf2-basic/js/fancy-box
cp -r vendor/newerton/fancy-box/source public/assets/themes/zf2-basic/js/fancy-box

mkdir -p public/assets/themes/zf2-basic/js/tinymce
mkdir -p public/assets/themes/zf2-basic/css/tinymce
cp -r vendor/tinymce/tinymce/tinymce.min.js public/assets/themes/zf2-basic/js/tinymce/
cp -r vendor/tinymce/tinymce/tinymce.jquery.min.js public/assets/themes/zf2-basic/js/tinymce/
cp -r vendor/tinymce/tinymce/jquery.tinymce.min.js public/assets/themes/zf2-basic/js/tinymce/
cp -r vendor/tinymce/tinymce/plugins public/assets/themes/zf2-basic/js/tinymce/
cp -r vendor/tinymce/tinymce/themes public/assets/themes/zf2-basic/js/tinymce/
cp -r vendor/tinymce/tinymce/skins public/assets/themes/zf2-basic/css/tinymce/

rm -rf components