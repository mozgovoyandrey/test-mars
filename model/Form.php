<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 * Date: 11.01.14
 * Time: 3:18
 */

class FormModel extends Model {

    public function FormModel($mars, $config = array()){
        $this->mars = $mars;
        $this->config = $config;
        $this->data = array();
    }

    public function show_form(){

        $this->data['buttonName'] = $this->config->formBtnSubmitName;

        $rows = array();
        if ($this->config->formFields){
            foreach($this->config->formFields AS $key => $field){
                $row = array();
                $row['title'] = $field['title'];
                $row['error'] = $this->config->errors[$key] ? $this->config->errors[$key] : "";
                switch ($field['type']){
                    case "text":
                        $input_tmpl = '<input type="text" value="[%value%]" name="field[%id%]">';
                        $input_data['id'] = $key;
                        $input_data['value'] = $field['value'];
                        break;
                    case "textbox":
                        $input_tmpl = '<textarea name="field[%id%]">[%value%]</textarea>';
                        $input_data['id'] = $key;
                        $input_data['value'] = $field['value'];
                        break;
                }
                $row['input'] = new View($input_tmpl, $input_data);
                $rows[] = $row;
            }
        }
        $tmpl_line = file_get_contents("views/form/form_line.php");
        $lines = new View($tmpl_line, $rows, true);
        $this->data['lines'] = $lines;
        return $this->data;
    }
} 