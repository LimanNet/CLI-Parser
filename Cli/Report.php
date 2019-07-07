<?php

namespace Parser\Cli;
use Parser\main;

class Report extends AbstractCommand
{
    protected function checkParams()
    {
        $this->ensureParamExists();
    }

    public function execute()
    {
        //echo $this->getParam();
		$parse = new main($this->getParam());
		$parse->reportDisplay();
    }
}