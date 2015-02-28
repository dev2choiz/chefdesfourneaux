<?php

namespace Library\PopUp;

abstract class PopUp{

	public function __construct(){

	}

	public function getScriptPopUp($class, $popUpContainer, $popUp){
		return
		"$(document).ready(function(){
			$('#$class')
				.click(function(){
					$('#$popUpContainer').css('display', 'block');
					$('#$popup').css('display', 'block');	
				});

			$('.popUpContainer').click(function(){
				$('#$popUpContainer').css('display', 'none');
				$('#$popup').css('display', 'none');
			});
		});";
	}

	public function getHtmlPopUp($popUpContainer, $popup, $textPopUp){
		return
		"<div class='#$popUpContainer'>
			<div id='#$popup'>

				<p>$textPopUp</p>
			</div>
		</div>";
	}


}