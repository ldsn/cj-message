#!/bash/shell

aa=$(ps -ef | grep 'php while.php' | wc -l)
if [ $aa -eq 0 ];then
	php while.php &
fi
