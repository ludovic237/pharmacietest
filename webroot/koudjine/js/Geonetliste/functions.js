var test = 0;
var startDate;
var endDate;
var idemploye = null
;
var idfulldepense;

$(document).ready(function () {

});



function delete_row(row, controller, table, confirmation) {

    if (confirmation) {
        $("#" + row).hide("slow", function () {
            var link = '/pharmacietest/bouwou/' + controller + '/delete/' + row + '/' + table;

        });
    }
    else {
        var box = $("#mb-remove-row");
        box.addClass("open");

        box.find(".mb-control-yes").on("click", function () {
            box.removeClass("open");
            $("#" + row).hide("slow", function () {
                var link = '/pharmacietest/bouwou/' + controller + '/delete/' + row + '/' + table;
                //alert(link);
                $.ajax({

                    url: link,

                    success: function (data) {
                        $(this).remove();
                    }

                })

            });
        });
    }

}


function enregistrer_codepostal(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_codepostal.php',
            data: {
                nom: nom,
                code: code
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/codepostal/';
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_codepostal.php',
            data: {
                nom: nom,
                code: code,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/codepostaladd/' + id;
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_codepostal(id) {
    var link = '/pharmacietest/bouwou/geonetliste/codepostaladd/' + id;
    ////alert(link);
    window.location.href = link;
}

function enregistrer_forme(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_forme.php',
            data: {
                nom: nom,
                code: code
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/forme/';
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_forme.php',
            data: {
                nom: nom,
                code: code,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/formeadd/' + id;
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_forme(row) {

    var nom;
    var code;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) {
            nom = $(this).children().html();
        }
        if (i == 1) {
            code = $(this).html();
        }

    });

    $('.titre').html('Modifier forme');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    $('#code').val(code);
}

function enregistrer_magasin(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_magasin.php',
            data: {
                nom: nom,
                code: code,
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/magasin/';
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_magasin.php',
            data: {
                nom: nom,
                code: code,
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/magasinadd/' + id;
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_magasin(row) {

    var nom;
    var code;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) {
            nom = $(this).children().html();
        }
        if (i == 1) {
            code = $(this).html();
        }

    });

    $('.titre').html('Modifier magasin');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    $('#code').val(code);
}

function enregistrer_ville(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_ville.php',
            data: {
                nom: nom,
                code: code
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/ville/';
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_ville.php',
            data: {
                nom: nom,
                code: code
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/villeadd/' + id;
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_ville(row) {

    var nom;
    var code;
    $("#" + row + " td").each(function (i) {

        if (i == 0) {
            nom = $(this).children().html();
            //alert(nom);
        }
        if (i == 1) {
            code = $(this).html();
            //alert(code);
        }

    });
    //alert(row);
    $('.titre').html('Modifier ville');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    $('#code').val(code);
}

function enregistrer_unite(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var libelle = $('#libelle').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_unite.php',
            data: {
                nom: nom,
                libelle: libelle
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/unite/';
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {
        ////alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_unite.php',
            data: {
                nom: nom,
                libelle: libelle,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/uniteadd/' + id;
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_unite(row) {

    var nom;
    var libelle;
    $("#" + row + " td").each(function (i) {

        if (i == 0) {
            nom = $(this).children().html();
            //alert(nom);
        }
        if (i == 1) {
            libelle = $(this).html();
            //alert(libelle);
        }

    });
    //alert(row);
    $('.titre').html('Modifier forme');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    $('#libelle').val(libelle);
}

function enregistrer_rayon(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();


    if (option == 'Ajouter') {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_rayon.php',
            data: {
                nom: nom,
                code: code
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/rayon/';
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);
                }
            }
        });
    }
    else {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_rayon.php',
            data: {
                nom: nom,
                code: code,
                id: id
            },
            success: function (data) {

                ////alert(data.erreur);
                if (data == 'ok') {
                    noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                    setTimeout(function () {
                        var link = '/pharmacietest/bouwou/geonetliste/rayonadd/' + id;
                        window.location.href = link;
                    }, 5000);

                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 93000);

                }
            }
        });
    }

}

function update_row_rayon(row) {

    var nom;
    var code;
    $("#" + row + " td").each(function (i) {
        ////alert(i);
        if (i == 0) {
            nom = $(this).children().html();
            //alert(nom);
        }
        if (i == 1) {
            code = $(this).html();
            //alert(code);
        }

    });

    $('.titre').html('Modifier rayon');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('#nom').val(nom);
    $('#code').val(code);
}



