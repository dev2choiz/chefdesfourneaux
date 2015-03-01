<?php

namespace Library\Ajax;



class Ajax{


  private $tabFonctionName;


	public function __construct(){
    $this->tabFonctionName= array();
	}


  public function getAjax( $type, $service, $methode, $data, $fonctionName, $successFonc ){

    //ajoute a la liste des noms de fonctions utilisées si $fonctionName n'y est pas encore
    //dans le cas contraire, return false
    foreach ($this->tabFonctionName as $key => $value) {
      if($value==$fonctionName){
        return false;
      }else{
        $this->tabFonctionName[]=$fonctionName;
      }
    }


    $url=WEBSERVICE_ROOT.'/index.php';
    $i=0;
    $separateur=",";
    $strData="service:'$service', method:'$methode'";
    foreach ($data as $key => $value) {
      $strData.=$separateur." '$key':'".$value."'";
      $i++;
    }
    echo $strData;
    return "
    <script type='text/javascript'>
    function $fonctionName(){
      $.ajax({
        type: '$type',
        data: {
          $strData
        },
        url: '$url',
        dataType: 'json',
        //async: false,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
        success: function(data) {
          $successFonc
        }
        });
    }

    </script>
    ";
  }




}

