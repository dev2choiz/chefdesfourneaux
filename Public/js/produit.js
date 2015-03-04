$(document).ready(function(){
	$('#divpopupContainer').css('display', 'none');

	$('#$idDiv')
		.click(function(){
			if( $('#popupContainer').css('display') == 'block' ){
				$('#popupContainer').css('display', 'none');
			}else{
				$('#popupContainer').css('display', 'block');	
			}
		});

	$('#btnCancel')
		.click(function(){
			$('#popupContainer').css('display', 'none');
		})

	$('#BtnPopup').click(function(){
		ajouterProduit();
	}); 
});

