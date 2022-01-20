#!/usr/bin/env bash

php run_sql.php "SELECT urlImage FROM serie UNION \
    SELECT urlImage FROM personne UNION \
    SELECT urlImage FROM personnage UNION \
    SELECT urlImage FROM episode;" \
| grep "^urlImage" -v | cut -d '/' -f6- | tr / _ | sort > in_db.txt \

#printf "medium_portrait.png\nmedium_landscape.png\n" >>in_db.txt
ls ../public/img/*.jpg | cut -d '/' -f4- > in_fs.txt

diff -d  in_db.txt in_fs.txt > delta.txt

cat delta.txt | grep '>' | cut -d ' ' -f2 > to_delete.txt
cat delta.txt | grep '<' | cut -d ' ' -f2 | grep -v '^$' > missing.txt

echo "Deleting files..."
wc -l to_delete.txt

xargs -L 1 -a to_delete.txt -I{} -d'\n' rm "../public/img/{}"

echo "Missing files (if any): "
wc -l missing.txt
#cat missing.txt
rm in_db.txt in_fs.txt delta.txt missing.txt to_delete.txt
