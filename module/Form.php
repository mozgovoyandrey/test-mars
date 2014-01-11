<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 * Date: 02.01.14
 * Time: 14:19
 */

class Form extends Module{

    //public $mars;

    public function Form($mars){
        $this->mars = $mars;
        include_once "config/Form.php";
        $this->config  = new FormConfig();

//        include_once "model/Form.php";
//        $this->model  = new FormModel($this->mars, $this->config);

        switch ($this->mars->urldata['action']) {
            case "post":
                include "library/Validate.php";
                $validate = new Validate($this->config);
                $this->config = $validate->getConfig();

                if (empty($this->config->errors)){
                    $this->show_submit();
                } else {
                    $this->show_form();
                }

                break;
            default:

                $this->show_form();
        }

    }

    public function show_form(){

        include_once "model/Form.php";
        $this->model  = new FormModel($this->mars, $this->config);

        $tmpl = file_get_contents("views/form/form.php");

        $data = $this->model->show_form();
        $content = new View($tmpl, $data);

        $this->mars->viewData["content"] = $content;
    }

    public function show_submit(){

        include_once "model/Form.php";
        $this->model  = new FormModel($this->mars, $this->config);
//
        $tmpl = file_get_contents("views/form/form_submit.php");
//
        $data = $this->model->show_form();
        $content = new View($tmpl, $data);
//
        $this->mars->viewData["content"] = $content;
    }
} 