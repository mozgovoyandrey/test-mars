<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 *
 * Объект для компоновки данных
 */

class View {

    public $tmpl;

    public $noOne;

    public $data;

    public $dataEmpty;

    /**
     * @param string $tmpl Шаблон данных (HTML код)
     * @param array $data Данные для подстановки
     * @param bool $noOne TRUE если требуется вывести несколько копий объекта с различными данными
     */
    public function __construct($tmpl = "", $data = array(), $noOne = false){

        $this->tmpl = $tmpl;
        $this->noOne = $noOne;

        preg_match_all('/\[%(.*)%\]/', $tmpl, $variable);

        foreach($variable[1] AS $key){
            $this->dataEmpty[$key] = "";
        }
        $this->data = $data;

        return true;
    }

    /**
     * Формирует данные объекта в HTML код
     *
     * @return string
     */
    public function render(){
        $render = "";
        if ($this->noOne){
            foreach($this->data AS $data){
                $render .= $this->renderCopy($data);
            }
        } else {
            $render = $this->renderCopy($this->data);
        }

        return $render;
    }

    /**
     * Формирует экзепляр по шаблону
     *
     * @param $data
     * @return string
     */
    public function renderCopy($data){
        $copy = $this->tmpl;
        foreach ($data AS $key => $val){
            if (is_object($val)){
                $copy = preg_replace('/\[%'.$key.'%\]/', $val->render(), $copy);
            } else {
                $copy = preg_replace('/\[%'.$key.'%\]/', $val, $copy);
            }
        }

        $copy = preg_replace('/\[%.*%\]/', "", $copy);

        return $copy;
    }
} 