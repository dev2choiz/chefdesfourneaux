<?php

namespace Library\TinyMCE;

class TinyMCE{

	private $source;

	public function __construct(){
		if(!isset($_SESSION)){
			session_start();
		}
		$this->source="<script type='text/javascript' src='".LINK_ROOT."Library/TinyMCE/tinymce/tinymce.min.js'></script>
			<script type='text/javascript'>
			tinymce.init({
			        selector: 'textarea',
			        plugins: [
			                'advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker',
			                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
			                //'table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern'
			                'table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern autoresize'
			        ],

			        toolbar1: 'newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect',
			        toolbar2: 'cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor',
			        toolbar3: 'table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft',

			        menubar: true,
			        toolbar_items_size: 'small',

			        style_formats: [
			                {title: 'Bold text', inline: 'b'},
			                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			                {title: 'Example 1', inline: 'span', classes: 'example1'},
			                {title: 'Example 2', inline: 'span', classes: 'example2'},
			                {title: 'Table styles'},
			                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
			        ],

			        templates: [
			                {title: 'Test template 1', content: 'Test 1'},
			                {title: 'Test template 2', content: 'Test 2'}
			        ],


					
					width: '100%',
					//height: 400,
					autoresize_min_height: 300
					//autoresize_max_height: 800



			});</script>";

	}

	public function getSource(){
		return $this->source;
	}


}