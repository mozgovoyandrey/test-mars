<?php
/**
 * Created by MOZGOVOY.NET
 * User: Mozgovoy Andrey
 * Date: 01.01.14
 * Time: 23:00
 */

include_once "Config.php";

include_once "library/Mars.php";
include_once "library/Module.php";
include_once "library/Model.php";
include_once "library/Main.php";
include_once "library/View.php";
include_once "library/XML.php";

$mars = new Main();

$mars->run();

exit;