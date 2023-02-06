<?php
require "../../dbBroker.php";
require "../../model/Rezervacija.php";

try {
    Rezervacija::add($_POST,$conn);
    echo "uspesno kreirana nova rezervacija";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
