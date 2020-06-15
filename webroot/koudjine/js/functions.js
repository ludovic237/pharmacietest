$(document).ready(function(){ 	// le document est charg鍊   $("a").click(function(){ 	// on selectionne tous les liens et on d?nit une action quand on clique dessus


});
  // Ajax
// Fonctions PHARMACIE

function enregistrer_produit(option,id){
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

    if(option == 'Ajouter'){
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

                if(data == 'ok'){
                    var link = '/pharmacietest/bouwou/catalogue/produit/';
                    window.location.href=link;
                }
                else{
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function(){
                        $("#message-box-danger").modal("hide");
                    },93000);
                }
            }
        });
    }
    else{
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
                if(data == 'ok'){
                    var link = '/pharmacietest/bouwou/catalogue/produitadd/'+id;
                    window.location.href=link;
                }
                else{
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function(){
                        $("#message-box-danger").modal("hide");
                    },93000);

                }
            }
        });
    }

}


function enregistrer_categorie(option,id){

    var nom = $('#nom').val();

    if(option == 'Ajouter'){
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_categorie.php',
            data: {
                nom: nom,
            },
            success: function (data) {

                if(data == 'ok'){
                    var link = '/pharmacietest/bouwou/catalogue/produit/';
                    window.location.href=link;
                }
                else{
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function(){
                        $("#message-box-danger").modal("hide");
                    },93000);
                }
            }
        });
    }
    else{
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/pharmacietest/koudjine/inc/enregistrer_produit.php',
            data: {
                nom: nom,
                id: id
            },
            success: function (data) {
                //alert(data.erreur);
                if(data == 'ok'){
                    var link = '/pharmacietest/bouwou/catalogue/produitadd/'+id;
                    window.location.href=link;
                }
                else{
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function(){
                        $("#message-box-danger").modal("hide");
                    },93000);

                }
            }
        });
    }

}

// FIN





  
  function enregistrer_universite(option,id){
      // Informations université
	 var nom = $('#nom').val();
      var nom_complet = $('#nom_complet').val();
      var ville = $('#ville').val();
      var region = $('#region').val();
      var statut = $('#statut option:selected').text();
      var type = $('#type').val();
      //alert(type);
      var responsable = $('#responsable').val();
      //var logo = $('#logo').val();
      var certif = $('#certif option:selected').text();
      /*var parrain = null;
      if( $('input[name=tutelle]').is(':checked') ){
          //alert('pass');
          var parrain = $('#universite').val();
      }*/

      // Informations contact
      var bp = $('#bp').val();
      var email = $('#email').val();
      var telephone_1 = $('#telephone_1').val();
      var telephone_2 = $('#telephone_2').val();
      var site = $('#site').val();
      //alert("passe");

      if(option == 'Ajouter'){
      $.ajax({
          type: "POST",
          url: '/Site/koudjine/inc/enregistrer_universite.php',
          data: {
              nom: nom,
              nom_complet: nom_complet,
              ville: ville,
              region: region,
              statut: statut,
              type: type,
              responsable: responsable,
              certif: certif,
              option: option,
              bp: bp,
              telephone_1: telephone_1,
              telephone_2: telephone_2,
              email: email,
              site: site
          },
          dataType: 'json',
          success: function (data) {

              if(data.erreur == 'non'){
                  var link = '/Site/bouwou/universites/presentation/'+data.id;
                  window.location.href=link;
              }
              else{
                  $('#message-box-danger p').html(data.erreur);
                  $("#message-box-danger").modal("show");
                  setTimeout(function(){
                      $("#message-box-danger").modal("hide");
                  },3000);
              }
          }
      });
      }
      else{
          //alert('test');
          $.ajax({
              type: "POST",
              url: '/Site/koudjine/inc/enregistrer_universite.php',
              data: {
                  nom: nom,
                  nom_complet: nom_complet,
                  ville: ville,
                  region: region,
                  statut: statut,
                  type: type,
                  responsable: responsable,
                  certif: certif,
                  option: option,
                  bp: bp,
                  telephone_1: telephone_1,
                  telephone_2: telephone_2,
                  email: email,
                  site: site,
                  id: id
              },
              dataType: 'json',
              success: function (data) {
                  //alert(data.erreur);
                  if(data.erreur == 'non'){
                      var link = '/Site/bouwou/universites/presentation/'+id;
                      window.location.href=link;
                  }
                  else{
                      $('#message-box-danger p').html(data.erreur);
                      $("#message-box-danger").modal("show");
                      setTimeout(function(){
                          $("#message-box-danger").modal("hide");
                      },3000);

                  }
              }
          });
      }

}

