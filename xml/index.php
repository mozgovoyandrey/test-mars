<?php
echo '<!DOCTYPE html><html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Сохраненные заявки</title></head><body><h1>Сохраненные заявки</h1><ul>';

$f = scandir("./");

foreach ($f as $file){
    if(preg_match('/^(\d*)-(\d*)\.xml$/', $file, $match)){
        echo '<li><a href="/xml/'.$match[0].'">Заявка на '.date("d.m.Y", $match[1]).' создана '.date("d.m.Y", $match[2]).'</a></li>';
    }
}

echo '</ul></body></html>';
exit;