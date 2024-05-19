$(document).ready(function(){
    $("#tab_Grecherche_grossiste").hide();

    $("#recherche_grossiste").keyup(function (event) {

        var recherche = $(this).val();
        recherche = $.trim(recherche);
        var data = 'motclef1=' + recherche;
        if (recherche.length > 1) {
            //alert('yes');
            $.ajax({
                type: "GET",
                url: "/pharmacietest/koudjine/inc/result_produit_grossiste.php",
                data: data,
                success: function (server_responce) {
                    $("#tab_Grecherche_grossiste").show();
                    $("#tab_Brecherche_grossiste").html(server_responce).show();
                    ////alert(server_responce);
                }
            })
        } else {
            $("#tab_Grecherche_grossiste").hide();
        }

    });

    /*$(".load_grossiste").on("click",function(e){
        e.preventDefault();
        alert('yes')
        var table1 = $('#add_grossiste').DataTable();
        var id = $(this).attr("data-id");
        var nom = $(this).attr("data-nom");
        var contenu = $(this).attr("data-contenu");

        table1.row
            .add([nom,contenu,''
            + '<button class="btn btn-default btn-rounded btn-sm" onClick="update_row_produit(' + id + ');"><span class="fa fa-pencil"></span></button>'
            + '<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row(' + id + ');"><span class="fa fa-times"></span></button>'
            ]).node().id = id;
        table1.draw( false );
        $("#tab_Grecherche_grossiste").hide();
        $("#recherche_grossiste").val('');

    });*/


});

function update_row_produit(id, e) {
    e.preventDefault();
    var link = '/pharmacietest/bouwou/catalogue/produitadd/' + id;
    //alert(link);
    window.location.href = link;
}
function delete_row(row, e){
    e.preventDefault();
    var box = $("#mb-remove-row");
    box.addClass("open");

    box.find(".mb-control-yes").on("click",function(){
        box.removeClass("open");
        $("#"+row).hide("slow",function(){
            $(this).remove();
        });
    });

}

function load_grossiste(id, nom, contenu, e) {
    e.preventDefault();
    var table1 = $('#add_grossiste').DataTable();

    table1.row
        .add([nom,contenu,''
        + '<button class="btn btn-default btn-rounded btn-sm" onClick="update_row_produit(' + id + ', event);"><span class="fa fa-pencil"></span></button>'
        + '<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row(' + id + ', event);"><span class="fa fa-times"></span></button>'
        ]).node().id = id;
        table1.draw( false );
    $("#tab_Grecherche_grossiste").hide();
    $("#recherche_grossiste").val('');

}

function enregistrer_produit_detail(option, id) {
    // Informations produit
    var nom = $('#nom').val();
    var reference = $('#reference').val();
    ////alert(type);
    var stock = $('#stock').val();
    var prix = parseInt($('#prix_detail').val());
    var stockmin = $('#stockmin').val();
    var stockmax = $('#stockmax').val();
    var reduction = $('#reduction').val();

    var list_grossiste = '';
    console.log(list_grossiste);
    var index = 0;
    $('#tab_grossiste  tr').each(function (i) {
        var id1 = $(this).attr("id");
        list_grossiste = list_grossiste + "" + id1 + "-";
        /*if (index == 0) {
            list_grossiste = list_grossiste + "" + id1;
        } else {
            list_grossiste = list_grossiste + "" + id1 + "-";
        }*/
        index++;
    });
    console.log(list_grossiste);
    prod = list_grossiste.slice(0,-1);

    if (option == 'Ajouter') {
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_produit_detail.php',
            data: {
                nom: nom,
                prix: prix,
                reference: reference,
                stock: stock,
                stockmin: stockmin,
                stockmax: stockmax,
                reduction: reduction,
                parrain: prod
            },
            success: function (data) {

                if (data == 'ok') {
                    noty({text: 'Ajout effectué', layout: 'topRight', type: 'success'});
                    setTimeout(() => {
                        var link = '/pharmacietest/bouwou/catalogue/produitadddetail';
                        window.location.href = link;
                    }, 5000);

                } else {
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function () {
                        $("#message-box-danger").modal("hide");
                    }, 13000);
                }
            }
        });
    } else {

        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_produit_detail.php',
            data: {
                nom: nom,
                prix: prix,
                reference: reference,
                stock: stock,
                stockmin: stockmin,
                stockmax: stockmax,
                reduction: reduction,
                parrain: prod,
                id: id
            },
            success: function (data) {
                ////alert(data.erreur);

                if (data == 'ok') {
                    noty({text: 'Modification effectué', layout: 'topRight', type: 'success'});
                    setTimeout(() => {
                        //var link = '/pharmacietest/bouwou/catalogue/produitadd/' + id;
                        var link = '/pharmacietest/bouwou/catalogue/produitadddetail';
                        window.location.href = link;
                    }, 5000);
                } else {
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