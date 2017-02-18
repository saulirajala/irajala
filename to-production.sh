# Script that deploys dev-* -themes to production ready theme
# Includes only the files needed in production
#
# How to use:
# 0) Make sure script is executable (chmod +x to-production.sh)
# 1) Run ./to-production.sh
# 2) Enjoy the coffee while the computer does the work

#!/bin/bash

deployFolder(){
  echo "Deploy $2"
  cp -vr ~/vagrant-local2/www/omat/htdocs/wp-content/themes/dev-$1/$2 ~/vagrant-local2/www/omat/htdocs/wp-content/themes/$1/$2
}
deployFile(){
  echo "Deploy $2"
  cp -vr ~/vagrant-local2/www/omat/htdocs/wp-content/themes/dev-$1/$2 ~/vagrant-local2/www/omat/htdocs/wp-content/themes/$1/$2
}

if [ -z "$1" ]; then
    echo "Empty theme-name 1"
    exit 1
else
  rm -rvf ~/vagrant-local2/www/omat/htdocs/wp-content/themes/$1/
  mkdir ~/vagrant-local2/www/omat/htdocs/wp-content/themes/$1/
  deployFolder $1 "dist"
  deployFolder $1 "src"
  deployFolder $1 "templates"
  deployFolder $1 "vendor"
  deployFile $1 "functions.php"
  deployFile $1 "index.php"
  deployFile $1 "style.css"
  deployFile $1 "screenshot.png"
fi
