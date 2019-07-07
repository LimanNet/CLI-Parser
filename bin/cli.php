<?php

try {
    unset($argv[0]);

    // Регистрируем функцию автозагрузки
	chdir("..");
    spl_autoload_register(function (string $className) {
        require_once($className . '.php');
    });
	
    // Составляем полное имя класса, добавив нэймспейс
    $className = '\\Parser\\Cli\\' . array_shift($argv);
    if (!class_exists($className)) {
        throw new \Parser\Exceptions\CliException('Class "' . $className . '" not found');
    }

    // Создаём экземпляр класса, передав параметр и вызываем метод execute()
    $class = new $className($argv[0]);
    $class->execute();
} catch (\Parser\Exceptions\CliException $e) {
    echo 'Error: ' . $e->getMessage(); 
}