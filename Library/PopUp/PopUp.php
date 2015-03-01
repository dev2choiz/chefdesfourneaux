<?php

namespace Library\PopUp;

abstract class PopUp{

	public function __construct(){

	}

	public function getScriptPopUp($class, $popUpContainer, $popUp){
		return"

<script type='text/javascript'>
		$(document).ready(function(){
			$('#$class')
				.click(function(){
					$('#$popUpContainer').css('display', 'block');
					$('#$popUp').css('display', 'block');	
				});

			$('.popUpContainer').click(function(){
				$('#$popUpContainer').css('display', 'none');
				$('#$popUp').css('display', 'none');
			});
		});
</script>
";
	}

	public function getHtmlPopUp($popUpContainer, $popup, $textPopUp){
		return
		"
		
		<div id='$popUpContainer' style='display:none;'>

			<div id='$popup' style='display:none;'>

				<p>$textPopUp</p>
			</div>
		</div>";
	}


}