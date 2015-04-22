// Définitions de constantes utilisables dans tout le fichier
MONNAIE="€";



var jusqua=30;
var cmptARebours=jusqua;
var sTime=null;

  //$('.animSiteTop' ).css("visibility", "hidden");
  //$('.animSiteLeft' ).css("visibility", "hidden");

/*5*/
$("*[class*=animSite]").hide();
//$("*[class*=animSite]" ).css("visibility", "hidden");

function animerSite(anim){
  slow=5000;
  normal=3500;
  fast=1500;
  
  
  $(".animSiteFadeInSlow").fadeIn(slow);
  $(".animSiteFadeInNormal").fadeIn(normal);
  $(".animSiteFadeInFast").fadeIn(fast);

  $(".animSiteShowSlow").show(slow);
  $(".animSiteShowNormal").show(normal);
  $(".animSiteShowFast").show(fast);

  $(".animSiteSlideDownSlow").slideDown(slow);
  $(".animSiteSlideDownNormal").slideDown(normal);
  $(".animSiteSlideDownFast").slideDown(fast);

}





$(document).ready(function(){  

    $("#easteregg").hide();

    if (true) {
      animerSite("vas y");
    };

    $('body').click(function(){
      cmptARebours--;
      if (cmptARebours<=0) {
        //alert("cmpt"+cmptARebours);
        $("#easteregg").show('low');
        easterEgg();        
        
      }
    }); 

    $("#easteregg").click(function(){
      cmptARebours=jusqua;
      $("#easteregg").hide();
      clearTimeout(sTime1);
    }); 




  //barre de recherche

  $("#inputTextSearch").keypress(function(e) {

      if(e.which == 13 && $("#inputTextSearch").val()!==""  ) {
        //alert("entré");
        $(location).attr('href',"http://localhost/fourneaux/recette/recherche/"+$("#inputTextSearch").val());
      }
  });

  $('#inputTextSearch').autocomplete({
      source : function(requete, reponse){ // les deux arguments représentent les données nécessaires au plugin
        jsonData = {
          'service'     : 'Recherche',
          'method'      : 'getAutoCompletion',
          'ou'          : 'titre',
          'recherche'   : $('#inputTextSearch').val()
        };

        

        nbrRes=0;
        $.ajax({
                url : urlWebService,
                dataType : 'json',
                data : jsonData,
                type: 'POST',
                
                success : function(donnee){
                    $('#dataListSearch').empty();
                    $.map(donnee.response, function(objet){
                        nbrRes++;
                        $('#dataListSearch').append("<option value='"+objet.titre+"'  onclick='redirigerVers(\"recette\","+objet.id_recette+");'   >"+objet.titre+" </option>");
                    });
                }
        });
      }
      
  });








		if(idUser !== 'rien') actualiserPanier(idUser);



	}
);




function redirigerVers(ouCa, id){
  if (ouCa==="recette") {
    ouCa="recette/categorie/";
  } else if(ouCa==="produit"){
    ouCa="vente/produit/";
  }
  //alert("on essaye de rediriger");
  $(location).attr('href',"http://localhost/fourneaux/"+ouCa+id);

}


// On pourra acheter dans indexproduit et produit

function ajouterAuPanier(idUser, idProd){
	jsonData = 
	{
		'service' 		: 'Panier',
		'method' 		: 'insertPanier',
		'id_user' 		: idUser,
		'id_produit' 	: idProd
	};
	
	
   	$.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async:false,
        success: function(data) {
			//console.log(data);
      alert("produit ajouté");
			actualiserPanier(idUser);
			
		}
    });
    



}




function actualiserPanier(idUser){



	jsonData = 
	{
		'service' 		: 'Panier',
		'method' 		: 'getHtmlIconPanier',
		'id_user' 		: idUser
	};
	
	
   	$.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async:false,
        success: function(data){
			
			//alert(data['response']);
			$('#panierContent').html( data.response );
				
			
			
		}
    });
    



}







/*easter egg*/

