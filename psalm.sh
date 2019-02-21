#!/usr/bin/env bash

# Install ansifilter is not already installed
# http://www.andre-simon.de/doku/ansifilter/en/ansifilter.php
if ! [ -x "$(command -v ansifilter)" ]; then
    curl --header "Host: www.andre-simon.de" --header "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36" --header "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8" "http://www.andre-simon.de/zip/ansifilter-2.13.tar.bz2" -o "ansifilter-2.13.tar.bz2" -L
    tar xjf ansifilter-2.13.tar.bz2
    cd ansifilter-2.13
    make help
    make
    make install
    cd ..
    rm -f ansifilter-2.13.tar.bz2
fi;

# Install and run Psalm php static analysis tool
# https://getpsalm.org/docs/
PSALM_DIR=psalm
mkdir ./$PSALM_DIR || :
cd ./$PSALM_DIR;
if [ ! -f composer.json ]; then composer init --no-interaction; fi;
(composer info -N | grep -q "vimeo/psalm") && : || composer require vimeo/psalm --dev --no-suggest --no-ansi --no-interaction --no-progress --ignore-platform-reqs
cd ..

# Initialize Psalm if xml file does not exist
if [ ! -f ./psalm.xml ]; then ./$PSALM_DIR/vendor/bin/psalm init; fi;
./$PSALM_DIR/vendor/bin/psalm > psalm.log

# Parse log into html
ansifilter --html --input=psalm.log --output=psalm.log.html

# Output the log to the terminal
cat psalm.log

#fin
