<?php

	Class Index extends Controller{

		function __construct(){
			parent::__construct();
		}

		/*Acceder a la pantalla principal*/
		public function index()
		{
			$this->view->render($this,"login");
			Session::destroy();
		}

		// public function registrar(){
		// 	// if (empty($_POST)) {
		// 	// 	echo "";
		// 	// }else{
		// 		$user = "Ramby";
		// 		$password = "12345";
		// 		$idTipoUser = "5";
		//
		// 		$pass = md5($password.KEY);
		//
		// 		// echo $pass."<br>";
		//
		// 		$this->loadOtherModel('Principal');
		// 		$login = $this->Principal->insertarUsuario($user, $pass, $idTipoUser);
		// 		//echo $login;
		// 		if($login == '1'){
		// 			echo "HOLA";
		// 		}else{
		// 			echo "ADIOS";
		// 		}
		// 	// }
		// }

		public function ingresar(){

			if (empty($_POST)) {
				echo "";
			}else{
				$user = $_POST['usuario'];
				$password = $_POST['pass'];
				$mensajeFallo = strtoupper("Datos incorrectos, verifica por favor");
				$pass = md5($password.KEY);

				$this->loadOtherModel('Principal');
				$login = $this->Principal->ingresar($user, $pass);
				if(isset($login['NombreUsuario']) && isset($login['Password'])){
					$idTipoUsuario = $login['idTipoUsuario'];
					$verificar = $this->Principal->verificarID($idTipoUsuario);

					$entradaU = $login['NombreUsuario'];
					$entradaP = $login['Password'];

					if(sizeof($verificar) > 1){
						for ($i=0; $i < sizeof($verificar); $i++) {
							if($verificar[$i]['u.NombreUsuario'] == $user &&  $verificar[$i]['u.NombreUsuario'] == $entradaU &&
									$verificar[$i]['Tipo'] == $idTipoUsuario && $pass == $entradaP){
										$con = $verificar[$i]['Controller'];
										Session::setValue('Usuario', $entradaU);
										Session::setValue('Controller', $verificar[$i]['Controller']);
										Session::setValue('idTipoUsuario', $idTipoUsuario);
										echo "<script>sessionStorage.removeItem('evento');</script>";
										echo "<script>sessionStorage.setItem('controller',".$con.")</script>";
										echo "<script>window.location ='".URL.$con."'</script>";
										break;
							}
						}
					}elseif (sizeof($verificar) == 1) {
						if($user == $entradaU && $pass == $entradaP && $verificar[0]['Tipo'] == $idTipoUsuario){
							Session::setValue('Controller', $verificar[0]['Controller']);
							Session::setValue('Usuario', $entradaU);
							Session::setValue('idTipoUsuario', $idTipoUsuario);
							if(Session::getValue('Usuario')!=null && Session::getValue('idTipoUsuario')!=null){
								echo "<script>sessionStorage.removeItem('evento');</script>";
								echo "<script>sessionStorage.setItem('controller','$user' )</script>";
								echo "<script>window.location ='".URL.$user."'</script>";
							}
						}
				}
			}else{
					echo "<script>";
					echo "alert('".$mensajeFallo."');";
					echo "window.location ='".URL."';";
					echo "</script>";
			}
		}
	}

		public function logOut()
		{
			$this->loadOtherModel('Principal');
			$control = Session::getValue('idTipoUsuario');
			$us = ( Session::getValue('Usuario'));
			if($control != null && $us != null){
					echo "<script>
					 				if(confirm('¿Seguro deseas salir de la sesión?')){
					 					window.location='".URL."';
					 				}else{
					 					window.history.back();
					 				}
					 			</script>";
			}else{
				echo "<script>
									window.location='".URL."';
							</script>";
			}
		}

		public function tabs()
		{
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "tabs", true);
			}else{
				header('Location: '.URL);
			}

		}
		public function navEvento()
		{
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "tabsEvento", true);
			}else{
				header('Location: '.URL);
			}

		}

		public function navPreevento()
		{
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "tabsPre", true);
			}else{
				header('Location: '.URL);
			}

		}

		public function CE()
		{
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "crear_evento", true);
			}else{
				header('Location: '.URL);
			}
		}

		public function EV()
		{
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "evento", true);
			}else{
				header('Location: '.URL);
			}
		}

		public function PreE()
		{
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "crear_evento", true);
			}else{
				header('Location: '.URL);
			}
		}


		public function calendario()
		{
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "cronograma", true);
			}else{
				header('Location: '.URL);
			}
		}

		public function manteleriaLoza()
		{
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "items", true);
			}else{
				header('Location: '.URL);
			}
		}

		public function eventos()
		{
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "preeventos", true);
			}else{
				header('Location: '.URL);
			}
		}

		public function eventos2()
		{
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "eventos", true);
			}else{
				header('Location: '.URL);
			}
		}

		public function pMenu(){

			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "cocina", true);
			}else{
				header('Location: '.URL);
			}


		}
		public function pBitacora(){

			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "bitacora", true);
			}else{
				header('Location: '.URL);
			}


		}
		public function pInfo(){

			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "crear_evento", true);
			}else{
				header('Location: '.URL);
			}


		}


		public function prueba(){
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			$this->loadOtherModel("Principal");
			$resultados = $this->Principal->getPreEventos();
			$this->view->resultados = $resultados;
			$this->view->render($controller, "preeventos", true);
		}

		public function prueba2(){
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			$this->loadOtherModel("Principal");
			$resultados = $this->Principal->getEventos();
			$this->view->resultados = $resultados;
			$this->view->render($controller, "eventos", true);
		}


		public function notFound()
		{
			$this->loadOtherModel('Principal');
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			$verificar = $this->Principal->verificarID($control);
			if( $control != null && $control == $verificar['u.idTipoUsuario']){
				echo 	"<script>
							window.location = '".URL.$controller."';
						</script>";
			}else{
				echo "<script>window.location ='".URL."';</script>";
			}
		}

		public function tabsEventos(){
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "tabsEventos", true);
			}else{
				header('Location: '.URL);
			}

		}

		public function tabsCalendario(){
			$control = Session::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "tabsCalendario", true);
			}else{
				header('Location: '.URL);
			}

		}

		public function pPruebaMenu(){
			$control = SESSION::getValue('idTipoUsuario');
			$controller = Session::getValue('Controller');
			if( $control != null){
				$this->view->render($controller, "pruebaM", true);
			}else{
				header('Location: '.URL);
			}


		}



	}

 ?>
