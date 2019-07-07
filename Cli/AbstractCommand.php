<?php

namespace Parser\Cli;

use Parser\Exceptions\CliException;

abstract class AbstractCommand
{
    /** @var string */
    private $param;

    public function __construct(string $param)
    {
        $this->param = $param;
		$this->checkParams();
    }

    abstract public function execute();

    abstract protected function checkParams();

    protected function getParam()
    {
        return $this->param ?? null;
    }

    protected function ensureParamExists()
    {
        if (!isset($this->param)) {
            throw new CliException('Param is not set!');
        }
    }
}