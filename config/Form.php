<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 * Настройки модуля Form
 */

class FormConfig {

    // Поля для формы
    public $formFields = array();

    // Название кнопки Submit
    public $formBtnSubmitName = "Отправить заявку";

    public function FormConfig(){
        $this->addFormField("lastname", "Фамилия", "text", "FIO", "", true);
        $this->addFormField("firstname", "Имя", "text", "FIO", "", true);
        $this->addFormField("nlonumber", "Номер летающей тарелки", "text", "NLOnum", "", true);
        $this->addFormField("daterepair", "Дата ремонта", "text", "Date", date("d-m-Y", strtotime('+1 day')), true);
        $this->addFormField("phonenumber", "Телекоммуникационный номер", "text", "PhoneNumber", "", true);
        $this->addFormField("comment", "Комментарий", "textbox", "Comment", "");
    }

    /**
     * Добавляет поле для формы
     *
     * @param $name Название поля (используется при сохранении данных)
     * @param $title Заголовок поля для вывода на форме
     * @param $type Тип поля
     * @param $validate Метод валидации данных
     * @param $value Значение по умолчанию
     * @param bool $notempty Если обязательно для заполнения - true
     * @return bool
     */
    private function addFormField($name, $title, $type, $validate, $value, $notempty = false){
        $this->formFields[] = array(
            "name" => $name,
            "title" => $title,
            "type" => $type,
            "validate" => $validate,
            "value" => $value,
            "notempty" => $notempty,
        );
        return true;
    }
} 