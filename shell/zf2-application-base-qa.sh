#
# project code qualitiy assurance and testing script
#

SOURCE_PATH="./module"
PROJECT_NAME="application-base"
LOCAL_REPORT_PATH="/Volumes/BB.DATA.MOBILE.01/applications/ZF2BaseApp/$PROJECT_NAME.wiki/QA/"



# purge old reports
rm -rf $LOCAL_REPORT_PATH/*

# code beautifier & fixer
phpcbf $SOURCE_PATH --report=diff -vv > $LOCAL_REPORT_PATH/qa.codebeautifier.diff
git diff > $LOCAL_REPORT_PATH/qa.beautifier.git-head.diff

# codesniffer
mkdir -p $LOCAL_REPORT_PATH/codesniffer
phpcs -s --report-file=$LOCAL_REPORT_PATH/qa.codesniffer.report.txt --error-severity=1 --warning-severity=8 $SOURCE_PATH
phpcs -s --report-info=$LOCAL_REPORT_PATH/qa.codesniffer.info.txt --error-severity=1 --warning-severity=8 $SOURCE_PATH
phpcs -s --report-summary=$LOCAL_REPORT_PATH/qa.codesniffer.summary.txt --error-severity=1 --warning-severity=8 $SOURCE_PATH
phpcs -s --report-source=$LOCAL_REPORT_PATH/qa.codesniffer.source.txt --error-severity=1 --warning-severity=8 $SOURCE_PATH
phpcs -s --report-full=$LOCAL_REPORT_PATH/qa.codesniffer.full.txt --error-severity=1 --warning-severity=8 $SOURCE_PATH
phpcs -s --report-xml=$LOCAL_REPORT_PATH/qa.codesniffer.report.xml --error-severity=1 --warning-severity=8 $SOURCE_PATH

# phpmd
phpmd $SOURCE_PATH html "cleancode,codesize,controversial,design,naming,unusedcode" > $LOCAL_REPORT_PATH/qa.phpmd.html

# phpmetrics
phpmetrics --report-html=$LOCAL_REPORT_PATH/qa.phpmetrics.html $SOURCE_PATH

# phpunit
composer update; 
mkdir -p $LOCAL_REPORT_PATH/phpunit

# phpunit (only application)
vendor/bin/phpunit --verbose --debug --configuration $SOURCE_PATH/Application/test/phpunit.xml --coverage-html $LOCAL_REPORT_PATH/phpunit --coverage-text=$LOCAL_REPORT_PATH/qa.phpunit.txt

# phpunit (all found)
touch $LOCAL_REPORT_PATH/qa.phpunit.all.txt;
find $SOURCE_PATH -name "phpunit.xml" -exec vendor/bin/phpunit --verbose --debug --configuration {} >> $LOCAL_REPORT_PATH/qa.phpunit.all.txt \;

# try to commit new/updated report wiki contend to project wiki
CURRENTDIR=`pwd`
cd $LOCAL_REPORT_PATH
git pull
git add .
git commit -m "update latest build, testing, coverage, code metrics info"
git push