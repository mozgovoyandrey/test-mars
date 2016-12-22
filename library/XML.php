<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 *
 * Используется для формирования и сохранения данных в XML формате
 */

class XML {

    public $xml;

    public $data;

    public function __construct($data){
        $this->data = $data;

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';

        $xml .= '<data>';
        $xml .= $this->layerXML('import', $data);
        $xml .= '</data>';

        //$xml = str_replace('&', '&amp;', $xml);
        $this->xml = $xml;
    }

    public function layerXML($name, $layer, $name_parent = ''){
        $text = '';
        if (is_int($name)){
            $text .= '<'.$name_parent.'>';
        }
        foreach($layer AS $k1=>$v1){
            if (is_array($v1)){
                $text .= $this->layerXML($k1, $v1, $name);
            } else {
                $text .= '<'.$k1.'>';
                $text .= $v1;
                $text .= '</'.$k1.'>';
            }
        }
        if (is_int($name)){
            $text .= '</'.$name_parent.'>';
        }

        return $text;
    }

    public function saveXML($path){
        file_put_contents($path,$this->xml);
        return true;
    }
} 