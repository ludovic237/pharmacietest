$(document).ready(function(){
    //$("#div_inventaire").hide();
    $("#tab_BCrecherche").hide();
    $("#tab_GCrecherche").hide();
    $(".btn-modifier").hide();


});
function charger_produit_commande(id) {

}
function change_input(option, id) {
    if(option == 'plus'){
        $("#"+id).val(parseInt($("#"+id).val())+1);
    }
    else {
        if(parseInt($("#"+id).val()) != 0)
            $("#"+id).val(parseInt($("#"+id).val())-1);
    }
}



