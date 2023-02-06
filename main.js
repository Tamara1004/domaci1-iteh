function obradiGet(putanja, htmlElement, elementRenderer, pocetno = '') {
    $.getJSON(putanja).then(res => {
        if (res.greska) {
            alert(res.greska);
            return;
        }
        htmlElement.html(pocetno);
        for (let element of res) {
            htmlElement.append(elementRenderer(element));
        }
    })
}
function ucitajUFormu(e, atributi = []) {
    let button = $(e.relatedTarget);
    let id = Number(button.data('id') || 0);
    if (!id) {
        for (let atribut of atributi) {
            $('#' + atribut).val('');
        }
    } else {
        for (let atribut of atributi) {
            $('#' + atribut).val(button.data(atribut));
        }
    }
    return id;
}


