<?php

namespace Library\Router;

class Router
{
	
	use \Library\Traits\Patterns\Singleton;

	private function __construct(){
	
	}


	/**
	 * Genere le chemin vers un controller
	 * 
	 * @param  String $name
	 * @return String
	 */
	static private function getControllerPath($name){
		return APP_ROOT . 'Controllers' . DIRECTORY_SEPARATOR . ucfirst(strtolower($name)) . '.php';
	}

	/**
	 * Genere le nom d'un controller
	 * 
	 * @param  String $name
	 * @return String
	 */
	static private function getControllerClassName($name){
		return "\Application\Controllers\\".ucfirst(strtolower($name));
	}


	/**
	 * Genere le chemin vers un module
	 * 
	 * @param  String $name
	 * @return String
	 */
	static private function getModulePath($name){
		return APP_ROOT . 'Modules' . DIRECTORY_SEPARATOR . ucfirst(strtolower($name)) . '.php';
	}


	/**
	 * Genere le nom d'un module
	 * 
	 * @param  String $name
	 * @return String
	 */
	static private function getModuleClassName($name){
		return "\Application\Modules\\".ucfirst(strtolower($name));
	}


	/**
	 * Genere le nom d'une action
	 * 
	 * @param  String $name
	 * @return String
	 */
	static private function getActionName($name){
		return strtolower($name)."Action";
	}





	static public function dispatchPage($page){
		
		$page 		= explode('/', $page);
		$controller = self::getControllerClassName('index');
		$action 	= self::getActionName('index');
//echo $page[0]."{##########".self::getControllerPath($page[0])."##".self::getControllerClassName($page[0]);die();		
		if(!empty($page[0])){
			if(file_exists(self::getControllerPath($page[0])) && class_exists(self::getControllerClassName($page[0]))){
				$controller = self::getControllerClassName($page[0]);
				array_splice($page, 0, 1);
			}else{
				$controller = self::getControllerClassName('error');
			}
		}

		$controller = new $controller;

//echo $page[0]."{##########".self::getControllerPath($page[0])."##".self::getControllerClassName($page[0]);die();
		if(!empty($page[0])){
			if(method_exists($controller, self::getActionName($page[0]))){
				$action = self::getActionName($page[0]);
			}
			array_splice($page, 0, 1);
		}
		call_user_func_array(array($controller, $action), $page);
		call_user_func_array(array($controller, 'renderView'), array("controller"	=> get_class($controller),
																	 "action"		=> $action));

		unset($controller, $action);
	}





	static public function dispatchModule($module, $action, array $param=array()){
		
		if(empty($module)){
			throw new \Exception("Error parameter module name is Required for methode dispatchModule");
		}
		if(empty($action)){
			throw new \Exception("Error parameter action name is Required for methode dispatchModule");
		}
		

		if(file_exists(self::getModulePath($module)) && class_exists(self::getModuleClassName($module))){
			$module = self::getModuleClassName($module);
			$module = new $module;

			if(method_exists($module, self::getActionName($action))){
				$action = self::getActionName($action);

				call_user_func_array(array($module, $action), $param);
				call_user_func_array(array($module, 'renderModule'), array("module" => get_class($module),
																 		   "action" => $action));

				unset($action);

			}else{
				throw new \Exception("Error Action:'$action' not found");
			}
			
			unset($module);

		}else{
			throw new \Exception("Error Module:'$module' not found");
		}
	}
}