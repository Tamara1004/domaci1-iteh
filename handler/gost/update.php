<?php
require "../../dbBroker.php";
include "../../model/Gost.php";

try {
    $gost = new Gost($_POST['id'],$_POST['ime'],$_POST['prezime'],$_POST['broj_LK']);
    $gost->update($conn);
    echo "Uspesno izmenjen gost";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
