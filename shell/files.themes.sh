mkdir -p public/assets/themes/taurus
mkdir -p themes/taurus
rm -rf public/assets/themes/taurus/*
rm -rf themes/taurus/*
cp -r vendor/themes/zf2-taurus/assets/* public/assets/themes/taurus/
cp -r vendor/themes/zf2-taurus/view themes/taurus/
cp -r vendor/themes/zf2-taurus/config.php themes/taurus/
#rm -rf vendor/themes/zf2-taurus

mkdir -p public/assets/themes/remark
mkdir -p themes/remark
rm -rf public/assets/themes/remark/*
rm -rf themes/remark/*
cp -r vendor/themes/zf2-remark/assets/* public/assets/themes/remark/
cp -r vendor/themes/zf2-remark/view themes/remark/
cp -r vendor/themes/zf2-remark/config.php themes/remark/
#rm -rf vendor/themes/zf2-taurus
