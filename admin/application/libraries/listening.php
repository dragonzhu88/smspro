<?php
var_dump(json_decode(file_get_contents('php://input'),true));
$txt = file_get_contents('php://input');
$myfile = fopen("json.txt", "a");
fwrite($myfile, $txt);
fclose($myfile);
?>