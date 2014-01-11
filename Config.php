<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 * Date: 01.01.14
 * Time: 23:02
 */

class Config {

    public $formFields = array(
        0 => array(
            "name" => "lastname",
            "title" => "Фамилия",
            "type" => "text",
            "validate" => "FIO",
            "value" => "",
        ),
        1 => array(
            "name" => "firstname",
            "title" => "Имя",
            "type" => "text",
            "validate" => "FIO",
            "value" => "",
        ),
    );

    public $defaultMainTmpl = "main";

    public $defaultSiteName = "Mars Repair";

    public function Config (){
        return true;
    }

} 