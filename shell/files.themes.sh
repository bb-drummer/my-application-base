mkdir -p public/assets/themes/taurus
mkdir -p themes/taurus
rm -rf public/assets/themes/taurus/*
cp -r vendor/themes/zf2-taurus/assets/* public/assets/themes/taurus/
cp -r vendor/themes/zf2-taurus/view themes/taurus/
#rm -rf vendor/themes/zf2-taurus

mkdir -p public/assets/themes/remark
mkdir -p themes/remark
rm -rf public/assets/themes/remark/*
cp -r vendor/themes/zf2-remark/assets/* public/assets/themes/remark/
cp -r vendor/themes/zf2-remark/view themes/remark/
#rm -rf vendor/themes/zf2-taurus
