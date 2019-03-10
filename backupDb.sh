#!/bin/bash
MYSQL_ROOT_PASSWORD=`cat secret/db_root_password.txt`
#docker exec db sh -c "exec mysqldump --all-databases -uroot -p$MYSQL_ROOT_PASSWORD | gzip" > dumps/all-databases.sql.gz
#!/bin/bash
docker exec db sh -c "exec mysqldump -B wiki_physikerwelt wiki_test wiki_drmfbeta -uroot -p$MYSQL_ROOT_PASSWORD | gzip" > dumps/wiki-databases.sql.gz