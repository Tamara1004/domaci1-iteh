<?php

class Gost
{
    private $id;
    private $ime;
    private $prezime;
    private $broj_LK;

    public function __construct($id = null, $ime = null, $prezime = null, $broj_LK = null)
    {
        $this->id = $id;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->broj_LK = $broj_LK;
    }

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM gost";
        $rezultat = $conn->query($query);
        if (!$rezultat) {
            throw new  Exception($conn->error);
        }
        $data = [];
        while ($gost = $rezultat->fetch_assoc()) {
            $data[] = $gost;
        }
        return $data;
    }
    public static function add($dto, mysqli $conn)
    {
        $query = "INSERT INTO gost(ime,prezime,broj_LK) values('" . $dto['ime'] . "','" . $dto['prezime'] . "','" . $dto['broj_LK'] . "')";
        $rezultat = $conn->query($query);
        if (!$rezultat) {
            throw new Exception($conn->error);
        }
    }
    public function update(mysqli $conn)
    {
        $query = "UPDATE gost set ime='" . $this->ime . "', prezime='" . $this->prezime . "', broj_LK='" . $this->broj_LK . "' where id=" . $this->id;
        $rezultat = $conn->query($query);
        if (!$rezultat) {
            throw new  Exception($conn->error);
        }
    }
    public function deleteByid(mysqli $conn)
    {
        $query = "DELETE from gost where id=" . $this->id;
        $rezultat = $conn->query($query);
        if (!$rezultat) {
            throw new  Exception($conn->error);
        }
    }
}
