
function delete_row(row, controller, confirmation) {

    if (confirmation) {
        $("#" + row).hide("slow", function () {
            var link = '/Site/bouwou/' + controller + '/delete/' + row;
            //alert(link);
            /*$.ajax({

                url: link,

                success: function (data) {
                    //alert(data);
                    //$("#iconPreview .icon-preview").html(icon_preview);
                    $(this).remove();
                }

            })*/

        });
    }
    else {
        var box = $("#mb-remove-row");
        box.addClass("open");

        box.find(".mb-control-yes").on("click", function () {
            box.removeClass("open");
            $("#" + row).hide("slow", function () {
                var link = '/Site/bouwou/' + controller + '/delete/' + row;
                //alert(link);
                $.ajax({

                    url: link,

                    success: function (data) {
                        //alert(data);
                        //$("#iconPreview .icon-preview").html(icon_preview);
                        $(this).remove();
                    }

                })

            });
        });
    }

}

function delete_row_filiere(row, action) {


    var box = $("#mb-remove-row");
    box.addClass("open");

    box.find(".mb-control-yes").on("click", function () {
        box.removeClass("open");
        $("#" + row).hide("slow", function () {
            var link = '/Site/bouwou/formations/delete/' + row + '/' + action;
            //alert(link);
            $.ajax({

                url: link,

                success: function (data) {
                    //alert(data);
                    //$("#iconPreview .icon-preview").html(icon_preview);
                    $(this).remove();
                }

            })

        });
    });

}

function update_row(row) {

    var nom;
    var sigle;
    var description;
    $("#" + row + " td").each(function (i) {
        //alert(i);
        if (i == 0) { nom = $(this).children().html(); }
        if (i == 1) sigle = $(this).html();
        if (i == 2) description = $(this).html();
    });
    //alert(nom);
    $('.titre').html('Modifier une faculté');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('.name').children().val(nom);
    $('.sigle').children().val(sigle);
    $('.description').children().val(description);




}
function update_row_categorie(row) {

    var nom;
    var description;
    $("#" + row + " td").each(function (i) {
        //alert(i);
        if (i == 0) { nom = $(this).children().html(); }
        if (i == 2) description = $(this).html();
    });
    $("#form3").scroll('slow');
    //alert(nom);
    $('.titre').html('Modifier une categorie');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('.name').children().val(nom);
    $('.description').children().val(description);




}
function update_row_type(row) {

    var nom;
    var description;
    $("#" + row + " td").each(function (i) {
        //alert(i);
        if (i == 0) {
            nom = $(this).children().html();
        }
        if (i == 1) description = $(this).html();
        if (i == 3) {
            certif = $(this).children().html();
        }
    });
    //alert(nom);
    $('.titre').html('Modifier un type d\'université');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('.name').children().val(nom);
    $('.description').children().val(description);
    if (certif == 'En attente') {
        //$('option[value="1"]').prop('selected', true);
        $('.selectpicker').selectpicker('val', '1');

    }
    else {

        $('.selectpicker').selectpicker('val', '0');
        //$('.selectpicker').val('Certifié');
        //$('.selectpicker').selectpicker('render');
    }
}
function update_row_question(row) {

    var question;
    var type;
    $("#" + row + " td").each(function (i) {
        //alert(i);
        if (i == 1) {
            question = $(this).children().html();
        }
        if (i == 2) {
            type = $(this).html();
        }
    });
    //alert(nom);
    $('.titre').html('Modifier une question');
    $('.button').html('Modifier');
    $('.button').attr('href', row);
    $('.question').children().val(question);
    if (type == 'General') {
        //$('option[value="1"]').prop('selected', true);
        $('.selectpicker').selectpicker('val', '0');

    } else if (type == 'Personnalite') {
        //$('option[value="1"]').prop('selected', true);
        $('.selectpicker').selectpicker('val', '1');

    }
    else {

        $('.selectpicker').selectpicker('val', '2');
    }
}

function update_row_univ(id) {
    var link = '/Site/bouwou/universites/edit/' + id;
    //alert(link);
    window.location.href = link;
}
function update_row_concours(id) {
    var link = '/Site/bouwou/concours/edit/' + id;
    //alert(link);
    window.location.href = link;
}
function update_row_produit(id) {
    var link = '/pharmacietest/bouwou/catalogue/produitadd/' + id;
    //alert(link);
    window.location.href = link;
}
function update_row_user(id) {
    var link = '/Site/bouwou/users/edit/' + id;
    //alert(link);
    window.location.href = link;
}
function filiere_row(iduniv, idfac) {
    var link = '/Site/bouwou/formations/index/' + iduniv + '/' + idfac;
    //alert(link);
    window.location.href = link;
}
function filiere_categorie_row(id) {
    var link = '/Site/bouwou/formations/index/0/0/' + id;
    //alert(link);
    window.location.href = link;
}
function update_row_filiere(id) {
    var link = '/Site/bouwou/formations/edit/' + id;
    //alert(link);
    window.location.href = link;
}
function conf_row_question(id) {
    var link = '/Site/bouwou/orientation/configuration/' + id;
    //alert(link);
    window.location.href = link;
}
function categorie_row_question(id) {
    var link = '/Site/bouwou/orientation/recapitulatif/categorie/' + id;
    //alert(link);
    window.location.href = link;
}

function info_row(row) {

    //var lien = $(this).attr('id');
    //alert('test');

    $.ajax({
        type: "POST",
        url: '/Site/koudjine/inc/info_universite.php',
        data: {
            id: row
        },
        dataType: 'json',
        success: function (data) {
            //alert(data);
            //$("#iconPreview .icon-preview").html(icon_preview);

            $('#iconPreview .nom').html(data.nom);
            $("#iconPreview .ville").html(data.ville);
            $("#iconPreview .region").html(data.region);
            $("#iconPreview .statut").html(data.statut);
            $("#iconPreview .type").html(data.type);
            $("#iconPreview .responsable").html(data.responsable);
            $("#iconPreview .bp").html(data.bp);
            $("#iconPreview .email").html(data.email);
            $("#iconPreview .phone").html(data.phone);
            $("#iconPreview .site").html(data.site);
            $("#iconPreview .certif").html(data.certif);
        }

    })

    // var icon_preview = $("<i></i>").addClass(iClass);
    $("#iconPreview").modal("show");

}

// Fonctions Pharmacie

function info_row(row) {

    //var lien = $(this).attr('id');
    //alert('test');

    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/info_universite.php',
        data: {
            id: row
        },
        dataType: 'json',
        success: function (data) {
            //alert(data);
            //$("#iconPreview .icon-preview").html(icon_preview);

            $('#iconPreview .nom').html(data.nom);
            $("#iconPreview .ville").html(data.ville);
            $("#iconPreview .region").html(data.region);
            $("#iconPreview .statut").html(data.statut);
            $("#iconPreview .type").html(data.type);
            $("#iconPreview .responsable").html(data.responsable);
            $("#iconPreview .bp").html(data.bp);
            $("#iconPreview .email").html(data.email);
            $("#iconPreview .phone").html(data.phone);
            $("#iconPreview .site").html(data.site);
            $("#iconPreview .certif").html(data.certif);
        }

    })

    // var icon_preview = $("<i></i>").addClass(iClass);
    $("#iconPreview").modal("show");

}
// Fin
