<?php
require "../../dbBroker.php";
require "../../model/Gost.php";

if(!isset($_POST['id'])){
    echo "id nije prosledjen";
    exit;
}

try {
    $gost=new Gost($_POST['id']);
    $gost->deleteByid($conn);
    echo "uspesno obrisan gost";
} catch (Exception $ex) {
   echo $ex->getMessage();
}
