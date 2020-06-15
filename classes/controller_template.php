<?php


abstract class Controller_Template
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    abstract public function action(string $action);

}