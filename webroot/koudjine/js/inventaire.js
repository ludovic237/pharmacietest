function updateList(targetList, sourceList) {

    console.log("targetList");
    console.log(targetList);
    console.log("sourceList");
    console.log(sourceList);
    targetList.forEach(targetItem => {
        // Recherche dans la liste source un élément avec le même 'nom'
        let matchingItem = sourceList.find(sourceItem => sourceItem.DT_RowId === targetItem.DT_RowId);

        if (matchingItem) {
            // Modifier une propriété (ex: mise à jour de 'quantiteInventaire')
            targetItem.action = "<button disabled class=\"btn btn-success \" data-toggle=\"tooltip\" data-placement=\"top\" ><span class=\"\">Ajouté</span></button>";

            console.log(`Mise à jour: ${targetItem.nom} -> Nouvelle quantité: ${targetItem.quantiteInventaire}`);
        }
    });
    console.log(targetList);
    return targetList;
}
function getTableData() {
    let data = [];

    $("#DataTables_Table_0 tbody tr").each(function () {
        let rowId = $(this).attr("id");
        let columns = $(this).find("td"); // Sélectionne toutes les cellules de la ligne

        if (columns.length < 7) {
            console.warn("Ligne ignorée (pas assez de colonnes) :", this);
            return; // Ignore cette ligne si elle n'a pas assez de colonnes
        }

        let obj = {
            DT_RowId:rowId,
            nom: $(columns[0]).text().trim() || "", // Nom du produit
            prixUnitaire: $(columns[1]).text().trim() || "", // Prix Unitaire
            quantiteAvant: $(columns[2]).text().trim() || "", // Quantité avant inventaire
            quantiteCours: $(columns[3]).text().trim() || "", // Quantité en cours
            dateLivraison: $(columns[4]).text().trim() || "", // Date de livraison
            inventoriePar: $(columns[5]).text().trim() || "", // Inventorié par
            quantiteInventaire: $(columns[6]).find("input").val() ? $(columns[6]).find("input").val().trim() : "", // Quantité inventaire (input)
            action: $(columns[7]).find("button").length ? $(columns[7]).find("button").text().trim() : "" // Texte du bouton
        };

        data.push(obj);
    });
    console.log(data);
    console.log("data");
    return data;
}

function addProductInventaire(recherche, action, data) {
    $('#tab_BIinventaire  tr').each(function (i) {
        var id1 = $(this).attr("id");
        if (id1 == recherche) {
            action = 1;
            if ($("#" + id1 + " .valider_inventaire").attr("disabled") == "disabled") {
                $('#message-box-danger p').html("Ce produit a déjà été inventorié, veuillez contacter l'administrateur pour toute modification !!!");
                $("#message-box-danger").modal("show");
                setTimeout(function () {
                    $("#message-box-danger").modal("hide");
                }, 5000);
            }
        }

    });
    $('#tab_Binventaire  tr').each(function (i) {
        var id1 = $(this).attr("id");
        if (id1 == recherche) {
            action = 1;
            if ($("#" + id1 + " .valider_inventaire").attr("disabled") == "disabled") {
                $('#message-box-danger p').html("Ce produit a déjà été inventorié, veuillez contacter l'administrateur pour toute modification !!!");
                $("#message-box-danger").modal("show");
                setTimeout(function () {
                    $("#message-box-danger").modal("hide");
                }, 5000);
            } else
                $("#" + id1 + " .qte_inventaire").val(parseInt($("#" + id1 + " .qte_inventaire").val()) + 1);
        }

    });
    if (action == 0) {
        var cat = '<tr id="' + recherche + '">'
            + ' <td><strong>' + data.nom + '</strong></td>'
            + '<td>' + data.prix + '</td>'
            + '<td class="qte_restante">' + data.quantiteRestante + '</td>'
            + '<td class="qte_restante">' + data.quantiteRestante + '</td>'
            + '<td>' + data.datel + '</td>'
            + '<td>' + $("#recherche_inventaire").attr("data1") + '</td>'
            + '<td><input class=\'qte_inventaire\' style="width: 50px;" type="number" value=\'1\'></td>'
            + '<td>'
            + '<button class="btn btn-success btn-rounded btn-sm valider_inventaire" onClick="valider_row_inventaire(\'' + recherche + '\');">Valider</span></button>'
            + '</td>'
            + '</tr>';
        $('#tab_Binventaire').prepend(cat);
        if ($("#recherche_inventaire").attr("name") != 'Administrateur') {
            $('.ajouter_inventaire').hide();
        }
    }

    $('#recherche_inventaire').val("");
    $("#div_inventaire").show();
    $('#recherche_inventaire').focus();
}

