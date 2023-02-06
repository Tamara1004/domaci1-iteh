<?php

require "dbBroker.php";
require "model\Rezervacija.php";

session_start(); //zapocinjanje sesije
if (!isset($_SESSION['user_id'])) { //ako nije postavljen session na user_id. SESSION je prazan niz na celoj stranici kome prosledjujemo kljuceve,itd.
    header('Location: login.php'); //postavljamo ga na pocetnu stranicu, login stranicu, ostavlja nas na index.php
    exit(); //kraj
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=”stylesheet” href=”https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css”rel=”nofollow” 
    integrity=”sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm” crossorigin=”anonymous”>
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css\home.css">  
    <title>Rezervacije</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Grande Resto</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" href="home.php">REZERVACIJE</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="gosti.html">GOSTI</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
 

    <div class="container mt-2">
        
        <table id="myTable" class="table table-striped table-hover">
            <thead>
                <th style="text-align: center">Tabela rezervacija</th>
                <tr class="table-secondary">
                    <th>ID</th>
                    <th>Cena (€)</th>
                    <th>Gost</th>
                    <th>Opis</th>
                    <th>Tip sobe</th>
                    <th>Izmena podataka</th>
                </tr>
            </thead>
            <tbody id='rezervacije'>

            </tbody>
        </table>
    </div>
    <div class="row mb-5">
        <div class="col-4">
            <select id="sort" class="form-control combo-boksevi">
                <option value="1">Sortiraj po ceni od manje ka vecoj</option>
                <option value="-1">Sortiraj po ceni od vece ka manjoj</option>
            </select>
        </div>
        <div class="col-4">
            <select id="gost_pretraga" class="form-control combo-boksevi"></select>
        </div>
        <div class="col-4">
            <select id="tip_sobe_pretraga" class="form-control combo-boksevi"></select>
        </div>
    </div>
    <div class="row mb-4">
            <div class="col-10"></div>
            <div class="col-2">
                <button data-toggle='modal' data-target='#exampleModal' type="button" class="btn btn-secondary">Rezervisi</button>

            </div>
        </div>
       
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forma rezervacija</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="forma">
                        <div class="form-group">
                            <label for="cena" class="col-form-label">Cena</label>
                            <input required type="text" class="form-control" id="cena">
                        </div>
                        <div class="form-group">
                            <label for="gost" class="col-form-label">Gost</label>
                            <select required class="form-control" id="gost"></select>
                        </div>
                        <div class="form-group">
                            <label for="opis" class="col-form-label">Opis</label>
                            <input required class="form-control" id="opis">
                        </div>
                        <div class="form-group">
                            <label for="tip_sobe" class="col-form-label">Tip sobe</label>
                            <select required class="form-control" id="tip_sobe"></select>
                        </div>
                        <button type="submit" class="btn btn-primary form-control">Sacuvaj</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src=”https://code.jquery.com/jquery-3.2.1.slim.min.js” integrity=”sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN” crossorigin=”anonymous”></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js integrity=”sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q” crossorigin=”anonymous”></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="./main.js"></script>

    <script>
    let id = 0;
    let rezervacije = [];
    $(document).ready(() => {
        obradiGet('./handler/gost/getAll.php', $('#gost_pretraga'), gost => `
            <option value='${gost.id}'>
                ${gost.ime + ' ' + gost.prezime}
            </option>
        `, '<option value=0 >Svi gosti</option>')

        obradiGet('./handler/gost/getAll.php', $('#gost'), gost => `
            <option value='${gost.id}'>
                ${gost.ime + ' ' + gost.prezime}
            </option>
        `)
        obradiGet('./handler/tip_sobe/getAll.php', $('#tip_sobe_pretraga'), tip_sobe => `
            <option value='${tip_sobe.id}'>
                ${tip_sobe.naziv}
            </option>
        `, '<option value=0 >Tipovi soba</option>')

        obradiGet('./handler/tip_sobe/getAll.php', $('#tip_sobe'), tip_sobe => `
            <option value='${tip_sobe.id}'>
                ${tip_sobe.naziv}
            </option>
        `)
        ucitajrezervacije()
        $('#exampleModal').on('show.bs.modal', e => {
            id = ucitajUFormu(e, ['cena', 'gost', 'opis', 'tip_sobe'])
        })
        $('#forma').submit(e => {
            e.preventDefault();
            const telo = {
                id,
                cena: $('#cena').val(),
                gost: $('#gost').val(),
                opis: $('#opis').val(),
                tip_sobe: $('#tip_sobe').val(),
            }
            $.post(`./handler/rezervacija/${id ? 'update' : 'add'}.php`, telo).then(res => {
                alert(res);
                ucitajrezervacije();
            })
        })
        $('#sort').change(prikaziPodatkeTabele);
        $('#gost_pretraga').change(prikaziPodatkeTabele);
        $('#tip_sobe_pretraga').change(prikaziPodatkeTabele);
    })

    function ucitajrezervacije() {
        $.getJSON('./handler/rezervacija/getAll.php').then(res => {
            if (res.greska) {
                alert(res.greska);
                return;
            }
            rezervacije = res;
            prikaziPodatkeTabele();
        })
    }
function prikaziPodatkeTabele() {
    const sort = Number($('#sort').val());
    const gost = Number($('#gost_pretraga').val());
    const tip_sobe = Number($('#tip_sobe_pretraga').val());

    const filtrirane = rezervacije.filter(rezervacija => {
        return (gost == 0 || rezervacija.gost == gost) && (tip_sobe == 0 || rezervacija.tip_sobe == tip_sobe)
    }).sort((a, b) => {
        return a.cena > b.cena ? sort : 0 - sort;
    })
    $('#rezervacije').html('');
    for (let rezervacija of filtrirane) {
        $('#rezervacije').append(`
        <tr>
            <td>${rezervacija.id}</td>    
            <td>${rezervacija.cena}</td>    
            <td>${rezervacija.naziv_gosta}</td>    
            <td>${rezervacija.opis}</td>    
            <td>${rezervacija.naziv_tipa_sobe}</td>    
            <td>
            <button
                data-toggle='modal' 
                data-target='#exampleModal'
                data-id='${rezervacija.id}'
                data-cena='${rezervacija.cena}'
                data-gost='${rezervacija.gost}'
                data-opis='${rezervacija.opis}'
                data-tip_sobe='${rezervacija.tip_sobe}'
                class='btn btn-success form-control'>Izmeni
            </button>
            <button  onClick="obrisiRezervaciju(${rezervacija.id})" type="button" class="btn btn-dark disabled form-control">Obrisi</button>
        </td>
        </tr>
        `)
    }
}
    function obrisiRezervaciju(id) {
        $.post('./handler/rezervacija/delete.php', { id }).then(res => {
            alert(res);
            ucitajrezervacije();
        })
    }
</script>
</body>

</html>