//forms
;(function($){
    $.fn.forms=function(o){
        return this.each(function(){
            var th=$(this)
                ,_=th.data('forms')||{
                        errorCl:'error',
                        emptyCl:'empty',
                        invalidCl:'invalid',
                        notRequiredCl:'notRequired',
                        successCl:'success',
                        successShow:'4000',
                        mailHandlerURL:'/pharmacietest/koudjine/inc/magasin.php',
                        ownerEmail:'support@template-help.com',
                        stripHTML:true,
                        smtpMailServer:'localhost',
                        targets:'input,textarea',
                        controls:'a[data-type=reset],a[data-type=submit]',
                        validate:true,
                        rx:{
                            //".name":{rx:/^[a-zA-Zéèçàêâôù()'][a-zA-Z-éèçàâôêù()' ]+[a-zA-Zéèçàâôêù']?$/,target:'input'}
                            //".sigle":{rx:/^[a-zA-Z'][a-zA-Z-' ]+[a-zA-Z']?$/,target:'input'}
                            //".email":{rx:/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i,target:'input'},
                            //".phone":{rx:/^\+?(\d[\d\-\+\(\) ]{5,}\d$)/,target:'input'},
                            //".fax":{rx:/^\+?(\d[\d\-\+\(\) ]{5,}\d$)/,target:'input'},
                            //".message":{rx:/.{5}/,target:'textarea'}
                        },
                        preFu:function(){
                            _.labels.each(function(){
                                var label=$(this),
                                    inp=$(_.targets,this),
                                    
                                    defVal=inp.val(),
                                    trueVal=(function(){
                                        
                                        var tmp=inp.is('input')?(tmp=label.html().match(/value=['"](.+?)['"].+/),!!tmp&&!!tmp[1]&&tmp[1]):inp.html()
                                        return defVal==''?defVal:tmp
                                    })()
                                trueVal!=defVal
                                &&inp.val(defVal=trueVal||defVal)
                                label.data({defVal:defVal})
                                inp
                                    .bind('focus',function(){
                                        inp.val()==defVal
                                        &&(inp.val(''),_.hideEmptyFu(label),label.removeClass(_.invalidCl))
                                    })
                                    .bind('blur',function(){
                                        _.validateFu(label)
                                        if(_.isEmpty(label))
                                            inp.val(defVal)
                                                ,_.hideErrorFu(label.removeClass(_.invalidCl))
                                    })
                                    .bind('keyup',function(){
                                        label.hasClass(_.invalidCl)
                                        &&_.validateFu(label)
                                    })
                                label.find('.'+_.errorCl+',.'+_.emptyCl).css({display:'block'}).hide()
                            })
                            _.success=$('.'+_.successCl,_.form).hide()
                        },
                        isRequired:function(el){
                            return !el.hasClass(_.notRequiredCl)
                        },
                        isValid:function(el){
                            var ret=true
                            $.each(_.rx,function(k,d){
                                if(el.is(k))
                                    ret=d.rx.test(el.find(d.target).val())
                            })
                            return ret
                        },
                        isEmpty:function(el){
                            var tmp
                            return (tmp=el.find(_.targets).val())==''||tmp==el.data('defVal')
                        },
                        validateFu:function(el){
                            el.each(function(){
                                var th=$(this)
                                    ,req=_.isRequired(th)
                                    ,empty=_.isEmpty(th)
                                    ,valid=_.isValid(th)

                                if(empty&&req)
                                    _.showEmptyFu(th.addClass(_.invalidCl))
                                else
                                    _.hideEmptyFu(th.removeClass(_.invalidCl))

                                if(!empty)
                                    if(valid)
                                        _.hideErrorFu(th.removeClass(_.invalidCl))
                                    else
                                        _.showErrorFu(th.addClass(_.invalidCl))
                            })
                        },
                        getValFromLabel:function(label){
                            var val=$('input,textarea',label).val()
                                ,defVal=label.data('defVal')
                            return label.length?val==defVal?'':val:''
                        }
                        ,submitFu:function() {
                            
                            _.validateFu(_.labels)
                            if (!_.form.has('.' + _.invalidCl).length) {

                                var code = _.getValFromLabel($('.code', _.form));
                                var nom = _.getValFromLabel($('.name', _.form));
                                if($('.button').html() == "Ajouter"){
                                    //alert('passB')
                                    //alert(certif);
                                    //var lien = $('#srch_universite').val();

                                    $.ajax({
                                        type: "POST",
                                        url:_.mailHandlerURL,
                                        data:{
                                            nom:nom,
                                            code:code
                                            //dept_id:iddef
                                        },
                                        dataType:'json',
                                        success: function(data) {
                                            noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                                                if (data.erreur == 'non') {
                                                    var cat = '<tr id="' + data.id + '">'
                                                        + ' <td><strong>' + nom + '</strong></td>'
                                                        + '<td>' + code + '</td>'
                                                        + '<td>'
                                                        + '<button class="btn btn-default btn-rounded btn-sm" onClick="update_row_magasin(' + data.id + ');"><span class="fa fa-pencil"></span></button>'
                                                        + '<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row(' + data.id + ');"><span class="fa fa-times"></span></button>'
                                                        + '</td>'
                                                        + '</tr>';


                                                    $('#tableau_magasin').prepend(cat);
                                                }
                                                else{
                                                    $('#message-box-danger p').html(data.erreur);
                                                    $("#message-box-danger").modal("show");
                                                    setTimeout(function(){
                                                        $("#message-box-danger").modal("hide");
                                                    },3000);
                                                }

                                        }
                                    })

                                    _.form.trigger('reset')

                                    /*$.ajax({
                                     cat: "POST",
                                     url:_.mailHandlerURL,
                                     data:{
                                     nom:nom,
                                     sigle: sigle,
                                     code:code,
                                     univ_id:lien
                                     },
                                     success: function(data){
                                     //alert(lien);
                                     //alert(data);
                                     var faculte = '<tr id="'+lien+'">'
                                     + ' <td><strong>' + nom + '</strong></td>'
                                     + '<td>' + sigle + '</td>'
                                     + '<td>' + code + '</td>'
                                     + '<td>'
                                     + '<button class="btn btn-default btn-rounded btn-sm" onClick="update_row('+lien+');"><span class="fa fa-pencil"></span></button>'
                                     + '<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('+lien+');"><span class="fa fa-times"></span></button>'
                                     +'<button class="btn btn-info btn-rounded btn-sm" onClick="filiere_row('+lien+');">Filières</button>'
                                     + '</td>'
                                     + '</tr>';


                                     $('#tableau').prepend(faculte);
                                     }
                                     })



                                     /*$.ajax({
                                     cat: "POST",
                                     url:_.mailHandlerURL,
                                     data:{
                                     nom:_.getValFromLabel($('.name',_.form)),
                                     email:_.getValFromLabel($('.email',_.form)),
                                     responsable: _.getValFromLabel($('.responsable',_.form)),
                                     sigle: _.getValFromLabel($('.sigle',_.form)),
                                     code: _.getValFromLabel($('.code',_.form))
                                     },
                                     success: function(data){
                                     var faculte = JQuery('<tr id="trow_1">'
                                     +' <td><strong>Faculté des Sciences</strong></td>'
                                     +'<td><span class="">FS</span></td>'
                                     +'<td>bouwou02@yahoo.fr</td>'
                                     +'<td>Les catégories, contrairement aux étiquettes, peuvent avoir une hiérarchie. Vous pouvez avoir une catégorie nommée Jazz, et à l’intérieur, plusieurs catégories comme Bebop et Big Band. Ceci est totalement facultatif.</td>'
                                     +'<td>'
                                     +'<button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>'
                                     +'<button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row(\'trow_1\');"><span class="fa fa-times"></span></button>'
                                     +'</td>'
                                     +'</tr>');


                                     $('#tableau').prepend(faculte);
                                     }
                                     })*/

                                }
                                else{
                                    var lien = $('.button').attr('href');
                                    //alert("id : "+lien);
                                    $.ajax({
                                        type: "POST",
                                        url:_.mailHandlerURL,
                                        data:{
                                            nom:_.getValFromLabel($('.name',_.form)),
                                            code: _.getValFromLabel($('.code',_.form)),
                                            id:lien
                                        },
                                        dataType:'json',
                                        success: function(data){
                                            noty({ text: 'Information enregistré', layout: 'topRight', type: 'success' });
                                            if(data.erreur == 'non' ){
                                                $("#"+lien+" td").each(function(i){
                                                    //alert(i);
                                                    if(i==0) {$(this).children().html(nom);}
                                                    if(i==1)  $(this).html(code);

                                                });
                                                $('.button').html('Ajouter');
                                                $('.titre').html('Ajouter un nouveau magasin');
                                                $("#"+lien+" td").addClass('alt');
                                                _.form.trigger('reset')
                                                setTimeout(function(){
                                                    $("#"+lien+" td").removeClass('alt');
                                                },3000);
                                            }
                                            else{
                                                $('#message-box-danger p').html(data.erreur);
                                                $("#message-box-danger").modal("show");
                                                setTimeout(function(){
                                                    $("#message-box-danger").modal("hide");
                                                },3000);
                                                $('.button').html('Ajouter');
                                                $('.titre').html('Ajouter une nouvelle catégorie');
                                                $("#"+lien+" td").addClass('alt');
                                                _.form.trigger('reset')
                                                setTimeout(function(){
                                                    $("#"+lien+" td").removeClass('alt');
                                                },3000);
                                            }
                                        }
                                    })


                                }
                            }

                        },
                        showFu:function(){
                            _.success.slideDown(function(){
                                setTimeout(function(){
                                    //_.success.slideUp()
                                    _.form.trigger('reset')
                                },_.successShow)
                            })
                        },
                        controlsFu:function(){
                            $(_.controls,_.form).each(function(){
                                var th=$(this)
                                th
                                    .bind('click',function(){
                                        _.form.trigger(th.data('type'))
                                        return false
                                    })
                            })
                        },
                        showErrorFu:function(label){
                            label.find('.'+_.errorCl).slideDown()
                        },
                        hideErrorFu:function(label){
                            label.find('.'+_.errorCl).slideUp()
                        },
                        showEmptyFu:function(label){
                            label.find('.'+_.emptyCl).slideDown()
                            _.hideErrorFu(label)
                        },
                        hideEmptyFu:function(label){
                            label.find('.'+_.emptyCl).slideUp()
                        },
                        init:function(){
                            _.form=_.me
                            _.labels=$('label',_.form)

                            _.preFu()

                            _.controlsFu()

                            _.form
                                .bind('submit',function(){
                                    if(_.validate)
                                        _.submitFu()
                                    else
                                        _.form[0].submit()
                                    return false
                                })
                                .bind('reset',function(){
                                    _.labels.removeClass(_.invalidCl)
                                    _.labels.each(function(){
                                        var th=$(this)
                                        _.hideErrorFu(th)
                                        _.hideEmptyFu(th)
                                    })
                                })
                            _.form.trigger('reset')
                        }
                    }
            _.me||_.init(_.me=th.data({forms:_}))
            typeof o=='object'
            &&$.extend(_,o)
        })
    }
})(jQuery)