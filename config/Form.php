<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 * Date: 11.01.14
 * Time: 3:02
 */

class FormConfig {
    public $formFields = array();

    public $formBtnSubmitName = "Отправить заявку";

    public function FormConfig(){
        $this->formFields[] = array(
            "name" => "lastname",
            "title" => "Фамилия",
            "type" => "text",
            "validate" => "FIO",
            "value" => "",
            "notempty" => true,
        );
        $this->formFields[] = array(
            "name" => "firstname",
            "title" => "Имя",
            "type" => "text",
            "validate" => "FIO",
            "value" => "",
            "notempty" => true,
        );
        $this->formFields[] = array(
            "name" => "nlonumber",
            "title" => "Номер летающей тарелки",
            "type" => "text",
            "validate" => "NLOnum",
            "value" => "",
            "notempty" => true,
        );
        $this->formFields[] = array(
            "name" => "daterepair",
            "title" => "Дата ремонта",
            "type" => "text",
            "validate" => "Date",
            "value" => date("d-m-Y"),
            "notempty" => true,
        );
        $this->formFields[] = array(
            "name" => "phonenumber",
            "title" => "Телекоммуникационный номер",
            "type" => "text",
            "validate" => "PhoneNumber",
            "value" => "",
            "notempty" => true,
        );
        $this->formFields[] = array(
            "name" => "comment",
            "title" => "Комментарий",
            "type" => "textbox",
            "validate" => "Сomment",
            "value" => "",
            "notempty" => false,
        );




    }

} 