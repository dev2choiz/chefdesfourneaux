<?php

namespace Library\Ajax;



class Ajax{


  private $tabFunctionName;


	public function __construct(){
        $this->tabFunctionName= array();
	}


    public function getAjax( $tabInputValue ,  $type, $service, $methode, $data, $functionName, $successfonc){
        $str="str='';\n";
        foreach ($tabInputValue as $key => $value) {
            $str.= "
                str+=','+'$key'+ ':'+ document.getElementById('$value').value;
            ";
        }
            $str.="";

        //ajoute a la liste des noms de fonctions utilisées si $fonctionName n'y est pas encore
        //dans le cas contraire, return false
        if (is_array($this->tabFunctionName) && count($this->tabFunctionName)>0 ){
            foreach ( $this->tabFunctionName as $key => $value ){
                if($value == $functionName){
                    return false;
                }else{
                    $this->tabFunctionName[] = $functionName;
                }
            }
        }else{
            $this->tabFunctionName[] = $functionName;
        }

        $url = WEBSERVICE_ROOT.'/index.php';
        $i = 0;
        $separateur = ",";
        $strData = "service:'$service', method:'$methode'";
        foreach ($data as $key => $value) {
            $strData.=$separateur." '$key':'".$value."'";
            $i++;
        }
        echo $strData;

        return "



                function $functionName(){
            $str

            alert(strData+str);


            $.ajax({
                type: '$type',
                data: {
                    $strData+str
                },
                url: '$url',
                dataType: 'json',
                //async: false,
                success: function(data) {
                    $successfonc

                }
            });
        }
    
        ";
    }

}

