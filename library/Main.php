<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 * Date: 01.01.14
 * Time: 23:53
 */

class Main {

    public $mars;



    public function Main(){
        $this->mars = new Mars();
        $this->mars->config = new Config();
    }

    public function run(){
        $this->urlManager();

        $this->mars->viewData = $this->setDefaultViewData();

        include "module/".ucfirst($this->mars->urldata['module']).".php";
        ////$mmm = new Form()
        $module_name = ucfirst($this->mars->urldata['module']);
        //eval('$module =  new '.ucfirst($this->mars->urldata['module']).'($this->mars);');
        $module =  new $module_name($this->mars);

        $this->mars = $module->getResult();

        $this->render();
    }

    public function urlManager(){
        if ($_GET['module']){
            $this->mars->urldata['module'] = $_GET['module'];
        }
        if ($_POST || $_POST['post'] == true){
            $this->mars->urldata['action'] = "post";
        }
    }

    /**
     * Запускает компоновку и вывод данных на экран
     */
    public function render(){
        $tmpl_main = file_get_contents("views/".$this->mars->config->defaultMainTmpl.".php");

        $view = new View($tmpl_main, $this->mars->viewData);

        echo $view->render();
    }

    /**
     * Устанавливает значения "по умолчанию" из конфига
     *
     * @return array
     */
    private function setDefaultViewData(){
        $viewData = array();

        if(!empty($this->mars->config->defaultSiteName)){
            $viewData["name"] = $this->mars->config->defaultSiteName;
        }

        return $viewData;
    }
} 