function enregistrer_filiere(option,id){
    // Informations filiere
    var nom = $('#nom').val();
    var sigle = $('#sigle').val();
    var description = $('#description').val();
    var id_fac = $('#faculte option:selected').val();
    var id_cat = $('#categorie option:selected').val();
    var id_univ = $('#universite option:selected').val();
    var i;
    var niveau='';

    for(i=1;i<=8;i++){
        if($('#srch_niveau-'+i).is(':checked')){
            niveau = niveau+';'+$('#srch_niveau-'+i).val();
        }
    }
    //alert(id_fac);

    if(option == 'Ajouter'){
        $.ajax({
            type: "POST",
            url: '/Site/koudjine/inc/enregistrer_filiere.php',
            data: {
                nom: nom,
                sigle: sigle,
                description: description,
                id_fac: id_fac,
                id_cat: id_cat,
                niveau: niveau
            },
            success: function (data) {
                //alert(data);
                if(data == 'ok'){
                    var link = '/Site/bouwou/formations/index/'+id_univ+'/'+id_fac+'/'+id_cat;
                    window.location.href=link;
                }
                else{
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function(){
                        $("#message-box-danger").modal("hide");
                    },3000);
                }
            }
        });
    }
    else{
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/Site/koudjine/inc/enregistrer_filiere.php',
            data: {
                nom: nom,
                sigle: sigle,
                description: description,
                id_fac: id_fac,
                id_cat: id_cat,
                niveau: niveau,
                id: id
            },
            success: function (data) {
                //alert(data);
                if(data == 'ok'){
                    //alert(data);
                    var link = '/Site/bouwou/formations/index/'+id_univ+'/'+id_fac+'/'+id_cat;
                    window.location.href=link;
                }
                else{
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function(){
                        $("#message-box-danger").modal("hide");
                    },3000);

                }
            }
        });
    }

}
function enregistrer_question(id,type){
    // Informations
    var id_cats='';
    var id_cat;
    var taux='';
    var statut = true;
    var is_taux = true;


    for(i=0;i<=47;i++){
        if($('.check-'+i).is(':checked')){
            //alert(id_cat.isNumeric());
            id_cat = $('.check-'+i).attr('id');
            if($('.'+id_cat).val() == '' ){
                alert('Vérifier que toutes les valeurs des taux qui sont checkés ont une valeur numérique ');
                is_taux = false;
                break;
            }
        }
    }
    if(is_taux){

        if(type =='Categorie'){
            for(i=0;i<=47;i++){
                if($('.check-'+i).is(':checked')){
                    id_cat = $('.check-'+i).attr('id');
                    id_cats = id_cats+';'+id_cat;
                    if($('.'+id_cat).val() != 100){
                        alert('Vérifier que toutes les valeurs des taux soient égal à 100 \n Condition imposée par le type Categorie ');
                        statut = false;
                        break;
                    }
                    taux = taux+';'+$('.'+id_cat).val();
                }
            }
            if(statut){
                $.ajax({
                    type: "POST",
                    url: '/Site/koudjine/inc/question_categorie.php',
                    data: {
                        id: id,
                        id_cats: id_cats,
                        taux: taux
                    },
                    success: function (data) {
                        //alert(data);
                        if(data == 'ok'){
                            var link = '/Site/bouwou/orientation/questions';
                            window.location.href=link;
                        }
                        else{
                            $('#message-box-danger p').html(data);
                            $("#message-box-danger").modal("show");
                            setTimeout(function(){
                                $("#message-box-danger").modal("hide");
                            },3000);
                        }
                    }
                });
            }

        }
        else{
            for(i=0;i<=47;i++){
                if($('.check-'+i).is(':checked')){
                    id_cat = $('.check-'+i).attr('id');
                    id_cats = id_cats+';'+id_cat;
                    taux = taux+';'+$('.'+id_cat).val();
                }
            }
            $.ajax({
                type: "POST",
                url: '/Site/koudjine/inc/question_categorie.php',
                data: {
                    id: id,
                    id_cats: id_cats,
                    taux: taux
                },
                success: function (data) {
                    //alert(data);
                    if(data == 'ok'){
                        var link = '/Site/bouwou/orientation/questions';
                        window.location.href=link;
                    }
                    else{
                        $('#message-box-danger p').html(data);
                        $("#message-box-danger").modal("show");
                        setTimeout(function(){
                            $("#message-box-danger").modal("hide");
                        },3000);
                    }
                }
            });
        }
    }





}
function enregistrer_concours(option,id){
    // Informations filiere
    var dated = $('#dp-3').val();
    var datef = $('#dp-2').val();
    var datec = $('#dp-4').val();
    var description = $('#description').val();
    var modalite = $('#modalite').val();
    var id_univ = $('#universite option:selected').val();
    var i;
    var composition='';

    for(i=1;i<=10;i++){
        if($('#check_compo-'+i).is(':checked')){
            composition = composition+';'+$('#input_compo-'+i).val();
        }
    }
    //alert('passe');

    if(option == 'Ajouter'){
        $.ajax({
            type: "POST",
            url: '/Site/koudjine/inc/enregistrer_concours.php',
            data: {
                dated: dated,
                datef: datef,
                datec: datec,
                description: description,
                modalite: modalite,
                composition: composition,
                univid: id_univ
            },
            success: function (data) {
                //alert(data);
                if(data == 'ok'){
                    var link = '/Site/bouwou/concours';
                    window.location.href=link;
                }
                else{
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function(){
                        $("#message-box-danger").modal("hide");
                    },3000);
                }
            }
        });
    }
    else{
        //alert('test');
        $.ajax({
            type: "POST",
            url: '/Site/koudjine/inc/enregistrer_concours.php',
            data: {
                dated: dated,
                datef: datef,
                datec: datec,
                description: description,
                modalite: modalite,
                composition: composition,
                univid: id_univ,
                id: id
            },
            success: function (data) {
                //alert(data);
                if(data == 'ok'){
                    //alert(data);
                    var link = '/Site/bouwou/concours';
                    window.location.href=link;
                }
                else{
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function(){
                        $("#message-box-danger").modal("hide");
                    },3000);

                }
            }
        });
    }

}
function enregistrer_utilisateur(option,id){
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
    if(photo_profil == ''){
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

    if(option == 'Ajouter'){
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
                if(data == 'ok'){
                    var link = '/Site/bouwou/users';
                    window.location.href=link;
                }
                else{
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function(){
                        $("#message-box-danger").modal("hide");
                    },3000);
                }
            }
        });
    }
    else if(option == 'Modifier'){
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
                if(data == 'ok'){
                    var link = '/Site/bouwou/users';
                    window.location.href=link;
                }
                else{
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function(){
                        $("#message-box-danger").modal("hide");
                    },3000);

                }
            }
        });
    }
    else{
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
                if(data == 'ok'){
                    var link = '/Site/bouwou/users';
                    window.location.href=link;
                }
                else{
                    $('#message-box-danger p').html(data);
                    $("#message-box-danger").modal("show");
                    setTimeout(function(){
                        $("#message-box-danger").modal("hide");
                    },3000);

                }
            }
        });
    }

}