function addProductInventaireCaractere(id) {
    let row = document.getElementById(id); // Sélectionne la ligne <tr> par son ID

    if (row) {
        let nom = row.querySelector(".nom").childNodes[0].textContent.trim(); // Nom du produit
        let statut = row.querySelector(".badge").textContent.trim(); // Statut (encore valide, périmé, etc.)
        let prix = row.children[1].textContent.trim(); // Prix
        let qteRest1 = row.querySelectorAll(".qterest")[0].textContent.trim(); // Quantité restante 1
        let qteRest2 = row.querySelectorAll(".qterest")[1].textContent.trim(); // Quantité restante 2
        let reduction = row.querySelector(".reduction").textContent.trim(); // Réduction
        let dateLot = row.querySelector(".datel").textContent.trim(); // Date du lot
        let datePeremption = row.querySelector(".datePeremption").textContent.trim(); // Date de péremption

        let productData = {
            id: id,
            nom: nom,
            statut: statut,
            prix: prix,
            quantiteRestante: qteRest1,
            quantiteRestante: qteRest2,
            reduction: reduction,
            datel: dateLot,
            datePeremption: datePeremption
        };
        let bouton = row.querySelector("button");
        if (bouton) {
            bouton.disabled = true;
            bouton.textContent = "Ajouté"; // Change le texte du bouton
        }
        console.log(productData); // Affiche les données dans la console (peut être remplacé par une autre action)
        var cat = '<tr id="' + productData.id + '">'
            + ' <td><strong>' + productData.nom + '</strong></td>'
            + '<td>' + productData.prix + '</td>'
            + '<td class="qte_restante">' + productData.quantiteRestante + '</td>'
            + '<td class="qte_restante">' + productData.quantiteRestante + '</td>'
            + '<td>' + productData.datel + '</td>'
            + '<td>' + $("#recherche_inventaire").attr("data1") + '</td>'
            + '<td><input class=\'qte_inventaire\' style="width: 50px;" type="number" value=\'1\'></td>'
            + '<td>'
            + '<button class="btn btn-success btn-rounded btn-sm valider_inventaire" onClick="valider_row_inventaire(\'' + productData.id + '\');">Valider</span></button>'
            + '</td>'
            + '</tr>';
        $('#tab_Binventaire').prepend(cat);
        getTableData();
    } else {
        console.error("Ligne introuvable pour l'ID :", id);
    }
}
$(document).ready(function(){
    //$("#div_inventaire").hide();
    //mise_a_jour_inventaire();

    $("#recherche_inventaire").keyup(function (event) {
        var recherche = $(this).val(); // Récupère et nettoie la valeur saisie
        var valeur = $(this).val().trim(); // Récupère et nettoie la valeur saisie

        if (event.keyCode == 13) {
            recherche = $.trim(recherche);
            if (recherche.length > 1) {
                $.ajax({
                    type: "GET",
                    url: "/pharmacietest/koudjine/inc/inventaire_result1.php",
                    data: {
                        motclef: $(this).val()
                    },
                    dataType: 'json',
                    error: function (e) {
                        loader(false);
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.erreur == 'non') {
                            var action = 0;
                            $('#tab_BIinventaire  tr').each(function (i) {
                                var id1 = $(this).attr("id");

                                if (id1 == recherche) {
                                    console.log('passe')
                                    action = 1;
                                    //if($("#" + id1 + " .valider_inventaire").attr("disabled") == "disabled"){
                                    $('#message-box-danger p').html("Ce produit a déjà été inventorié, veuillez contacter l'administrateur pour toute modification !!!");
                                    $("#message-box-danger").modal("show");
                                    setTimeout(function () {
                                        $("#message-box-danger").modal("hide");
                                    }, 5000);
                                    //}
                                    $('#recherche_inventaire').val("");
                                    $("#div_inventaire").show();
                                    $('#recherche_inventaire').focus();
                                }

                            });
                            $('#tab_Binventaire  tr').each(function (i) {
                                var id1 = $(this).attr("id");
                                if (id1 == recherche) {
                                    action = 1;
                                    if($("#" + id1 + " .valider_inventaire").attr("disabled") == "disabled"){
                                        $('#message-box-danger p').html("Ce produit a déjà été inventorié, veuillez contacter l'administrateur pour toute modification !!!");
                                        $("#message-box-danger").modal("show");
                                        setTimeout(function () {
                                            $("#message-box-danger").modal("hide");
                                        }, 5000);
                                    }else
                                        $("#" + id1 + " .qte_inventaire").val(parseInt($("#" + id1 + " .qte_inventaire").val() )+ 1);
                                }
                                console.log(action)
                            });
                            if (action == 0) {
                                var cat = '<tr id="' + recherche + '">'
                                    + ' <td><strong>' + data.nom + '</strong></td>'
                                    + '<td>' + data.prix + '</td>'
                                    + '<td class="qte_restante">' + data.quantiteRestante + '</td>'
                                    + '<td class="qte_restante">' + data.quantiteRestante + '</td>'
                                    + '<td>' + data.datel + '</td>'
                                    + '<td>' + $("#recherche_inventaire").attr("data1")+ '</td>'
                                    + '<td><input class=\'qte_inventaire\' style="width: 50px;" type="number" value=\'1\'></td>'
                                    + '<td>'
                                    + '<button class="btn btn-success btn-rounded btn-sm valider_inventaire" onClick="valider_row_inventaire(\'' + recherche + '\',\'valider\');">Valider</span></button>'
                                    + '</td>'
                                    + '</tr>';
                                $('#tab_Binventaire').prepend(cat);
                                if($("#recherche_inventaire").attr("name") != 'Administrateur'){
                                    $('.ajouter_inventaire').hide();
                                }
                                valider_row_inventaire(recherche, 'creer');
                            }

                            $('#recherche_inventaire').val("");
                            $("#div_inventaire").show();
                            $('#recherche_inventaire').focus();

                        }
                        else {
                            $('#message-box-danger p').html(data.erreur);
                            $("#message-box-danger").modal("show");
                            setTimeout(function () {
                                $("#message-box-danger").modal("hide");
                            }, 3000);
                            $('#recherche_inventaire').val("");
                        }


                    }
                })
            }
        } else if (typeof valeur === "string") {
            recherche = $.trim(recherche);
            var data = 'motclef1=' + recherche;
            if (recherche.length > 1) {
                ////alert('yes');
                $.ajax({
                    type: "GET",
                    url: "/pharmacietest/koudjine/inc/inventaire_result.php",
                    data: data,
                    error: function (e) {
                        loader(false);
                    },
                    success: function (server_responce) {
                        $("#tab_Grecherche").show();
                        $("#tab_Brecherche").html(server_responce).show();
                        ////alert(server_responce);
                    }
                })
            } else {
                $("#tab_Grecherche").hide();
            }
        }

    })
});

