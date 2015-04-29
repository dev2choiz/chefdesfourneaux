<?php


namespace Library\Sitemap;

class Sitemap{



    public $file;	
    public $url;	
    public $extension;
    public $freq;	
    public $priority;

	public $scanned;

	public $strLog;
	public $strSitemap;

	public $skip;
		

	public function __construct(){


	    $this->file = "sitemap.xml";
	    $this->url = "http://localhost/chefdesfourneaux";


		
		$this->extension = ".phtml";

		$this->freq = "daily";
		$this->priority = "0.5";



		$this->strLog="";
		$this->strSitemap="";

		$this->skip=[
			'http://localhost/chefdesfourneaux/user/',
			'http://localhost/chefdesfourneaux/error/',
			'https://youtube',
			'https://www.youtube'
		];




	    /*$pf = fopen ($this->file, "w");
	    if (!$pf){
			$this->strLog= "cannot create $file\n";
			return ;
	    }*/


		$this->strSitemap.="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<urlset
      xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
      xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
      xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">

<url>
  <loc>{$this->url}/</loc>
  <changefreq>daily</changefreq>
  <priority>1</priority>
</url>
";
	    /*fwrite ($pf,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<urlset
      xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
      xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
      xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">

<url>
  <loc>{$this->url}/</loc>
  <changefreq>daily</changefreq>
</url>
");*/







		$this->scanned = array();
		$this->strSitemap .= $this->scan ($this->url);
		//var_dump("apres",$this->scanned);

		// fwrite ($pf, "</urlset>\n");
		$this->strSitemap.="</urlset>\n";

		// fclose ($pf);

		//echo "@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>" . htmlentities($this->strSitemap) . "<<<@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@";
		//$this->strSitemap = $result;

		//return array($this->strLog, $this->strSitemap, $result);





	}




	    

	function Path ($p){
	    $a = explode ("/", $p);
	    $len = strlen ($a[count ($a) - 1]);
	    return (substr ($p, 0, strlen ($p) - $len));
	}

	function GetUrl($url){
	    /*$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $data = curl_exec($ch);
	    curl_close($ch);
		return $data;*/
	    return file_get_contents($url);
	}


	function scan($url){

	    //global $scanned, $pf, $extension, $skip, $freq, $priority;
		$this->strLog.="scan url $url\n";
		array_push ($this->scanned, $url);

		//var_dump("scanned", $this->scanned);

		$html = $this->GetUrl ($url);
		$a1 = explode ("<a", $html);

		
		$resultat="";
		foreach ($a1 as $key => $val){
			//$this->strLog.= "###".$val."{{{{{{{{{{{{\n";
			$parts = explode (">", $val);
			$a = $parts[0];
			//$this->strLog.= "<br>###".$a."<===aaaa<br>";

			$aparts = explode ("href=", $a);
			/*var_export($aparts);
			echo "<===aparts$a<br>";*/
			

			if($aparts[0]!="<!DOCTYPE html"){
				
				$hrefparts = explode (" ", $aparts[1]);
				//echo "";
				//var_export($hrefparts); echo "<==hrefparts<br>";
				$hrefparts2 = explode ("#", $hrefparts[0]);
				//echo "";
				//var_export($hrefparts2); echo "<==hrefparts2<br>"; echo "<hr>";

				$href = str_replace ("\"", "", $hrefparts2[0]);
				//$this->strLog.= "<br>###".$href."{{{{{{{{{{{{<br>";
				//echo "#".$href."#<br>";
				//On vérifie
				
				

				if ((substr ($href, 0, 7) != "http://") && (substr ($href, 0, 8) != "https://") && (substr ($href, 0, 6) != "ftp://")){
				    //if ($href[0] == '/')
					if (substr ($href, 0, 1) == '/')
						$href = "$scanned[0]$href";
				    else
						$href = $this->Path ($url) . $href;
				}
				
				if (substr ($href, 0, strlen ($this->scanned[0])) == $this->scanned[0]){

				    $ignore = false;
				    if (isset ($this->skip)){
						foreach ($this->skip as $k => $v){
						    if (substr ($href, 0, strlen ($v)) == $v){
						    	$ignore = true;
						    	//echo "ignoré";
						    }

					    }
					}
					//var_dump($this->scanned, $href);
					if ( (strpos ($href, "call-user-func-array") > 0) ) {
						$ignore = true;
			    	//echo "ignoré";
			    	}
			    	if ( $href=== "http://localhost/chefdesfourneaux/" || $href=== "http://localhost/chefdesfourneaux"  ) {
							$ignore = true;
					}

					/*echo $href. " dan ".$this->extension."<br>";
					if ( (strpos ($href, $this->extension) > 0) ) {
						echo ">>pas dedans OK<<";
					} else {
						echo "dedans<<";
					}*/
					
					
					
				    if ((!$ignore) && (!in_array ($href, $this->scanned)) /*&& (strpos ($href, $this->extension) > 0)*/){

				    	

						if ( (strpos (" ".$href, "http://localhost/chefdesfourneaux/recette/") > 0) ) {
							$this->freq = "monthly";
							$this->priority="0.8";
						}else if ( (strpos (" ".$href, "http://localhost/chefdesfourneaux/recette/indexcategorie/") > 0) ) {
							$this->freq = "monthly";
							$this->priority="1.0";
						}if ( (strpos (" ".$href, "http://localhost/chefdesfourneaux/vente/indexproduit") > 0) ) {
							$this->freq = "monthly";
							$this->priority="0.7";
						}else{
							$this->freq = "monthly";
							$this->priority="0.5";
						}

						/*fwrite ($pf, "<url>\n  <loc>$href</loc>\n" .
							     "  <changefreq>{$this->freq}</changefreq>\n" .
							     "  <priority>{$this->priority}</priority>\n</url>\n");*/

						/*$resultat*/
						$this->strSitemap .= htmlentities("<url>\n  <loc>$href</loc>\n").
							     htmlentities("  <changefreq>{$this->freq}</changefreq>\n").
							     htmlentities("  <priority>{$this->priority}</priority>\n</url>\n");
						//echo 				$href. "\n";
						$this->strSitemap .="\n";
						 $this->strSitemap .= $this->scan ($href);

				    }
				}


			}		// fin if qui verifie si c'est le Doctype
			
	    }	//fin foreach
	    //return $this->strSitemap;
	    //return $resultat;
	}





	public function verifHref($href){
		$exclues=[
			'',
			'http://localhost/chefdesfourneaux/user/',
			' ',
			'https://youtube',
			'https://www.youtube'
		];
		foreach ($exclues as $exclue) {
			if(substr($href, strlen($exclue) ) == $exclue){
				return false;
			} 
		}
		return true;
	}



}
						



?>