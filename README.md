# CLI Parser

[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2FLimanNet%2FCLI-Parser.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2FLimanNet%2FCLI-Parser?ref=badge_shield)


Parser CLI is a PHP command line interface library meant to provide a full set of functionality with a clean and simple api.

Installation
Parser CLI requires PHP 7.0 or higher

Parser CLI is PSR-4 compliant and can be installed using <a href="https://ospanel.io">Open Server Panel</a>.

## Listing Commands

Calling a script that has commands with no options or just the `--help` option will display a list of commands. Here is the output from the multiple commands example above.

<pre>
<b>usage: </b>php bin/cli.php <command> [&lt;options&gt;] [&lt;args&gt;]

<b>COMMANDS</b>
  parse url       - запускает парсер, принимает обязательный параметр url результат выводится в файл .csv
  report url      - выводит в консоль результаты анализа для домена, принимает обязательный параметр domain (как с протоколом, так и без).
  help            - выводит список команд с пояснениями.
</pre>


# CLI Parser

php bin/cli.php help

php bin/cli.php parse url

php bin/cli.php report url

Command         Description

parse url       - запускает парсер, принимает обязательный параметр url результат выводится в файл .csv

report url      - выводит в консоль результаты анализа для домена, принимает обязательный параметр domain (как с протоколом, так и без).

help            - выводит список команд с пояснениями.