function afterSuccess()
{
    $('#submit-btn').show(); //hide submit button
    $('#loading-img').hide(); //hide submit button

}

//function to check file size before uploading.
function beforeSubmit(){

    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob)
    {

        if( !$('#img_presentation').val() || !$('#logo').val()) //check empty input filed
        {
            /*$("#output").html("Are you kidding me?");
            $('.alert').removeClass('hidden');
            return false*/
        }

         if($('#img_presentation').val()){
            var fsize = $('#img_presentation')[0].files[0].size; //get file size
            var ftype = $('#img_presentation')[0].files[0].type; // get file type


            //allow only valid image file types
            switch(ftype)
            {
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/jpg':
                break;
                default:
                    $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
                    $('.alert').removeClass('hidden');
                    return false
            }

            //Allowed file size is less than 2 MB (1048576*2)
            if(fsize>(1048576*2))
            {
                $("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
                $('.alert').removeClass('hidden');
                return false
            }

        }
         if($('#logo').val()){
            var fsize2 = $('#logo')[0].files[0].size; //get file size
            var ftype2 = $('#logo')[0].files[0].type; // get file type


            //allow only valid image file types
            switch(ftype2)
            {
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/jpg':
                break;
                default:
                    $("#output").html("<b>"+ftype2+"</b> Unsupported file type!");
                    $('.alert').removeClass('hidden');
                    return false
            }

            //Allowed file size is less than 2 MB (1048576*2)
            if(fsize2>(1048576*2))
            {
                $("#output").html("<b>"+bytesToSize(fsize2) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
                $('.alert').removeClass('hidden');
                return false
            }


        }

        $('#submit-btn').hide(); //hide submit button
        $('#loading-img').show(); //hide submit button
        $("#output").html("");
        $('.alert').removeClass('hidden');


    }
    else
    {
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
function fileBrowser(field_name,url,type,win){
    tinyMCE.activeEditor.windowManager.open({
        file: 'http://google.cm',
        title: 'Gallerie',
        width: 420,
        height: 400,
        resizable: 'yes',
        inline: 'no',
        close_previous: 'no'
    },{
        window : win,
        input : field_name
    });
    return false;
}

