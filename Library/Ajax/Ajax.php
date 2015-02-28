<?php

namespace Library\Ajax;



class Ajax{

	public function __construct(){
		
	}


  public function getAjax($methode,$data, $url, $fonction ){

    $str="";$i=0;
    $separateur=",";
    foreach ($data as $key => $value) {
      if($i == (count($data)-1)   ){
        $separateur="";
      }
      $str.="'$key':".$value.$separateur;
      $i++;
    }
    echo $str;
    return "
    <script type=text/javascript>
      $.ajax({
        type: '$methode',
        data: {
          $str
        },
        url: '$url',
        dataType: 'json',
        //async: false,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
        success: function(data) {
          $fonction
        }
        });
    </script>";
  }




}