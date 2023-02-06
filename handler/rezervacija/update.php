<?php
require "../../dbBroker.php";
require "../../model/Rezervacija.php";

try {
    $rezervacija = new Rezervacija($_POST['id'], $_POST['cena'], $_POST['gost'], $_POST['opis'], $_POST['tip_sobe']);
    $rezervacija->update($conn);
    echo "uspesno izmenjena rezervacija";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
