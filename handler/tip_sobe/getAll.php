<?php
require "../../dbBroker.php";
require "../../model/TipSobe.php";

try {
    echo json_encode(TipSobe::getAll($conn));
} catch (Exception $ex) {
  echo json_encode([
      "greska"=>$ex->getMessage()
  ]);
}
