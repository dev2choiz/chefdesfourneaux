<?php

namespace Library\Ajax;


//sera plus tard un singleton
class Ajax{


  private $tabFunctionName;


	public function __construct(){
        $this->tabFunctionName= array();
	}

    /**
     * [getAjax description]
     * @param  [type] $tabInputValue [tableau dont les indices sont "les types de retour" des inputs du ShowDiv, et les valeurs, les ids des inputs correspondants]
     * @param  [type] $type          [description]
     * @param  [type] $service       [quel service]
     * @param  [type] $methode       [quelle methode]
     * @param  [type] $data          [valeurs supplementaires a transmettre au webservice] //ca pourra pt-etre servir
     * @param  [type] $fonctionName  [nom de la fonction lancé en cas de succes]
     * @param  [type] $successfonc   [script du success qui lance fonctionName] (tordu non?)
     * @return [String]                [script ajax qui envoit et lance la $successfonc qui s'appelle $fonctionName]
     */
    public function getAjax( $tabInputValue ,  $type, $service, $methode, $data, $functionName, $successfonc){

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
        $strData = "jsonData={};
                    jsonData['service']= '$service';
                    jsonData['method']= '$methode';
                    ";


        //ecrit le js qui recupere les valeurs à envoyer au webservice
        foreach ($tabInputValue as $key => $value) {
            $strData .= "jsonData['$key']= document.getElementById('$value').value;";       //.value pour l'instant
        }
        
        //ecrit le js qui recupere les valeurs à envoyer au webservice
        foreach ($data as $key => $value) {
            $strData.=$separateur." '$key':'".$value."'";
            $i++;
        }
        //echo $strData;

        //'service' : 'ingredient', 'method' : 'insertingredients', 'value' : 'ljlmk'
        //alert(\"$strData\"+str       );
        return "
        function $functionName(){

            $strData


            //console.log('jlghiici');
            //console.log(jsonData);

            $.ajax({
                type: '$type',
                data: jsonData,
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