function load_produit_inventaire(id,type) {
    typeProduitVente = type;
    console.log("type");
    console.log(typeProduitVente);
    var qte = parseInt($("#R" + id + " .qte").val());
    var stock = parseInt($("#R" + id + " .stock").html());
    console.log($(this).attr("data"))
    if (qte > stock) {
        //  alert("Quantité en stock pas suffisante pour cette opération ");
    } else {
        var test = $(this).attr("data");
        if(id < 1000){
            if ($.fn.dataTable.isDataTable('#tab_load_produit')) {
                $('#tab_load_produit').dataTable({
                    destroy: true,
                    // searching: false,
                    // retrieve: true,
                    // "processing": true,
                    // "serverSide": true,
                    //dom: "Bfrtip",
                    ajax: {
                        type: "POST",
                        url: '/pharmacietest/koudjine/inc/load_produit_inventaire.php',
                        data: {
                            id: id,
                            option: 'detail'
                        },
                        dataType: 'json',
                        dataSrc: function (json) {
                            return updateList(json.data,getTableData())
                        },
                    },
                    columns: [
                        {data: "nom"},
                        {data: "prix"},
                        {data: "quantiteRestante"},
                        {data: "quantiteRestante"},
                        {data: "reduction"},
                        {data: "datel"},
                        { data: "peremption" },
                        {data: "action"},
                    ],
                    order:[[6,'asc']]
                });

            } else {
                $('#tab_load_produit').dataTable({
                    destroy: true,
                    // paging: false,
                    // searching: false,
                    // retrieve: true,
                    // "processing": true,
                    // "serverSide": true,
                    //dom: "Bfrtip",
                    ajax: {
                        type: "POST",
                        url: '/pharmacietest/koudjine/inc/load_produit_inventaire.php',
                        data: {
                            id: id,
                            option: 'detail'
                        },
                        dataType: 'json',
                        dataSrc: function (json) {
                            return updateList(json.data,getTableData())
                        },
                    },
                    columns: [
                        {data: "nom"},
                        {data: "prix"},
                        {data: "quantiteRestante"},
                        {data: "quantiteRestante"},
                        {data: "reduction"},
                        {data: "datel"},
                        { data: "peremption" },
                        {data: "action"},
                    ],
                    order:[[6,'asc']]
                });

            }
        }else{
            if ($.fn.dataTable.isDataTable('#tab_load_produit')) {
                $('#tab_load_produit').dataTable({
                    destroy: true,
                    // searching: false,
                    // retrieve: true,
                    // "processing": true,
                    // "serverSide": true,
                    //dom: "Bfrtip",
                    ajax: {
                        type: "POST",
                        url: '/pharmacietest/koudjine/inc/load_produit_inventaire.php',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        dataSrc: function (json) {
                            return updateList(json.data,getTableData())
                        },
                    },
                    columns: [
                        {data: "nom"},
                        {data: "prix"},
                        {data: "quantiteRestante"},
                        {data: "quantiteRestante"},
                        {data: "reduction"},
                        {data: "datel"},
                        { data: "peremption" },
                        {data: "action"},
                    ],
                    order:[[6,'asc']]
                });

            } else {
                $('#tab_load_produit').dataTable({
                    destroy: true,
                    // paging: false,
                    // searching: false,
                    // retrieve: true,
                    // "processing": true,
                    // "serverSide": true,
                    //dom: "Bfrtip",
                    ajax: {
                        type: "POST",
                        url: '/pharmacietest/koudjine/inc/load_produit_inventaire.php',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        dataSrc: function (json) {
                            return updateList(json.data,getTableData())
                        },
                    },
                    columns: [
                        {data: "nom"},
                        {data: "prix"},
                        {data: "quantiteRestante"},
                        {data: "quantiteRestante"},
                        {data: "reduction"},
                        {data: "datel"},
                        { data: "peremption" },
                        {data: "action"},
                    ],
                    order:[[6,'asc']]
                });

            }
        }



        // var icon_preview = $("<i></i>").addClass(iClass);
        $("#iconPreviewVente").modal("show");

    }

}

    function getFormattedDateTime() {
        let now = new Date();
        let year = now.getFullYear();
        let month = String(now.getMonth() + 1).padStart(2, '0'); // Mois de 0 à 11
        let day = String(now.getDate()).padStart(2, '0');
        let hours = String(now.getHours()).padStart(2, '0');
        let minutes = String(now.getMinutes()).padStart(2, '0');
        let seconds = String(now.getSeconds()).padStart(2, '0');

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }




