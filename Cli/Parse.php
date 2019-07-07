<?php

namespace Parser\Cli;
use Parser\main;

class Parse extends AbstractCommand
{
    protected function checkParams()
    {
        $this->ensureParamExists();
    }

    public function execute()
    {
        //echo $this->getParam();
		echo "Wait...";
		$parse = new main($this->getParam());
		$parse->reportFile();
		echo "
";
		echo "Complate.";
    }
}