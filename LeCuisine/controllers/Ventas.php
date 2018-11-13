<?php

	Class Ventas extends Controller{

		function __construct(){
			parent::__construct();
		}

		/*Acceder a la pantalla principal de VENTAS*/

		public function index()
		{
			$control =  SESSION::getValue('Usuario');
			$id = SESSION::getValue('idTipoUsuario');
			$verificar = $this->model->verificarID($id);
			if( $control != null  && $id != null && $id == $verificar[0]['Tipo']){
				$this->view->render($this, "index");
				echo("<script>sessionStorage.setItem('controller','".Session::getValue('Controller')."')</script>");
				echo "<script>sessionStorage.removeItem('idEventoCreado')</script>";
				echo "<script>sessionStorage.removeItem('arrayBebida5')</script>";
				echo "<script>sessionStorage.removeItem('arrayBebida4')</script>";
				echo "<script>sessionStorage.removeItem('arrayBebida3')</script>";
				echo "<script>sessionStorage.removeItem('arrayBebida2')</script>";
				echo "<script>sessionStorage.removeItem('arrayBebida1')</script>";
			}else{
				header('Location: '.URL);
			}

		}

		public function infoEv(){
			$control =  SESSION::getValue('Usuario');
			$id = SESSION::getValue('idTipoUsuario');
			$verificar = $this->model->verificarID($id);
			if( $control != null  && $id != null && $id == $verificar[0]['Tipo']){
				$resultados = $this->model->getInfo($id);
				print_r($resultados);
			}
		}

		public function verEvento(){

			$id = $_GET['id'];
			$control =  SESSION::getValue('Usuario');
			$resultado = $this->model->getEvento($id);
			print_r($resultado);

		}

		public function verPreevento(){

			$id = $_GET['id'];
			$control =  SESSION::getValue('Usuario');
			$resultado = $this->model->getPreevento($id);
			print_r($resultado);

		}



		public function tabs()
		{
			$control =  SESSION::getValue('Usuario');
			$id = SESSION::getValue('idTipoUsuario');
			$verificar = $this->model->verificarID($id);
			echo 1;
			if( $control != null  && $id != null && $id == $verificar[0]['Tipo']){
				$this->view->render($this, "tabs");
			}else{
				header('Location: '.URL);
			}

		}

		public function CE()
		{
			$control =  SESSION::getValue('Usuario');
			$id = SESSION::getValue('idTipoUsuario');
			$verificar = $this->model->verificarID($id);
			if( $control != null  && $id != null && $id == $verificar[0]['Tipo']){
				$this->view->render($this, "crear_evento");
			}else{
				header('Location: '.URL);
			}
		}

		public function cocina(){
			$control =  SESSION::getValue('Usuario');
			$id = SESSION::getValue('idTipoUsuario');
			$verificar = $this->model->verificarID($id);
			if( $control != null  && $id != null && $id == $verificar[0]['Tipo']){
				$this->view->render($this, "cocina");
			}else{
				header('Location: '.URL);
			}
		}

		public function caratula()
		{
			if (empty($_POST)) {
				echo "no";
			}else{


				//POST de valores TABLA evento_
				$fecha = $_POST['fecha']." ".date('H:i:s');
				$vendedor = $_POST['vendedor'];
				$calle = $_POST['calle'];
				$lugarEvento = $_POST['lugarEvento'];
				$telLugarEvento = $_POST['telLugarEvento'];
				$colonia = $_POST['colonia'];
				$municipio = $_POST['municipio'];
				$estado = $_POST['estado'];
				$EntreCalles = $_POST['EntreCalles'];
				$hreventoIn = $_POST['hreventoIn'];
				$hreventoFi = $_POST['hreventoFi'];
				$hrecepIn = $_POST['hrecepIn'];
				$hrecepFi = $_POST['hrecepFi'];
				$hrcoctelIn = $_POST['hrcoctelIn'];
				$hrcoctelFi = $_POST['hrcoctelFi'];
				$hrbanqueteIn = $_POST['hrbanqueteIn'];
				$hrbanqueteFi = $_POST['hrbanqueteFi'];
				$hrtornaIn = $_POST['hrtornaIn'];
				$hrtornaFi = $_POST['hrtornaFi'];
				$hrotroIn = $_POST['hrotroIn'];
				$hrotroFi = $_POST['hrotroFi'];

				$insertEvento = $this->model->insertEvento($fecha, $vendedor, $lugarEvento, $calle, $colonia, $municipio, $estado, $EntreCalles, $hreventoIn, $hreventoFi, $hrecepIn, $hrecepFi, $hrcoctelIn, $hrcoctelFi, $hrbanqueteIn, $hrbanqueteFi, $hrtornaIn, $hrtornaFi, $hrotroIn, $hrotroFi, $telLugarEvento);

				if ($insertEvento == '1') {
					$id = $this->model->selectId($fecha, $vendedor);
					$idEvento = $id['idEvento'];

					//POST de valores TABLA contratante
					$nombre = $_POST['nombre'];
					$empresa = $_POST['empresa'];
					$tel = $_POST['tel'];
					$telSecu = $_POST['telSecu'];
					$mail = $_POST['mail'];
					$mailSecu = $_POST['mailSecu'];
					$contactoInvolucrado = $_POST['contactoInvolucrado'];

					$insertCon = $this->model->insertCon($nombre, $empresa, $tel, $telSecu, $mail, $mailSecu, $contactoInvolucrado, $idEvento);

					//POST valores tabla descripcionevento
					$timepo = $_POST['timepo'];
					$torna = $_POST['torna'];
					$tiposervicio = $_POST['tiposervicio'];
					$tipoEvento = $_POST['tipoEvento'];
					$Hostess = $_POST['Hostess'];
					$PersonalSeguridad = $_POST['PersonalSeguridad'];
					$PersonalBanos = $_POST['PersonalBanos'];
					$hrservicio = $_POST['hrservicio'];
					$totalpersona = $_POST['totalpersona'];
					$totalAdulto = $_POST['totalAdulto'];
					$margen = $_POST['margen'];
					$niño = $_POST['niño'];
					$menu = $_POST['menu'];
					$menuCantidad = $_POST['menuCantidad'];
					$impresos = $_POST['impresos'];
					$numimpresos = $_POST['numimpresos'];
					$inserDesc = $this->model->inserDesc($timepo, $torna, $tiposervicio, $tipoEvento, $totalpersona, $totalAdulto, $margen, $niño, $menu, $menuCantidad, $impresos, $numimpresos, $Hostess, $PersonalSeguridad, $hrservicio, $PersonalBanos, $idEvento);

					//POST valores tabla equipo_operativo
					$entregaFe = $_POST['entregaFe'];
					$entregaHr = $_POST['entregaHr'];
					$premontajeFe = $_POST['premontajeFe'];
					$premontajeHr = $_POST['premontajeHr'];
					$numper = $_POST['numper'];
					$montajeFe = $_POST['montajeFe'];
					$montajeHr = $_POST['montajeHr'];
					$insertEO = $this->model->insertEO($entregaFe, $entregaHr, $premontajeFe, $premontajeHr, $numper, $montajeFe, $montajeHr, $idEvento);


					//POST valores tabla operativo_servicio
					$hrservicio = $_POST['hrservicio'];
					$capitan = $_POST['capitan'];
					$supervisor = $_POST['supervisor'];
					$mesero = $_POST['mesero'];
					$insertOP = $this->model->insertOP($hrservicio, $capitan, $supervisor, $mesero, $idEvento);

					//POST valores tabla proveedores_externos
					$info = $_POST['info'];
					$insertPE = $this->model->insertPE($info, $idEvento);

					if($insertCon == '1' && $inserDesc == '1' && $insertEO == '1' && $insertOP == '1' && $insertPE == '1'){
						echo $idEvento;

					}
				}else{
					echo "noID";
				}
			}
		}




		public function cocinaInsert()
		{
			if (empty($_POST)) {
				echo "NO DATA";
			}else{
				$idEvento = $_POST['idEvento'];


				/*TABLA menu*/
				$bocadillos = $_POST['bocadillos'];
				$entremes = $_POST['entremes'];
				$sopaCrema = $_POST['sopaCrema'];
				$platoFuerte = $_POST['platoFuerte'];
				$menuInfantil = $_POST['menuInfantil'];
				$tornaFiestaTipo = $_POST['tornaFiestaTipo'];
				$numTorna = $_POST['numTorna'];
				$descTorna = $_POST['descTorna'];
				$postres = $_POST['postres'];

				$insertMenu = $this->model->insertMenu($bocadillos, $entremes, $sopaCrema, $platoFuerte, $menuInfantil, $tornaFiestaTipo, $numTorna, $descTorna, $postres, $idEvento);


				if($insertMenu == '1'){

					$getMenu = $this->model->getMenu($idEvento);
					$idMenu = $getMenu['idMenu'];


					/*TABLA pan*/
					$pan = $_POST['pan'];
					$insertPan = $this->model->insertPan($pan, $idMenu);

					/*TABLA bebida*/
					if(empty($_POST['bebidas1'])){
						$b1 = "";
					}else{
						$b1 = $_POST['bebidas1'];
					}

					if(empty($_POST['bebidas2'])){
						$b2 = "";
					}else{
						$b2 = $_POST['bebidas2'];
					}

					if(empty($_POST['bebidas3'])){
						$b3 = "";
					}else{
						$b3 = $_POST['bebidas3'];
					}

					if(empty($_POST['bebidas4'])){
						$b4 = "";
					}else{
						$b4 = $_POST['bebidas4'];
					}

					if(empty($_POST['bebidas5'])){
						$b5 = "";
					}else{
						$b5 = $_POST['bebidas5'];
					}




					if ($b1 != "") {
						$a = explode("/", $b1);
						$NombreBebida = $a[1];
						$CategoriaBebida = $a[0];
						if($NombreBebida != "	NO"){
							$insertBebida1 = $this->model->insertBebida($NombreBebida, $CategoriaBebida, $idMenu);
						}

					}else{
						$insertBebida1 = "1";
					}

					if ($b2 != "") {
						$a = explode("/", $b2);
						$NombreBebida = $a[1];
						$CategoriaBebida = $a[0];
						if($NombreBebida != "	NO"){
							$insertBebida2 = $this->model->insertBebida($NombreBebida, $CategoriaBebida, $idMenu);
						}

					}else{
						$insertBebida2 = "1";
					}

					if ($b3 != "") {
						$a = explode("/", $b3);
						$NombreBebida = $a[1];
						$CategoriaBebida = $a[0];
						if($NombreBebida != "	NO"){
							$insertBebida3 = $this->model->insertBebida($NombreBebida, $CategoriaBebida, $idMenu);
						}

					}else{
						$insertBebida3 = "1";
					}

					if ($b4 != "") {
						$a = explode("/", $b4);
						$NombreBebida = $a[1];
						$CategoriaBebida = $a[0];
						if($NombreBebida != "	NO"){
							$insertBebida4 = $this->model->insertBebida($NombreBebida, $CategoriaBebida, $idMenu);
						}


					}else{
						$insertBebida4 = "1";
					}
					if ($b5 != "") {
						$a = explode("/", $b5);
						$NombreBebida = $a[1];
						$CategoriaBebida = $a[0];
						if($NombreBebida != "	NO"){
							$insertBebida5 = $this->model->insertBebida($NombreBebida, $CategoriaBebida, $idMenu);
						}

					}else{
						$insertBebida5 = "1";
					}


					/*TABLA vajilla*/
					$vajilla = $_POST['vajilla'];

					$insertVajilla = $this->model->insertVajilla($vajilla, $idMenu);

					/*TABLA equipo_cocina*/
					$estufones = $_POST['estufones'];
					$numEstufones = $_POST['numEstufones'];
					$estufa3Quemadores = $_POST['estufa3Quemadores'];
					$numEstufa3Q = $_POST['numEstufa3Q'];
					$pulpo = $_POST['pulpo'];
					$numPulpo = $_POST['numPulpo'];
					$horno = $_POST['horno'];
					$numHorno = $_POST['numHorno'];
					$tanqueGas = $_POST['tanqueGas'];
					$numTanquesGas = $_POST['numTanquesGas'];
					$tablones = $_POST['tablones'];
					$numTablones = $_POST['numTablones'];
					$garrafones = $_POST['garrafones'];
					$numGarrafones = $_POST['numGarrafones'];
					$otrosFinal = $_POST['otrosFinal'];

					$insertEquipoCocina1 = $this->model->insertEquipoCocina($estufones, $numEstufones, $idEvento);
					$insertEquipoCocina2 = $this->model->insertEquipoCocina($estufa3Quemadores, $numEstufa3Q, $idEvento);
					$insertEquipoCocina3 = $this->model->insertEquipoCocina($pulpo, $numPulpo, $idEvento);
					$insertEquipoCocina4 = $this->model->insertEquipoCocina($horno, $numHorno, $idEvento);
					$insertEquipoCocina5 = $this->model->insertEquipoCocina($tanqueGas, $numTanquesGas, $idEvento);
					$insertEquipoCocina6 = $this->model->insertEquipoCocina($tablones, $numTablones, $idEvento);
					$insertEquipoCocina7 = $this->model->insertEquipoCocina($garrafones, $numGarrafones, $idEvento);
					$insertEquipoCocina8 = $this->model->insertEquipoCocinaOtros($otrosFinal, $idEvento);

					if ($insertPan == '1' && $insertBebida1 == '1' && $insertBebida2 == '1' && $insertBebida3 == '1'
 						&& $insertBebida4 == '1' && $insertBebida5 == '1' && $insertVajilla == '1'
 						&& $insertEquipoCocina1 == '1' && $insertEquipoCocina2 == '1' && $insertEquipoCocina3 == '1'
 						&& $insertEquipoCocina4 == '1' && $insertEquipoCocina5 == '1' && $insertEquipoCocina6 == '1'
 						&& $insertEquipoCocina7 == '1' && $insertEquipoCocina8 == '1') {

						echo "YES";
					}else{
						echo "NoINSERT";
					}

				}else{
					echo "NO COCINA/MENU";
				}



			}
		}



		public function  scouting(){
			if (empty($_POST)) {
				echo "NO";
			}else{

				/*TABLA protocolo_acceso*/
				$idEvento = $_POST['id'];
				$fechaScout = $_POST['fechaScout'];
				$INE = $_POST['INE'];
				$listaPersonal = $_POST['listaPersonal'];
				$listaVehiculos = $_POST['listaVehiculos'];
				$altaIMSS = $_POST['altaIMSS'];
				$cartaResponsiva = $_POST['cartaResponsiva'];
				$zapatosSeguridad = $_POST['zapatosSeguridad'];
				$cascoSeguridad = $_POST['cascoSeguridad'];
				$lentesSeguridad = $_POST['lentesSeguridad'];
				$chalecoSeguridad = $_POST['chalecoSeguridad'];
				$arnes = $_POST['arnes'];
				$guantesSeguridad = $_POST['guantesSeguridad'];
				$extintores = $_POST['extintores'];
				$ingresaVehiculo = $_POST['ingresaVehiculo'];
				$estacionamientoInvitados = $_POST['estacionamientoInvitados'];
				$estacionamientoProveedor = $_POST['estacionamientoProveedor'];
				$valetParking = $_POST['valetParking'];

				$insertProtocolo = $this->model->insertProtocolo($idEvento,$fechaScout,$INE,$listaPersonal,$listaVehiculos,$altaIMSS,$cartaResponsiva,$zapatosSeguridad,$cascoSeguridad,$lentesSeguridad,$chalecoSeguridad,$arnes,$guantesSeguridad,$extintores,$ingresaVehiculo,$estacionamientoInvitados,$estacionamientoProveedor,$valetParking);


				/*TABLA logistica_entrega*/
				$horarioAcceso = $_POST['horarioAcceso'];
				$lugarAlmacenamiento = $_POST['lugarAlmacenamiento'];
				$responsableLugar = $_POST['responsableLugar'];

				$insertLog = $this->model->insertLog($idEvento,$horarioAcceso,$lugarAlmacenamiento,$responsableLugar);



				/*TABLA scouting1*/
				$ubicacionBanos = $_POST['ubicacionBanos'];
				$tipoBanos = $_POST['tipoBanos'];
				$carpaComensales = $_POST['carpaComensales'];
				$carpaCocina = $_POST['carpaCocina'];
				$carpaV = $_POST['carpaV'];
				$cortinas = $_POST['cortinas'];
				$sombrilla = $_POST['sombrilla'];
				$ubicacionBar = $_POST['ubicacionBar'];
				$ubicacionOperativo = $_POST['ubicacionOperativo'];
				$espacioBar = $_POST['espacioBar'];
				$espacioOperativo = $_POST['espacioOperativo'];

				$insertScouting1 = $this->model->insertScouting1($ubicacionBanos,$tipoBanos,$carpaComensales,$carpaCocina,$carpaV,$cortinas,$sombrilla,$ubicacionBar,$ubicacionOperativo,$espacioBar,$espacioOperativo, $idEvento);





				/*TABLA scouting2*/
				$espacioMetros = $_POST['espacioMetros'];
				$personasMesa = $_POST['personasMesa'];
				$metrosPista = $_POST['metrosPista'];
				$montajeEspecial = $_POST['montajeEspecial'];
				$calidadIlumacion = $_POST['calidadIlumacion'];
				$iluminacionCocina = $_POST['iluminacionCocina'];
				$plantaLuz = $_POST['plantaLuz'];
				$cerradoCuatroParedes = $_POST['cerradoCuatroParedes'];
				$accesoIndependiente = $_POST['accesoIndependiente'];
				$calidadIlumacionCocina = $_POST['calidadIlumacionCocina'];
				$ventilacion = $_POST['ventilacion'];
				$aguaPotable = $_POST['aguaPotable'];
				$corrienteElectrica = $_POST['corrienteElectrica'];
				$tipoSuelo = $_POST['tipoSuelo'];
				$alturaLugar = $_POST['alturaLugar'];
				$distanciaCocinaComedor = $_POST['distanciaCocinaComedor'];

				$insertScouting2 = $this->model->insertScouting2($espacioMetros,$personasMesa,$metrosPista,$montajeEspecial,$calidadIlumacion,$iluminacionCocina,$plantaLuz,$cerradoCuatroParedes,$accesoIndependiente,$calidadIlumacionCocina,	$ventilacion,	$aguaPotable,$corrienteElectrica,$tipoSuelo,$alturaLugar,$distanciaCocinaComedor,$idEvento);


				if($insertProtocolo == '1' && $insertLog == '1' && $insertScouting1 == '1' && $insertScouting2 == '1'){
					echo "1";
				}




			}
		}



		public function preEvento(){
			$fechaEvento = $_POST['fechaEvento'];
			$vendedor = $_POST['vendedor'];
			$tipoCliente = $_POST['tipoCliente'];
			$contacto = $_POST['contacto'];
			$estadoCiudad = $_POST['estadoCiudad'];
			$empresa = $_POST['empresa'];
			$tipoEmpresa = $_POST['tipoEmpresa'];
			$telContacto = $_POST['telContacto'];
			$telContacto2 = $_POST['telContacto2'];
			$email = $_POST['email'];
			$email2 = $_POST['email2'];
			$tipoEvento = $_POST['tipoEvento'];
			$lugar = $_POST['lugar'];
			$calleNumero = $_POST['calleNumero'];
			$colonia = $_POST['colonia'];
			$municipio = $_POST['municipio'];
			$estado = $_POST['estado'];
			$tel = $_POST['tel'];
			$entreCalles = $_POST['entreCalles'];
			$codigoPostal = $_POST['codigoPostal'];
			$totalPersonas = $_POST['totalPersonas'];
			$adultos = $_POST['adultos'];
			$ninos = $_POST['ninos'];
			$horario = $_POST['horario'];
			$hrServicio = $_POST['hrServicio'];
			$fechaCita = $_POST['fechaCita'];
			$hrCita = $_POST['hrCita'];
			$metodoCita = $_POST['metodoCita'];
			$hrExtra = $_POST['hrExtra'];
			$costoHr = $_POST['costoHr'];
			$finSub = $_POST['finSub'];
			$finTo = $_POST['finTo'];
			$tempo = "";
			$insertPreevento = $this->model->insertPre($fechaEvento, $vendedor, $tipoCliente, $contacto,
																								$estadoCiudad, $empresa, $tipoEmpresa, $telContacto, $telContacto2, $email,
																								$email2, $tipoEvento, $lugar, $calleNumero, $colonia, $municipio, $estado,
																								$tel, $entreCalles, $codigoPostal, $totalPersonas, $adultos, $ninos, $horario,
																								$hrServicio, $fechaCita, $hrCita, $metodoCita, $hrExtra, $costoHr);


			if($insertPreevento == '1'){
				if($_POST['cotizado']!="NO" && $_POST['cotizado'] !="" ){
					$selectID = $this->model->idPreevento($fechaEvento, $vendedor, $tipoEvento);
					$id = $selectID['idPreevento'];
					$numCoti = explode(",", $_POST['cotizado']);
					$coti;
					$descripcion;
					$cantidad;
					$precio;
					for ($e=0; $e < sizeof($numCoti); $e++) {
						$coti = explode("/",$numCoti[$e]);


						for ($f=0; $f < sizeof($coti); $f++) {
							$descripcion = $coti[0];
							$cantidad = $coti[1];
							$precio = $coti[2];
							if($id != 0){
								$insertCoti = $this->model->insertCoti($descripcion, $cantidad, $precio, $id);
								if($insertCoti == "1"){
									$tempo = "1";
								}
								break;
							}else{
								break;
							}
						}
					}
				}
				if($tempo == "1"){
					echo "10";
				}else{
					echo "1";
				}

			}

		}

		public function UpPreEvento(){
			$idPreevento = $_POST['id'];
			$fechaEvento = $_POST['fechaEvento'];
			$vendedor = $_POST['vendedor'];
			$tipoCliente = $_POST['tipoCliente'];
			$contacto = $_POST['contacto'];
			$estadoCiudad = $_POST['estadoCiudad'];
			$empresa = $_POST['empresa'];
			$tipoEmpresa = $_POST['tipoEmpresa'];
			$telContacto = $_POST['telContacto'];
			$telContacto2 = $_POST['telContacto2'];
			$email = $_POST['email'];
			$email2 = $_POST['email2'];
			$tipoEvento = $_POST['tipoEvento'];
			$lugar = $_POST['lugar'];
			$calleNumero = $_POST['calleNumero'];
			$colonia = $_POST['colonia'];
			$municipio = $_POST['municipio'];
			$estado = $_POST['estado'];
			$tel = $_POST['tel'];
			$entreCalles = $_POST['entreCalles'];
			$codigoPostal = $_POST['codigoPostal'];
			$totalPersonas = $_POST['totalPersonas'];
			$adultos = $_POST['adultos'];
			$ninos = $_POST['ninos'];
			$horario = $_POST['horario'];
			$hrServicio = $_POST['hrServicio'];
			$fechaCita = $_POST['fechaCita'];
			$hrCita = $_POST['hrCita'];
			$metodoCita = $_POST['metodoCita'];
			$hrExtra = $_POST['hrExtra'];
			$costoHr = $_POST['costoHr'];
			$finSub = $_POST['finSub'];
			$finTo = $_POST['finTo'];
			$tempo = "";
			$updatePreevento = $this->model->updatePreevento($idPreevento, $fechaEvento, $vendedor, $tipoCliente, $contacto,
																								$estadoCiudad, $empresa, $tipoEmpresa, $telContacto, $telContacto2, $email,
																								$email2, $tipoEvento, $lugar, $calleNumero, $colonia, $municipio, $estado,
																								$tel, $entreCalles, $codigoPostal, $totalPersonas, $adultos, $ninos, $horario,
																								$hrServicio, $fechaCita, $hrCita, $metodoCita, $hrExtra, $costoHr);


			if($updatePreevento == '1'){
				if($_POST['cotizado']!="NO" && $_POST['cotizado'] !="" ){
					$id = $idPreevento;
					$numCoti = explode(",", $_POST['cotizado']);
					$coti;
					$descripcion;
					$cantidad;
					$precio;
					$deleteCoti = $this->model->deleteCoti($id);
					for ($e=0; $e < sizeof($numCoti); $e++) {
						$coti = explode("/",$numCoti[$e]);


						for ($f=0; $f < sizeof($coti); $f++) {
							$descripcion = $coti[0];
							$cantidad = $coti[1];
							$precio = $coti[2];
							if($id != 0){
								if($deleteCoti == "1"){$insertCoti = $this->model->insertCoti($descripcion, $cantidad, $precio, $id);}
								else{$insertCoti = $this->model->insertCoti($descripcion, $cantidad, $precio, $id);}
								if($insertCoti == "1"){
									$tempo = "1";
								}
								break;
							}else{
								break;
							}
						}
					}
				}
				if($tempo == "1"){
					echo "10";
				}else{
					echo "1";
				}

			}
		}

		public function selectIdPreevento(){
			$fechaEvento = $_POST['fechaEvento'];
			$vendedor = $_POST['vendedor'];
			$tipoEvento = $_POST['tipoEvento'];

			$selectIdPreevento = $this->model->selectIdPreevento($fechaEvento, $vendedor, $tipoEvento);
			echo json_encode($selectIdPreevento);
		}

		public function bita(){
			$fecha = $_POST['fecha'];
			$descripcion = $_POST['descripcion'];
			$id = $_POST['id'];
			$b = "";

			if ($id != 0) {
				$b = $this->model->bitac($fecha, $descripcion, $id);
			}else{
				echo "NO";
			}

			if ($b == '1') {
				echo "si";
			}else{
				echo "NO";
			}
		}

		public function infoBita(){
			$idPreevento = $_POST['id'];
			$selectBita = $this->model->selectBita($idPreevento);
			echo json_encode($selectBita);
		}



	}









 ?>