var easterEgg = function() {
  var COLORS, Confetti, NUM_CONFETTI, PI_2, canvas, confetti, context, drawCircle, i, range, resizeWindow, xpos;

  NUM_CONFETTI = 350;

  COLORS = [[85, 71, 106], [174, 61, 99], [219, 56, 83], [244, 92, 68], [248, 182, 70]];

  PI_2 = 2 * Math.PI;

  canvas = document.getElementById("easteregg");

  context = canvas.getContext("2d");

  window.w = 0;

  window.h = 0;
  

  resizeWindow = function() {
    window.w = canvas.width = window.innerWidth;
    return window.h = canvas.height = window.innerHeight;
  };

  window.addEventListener('resize', resizeWindow, false);

  /*window.onload = function() {*/
    sTime1 = setTimeout(resizeWindow, 0);
  /*};*/

  range = function(a, b) {
    return (b - a) * Math.random() + a;
  };

  drawCircle = function(x, y, r, style) {
    context.beginPath();
    context.arc(x, y, r, 0, PI_2, false);
    context.fillStyle = style;
    return context.fill();
  };

  xpos = 0.5;

  document.onmousemove = function(e) {
    return xpos = e.pageX / w;
  };

  window.requestAnimationFrame = (function() {
    return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
      return window.setTimeout(callback, 1000 / 60);
    };
  })();

  Confetti = (function() {
    function Confetti() {
      this.style = COLORS[~~range(0, 5)];
      this.rgb = "rgba(" + this.style[0] + "," + this.style[1] + "," + this.style[2];
      this.r = ~~range(2, 6);
      this.r2 = 2 * this.r;
      this.replace();
    }

    Confetti.prototype.replace = function() {
      this.opacity = 0;
      this.dop = 0.03 * range(1, 4);
      this.x = range(-this.r2, w - this.r2);
      this.y = range(-20, h - this.r2);
      this.xmax = w - this.r;
      this.ymax = h - this.r;
      this.vx = range(0, 2) + 8 * xpos - 5;
      return this.vy = 0.7 * this.r + range(-1, 1);
    };

    Confetti.prototype.draw = function() {
      var _ref;
      this.x += this.vx;
      this.y += this.vy;
      this.opacity += this.dop;
      if (this.opacity > 1) {
        this.opacity = 1;
        this.dop *= -1;
      }
      if (this.opacity < 0 || this.y > this.ymax) {
        this.replace();
      }
      if (!((0 < (_ref = this.x) && _ref < this.xmax))) {
        this.x = (this.x + this.xmax) % this.xmax;
      }
      return drawCircle(~~this.x, ~~this.y, this.r, "" + this.rgb + "," + this.opacity + ")");
    };

    return Confetti;

  })();

  confetti = (function() {
    var _i, _results;
    _results = [];
    for (i = _i = 1; 1 <= NUM_CONFETTI ? _i <= NUM_CONFETTI : _i >= NUM_CONFETTI; i = 1 <= NUM_CONFETTI ? ++_i : --_i) {
      _results.push(new Confetti);
    }
    return _results;
  })();

  window.step = function() {
    var c, _i, _len, _results;
    requestAnimationFrame(step);
    context.clearRect(0, 0, w, h);
    _results = [];
    for (_i = 0, _len = confetti.length; _i < _len; _i++) {
      c = confetti[_i];
      _results.push(c.draw());
    }
    return _results;
  };

  step();

};


/**
 * formatFloat nettoie un string contenant un float
 * @param  [string, float] num
 * @return string
 */
function formatFloat(num){
  num=num+"";
  num=num.replace(/\s/g,"ZZZ");
  num=num.replace(/,/g,".");
  num=num.replace(/[a-zA-Z]/g,"");
  num=num.replace(/€/g,"");
  num=num.replace(/\$/g,"");
  return num;
}


function formatMoney( num , localize, fixedDecimalLength ){
    num=formatFloat(num)+"";
    
    var str=num;
    var reg=new RegExp(/(\D*)(\d*(?:[\.|,]\d*)*)(\D*)/g);
  if(reg.test(num)){
    var pref=RegExp.$1;
    var suf=RegExp.$3;
    var part=RegExp.$2;
    if(fixedDecimalLength/1)part=(part/1).toFixed(fixedDecimalLength/1);
    if(localize)part=(part/1).toLocaleString();
    str= pref +part.match(/(\d{1,3}(?:[\.|,]\d*)?)(?=(\d{3}(?:[\.|,]\d*)?)*$)/g ).join(' ')+suf;
  };
  return str;
}

/*alert(formatMoney("1 2 34  5 6 7 89,12 3 4 56 7 8 9",false, 2));
alert(formatMoney("123 456789 , 12 3456789",false, 2));
alert(formatMoney( "    123456789,1234   56789",false, 2));
*/
