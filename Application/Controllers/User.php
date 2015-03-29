<?php

namespace Application\Controllers;

class User extends \Library\Controller\Controller{

	private $message;

	public function __construct(){
		parent::__construct();
		$this->setLayout("signin");
		$this->message = new \Library\Message\Message();
	}

	public function indexAction(){
		$this->setRedirect(LINK_ROOT."user/login");
	}


	public function profilAction(){

		if(empty($_SESSION['user'])){
			$this->setRedirect(LINK_ROOT);
		}

		$this->setDataView(array("pageTitle" => "Mise à jour de votre profil"));
		$this->setDataView(array("message" => ""));

		if(isset($_POST['btn'])){

			if(empty($_POST['nom'])){
				$this->message->addError("Nom vide !");
			}elseif(strlen($_POST['nom'])>50){
				$this->message->addError("Nom trop long !");
			}

			if(empty($_POST['prenom'])){
				$this->message->addError("Prenom vide !");
			}elseif(strlen($_POST['prenom'])>50){
				$this->message->addError("Prenom trop long !");
			}

			if(empty($_POST['mail'])){
				$this->message->addError("Mail vide !");
			}elseif(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
				$this->message->addError("Mail non valide !");
			}

			$currentPassword	=	$_POST['currentpassword'];

			if(!empty($_POST['password'])){
  				if(isset($_POST['confpassword']) && $_POST['password'] !== $_POST['confpassword']){
					$this->message->addError("Confirmation password non valide !");

				}else{	//password=confpassword
					$password =	$_POST['password'];
				}
			}else{	//on ne cherche pas a modifier le mot de passe
				$password	=	$_POST['currentpassword'];	//==>new pwd= old pwd
			}
			
			$listMessage = $this->message->getMessages("error");
			
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));	
				return false;
			}
			

			
			$modelUser = new \Application\Models\User('localhost');

			$user = $modelUser->login($_SESSION['user']['mail'], $_POST['currentpassword']);
			//$user=$modelUser->convEnTab($user['response'][0]);
			$user=$modelUser->convEnTab($user);
			var_dump("dqdf", $user);
			$user=$user['response'][0];
			//var_dump("dqdf", $user);
			if(!empty($user)){


				unset( $_POST['btn'],$_POST['password'], $_POST['confpassword'], $_POST['currentpassword'], $listMessage);

				$_POST['password']=$password;		//<== new password
				var_dump($_POST);
				$res=$modelUser->convEnTab($modelUser->updateUser($_SESSION['user']["id_user"],$_SESSION['user']["mail"] , $currentPassword, $_POST));
				//echo "############".$res['page']."#############";
				var_dump("resulta", $res);
				echo $res['page'];
				$res=$res['response'];

				//var_dump("fdf",$res, $_POST ,"df");
				if($res){
					


					//recupere les nouvelles données de l'utlisateur
					$user = $modelUser->convEnTab( $modelUser->login( $_POST['mail'], $_POST['password'] ) );

					$user=$user ['response'][0];
					if(!empty($user)){
						$_SESSION['user'] = $user;

						$this->message->addSuccess("Update valide");
					}else{
						$this->message->addError("Update Failure !");
					}

				}else{
					$this->message->addError("La mise à jour ne s'est pas faite correctement");
				}

			}else{
				$this->message->addError("Password non valide !");
			}
		}		//fin traitement formulaire


		$this->setDataView(array("message" => $this->message->showMessages()));
		
			
	

	}	//fin de la fonction profil





	public function loginAction(){

		if(!empty($_SESSION['user'])){
			$this->setRedirect(LINK_ROOT);
		}
		
		$this->setDataView(array("pageTitle" => "Connexion"));

		if(isset($_POST['btn'])){

			if(empty($_POST['mail'])){
				$this->message->addError("Mail vide !");
			}elseif(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
				$this->message->addError("Mail non valide !");
			}

			if(empty($_POST['password'])){
				$this->message->addError("Password vide !");
			}
			
			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));

				return false;
			}

			unset($_POST['btn'], $listMessage);
			
			$modelUser = new \Application\Models\User('localhost');
			
			$user = $modelUser->convEnTab($modelUser->login($_POST['mail'], $_POST['password']) );
			
			/*object(stdClass)[9]
			  public 'response' => 
			    array (size=1)
			      0 => 
			        object(stdClass)[10]
			          public 'id' => int 13
			          public 'nom' => string 'nom1' (length=4)
			          public 'prenom' => string 'prenom1' (length=7)
			          public 'mail' => string 'mail1@hotmail.com' (length=17)
			          public 'password' => string 'b4136225ae3ffed43874cec08fcf7330' (length=32)
			          public 'update' => string '2015-02-01 09:06:40' (length=19)
			  public 'apiError' => boolean false
			  public 'apiErrorMessage' => string '' (length=0)
			  public 'serverError' => boolean false
			  public 'serverErrorMessage' => string '' (length=0)
			*/

			//var_dump($user);die();
			if(empty($user)){	//s'il y a une erreur
				$this->message->addError("Erreur au niveau du webservice !");
			}elseif ($user['apiError'] ) {
				$this->message->addError($user['apiErrorMessage']);
			}elseif ( $user['serverError'] ) {
				$this->message->addError($user['serverErrorMessage']);
			}elseif ( count($user['response'])!=1 ) {
				$this->message->addError("Mail/Password non valide !"); // ou couple d'id/pwd en double
			}else{			//tout roule
				$user=$user['response'][0];
					/*array (size=x)
				          'id' => int 13
				           'nom' => string 'nom1' (length=4)
				           'prenom' => string 'prenom1' (length=7)
				           'mail' => string 'mail1@hotmail.com' (length=17)
				           'password' => string 'b4136225ae3ffed43874cec08fcf7330' (length=32)
				           'update' => string '2015-02-01 09:06:40' (length=19)
				    */
					
				$_SESSION['user'] = $user;
				header('location: '.LINK_ROOT);
				die();

			}


		}
		$this->setDataView(array("message" => $this->message->showMessages()));
	}



	public function logoutAction(){
		session_unset();
	}



	public function inscriptionAction(){

		if(!empty($_SESSION['user'])){
			$this->setRedirect(LINK_ROOT);
		}

		$this->setDataView(array("pageTitle" => "Inscription"));


		if(isset($_POST['btn'])){

			var_dump($_POST);
			if(empty($_POST['nom'])){
				$this->message->addError("Nom vide !");
			}elseif(strlen($_POST['nom'])>50){
				$this->message->addError("Nom trop long !");
			}

			if(empty($_POST['prenom'])){
				$this->message->addError("Prenom vide !");
			}elseif(strlen($_POST['prenom'])>50){
				$this->message->addError("Prenom trop long !");
			}

			if(empty($_POST['mail'])){
				$this->message->addError("Mail vide !");
			}elseif(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
				$this->message->addError("Mail non valide !");
			}

			if(empty($_POST['password'])){
				$this->message->addError("Password vide !");
			}elseif($_POST['password'] !== $_POST['confpassword']){
				$this->message->addError("Confirmation password non valide !");
			}
			
			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));	
				return false;
			}

			unset($_POST['btn'], $_POST['confpassword'], $listMessage);
			


			$_POST['role']='membre';
			$_POST['date_naissance']=$_POST['date_naissance'];

			$modelUser = new \Application\Models\User('localhost');
			$res=$modelUser->convEnTab($modelUser->insertUser($_POST));

			echo $res['page'];


			//var_dump("dskj",$res, $_POST);
			if($res){
				$this->message->addSuccess("Inscription valide");
				header('location: '.LINK_ROOT.'user/login');
				die();
			}else{
				$this->message->addError("erreur pendant l'inscription !");

			}
		}
		$this->setDataView(array("message" => $this->message->showMessages()));	
	}




	public function deleteAction(){

		
		if(empty($_SESSION['user'])){
			$this->setRedirect(LINK_ROOT);
		}

		$this->setDataView(array("pageTitle" => "Delete"));


		if(isset($_POST['btn'])){

			
			
			if(empty($_POST['password'])){
				$this->message->addError("Password vide !");
			}
			
			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));	
				return false;
			}

			unset($_POST['btn'], $listMessage);
			


			$_POST['id_user']=$_SESSION['user']['id_user'];

			$modelUser = new \Application\Models\User('localhost');
			$res=$modelUser->convEnTab($modelUser->deleteUser($_POST));

			$res=$res['response'];
			//echo $res['page'];


			
			if($res){
				$this->message->addSuccess("Compte supprimé");
				unset($_SESSION['user']);
				$this->setRedirect(LINK_ROOT.'user/login'); 	
			}else{
				$this->message->addError("mot de passe erroné  !");

			}
		}
		$this->setDataView(array("message" => $this->message->showMessages()));	
	}



