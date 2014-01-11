<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 * Date: 11.01.14
 * Time: 3:25
 */

abstract class Module {

    public $mars;

    public $config;

    public function getResult(){
        return $this->mars;
    }
} 