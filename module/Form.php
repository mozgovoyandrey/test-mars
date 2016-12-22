<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 * Модуль Form
 */

class Form extends Module{

    public function __construct($mars){
        $this->mars = $mars;
        include_once "config/Form.php";
        $this->config  = new FormConfig();

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
                break;
        }

        return true;
    }

    /**
     * Отображает форму создания заявки
     */
    public function show_form(){

        include_once "model/Form.php";
        $this->model  = new FormModel($this->mars, $this->config);

        $tmpl = file_get_contents("views/form/form.php");

        $data = $this->model->show_form();
        $content = new View($tmpl, $data);

        $this->mars->viewData["content"] = $content;

        return true;
    }

    /**
     * Отображает сообщение об успешном создании заявки и сохраняет данные
     */
    public function show_submit(){

        include_once "model/Form.php";
        $this->model  = new FormModel($this->mars, $this->config);

        $tmpl = file_get_contents("views/form/form_submit.php");

        //$data = $this->model->show_form();
        $content = new View($tmpl);

        $xml = new XML($this->model->getXMLdata());

        $xml->saveXML("xml/".strtotime($xml->data['daterepair'])."-".time().".xml");

        $this->mars->viewData["content"] = $content;

        return true;
    }

}