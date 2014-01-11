<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 * Date: 01.01.14
 * Time: 23:08
 */

class Validate {

    public $config;

    public $errors = false;

    public function Validate($config){

        $this->config = $config;

        $errors = array();

        foreach($this->config->formFields AS $key => $field){

            if (empty($_POST['field'.$key])){
                if ($field['notempty']){
                    $errors[$key] = "Не заполнено обязательное поле!";
                }
            } else {
//                $value = $_POST['field'.$key];
                if ($field['validate']){
                    $funcValidate = "validate".$field['validate'];
                    $error = $this->$funcValidate($_POST['field'.$key]);
                    if ($error === true){
                        $this->config->formFields[$key]["value"] = $this->correction($_POST['field'.$key], $field['validate']);
                    } else {
                        $errors[$key] = $error;
                        $this->config->formFields[$key]["value"] = $this->correction($_POST['field'.$key], "error");
                    }
                }

            }

        }

        $this->config->errors = $errors;

    }

    public function validateFIO($value){
        $value = trim($value);
        if (preg_match('/^[a-zA-Z]+[a-zA-Z\s-]+[a-zA-Z]+$/',$value)){
            return true;
        } else {
            return "Некорректно заполнено поле. Возможно Вы не марсианин?";
        }
    }

    public function validateNLOnum($value){
        $value = trim($value);
        $value = preg_replace('/\s/','',$value);
        if (preg_match('/^[a-zA-Z]{1}[0-9]{5}[a-zA-Z]{2}$/',$value)){
            return true;
        } else {
            return "Некорректно заполнено поле.";
        }
    }

    public function validatePhoneNumber($value){
        $value = preg_replace('/\s/','',$value);
        if (preg_match('/^[a-fA-F0-9]{12}$/',$value)){
            return true;
        } else {
            return "Некорректно заполнено поле.";
        }
    }

    public function validateDate($value){
        $value = preg_replace('/\s/','',$value);
        //$value = intval($value);
        if (preg_match('/^([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})$/',$value, $match)){
            $d = intval($match[1]);
            if (checkdate($match[2],$match[1],$match[3])){
                $valueUnix = strtotime($value);
                $currentDate = time();

                if ($currentDate > $valueUnix) {
                    echo "Должна быть задана еще не прошедшая дата.";
                } else {
                    return true;
                }
            } else{
                return "Некорректная дата.";
            }


            return true;
        } else {
            return "Некорректно заполнено поле. Введите дату в формате DD-MM-YYYY";
        }
    }

    public function validateComment($value){
        return true;
    }

    public function correction($value, $type){
        switch ($type){
            case "FIO":
                $value = trim($value);
                //$value = preg_replace('/-\s|\s-{1,}/','-',$value);
                $value = preg_replace('/\s{2,}/',' ',$value);
                $value = preg_replace('/-{2,}/','-',$value);
                $value = ucfirst(strtolower($value));
                break;
            case "NLOnum":
                //$value = trim($value);
                $value = preg_replace('/\s/','',$value);
                $value = strtoupper($value);
                break;
            case "Date":
                preg_match('/^([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})$/',$value, $match);
                $value = (intval($match[1]) < 10 ? "0" : "").$match[1]."-"
                    .(intval($match[2]) < 10 ? "0" : "").$match[2]."-"
                    .$match[3];
                //$value = trim($value);
                //$value = preg_replace('/\s/','',$value);
                //$value = strtoupper($value);
                break;
            case "PhoneNumber":
                //$value = trim($value);
                $value = preg_replace('/\s/','',$value);
                $value = strtoupper($value);
                break;
            case "Comment":
                $value = trim($value);
                break;
            case "error":
                $value = trim($value);
                $value = htmlspecialchars($value);
                break;
            default:
        }
        return $value;
    }

    public function getConfig(){
        return $this->config;
    }
} 