function valider_row_inventaire(id, action) {
    if(action == 'creer'){
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/gerer_produit_inventaire.php',
            data: {
                action: action,
                id: id,
                employe_id: $("#recherche_inventaire").attr("data"),
                qteRestante: parseInt($("#" + id + " .qte_restante").html())
            },
            error: function (e) {
                loader(false);
            },
            success: function (server_responce) {
                //alert(server_responce);
                //$('#' + id + ' .valider_inventaire').attr("disabled", "disabled");
                $('#recherche_inventaire').focus();
            }
        })
    }else if(action == 'valider'){
        let date_fin = getFormattedDateTime();
        console.log(date_fin)
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/gerer_produit_inventaire.php',
            data: {
                action: action,
                id: id,
                qte: $("#" + id + " .qte_inventaire").val(),
                date_fin: date_fin
            },
            error: function (e) {
                loader(false);
            },
            success: function (server_responce) {
                console.log(server_responce);
                $('#' + id + ' .valider_inventaire').attr("disabled", "disabled");
                $('#recherche_inventaire').focus();
            }
        })
    }else{
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/gerer_produit_inventaire.php',
            data: {
                action: action,
                id: id,
                qte: $("#" + id + " .qte_inventaire").val()
            },
            error: function (e) {
                loader(false);
            },
            success: function (server_responce) {
                //alert(server_responce);
                $('#' + id + ' .valider_inventaire').attr("disabled", "disabled");
                $('#recherche_inventaire').focus();
            }
        })
    }
}
function validers_row_inventaire() {
    $('#tab_Binventaire  tr').each(function (i) {
        var id1 = $(this).attr("id");

            if($("#" + id1 + " .valider_inventaire").attr("disabled") != "disabled"){
                valider_row_inventaire(id1,'valider');
                $("#" + id1 ).remove();
            }else{
                $("#" + id1 ).remove();
            }

    });
}

