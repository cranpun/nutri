#!/bin/bash

find . -not -name "composer.phar" -type f -exec sed -i -e "s/\r//g" {} \;
