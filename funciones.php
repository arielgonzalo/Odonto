<?php
//Metodo que nos deje conectarnos a la base de datos
$Conexion = null;

function ConectarBD(){
	global $Conexion;
	//mysqli_connect es el metodo que me permite conectarme a la base de datos y como parametro el servidor, el usuario, la clave y el nombre de la base.
	$Conexion = mysqli_connect("localhost", "root", "", "clinicaodontologica");
	//Retorna el codigo del error. Plan A.
	if(mysqli_connect_errno()){
		//Retorna la descripcion del error
		//echo("Error en conexion".mysql_connect_error());
	}
	//Para validar el error. Plan B.
	/*if(!$Conexion){
		echo("No se establecio la conexion con la BD");
		exit();
	}
	echo("Se establecio la conexion");*/
}


function AgregarPersona(){
	global $Conexion;
	ConectarBD();
	//prepare = de forma preconfigurada, manda una sentencia al servidor pero no lo ejecuta
	//? es una variable de macrosustitucion que despues se sustituye con los valores reales
	$sentencia = $Conexion -> prepare("Insert into persona (IdPersona, Nombre,Apellido1,Apellido2,FechaNacimiento) values (?,?,?,?,?)");
	//como parametro, es el tipo de dato de los valores, despues darle nombre a cada espacio
	//bind_param asocia cada variable que tengo que macrosustituir con una variable php
	$sentencia -> bind_param('sssss', $P1, $P2, $P3, $P4, $P5);
	$parametros = json_decode($_POST['Objeto']);
	$P1 = $parametros ->{'IdPersona'};
	$P2 = $parametros ->{'Nombre'};
	$P3 = $parametros ->{'Apellido1'};
	$P4 = $parametros ->{'Apellido2'};
	$P5 = $parametros ->{'FechaNacimiento'};
	$sentencia -> execute();
	$ObjRetorno = array('Resultado' => true);
	$sentencia -> close();
	$Conexion -> close();
	echo json_encode($ObjRetorno,JSON_FORCE_OBJECT);
}

function AgregarCliente(){
	global $Conexion;
	ConectarBD();
	//prepare = de forma preconfigurada, manda una sentencia al servidor pero no lo ejecuta
	//? es una variable de macrosustitucion que despues se sustituye con los valores reales
	$sentencia = $Conexion -> prepare("Insert into cliente (FechaIngresado, Activo, IdPersona) values (?,?,?)");
	//como parametro, es el tipo de dato de los valores, despues darle nombre a cada espacio
	//bind_param asocia cada variable que tengo que macrosustituir con una variable php
	$sentencia -> bind_param('sis', $P1, $P2, $P3);
	$parametros = json_decode($_POST['Objeto']);
	$P1 = $parametros ->{'FechaIngresado'};
	$P2 = $parametros ->{'Activo'};
	$P3 = $parametros ->{'IdPersona'};
	$sentencia -> execute();
	$ObjRetorno = array('Resultado' => true);
	$sentencia -> close();
	$Conexion -> close();
	echo json_encode($ObjRetorno,JSON_FORCE_OBJECT);
}

function AgregarTelefono(){
	global $Conexion;
	ConectarBD();
	//prepare = de forma preconfigurada, manda una sentencia al servidor pero no lo ejecuta
	//? es una variable de macrosustitucion que despues se sustituye con los valores reales
	$sentencia = $Conexion -> prepare("Insert into telefono (IdTelefono, FechaIngresado, Activo, IdPersona, IdTipoTelefono) values (?,?,?,?,?)");
	//como parametro, es el tipo de dato de los valores, despues darle nombre a cada espacio
	//bind_param asocia cada variable que tengo que macrosustituir con una variable php
	$sentencia -> bind_param('ssisi', $P1, $P2, $P3, $P4, $P5);
	$parametros = json_decode($_POST['Objeto']);
	$P1 = $parametros ->{'IdTelefono'};
	$P2 = $parametros ->{'FechaIngresado'};
	$P3 = $parametros ->{'Activo'};
	$P4 = $parametros ->{'IdPersona'};
	$P5 = $parametros ->{'IdTipoTelefono'};
	$sentencia -> execute();
	$ObjRetorno = array('Resultado' => true);
	$sentencia -> close();
	$Conexion -> close();
	echo json_encode($ObjRetorno,JSON_FORCE_OBJECT);
}

