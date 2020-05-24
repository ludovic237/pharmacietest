$(document).ready(function(){
    
    // click outside spy
    $("html").on("click",function(){
        $(".search").removeClass("active");
    });// end click outside spy
    
    // toggle search 
    $(".search .search-button").on("click",function(e){        
        $(this).parent(".search").toggleClass("active");
        e.stopPropagation();
        
    });
    $(".search .search-container").on("click",function(e){
        alert("test");
        e.stopPropagation();
    });// end toggle search

    // MixItUp
    if($(".mix-grid").length > 0)
        $(".mix-grid").mixItUp();  
    // end MixItUp
    
    // animate on scroll
    $(".this-animate").each(function(){
        $(this).appear(function(){
            $(this).addClass("animated").addClass($(this).data("animate")).addClass("this-animated");            
        });        
    });
    // end animate on scroll
    /* DATATABLES/CONTENT HEIGHT FIX */
    $(".dataTables_length select").on("change",function(){
        onresize();
    });
    /* END DATATABLES/CONTENT HEIGHT FIX */
    /* ACCORDION */
    $(".accordion .panel-title a").on("click",function(){

        var blockOpen = $(this).attr("href");
        var accordion = $(this).parents(".accordion");
        var noCollapse = accordion.hasClass("accordion-dc");


        if($(blockOpen).length > 0){

            if($(blockOpen).hasClass("panel-body-open")){
                $(blockOpen).slideUp(200,function(){
                    $(this).removeClass("panel-body-open");
                });
            }else{
                $(blockOpen).slideDown(200,function(){
                    $(this).addClass("panel-body-open");
                });
            }

            if(!noCollapse){
                accordion.find(".panel-body-open").not(blockOpen).slideUp(200,function(){
                    $(this).removeClass("panel-body-open");
                });
            }

            return false;
        }

    });
    /* EOF ACCORDION */
    
});

$(function(){    
    onPageResize();
    navController();    
});

$(window).scroll(function(){    
    if($(window).scrollTop() > 40){
        $(".page-container").addClass("page-header-fixed");
        
        if($(window).scrollTop() < 40)
            $(".page-container .page-content").css("padding-top",$(window).scrollTop());
    }else{
        $(".page-container").removeClass("page-header-fixed");    
        $(".page-container .page-content").css("padding-top","");
    }
});

$(window).resize(function(){
    onPageResize();
});

// on page resize actions
function onPageResize(){
    
    var pageWidth = window.innerWidth || $(document).width();
    
    if(pageWidth <= 1100)
        $(".page-header .navigation").addClass("navigation-mobile");
    else
        $(".page-header .navigation").removeClass("navigation-mobile,active").find("li").removeClass("open");
    
}// end on page resize actions

// navigation controller 
function navController(){
    
    // toggle navigation
    $(".navigation-toggle-button").on("click",function(){
        $(".page-header .navigation").toggleClass("active");
    });// end toggle navigation
    
    $(".page-header-holder").on("click",".navigation-mobile li > a",function(e){
        
        var li = $(this).parent("li");
        
        if(li.children("ul").length > 0){            
            li.toggleClass("open");
        }
        
    });    
    
}// end navigation controller 
function onresize(timeout){    
    timeout = timeout ? timeout : 200;

    setTimeout(function(){
        page_content_onresize();
        $('tr').click(function(){
			
			var id = this.id;
			//var dep =  $('#'+id).attr("alt");
			var filiere =  $(this).attr("rel");
			//alert(id+' '+filiere);
			 var link = 'universite/presentation.php?univ_id='+id+'&filiere='+filiere+'#'+filiere;
             window.location.href=link;
			//alert(id);
			});
    },timeout);
}
/* EOF PAGE ON RESIZE WITH TIMEOUT */
function page_content_onresize(){
    $(".page-content,.content-frame-body,.content-frame-right,.content-frame-left").css("width","").css("height","");
    
    var content_minus = 0;
    content_minus = ($(".page-container-boxed").length > 0) ? 40 : content_minus;
    content_minus += ($(".page-navigation-top-fixed").length > 0) ? 50 : 0;
    
    var content = $(".page-content");
    var sidebar = $(".page-sidebar");
    
    if(content.height() < $(document).height() - content_minus){        
        content.height($(document).height() - content_minus);
    }        
    
    if(sidebar.height() > content.height()){        
        content.height(sidebar.height());
    }
    
    if($(window).width() > 1024){
        
        if($(".page-sidebar").hasClass("scroll")){
            if($("body").hasClass("page-container-boxed")){
                var doc_height = $(document).height() - 40;
            }else{
                var doc_height = $(window).height();
            }
           $(".page-sidebar").height(doc_height);
           
       }
       
        if($(".content-frame-body").height() < $(document).height()-162){
            $(".content-frame-body,.content-frame-right,.content-frame-left").height($(document).height()-162);            
        }else{
            $(".content-frame-right,.content-frame-left").height($(".content-frame-body").height());
        }
        
        $(".content-frame-left").show();
        $(".content-frame-right").show();
    }else{
        $(".content-frame-body").height($(".content-frame").height()-80);
        
        if($(".page-sidebar").hasClass("scroll"))
           $(".page-sidebar").css("height","");
    }
    
    if($(window).width() < 1200){
        if($("body").hasClass("page-container-boxed")){
            $("body").removeClass("page-container-boxed").data("boxed","1");
        }
    }else{
        if($("body").data("boxed") === "1"){
            $("body").addClass("page-container-boxed").data("boxed","");
        }
    }
}