var data_stock_inventaire = [];
function mise_a_jour_inventaire(){
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/update_stock_inventaire.php',
        error: function (e) {
            loader(false);
        },
        dataType: 'json',
        success: function (data) {
            console.log(data)
            data_stock_inventaire = data.data
            $('#rapport_produit_inventaire').dataTable({
                destroy: true,
                searching: true,
                dFilter: true,
                bInfo: true,
                bPaginate: true,
                data: data_stock_inventaire,
                columns: [
                    {data: "nom"},
                    {data: "stock"},
                    {
                        "data": "id", "bSortable": false, "render": function (data, type, row) {
                            return '<button class="btn btn-default btn-rounded btn-sm" onClick="chargement_rayon_produit('+ data + ');"><span class="fa fa-info">Liste Rayon</span></button>';
                        }
                    }
                ]
            });
        }
    })
    /*$('#tab_Binventaire  tr').each(function (i) {


    });*/
}
function charger_prdt_non_inventaire(id){
    console.log('test')
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/charger_produits_non_inv.php',
        data: {
            id: id
        },
        error: function (e) {
            loader(false);
        },
        dataType: 'json',
        success: function (data) {
            console.log(data)
            data_stock_inventaire = data
            $('#tab_NIinventaire').dataTable({
                destroy: true,
                /*searching: true,
                dFilter: true,
                bInfo: true,
                bPaginate: true,*/
                data: data_stock_inventaire,
                columns: [
                    {data: "nom"},
                    {data: "qte"},
                    {data: "id"},
                    {data: "datel"},
                    {
                        "data": "id", "bSortable": false, "render": function (data, type, row) {
                            return '<button class="btn btn-success btn-rounded btn-sm inventorier_inventaire" data-toggle="tooltip" data-placement="top" onclick="inventorier_row_inventaire(\'' +data+ '\')">' +
                                'Maintenir Etat ' +
                                '</button> ' +
                            '<button class="btn btn-primary btn-rounded btn-sm exclure_inventaire" data-toggle="tooltip" data-placement="top" onclick="exclure_row_inventaire(\'' +data+ '\')">' +
                            'Exclure des recherches ' +
                            '</button>';
                        }
                    }
                ]
            });
        }
    })
    /*$('#tab_Binventaire  tr').each(function (i) {


    });*/
}
function chargement_rayon_produit(id) {
    /*$.each(data, function(index, item) {
        console.log("Élément " + index + " :", item);

    });*/
    var data = data_stock_inventaire.find(objet => objet.id == id)
    console.log("data");
    console.log(data);
    if (data){
        $('#tab_load_rayon_inventaire').dataTable({
            destroy: true,
            searching: true,
            dFilter: true,
            bInfo: true,
            bPaginate: true,
            data: data.listeRayon,
            columns: [
                {data: "nom"},
                {data: "qte"},
                {data: "dateL"},
                {data: "dateP"},
                // {
                //     "data": "listeRayon", "bSortable": false, "render": function (data, type, row) {
                //         return '<button class="btn btn-danger btn-rounded btn-sm" onClick="chargement_rayon_produit(\'' + data + '\');"><span class="fa fa-times">Liste Rayon</span></button>';
                //     }
                // }
            ]
        });
        $("#modalRapportInventaire").modal("show");
    }

}
function inventorier_row_inventaire(id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_produit_inventaire.php',
        data: {
            id: id
        },
        error: function (e) {
                loader(false);
            },
            success: function (server_responce) {
            //alert(server_responce);
            $('#' + id + ' .inventorier_inventaire').attr("disabled", "disabled");
            $('#' + id + ' .exclure_inventaire').attr("disabled", "disabled");
            $('#recherche_inventaire').focus();
        }
    })
}
function inventoriers_row_inventaire() {
    $('#tab_BNIinventaire  tr').each(function (i) {
        var id1 = $(this).attr("id");

        if($("#" + id1 + " .inventorier_inventaire").attr("disabled") != "disabled" || $("#" + id1 + " .exclure_inventaire").attr("disabled") != "disabled"){
            inventorier_row_inventaire(id1);
        }

    });
    var link = '/pharmacietest/bouwou/stock/inventaire';
    window.location.href=link;
}
function exclure_row_inventaire(id) {
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/exclure_inventaire.php',
        data: {
            id: id
        },
        error: function (e) {
                loader(false);
            },
            success: function (server_responce) {
            //alert(server_responce);
            $('#' + id + ' .exclure_inventaire').attr("disabled", "disabled");
            $('#' + id + ' .inventorier_inventaire').attr("disabled", "disabled");
            $('#recherche_inventaire').focus();
        }
    })
}
function exclures_row_inventaire() {
    $('#tab_BNIinventaire  tr').each(function (i) {
        var id1 = $(this).attr("id");
        //alert(id1);
        //if(id1 == '')
        if($("#" + id1 + " .exclure_inventaire").attr("disabled") != "disabled"){
            //alert('paasa');
            exclure_row_inventaire(id1);
        }

    });
    var link = '/pharmacietest/bouwou/stock/inventaire';
    window.location.href=link;
}
function ajouter_inventaire(id) {
    $("#quantiteajoute").attr("data", id);
    $("#iconPreviewInventaire").modal("show");
}
function ajouter_row_inventaire() {
    var id = $("#quantiteajoute").attr("data");
    var qte = parseInt($("#quantiteajoute").val());
    $.ajax({
        type: "POST",
        url: '/pharmacietest/koudjine/inc/gerer_produit_inventaire.php',
        data: {
            action: 'ajouter',
            id: id,
            qte: qte
        },
        error: function (e) {
                loader(false);
            },
            success: function (server_responce) {
                console.log(server_responce);
            var val = ''+id;
            //alert($('#'+ id + ' .qteinventaire').html());
            //$('#' + id + ' .valider_inventaire').attr("disabled", "disabled");
            $("#iconPreviewInventaire").modal("hide");
            var link = '/pharmacietest/bouwou/stock/inventaire';
            window.location.href=link;
            //$("#"+id+" .qtevalide").html(parseInt($("#"+id+" .qtevalide").html())+ qte);
        }
    })
}
function charger_inventaire() {
    id= $('#select_inventaire').val();
    var link = '/pharmacietest/bouwou/stock/inventaire/'+id;
    window.location.href=link;
}

