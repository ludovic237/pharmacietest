$(document).ready(function () { 	// le document est charg鍊   $("a").click(function(){ 	// on selectionne tous les liens et on d?nit une action quand on clique dessus

    // Pharmacie
    $("#recherche").keyup(function (event) {
        var prixTotal = 0;
        var reduction = 0;
        if (event.keyCode == 13) {
            var recherche = $(this).val();
            $("#resultat ul").empty();
            recherche = $.trim(recherche);
            if (recherche.length > 1) {
                //alert('yes');
                $.ajax({
                    type: "GET",
                    url: "/pharmacietest/koudjine/inc/result1.php",
                    data: {
                        motclef: $(this).val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        //alert(data);
                        if (data.erreur == 'non') {
                            //alert('yes');
                            var cat = '<tr id="' + data.motclef + '">'
                                + ' <td><strong>' + data.nom + '</strong></td>'
                                + '<td>' + data.prix + '</td>'
                                + '<td>' + 1 + '</td>'
                                + '<td>' + data.prix + '</td>'
                                + '<td>' + data.reduction + '</td>'
                                + '<td>' + data.datel + '</td>'
                                + '<td>' + data.stock + '</td>'
                                + '</tr>';
                            prixTotal = data.prix;
                            reduction = data.reduction;


                            $('#tab_vente').prepend(cat);

                        }
                        else {
                            $('#message-box-danger p').html(data.erreur);
                            $("#message-box-danger").modal("show");
                            setTimeout(function () {
                                $("#message-box-danger").modal("hide");
                            }, 3000);
                        }
                        $('#recherche').val("");
                        var prixTotal1 = parseInt($('#prixTotal').html()) + parseInt(prixTotal);
                        $('#prixTotal').html(prixTotal1);
                        var prixReduit = parseInt($('#prixReduit').html()) + (parseInt(prixTotal) - (parseInt(prixTotal) * reduction / 100));
                        $('#prixReduit').html(prixReduit);
                    }
                })
            } else {
                $("#resultat ul").empty();
            }
        }
        else {
            var recherche = $(this).val();
            recherche = $.trim(recherche);
            var data = 'motclef=' + recherche;
            if (recherche.length > 1) {
                //alert('yes');
                $.ajax({
                    type: "GET",
                    url: "/pharmacietest/koudjine/inc/result.php",
                    data: data,
                    success: function (server_responce) {
                        $("#resultat ul").html(server_responce).show();
                        //alert(server_responce);
                    }
                })
            } else {
                $("#resultat ul").empty();
            }
        }

    });

});
// Ajax
// Fonctions PHARMACIE

