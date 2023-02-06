<?php
require "../../dbBroker.php";
require "../../model/Gost.php";

try {
    Gost::add($_POST, $conn);
    echo "Uspesno kreiran novi gost";
} catch (Exception $ex) {
    echo $ex->getMessage();
}