public function motDePasseOublieAction(){

		

		$modelMailer = new \Application\Models\Mailer('localhost');		

		$modelQuestionSecrete = new \Application\Models\QuestionSecrete('localhost');
		$questionSecretes = $this->convEnTab( $modelQuestionSecrete->getQuestionSecretes() );

		$questionSecretes=$questionSecretes['response'];
		


		$this->setDataView(array("pageTitle" => "Mot de passe oubli&eacute;","message" => ""));

		if(isset($_POST['btn'])){

			if(empty($_POST['reponsesecrete'])){
				$this->message->addError("reponse vide !");
			}

			if(empty($_POST['mail'])){
				$this->message->addError("mail vide !");
			}

			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));	
				return false;
			}
			
			//envoyerMail($mailExped, $mailDest, $body, $subject, $template)

			$modelUser = new \Application\Models\User('localhost');		
			$user = $modelUser->redefinirPassword( $_POST['mail'], $_POST['reponsesecrete'] );
			var_dump($user);
			
			$user=$modelUser->convEnTab($user);
			$res=$user['response'];
			
			if( $res ){
				$this->message->addSuccess('vous recevrez dans quelques instants un mail contenant votre nouveau mot de passe');
			}else{
				$this->message->addError("le mail et la reponse ne correnspondent pas  !");
			}
		}		//fin traitement formulaire

		
		
		$this->setDataView(array(
			'message'			=> $this->message->showMessages(),
			'questionSecretes'	=> $questionSecretes,
			'userView'				=> $_SESSION['user']
		));
		
			
	

	}



}