function AgregarCorreo(){
	global $Conexion;
	ConectarBD();
	//prepare = de forma preconfigurada, manda una sentencia al servidor pero no lo ejecuta
	//? es una variable de macrosustitucion que despues se sustituye con los valores reales
	$sentencia = $Conexion -> prepare("Insert into correo (IdCorreo, FechaIngresado, Activo, IdPersona, IdTipoCorreo) values (?,?,?,?,?)");
	//como parametro, es el tipo de dato de los valores, despues darle nombre a cada espacio
	//bind_param asocia cada variable que tengo que macrosustituir con una variable php
	$sentencia -> bind_param('ssisi', $P1, $P2, $P3, $P4, $P5);
	$parametros = json_decode($_POST['Objeto']);
	$P1 = $parametros ->{'IdCorreo'};
	$P2 = $parametros ->{'FechaIngresado'};
	$P3 = $parametros ->{'Activo'};
	$P4 = $parametros ->{'IdPersona'};
	$P5 = $parametros ->{'IdTipoCorreo'};
	$sentencia -> execute();
	$ObjRetorno = array('Resultado' => true);
	$sentencia -> close();
	$Conexion -> close();
	echo json_encode($ObjRetorno,JSON_FORCE_OBJECT);
}

function AgregarTrabajo(){

	global $Conexion;
	ConectarBD();
	//prepare = de forma preconfigurada, manda una sentencia al servidor pero no lo ejecuta
	//? es una variable de macrosustitucion que despues se sustituye con los valores reales
	$sentencia = $Conexion -> prepare("Insert into trabajorealizado (Tratamiento, idDiente, idProtesis, idExpediente) values (?,?,?,?)");
	//como parametro, es el tipo de dato de los valores, despues darle nombre a cada espacio
	//bind_param asocia cada variable que tengo que macrosustituir con una variable php
	$sentencia -> bind_param('siii', $P1, $P2, $P3, $P4);
	$parametros = json_decode($_POST['Objeto']);
	$P1 = $parametros ->{'Tratamiento'};
	$P2 = $parametros ->{'IdDiente'};
	$P3 = $parametros ->{'IdProtesis'};
	$P4 = $parametros ->{'IdExpediente'};
	$sentencia -> execute();
	$ObjRetorno = array('Resultado' => true);
	$sentencia -> close();
	$Conexion -> close();
	echo json_encode($ObjRetorno,JSON_FORCE_OBJECT);

}

function ConsultarTratamiento(){
	global $Conexion;
	ConectarBD();
	//La sentencia que le quiero mandar a la base de datos
	$sql = "SELECT  * FROM trabajorealizado where IdTrabajoRealizado=(select max(IdTrabajoRealizado) from trabajorealizado where IdDiente = ?) ";
	//Variable para guardar los datos de ese sentencia sql cuyo parametro es la variable de conexion
	$stmt =  $Conexion -> stmt_init();
	$stmt->prepare($sql);
	$stmt -> bind_param('s', $P1);
	$parametros = json_decode($_POST['Objeto']);
	$P1 = $parametros ->{'IdDiente'};
	$Resultado = $stmt->get_result();
	//mysqli_fetch_object(#Resultado) = devuelve una tabla
	//mysqli_fetch_array(#Resultado) = devuelve un arreglo
	//mysqli_fetch_assoc(#Resultado) = devuelve un arreglo asociativo; por ejemplo, array("IdEmpleado" => 1, "NombreEmpleado" => "Carlos")
	while($row = $result->fetch_array(MYSQLI_NUM)){
		
		foreach ($row as $r)
            {
                print $r) ;
            }
		

	}
	mysqli_free_result($Resultado);
	mysqli_close($Conexion);
}

switch ($_POST['Metodo']) {
	case 'MtoAgregar':
		AgregarPersona();
		AgregarCliente();
		AgregarTelefono();
		AgregarCorreo();
		break;
	case 'AgregarTrabajo':
		AgregarTrabajo();
		break;
		case 'MtoTratamiento':
		ConsultarTratamiento();
		break;
	default:

		break;
};
?>