<?php

class Rezervacija
{
    private $id;
    private $cena;
    private $gost;
    private $opis;
    private $tip_sobe;

    public function __construct($id = null, $cena = null, $gost = null, $opis = null, $tip_sobe = null)
    {
        $this->id = $id;
        $this->cena = $cena;
        $this->gost = $gost;
        $this->opis = $opis;
        $this->tip_sobe = $tip_sobe;
    }

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT r.*, ts.naziv AS 'naziv_tipa_sobe', CONCAT(g.ime,' ',g.prezime) AS 'naziv_gosta' FROM rezervacija r INNER JOIN tip_sobe ts ON (ts.id = r.tip_sobe) INNER JOIN gost g ON (g.id= r.gost)";
        $rezultat = $conn->query($query);
        if (!$rezultat) {
            throw new  Exception($conn->error);
        }
        $data = [];

        while ($rezervacija = $rezultat->fetch_assoc()) {
            $data[] = $rezervacija;
        }
        return $data;
    }
    public static function add($dto, mysqli $conn)
    {
        $query = "INSERT INTO rezervacija(cena,gost,opis,tip_sobe) VALUES('" . $dto['cena'] . "','" . $dto['gost'] . "','" . $dto['opis'] . "'," . $dto['tip_sobe'] . ")";
        $rezultat = $conn->query($query);
        if (!$rezultat) {
            throw new  Exception($conn->error);
        }
    }
    public function update(mysqli $conn)
    {
        $query = "UPDATE rezervacija SET cena='" . $this->cena . "', gost='" . $this->gost . "', opis='" . $this->opis . "', tip_sobe=" . $this->tip_sobe . " where id=" . $this->id;
        $rezultat = $conn->query($query);
        if (!$rezultat) {
            throw new  Exception($conn->error);
        }
    }
    public function deleteByid(mysqli $conn)
    {
        $query = "DELETE FROM rezervacija WHERE id=" . $this->id;
        $rezultat = $conn->query($query);
        if (!$rezultat) {
            throw new  Exception($conn->error);
        }
    }
}
