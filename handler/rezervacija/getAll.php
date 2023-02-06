<?php
require "../../dbBroker.php";
require "../../model/Rezervacija.php";

try {
    echo json_encode(Rezervacija::getAll($conn));
} catch (Exception $ex) {
  echo json_encode([
      "greska"=>$ex->getMessage()
  ]);
}