function load_type_produit_inventaire() {
    $.ajax({
        type: "GET",
        url: "/pharmacietest/koudjine/inc/gerer_type_produit_inventaire.php",
        dataType: 'json',
        error: function (e) {
            loader(false);
        },
        success: function (data) {
            var datasForme = data.datasForme;
            var datasCategorie = data.datasCategorie;
            var datasRayon = data.datasRayon;
            var datasMagasin = data.$datasMagasin;


            let selectForme = $("#forme_inventaire");
            selectForme.empty();
            selectForme.append('<option value="">Sélectionnez une option</option>');
            $.each(datasForme, function (index, item) {
                selectForme.append(`<option value="${item.id}">${item.nom}</option>`);
            });


            let selectCategorie = $("#categorie_inventaire");
            selectCategorie.empty();
            selectCategorie.append('<option value="">Sélectionnez une option</option>');
            $.each(datasCategorie, function (index, item) {
                selectCategorie.append(`<option value="${item.id}">${item.nom}</option>`);
            });


            let selectRayon = $("#rayon_inventaire");
            selectRayon.empty();
            selectRayon.append('<option value="">Sélectionnez une option</option>');
            $.each(datasRayon, function (index, item) {
                selectRayon.append(`<option value="${item.id}">${item.nom}</option>`);
            });


            let selectMagasin = $("#magasin_inventaire");
            selectMagasin.empty();
            selectMagasin.append('<option value="">Sélectionnez une option</option>');
            $.each(datasMagasin, function (index, item) {
                selectMagasin.append(`<option value="${item.id}">${item.nom}</option>`);
            });
        }
    })

}


