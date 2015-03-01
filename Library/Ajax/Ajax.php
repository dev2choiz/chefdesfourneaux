<?php

namespace Library\Ajax;



class Ajax{


  private $tabFunctionName;


	public function __construct(){
        $this->tabFunctionName= array();
	}


    public function getAjax( $type, $service, $methode, $data, $functionName){

        //ajoute a la liste des noms de fonctions utilisées si $fonctionName n'y est pas encore
        //dans le cas contraire, return false
        /*foreach ($this->tabFunctionName as $key => $value) {
            if($value == $functionName){
                return false;
            }else{
                $this->tabFunctionName[] = $functionName;
            }
        }
*/

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
            $.ajax({
                type: '$type',
                data: {
                    $strData
                },
                url: '$url',
                dataType: 'json',
                //async: false,                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                success: function(data) {
                    var val = '';
                    var option = '';
                    for(var i=0; i<data.response.length; i++){
                        val = data.response[i]['value'];
                        option = '<option>' + val + '</option>';
                        $('#popupSelect').append(option);
                    }
                }
            });
        }";
    }

}

