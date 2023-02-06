<?php

class TipSobe{

    private $id;
    private $naziv;


    public function __construct($id=null, $naziv=null){
        $this->id = $id;
        $this->naziv = $naziv;
    }

    public static function getAll(mysqli $conn){
        $query = "SELECT * FROM tip_sobe";
        $rezultat = $conn->query($query);
        if(!$rezultat){
            throw new Exception($conn->error);
        }
        $data=[];
        
        while($tip_sobe=$rezultat->fetch_assoc()){
            $data[]=$tip_sobe;
        }
        return $data;
    }
}
