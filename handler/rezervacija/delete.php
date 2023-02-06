<?php
require "../../dbBroker.php";
require "../../model/Rezervacija.php";

if(!isset($_POST['id'])){
    echo "id nije prosledjen";
    exit;
}

try {
    $rezervacija=new Rezervacija($_POST['id']);
    $rezervacija->deleteByid($conn);
    echo "uspesno obrisana rezervacija";
} catch (Exception $ex) {
   echo $ex->getMessage();
}
