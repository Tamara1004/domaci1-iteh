<?php
require "../../dbBroker.php";
require "../../model/Gost.php";

try {
  echo json_encode(Gost::getAll($conn));
} catch (Exception $ex) {
  echo json_encode([
    "greska" => $ex->getMessage()
  ]);
}
