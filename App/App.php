<?php

namespace App;

use App\Controllers\HomeController;
use Exception;

class App
{
		private $controller;
		private $controllerFile;
		private $action;
		private $params;
		public  $controllerName;

		public function __construct()
		{
			/* 
			 * Constantes do sistema
			*/
			define('APP_HOST'			, $_SERVER['HTTP_HOST'] . "/devmedia/mvc");
			define('PATH'				, realpath('./'));
			define('TITLE'				, "Primeira Aplicação MVC em PHP - DevMedia");
			define('DB_HOST'			, "locahost");
			define('DB_USER'			, "root");
			define('DB_PASSWORD'		, "");
			define('DB_NAME'			, "devmedia");
			define('DB_DRIVER'			, "mysql");
			
			$this->url();
		}

public function run()
{
if($this->controller){
	$this->controllerName = ucwords($this->controller) . 'Controller';
	$this->controllerName = preg_replace('/[^a-zA-Z]/i', '', $this->controllerName);
}else{
	$this->controllerName = "HomeController";
}
	
	$this->controllerFile = $this->controllerName . '.php';
	$this->action = preg_replace('/[^a-zA-Z]/i', '', $this->action);

	if(!$this->controller){
		$this->controller = new HomeController($this);
		$this->controller->index();
	}

	if(!file_exists(PATH . '/App/Controllers/' . $this->controllerFile)){
		throw new Exception("Página não encontrada.", 404);
	}

	$nomeClasse  = "\\App\\Controllers\\" . $this->controllerName;
	$objetoController = new $nomeClasse($this);

	if(!class_exists($nomeClasse)){
		throw new Exception("Erro na aplicação",500);
	}

	if(method_exists($objetoController, $this->action)){
		$objetoController->{$this->action}($this->params);
		return;
	}else if (!$this->action && method_exists($objetoController,'index')){
		 $objetoController->index($this->params);
		return;
	}else{
		throw new Exception("Nosso suporte já está verificando!!", 500);
	}
	throw new Exception("Pàgina não encontrada.",400);
}

public function url(){

			if(isset($_GET['url'])){
				
				$path = $_GET['url'];
				$path = rtrim($path, '/');
				$path = filter_var($path, FILTER_SANITIZE_URL);

				$path = explode('/', $path);

				$this->controller = $this->verificarArray($path, 0);
				$this->action     = $this->verificarArray($path, 1);

				if( $this->verificarArray($path, 2)){
					unset( $path[0]);
					unset( $path[1]);
					$this->params = array_values($path);
				}
			}
		}

		public function getController()
		{
			return $this->controller;
		}

		public function getAction()
		{
			return $this->action;
		}

		public function getControllerName()
		{
			return $this->controllerName;
		}

		public function getParams()
		{
			return $this->params;
		}

		private function verificarArray($array, $key){
			if( isset( $array[ $key]) && !empty( $array[ $key])){
				return $array[ $key ];
			}
		return null;
	}
}