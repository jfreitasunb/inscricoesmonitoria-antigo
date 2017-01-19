<?php
require_once "config/init.php";
$disciplinas_escolhidas = $_POST;
// print_r($disciplinas_escolhidas);

for ($i=0; $i < $numero_escolhas_possiveis; $i++) { 
    foreach ($disciplinas_escolhidas as $key) {
        //echo print_r($key);
    }
}
?>