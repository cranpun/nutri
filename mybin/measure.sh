#!/bin/bash

# 対象ファイルの洗い出し
FILEPATHS=`
find \
app \
bdd/test \
database/migrations \
database/seeds \
docker \
mybin \
resources \
routes \
-type f`

echo "Lines";
grep -v '^\s*$' $FILEPATHS | wc -l;
echo "Files";
ls $FILEPATHS | wc -l;
