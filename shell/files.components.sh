mkdir public/assets/themes/zf2-components

rm -rf public/assets/themes/zf2-components/js/modernizr
mkdir public/assets/themes/zf2-components/js/modernizr
cp -r vendor/components/modernizr/modernizr.js public/assets/themes/zf2-components/js/modernizr/

rm -rf public/assets/themes/zf2-components/js/jquery
mkdir public/assets/themes/zf2-components/js/jquery
cp -r vendor/components/jquery/jquery.min.js public/assets/themes/zf2-components/js/jquery/
cp -r vendor/components/jquery/jquery.min.map public/assets/themes/zf2-components/js/jquery/
cp -r vendor/components/jquery/jquery-migrate.min.js public/assets/themes/zf2-components/js/jquery/
rm -rf public/assets/themes/zf2-components/js/jquery-ui
rm -rf public/assets/themes/zf2-components/css/jquery-ui
mkdir public/assets/themes/zf2-components/js/jquery-ui
mkdir public/assets/themes/zf2-components/css/jquery-ui
cp -r vendor/components/jqueryui/jquery-ui.min.js public/assets/themes/zf2-components/js/jquery-ui/
cp -r vendor/components/jqueryui/ui public/assets/themes/zf2-components/js/jquery-ui/
cp -r vendor/components/jqueryui/themes public/assets/themes/zf2-components/css/jquery-ui/

rm -rf public/assets/themes/zf2-components/js/foundation
rm -rf public/assets/themes/zf2-components/css/foundation
mkdir public/assets/themes/zf2-components/js/foundation
mkdir public/assets/themes/zf2-components/css/foundation
cp -r vendor/components/foundation/js/foundation.min.js public/assets/themes/zf2-components/js/foundation/
cp -r vendor/components/foundation/js/vendor public/assets/themes/zf2-components/js/foundation/
cp -r vendor/components/foundation/css/foundation.min.css public/assets/themes/zf2-components/css/foundation/
cp -r vendor/components/foundation/css/normalize.min.css public/assets/themes/zf2-components/css/foundation/
rm -rf public/assets/themes/zf2-components/js/foundation/vendor/jquery.js
rm -rf public/assets/themes/zf2-components/js/foundation/vendor/modernizr.js

rm -rf public/assets/themes/zf2-components/js/bootstrap
rm -rf public/assets/themes/zf2-components/css/bootstrap
mkdir public/assets/themes/zf2-components/js/bootstrap
mkdir public/assets/themes/zf2-components/css/bootstrap
cp -r vendor/twitter/bootstrap/dist/js/bootstrap.min.js public/assets/themes/zf2-components/js/bootstrap/
cp -r vendor/twitter/bootstrap/dist/css public/assets/themes/zf2-components/css/bootstrap/
cp -r vendor/twitter/bootstrap/dist/fonts public/assets/themes/zf2-components/css/bootstrap/

rm -rf public/assets/themes/zf2-components/js/fancy-box
mkdir public/assets/themes/zf2-components/js/fancy-box
cp -r vendor/newerton/fancy-box/source public/assets/themes/zf2-components/js/fancy-box

rm -rf public/assets/themes/zf2-components/js/tinymce
rm -rf public/assets/themes/zf2-components/css/tinymce
mkdir public/assets/themes/zf2-components/js/tinymce
mkdir public/assets/themes/zf2-components/css/tinymce
cp -r vendor/tinymce/tinymce/tinymce.min.js public/assets/themes/zf2-components/js/tinymce/
cp -r vendor/tinymce/tinymce/tinymce.jquery.min.js public/assets/themes/zf2-components/js/tinymce/
cp -r vendor/tinymce/tinymce/jquery.tinymce.min.js public/assets/themes/zf2-components/js/tinymce/
cp -r vendor/tinymce/tinymce/plugins public/assets/themes/zf2-components/js/tinymce/
cp -r vendor/tinymce/tinymce/themes public/assets/themes/zf2-components/js/tinymce/
cp -r vendor/tinymce/tinymce/skins public/assets/themes/zf2-components/css/tinymce/
rm -rf components