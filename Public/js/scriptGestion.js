

$(document).ready(function(){
	$('#divCat').css('display', 'none');
	$('#divIng').css('display', 'none');
	$('#divUnit').css('display', 'none');



	$('#categories')
		.click(function(){
			$('#divCat').css('display', 'block');
		}
	);

	$('#ingredients')
		.click(function(){
			$('#divIng').css('display', 'block');
		}
	);

	$('#unites')
		.click(function(){
			$('#divUnit').css('display', 'block');
		}
	);





	/*$('#{$divContainerName}BtnShowDiv').submit(function(e){t
	    e.preventDefault();
	 
	 }); */   





});