function enregistrer_produit(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var ean13 = $('#ean13').val();
    var reference = $('#reference').val();
    var laborex = $('#laborex').val();
    var ubipharm = $('#ubipharm').val();
    //alert(type);
    var stock = $('#stock').val();
    var stockmin = $('#stockmin').val();
    var stockmax = $('#stockmax').val();
    var reduction = $('#reduction').val();
    var cat = $('#catproduit option:selected').val();
    var ray = $('#rayonproduit option:selected').val();
    var fab = $('#fabproduit option:selected').val();
    var mag = $('#magproduit option:selected').val();
    var forme = $('#formeproduit option:selected').val();
    /*$("#magproduit").change(function () {
        v = $('#magproduit option:selected').val();
        alert(v);
    })*/
    //.trigger('change');
    //alert(mag);

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_produit.php', 
            data: {
                nom: nom,
                ean13: ean13,
                reference: reference,
                laborex: laborex,
                ubipharm: ubipharm,
                stock: stock,
                stockmin: stockmin,
                stockmax: stockmax,
                reduction: reduction,
                cat: cat,
                forme: forme,
                ray: ray,
                fab: fab,
                mag: mag
            },
            success: function (data) {

                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/produit/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_produit.php',
            data: {
                nom: nom,
                ean13: ean13,
                reference: reference,
                laborex: laborex,
                ubipharm: ubipharm,
                stock: stock,
                stockmin: stockmin,
                stockmax: stockmax,
                reduction: reduction,
                cat: cat,
                forme: forme,
                ray: ray,
                fab: fab,
                mag: mag,
                id: id
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/produitadd/' + id;
                    window.location.href = link;
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

function enregistrer_assureur(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var taux = $('#taux').val();
    var CodePostal_id = $('#CodePostal_id').val();
    var telephone = $('#telephone').val();
    /*$("#magassureur").change(function () {
        v = $('#magassureur option:selected').val();
        alert(v);
    })*/
    //.trigger('change');
    //alert(mag);

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_assureur.php',
            data: {
                nom: nom,
                taux: taux,
                CodePostal_id: CodePostal_id,
                telephone: telephone
            },
            success: function (data) {

                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/assureur/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_assureur.php',
            data: {
                nom: nom,
                taux: taux,
                CodePostal_id: CodePostal_id,
                telephone: telephone,
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/assureuradd/' + id;
                    window.location.href = link;
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

function enregistrer_categorie(option, id) {

    var nom = $('#nom').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_categorie.php',
            data: {
                nom: nom,
            },
            success: function (data) {

                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/categorie/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_categorie.php',
            data: {
                nom: nom,
                id: id
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/categorieadd/' + id;
                    window.location.href = link;
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

function enregistrer_commande(option, id) {

    var dateCreation = $('#dateCreation').val();
    var dateLivraison = $('#dateLivraison').val();
    var note = $('#note').val();
    var qtiteCmd = $('#qtiteCmd').val();
    var qtiteRecu = $('#qtiteRecu').val();
    var montantCmd = $('#montantCmd').val();
    var montantRecu = $('#montantRecu').val();
    var etat = $('#etat').val();
    var ref = $('#ref').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_commande.php',
            data: {
                dateCreation: dateCreation,
                dateLivraison: dateLivraison,
                note: note,
                qtiteCmd: qtiteCmd,
                qtiteRecu: qtiteRecu,
                montantCmd: montantCmd,
                montantRecu: montantRecu,
                etat: etat,
                ref: ref,
            },
            success: function (data) {

                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/commande/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_commande.php',
            data: {
                dateCreation: dateCreation,
                dateLivraison: dateLivraison,
                note: note,
                qtiteCmd: qtiteCmd,
                qtiteRecu: qtiteRecu,
                montantCmd: montantCmd,
                montantRecu: montantRecu,
                etat: etat,
                ref: ref,
                id: id
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/commandeadd/' + id;
                    window.location.href = link;
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

function enregistrer_client(option, id) {

    var nom = $('#nom').val();
    var telephone = $('#telephone').val();
    var modeReglement = $('#modeReglement').val();
    var poid = $('#poid').val();
    var taille = $('#taille').val();
    var reduction = $('#reduction').val();
    var assureur_id = $('#assureur_id').val();
    var CodePostal_id = $('#CodePostal_id').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_client.php',
            data: {
                nom: nom,
                telephone: telephone,
                modeReglement: modeReglement,
                poid: poid,
                taille: taille,
                reduction: reduction,
                assureur_id: assureur_id,
                CodePostal_id: CodePostal_id
            },
            success: function (data) {

                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/client/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_client.php',
            data: {
                nom: nom,
                telephone: telephone,
                modeReglement: modeReglement,
                poid: poid,
                taille: taille,
                reduction: reduction,
                assureur_id: assureur_id,
                CodePostal_id: CodePostal_id,
                id: id
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/clientadd/' + id;
                    window.location.href = link;
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
                    var link = '/pharmacietest/bouwou/geonetliste/codepostal/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_codepostal.php',
            data: {
                nom: nom,
                code: code,
                id: id
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/geonetliste/codepostaladd/' + id;
                    window.location.href = link;
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


function enregistrer_fabriquant(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();
    var adresse = $('#adresse').val();
    var telephone = $('#telephone').val();
    var email = $('#email').val()

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_fabriquant.php',
            data: {
                nom: nom,
                code: code,
                adresse: adresse,
                telephone: telephone,
                email: email
            },
            success: function (data) {

                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/fabriquant/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_fabriquant.php',
            data: {
                nom: nom,
                code: code,
                adresse: adresse,
                telephone: telephone,
                email: email,
                id: id
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/fabriquantadd/' + id;
                    window.location.href = link;
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
                    var link = '/pharmacietest/bouwou/geonetliste/forme/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_forme.php',
            data: {
                nom: nom,
                code: code,
                id: id
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/geonetliste/formeadd/' + id;
                    window.location.href = link;
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


function enregistrer_fournisseur(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var code = $('#code').val();
    var statut = $('#statut').val();
    var adresse = $('#adresse').val();
    var telephone = $('#telephone').val();
    var email = $('#email').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_fournisseur.php',
            data: {
                nom: nom,
                code: code,
                statut: statut,
                adresse: adresse,
                telephone: telephone,
                email: email,
            },
            success: function (data) {

                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/fournisseur/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_fournisseur.php',
            data: {
                nom: nom,
                code: code,
                statut: statut,
                adresse: adresse,
                telephone: telephone,
                email: email,
                id: id
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/fournisseuradd/' + id;
                    window.location.href = link;
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
                    var link = '/pharmacietest/bouwou/geonetliste/magasin/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_magasin.php',
            data: {
                nom: nom,
                code: code,
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/geonetliste/magasinadd/' + id;
                    window.location.href = link;
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


function enregistrer_prescripteur(option, id) {
    // Informations université
    var nom = $('#nom').val();
    var structure = $('#structure').val();
    var adresse = $('#adresse').val();
    var telephone = $('#telephone').val();

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_prescripteur.php',
            data: {
                Nom: nom,
                Structure: structure,
                Adresse: adresse,
                Telephone: telephone
            },
            success: function (data) {

                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/prescripteur/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_prescripteur.php',
            data: {
                Nom: nom,
                Structure: structure,
                Adresse: adresse,
                Telephone: telephone,
                id: id
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/catalogue/prescripteuradd/' + id;
                    window.location.href = link;
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
                    var link = '/pharmacietest/bouwou/geonetliste/ville/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_ville.php',
            data: {
                nom: nom,
                code: code
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/geonetliste/villeadd/' + id;
                    window.location.href = link;
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
                    var link = '/pharmacietest/bouwou/geonetliste/unite/';
                    window.location.href = link;
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
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_unite.php',
            data: {
                nom: nom,
                libelle: libelle,
                id: id
            },
            success: function (data) {
                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/geonetliste/uniteadd/' + id;
                    window.location.href = link;
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
                    var link = '/pharmacietest/bouwou/geonetliste/rayon/';
                    window.location.href = link;
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

                //alert(data.erreur);
                if (data == 'ok') {
                    var link = '/pharmacietest/bouwou/geonetliste/rayonadd/' + id;
                    window.location.href = link;
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


// FIN

function enregistrer_utilisateur(option, id) {
    // Informations utilisateur
    //e.preventDefault();
    var nom = $('#noms').val();
    var prenom = $('#prenoms').val();
    var identifiant = $('#identifiant').val();
    var password = $('#password').val();
    //alert(password);
    var daten = $('#dp-3').val();
    var statut = $('#statut option:selected').text();
    var fonction = $('#fonction').val();
    var photo_profil = $('#photo_profil').val();
    if (photo_profil == '') {
        photo_profil = 'no-image.jpg';
    }
    var file_data = $("#photo_profil").prop("files")[0];
    var form_data = new FormData();
    form_data.append("file", file_data);
    alert(form_data);

    // Informations contact
    var bp = $('#bp').val();
    var email = $('#email').val();
    var telephone_1 = $('#telephone_1').val();
    var telephone_2 = $('#telephone_2').val();
    var site = $('#site').val();
    //alert("passe");

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/Site/koudjine/inc/enregistrer_utilisateur.php',
            data: {
                nom: nom,
                prenom: prenom,
                identifiant: identifiant,
                password: password,
                daten: daten,
                statut: statut,
                fonction: fonction,
                photo_profil: photo_profil,
                bp: bp,
                telephone_1: telephone_1,
                telephone_2: telephone_2,
                email: email,
                site: site,
                option: option
            },
            success: function (data) {
                if (data == 'ok') {
                    var link = '/Site/bouwou/users';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 3000);
                }
            }
        });
    }
    else if (option == 'Modifier') {
        //alert('test2');
        $.ajax({
            type: "POST",
            url: '/Site/koudjine/inc/enregistrer_utilisateur.php',
            data: {
                nom: nom,
                prenom: prenom,
                identifiant: identifiant,
                password: null,
                daten: daten,
                statut: statut,
                fonction: fonction,
                photo_profil: photo_profil,
                bp: bp,
                telephone_1: telephone_1,
                telephone_2: telephone_2,
                email: email,
                site: site,
                option: option,
                id: id
            },
            success: function (data) {
                if (data == 'ok') {
                    var link = '/Site/bouwou/users';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 3000);

                }
            }
        });
    }
    else {
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/Site/koudjine/inc/enregistrer_utilisateur.php',
            contentType: false, // obligatoire pour de l'upload
            processData: false, // obligatoire pour de l'upload
            //dataType: 'json',
            data: {
                nom: nom,
                prenom: prenom,
                identifiant: identifiant,
                password: password,
                daten: daten,
                statut: null,
                fonction: fonction,
                photo_profil: photo_profil,
                bp: bp,
                telephone_1: telephone_1,
                telephone_2: telephone_2,
                email: email,
                site: site,
                option: option,
                id: id,
                data: form_data
            },
            success: function (data) {
                if (data == 'ok') {
                    var link = '/Site/bouwou/users';
                    window.location.href = link;
                }
                else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 3000);

                }
            }
        });
    }

}

function afterSuccess() {
    $('#submit-btn').show(); //hide submit button
    $('#loading-img').hide(); //hide submit button

}

//function to check file size before uploading.
function beforeSubmit() {

    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob) {

        if (!$('#img_presentation').val() || !$('#logo').val()) //check empty input filed
        {
            /*$("#output").html("Are you kidding me?");
            $('.alert').removeClass('hidden');
            return false*/
        }

        if ($('#img_presentation').val()) {
            var fsize = $('#img_presentation')[0].files[0].size; //get file size
            var ftype = $('#img_presentation')[0].files[0].type; // get file type


            //allow only valid image file types
            switch (ftype) {
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/jpg':
                    break;
                default:
                    $("#output").html("<b>" + ftype + "</b> Unsupported file type!");
                    $('.alert').removeClass('hidden');
                    return false
            }

            //Allowed file size is less than 2 MB (1048576*2)
            if (fsize > (1048576 * 2)) {
                $("#output").html("<b>" + bytesToSize(fsize) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
                $('.alert').removeClass('hidden');
                return false
            }

        }
        if ($('#logo').val()) {
            var fsize2 = $('#logo')[0].files[0].size; //get file size
            var ftype2 = $('#logo')[0].files[0].type; // get file type


            //allow only valid image file types
            switch (ftype2) {
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/jpg':
                    break;
                default:
                    $("#output").html("<b>" + ftype2 + "</b> Unsupported file type!");
                    $('.alert').removeClass('hidden');
                    return false
            }

            //Allowed file size is less than 2 MB (1048576*2)
            if (fsize2 > (1048576 * 2)) {
                $("#output").html("<b>" + bytesToSize(fsize2) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
                $('.alert').removeClass('hidden');
                return false
            }


        }

        $('#submit-btn').hide(); //hide submit button
        $('#loading-img').show(); //hide submit button
        $("#output").html("");
        $('.alert').removeClass('hidden');


    }
    else {
        //Output error to older browsers that do not support HTML5 File API
        $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
        $('.alert').removeClass('hidden');
        return false;
    }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return '0 Bytes';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
function fileBrowser(field_name, url, type, win) {
    tinyMCE.activeEditor.windowManager.open({
        file: 'http://google.cm',
        title: 'Gallerie',
        width: 420,
        height: 400,
        resizable: 'yes',
        inline: 'no',
        close_previous: 'no'
    }, {
        window: win,
        input: field_name
    });
    return false;
}

