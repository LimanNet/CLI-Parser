<?php

namespace Parser\Cli;

class Help
{

    public function execute()
    {
        
		echo "
		
		Command		Description
		
		parse url	- запускает парсер, принимает обязательный параметр url (как с протоколом, так и без)
			
		report url	- выводит в консоль результаты анализа для домена, принимает обязательный параметр domain (как с протоколом, так и без).
			
		help		- выводит список команд с пояснениями.
		";
    }
}