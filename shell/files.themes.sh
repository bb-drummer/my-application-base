## ZF2 theme : Taurus (from themeforest)
mkdir -p public/assets/themes/taurus
mkdir -p themes/taurus
rm -rf public/assets/themes/taurus/*
rm -rf themes/taurus/*
cp -r vendor/themes/zf2-taurus/assets/* public/assets/themes/taurus/
cp -r vendor/themes/zf2-taurus/view themes/taurus/
cp -r vendor/themes/zf2-taurus/config.php themes/taurus/
mkdir -p public/assets/themes/taurus/css/fontawesome
cp -r vendor/fortawesome/font-awesome/css public/assets/themes/taurus/css/fontawesome/
cp -r vendor/fortawesome/font-awesome/fonts public/assets/themes/taurus/css/fontawesome/
#rm -rf vendor/themes/zf2-taurus

## ZF2 theme : Remark (from themeforest)

mkdir -p public/assets/themes/remark
mkdir -p themes/remark
rm -rf public/assets/themes/remark/*
rm -rf themes/remark/*
cp -r vendor/themes/zf2-remark/assets/* public/assets/themes/remark/
cp -r vendor/themes/zf2-remark/view themes/remark/
cp -r vendor/themes/zf2-remark/config.php themes/remark/
mkdir -p public/assets/themes/remark/css/fontawesome
cp -r vendor/fortawesome/font-awesome/css public/assets/themes/remark/css/fontawesome/
cp -r vendor/fortawesome/font-awesome/fonts public/assets/themes/remark/css/fontawesome/
#rm -rf vendor/themes/zf2-remark

## ZF2 theme : AdminLTE
mkdir -p public/assets/themes/adminlte
mkdir -p themes/adminlte
rm -rf public/assets/themes/adminlte/*
rm -rf themes/adminlte/*
cp -r vendor/themes/zf2-adminlte/assets/* public/assets/themes/adminlte/
cp -r vendor/themes/zf2-adminlte/view themes/adminlte/
cp -r vendor/themes/zf2-adminlte/config.php themes/adminlte/
mkdir -p public/assets/themes/adminlte/css/fontawesome
cp -r vendor/fortawesome/font-awesome/css public/assets/themes/adminlte/css/fontawesome/
cp -r vendor/fortawesome/font-awesome/fonts public/assets/themes/adminlte/css/fontawesome/
#rm -rf vendor/themes/zf2-adminlte
