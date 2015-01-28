#!/bin/sh
aa=$(ps -ef | grep '/usr/bin/php /data/www/ldsn/cj-message/while.php' | wc -l)
if [ $aa -eq 0 ];then
	/usr/bin/php /data/www/ldsn/cj-message/while.php &
fi
