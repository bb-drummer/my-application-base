## move themes' js/css components since most of composer's custom installer paths i had set for these are ignored :(

## modernizr
mkdir -p public/themes/basic/assets/js/modernizr
cp -r vendor/components/modernizr/modernizr.js public/themes/basic/assets/js/modernizr/

## jquery
mkdir -p public/themes/basic/assets/js/jquery
cp -r vendor/components/jquery/jquery.min.js public/themes/basic/assets/js/jquery/
cp -r vendor/components/jquery/jquery.min.map public/themes/basic/assets/js/jquery/
cp -r vendor/components/jquery/jquery-migrate.min.js public/themes/basic/assets/js/jquery/
mkdir -p public/themes/basic/assets/js/jquery-ui
mkdir -p public/themes/basic/assets/css/jquery-ui
cp -r vendor/components/jqueryui/jquery-ui.min.js public/themes/basic/assets/js/jquery-ui/
cp -r vendor/components/jqueryui/ui public/themes/basic/assets/js/jquery-ui/
cp -r vendor/components/jqueryui/themes public/themes/basic/assets/css/jquery-ui/

## foundation ( deactivated )
#mkdir -p public/themes/basic/assets/js/foundation
#mkdir -p public/themes/basic/assets/css/foundation
#cp -r vendor/components/foundation/js/foundation.min.js public/themes/basic/assets/js/foundation/
#cp -r vendor/components/foundation/js/vendor public/themes/basic/assets/js/foundation/
#cp -r vendor/components/foundation/css/foundation.min.css public/themes/basic/assets/css/foundation/
#cp -r vendor/components/foundation/css/normalize.min.css public/themes/basic/assets/css/foundation/
#rm -rf public/themes/basic/assets/js/foundation/vendor/jquery.js
#rm -rf public/themes/basic/assets/js/foundation/vendor/modernizr.js

## bootstrap
mkdir -p public/themes/basic/assets/js/bootstrap
mkdir -p public/themes/basic/assets/css/bootstrap
cp -r vendor/twitter/bootstrap/dist/js/bootstrap.min.js public/themes/basic/assets/js/bootstrap/
cp -r vendor/twitter/bootstrap/dist/css public/themes/basic/assets/css/bootstrap/
cp -r vendor/twitter/bootstrap/dist/fonts public/themes/basic/assets/css/bootstrap/

## tiny-mce
mkdir -p public/themes/basic/assets/js/tinymce
mkdir -p public/themes/basic/assets/css/tinymce
cp -r vendor/tinymce/tinymce/tinymce.min.js public/themes/basic/assets/js/tinymce/
cp -r vendor/tinymce/tinymce/tinymce.jquery.min.js public/themes/basic/assets/js/tinymce/
cp -r vendor/tinymce/tinymce/jquery.tinymce.min.js public/themes/basic/assets/js/tinymce/
cp -r vendor/tinymce/tinymce/plugins public/themes/basic/assets/js/tinymce/
cp -r vendor/tinymce/tinymce/themes public/themes/basic/assets/js/tinymce/
cp -r vendor/tinymce/tinymce/skins public/themes/basic/assets/css/tinymce/

## datatables
mkdir -p public/themes/basic/assets/js/datatables
cp -r vendor/datatables/datatables/media/* public/themes/basic/assets/js/datatables/

## font-awesome
mkdir -p public/themes/basic/assets/css/fontawesome
cp -r vendor/fortawesome/font-awesome/css public/themes/basic/assets/css/fontawesome/
cp -r vendor/fortawesome/font-awesome/fonts public/themes/basic/assets/css/fontawesome/
mkdir -p public/themes/adminlte/assets/css/fontawesome
cp -r vendor/fortawesome/font-awesome/css public/themes/adminlte/assets/css/fontawesome/
cp -r vendor/fortawesome/font-awesome/fonts public/themes/adminlte/assets/css/fontawesome/
mkdir -p public/themes/remark/assets/css/fontawesome
cp -r vendor/fortawesome/font-awesome/css public/themes/remark/assets/css/fontawesome/
cp -r vendor/fortawesome/font-awesome/fonts public/themes/remark/assets/css/fontawesome/
mkdir -p public/themes/taurus/assets/css/fontawesome
cp -r vendor/fortawesome/font-awesome/css public/themes/taurus/assets/css/fontawesome/
cp -r vendor/fortawesome/font-awesome/fonts public/themes/taurus/assets/css/fontawesome/

rm -rf components vendor/components vendor/datatables vendor/fortawesome vendor/tinymce vendor/twitter