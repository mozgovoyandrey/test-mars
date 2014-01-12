<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 *
 * Макет модуля
 */

abstract class Module {

    public $mars;

    public $config;

    public function getResult(){
        return $this->mars;
    }
} 