rm -rf public/js/modernizr
mkdir public/js/modernizr
cp -r vendor/components/modernizr/modernizr.js public/js/modernizr/
rm -rf public/js/jquery
mkdir public/js/jquery
cp -r vendor/components/jquery/jquery.min.js public/js/jquery/
cp -r vendor/components/jquery/jquery.min.map public/js/jquery/
cp -r vendor/components/jquery/jquery-migrate.min.js public/js/jquery/
rm -rf public/js/jquery-ui
rm -rf public/css/jquery-ui
mkdir public/js/jquery-ui
mkdir public/css/jquery-ui
cp -r vendor/components/jqueryui/jquery-ui.min.js public/js/jquery-ui/
cp -r vendor/components/jqueryui/ui public/js/jquery-ui/
cp -r vendor/components/jqueryui/themes public/css/jquery-ui/
rm -rf public/js/foundation
rm -rf public/css/foundation
mkdir public/js/foundation
mkdir public/css/foundation
cp -r vendor/components/foundation/js/foundation.min.js public/js/foundation/
cp -r vendor/components/foundation/js/vendor public/js/foundation/
cp -r vendor/components/foundation/css/foundation.min.css public/css/foundation/
cp -r vendor/components/foundation/css/normalize.min.css public/css/foundation/
rm -rf public/js/foundation/vendor/jquery.js
rm -rf public/js/foundation/vendor/modernizr.js
rm -rf public/js/bootstrap
rm -rf public/css/bootstrap
mkdir public/js/bootstrap
mkdir public/css/bootstrap
cp -r vendor/twitter/bootstrap/dist/js/bootstrap.min.js public/js/bootstrap/
cp -r vendor/twitter/bootstrap/dist/css public/css/bootstrap/
cp -r vendor/twitter/bootstrap/dist/fonts public/css/bootstrap/
rm -rf public/js/fancy-box
mkdir public/js/fancy-box
cp -r vendor/newerton/fancy-box/source public/js/fancy-box
rm -rf public/js/tinymce
rm -rf public/css/tinymce
mkdir public/js/tinymce
mkdir public/css/tinymce
cp -r vendor/tinymce/tinymce/tinymce.min.js public/js/tinymce/
cp -r vendor/tinymce/tinymce/tinymce.jquery.min.js public/js/tinymce/
cp -r vendor/tinymce/tinymce/jquery.tinymce.min.js public/js/tinymce/
cp -r vendor/tinymce/tinymce/plugins public/js/tinymce/
cp -r vendor/tinymce/tinymce/themes public/js/tinymce/
cp -r vendor/tinymce/tinymce/skins public/css/tinymce/
rm -rf components