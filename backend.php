<?php

include"conn.php";
extract($_POST);

if(isset($_POST['readrecords'])){

	$data =  '<table class="table table-bordered table-striped ">
						<tr class="bg-dark text-white">
							<th>Id</th>
							<th>Nombre Cliente</th>
							<th>Direccion</th>
							<th>Telefono</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>'; 

	$displayquery = " SELECT * FROM `cliente` "; 
	$result = mysqli_query($conn,$displayquery);

	if(mysqli_num_rows($result) > 0){
			$num=1;
		
		while ($row = mysqli_fetch_array($result)) {
			
			$data .= '<tr>  
				<td>'.$row['id_cliente'].'</td>
				<td>'.$row['nombre'].'</td>
				<td>'.$row['direccion'].'</td>
				<td>'.$row['telefono'].'</td>
				<td>
					<button onclick="GetUserDetails('.$row['id_cliente'].')" class="btn btn-success">Edit</button>
				</td>
				<td>
					<button onclick="DeleteUser('.$row['id_cliente'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		
    		$num++;
		}
	} 
	 $data .= '</table>';
    	echo $data;

}

//adding records in database
if(isset($_POST['nombre']) &&  isset($_POST['direccion']) && isset($_POST['telefono']) )
	{
		$query = " INSERT INTO `cliente`( `nombre`, `direccion`, `telefono`) VALUES('$nombre', '$direccion', '$telefono' )   ";

		if($result = mysqli_query($conn,$query)){
			exit(mysqli_error());
		}else{
			echo "1 record added";
		}


	}
	// pass id on modal
if(isset($_POST['id_cliente']) && isset($_POST['id_cliente']) != "")
{
    $user_id = $_POST['id_cliente'];
    $query = "SELECT * FROM cliente WHERE id_cliente = '$user_id'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }
    
    $response = array();

    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
       
            $response = $row;
        }
    }

    else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }


    echo json_encode($response);
}

else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}
//////////////// update table//////////////

if(isset($_POST['id_cliente']))
{
    // get values
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $query = "UPDATE cliente SET nombre = '$nombre', direccion = '$direccion', telefono = '$telefono'  WHERE id_cliente = '$id_cliente'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }
}
/////////////Delete user record /////////

if(isset($_POST['id_cliente']))
{

	$id_cliente = $_POST['id_cliente']; 

	$deletequery = " delete from cliente where id_cliente ='$id_cliente' ";
	if (!$result = mysqli_query($conn,$deletequery)) {
        exit(mysqli_error());

}

}

?>
