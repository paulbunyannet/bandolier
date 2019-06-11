#!/usr/bin/env bash

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
./$PSALM_DIR/vendor/bin/psalm

#fin
