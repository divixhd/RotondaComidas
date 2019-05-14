<?php

include"conn.php";
extract($_POST);

if(isset($_POST['readrecords'])){

	$data =  '<table class="table table-bordered table-striped ">
						<tr class="bg-dark text-white">
							<th>Id</th>
							<th>Id Proveedor</th>
							<th>Nombre del Ingrediente</th>
							<th>Descirpcion</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>'; 

	$displayquery = " SELECT * FROM `ingredientes` "; 
	$result = mysqli_query($conn,$displayquery);

	if(mysqli_num_rows($result) > 0){
			$num=1;
		
		while ($row = mysqli_fetch_array($result)) {
			
			$data .= '<tr>  
				<td>'.$row['id_ingrediente'].'</td>
				<td>'.$row['id_proveedor'].'</td>
				<td>'.$row['nom_ingrediente'].'</td>
				<td>'.$row['descripcion'].'</td>
				<td>
					<button onclick="GetUserDetails('.$row['id_ingrediente'].')" class="btn btn-success">Edit</button>
				</td>
				<td>
					<button onclick="DeleteUser('.$row['id_ingrediente'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		
    		$num++;
		}
	} 
	 $data .= '</table>';
    	echo $data;

}

//adding records in database
if(isset($_POST['id_proveedor']) &&  isset($_POST['nom_ingrediente']) && isset($_POST['descripcion']) )
	{
		$query = " INSERT INTO `ingredientes`( `id_proveedor`, `nom_ingrediente`, `descripcion`) VALUES('$id_proveedor', '$nom_ingrediente', '$descripcion' )   ";

		if($result = mysqli_query($conn,$query)){
			exit(mysqli_error());
		}else{
			echo "1 record added";
		}


	}
	// pass id on modal
if(isset($_POST['id_ingrediente']) && isset($_POST['id_ingrediente']) != "")
{
    $id_ingrediente = $_POST['id_ingrediente'];
    $query = "SELECT * FROM ingredientes WHERE id_ingrediente = '$id_ingrediente'";
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

if(isset($_POST['id_ingrediente']))
{
    // get values
    $id_ingrediente = $_POST['id_ingrediente'];
    $id_proveedor = $_POST['id_proveedor'];
    $nom_ingrediente = $_POST['nom_ingrediente'];
    $descripcion = $_POST['descripcion'];
    $query = "UPDATE ingredientes SET id_proveedor = '$id_proveedor', nom_ingrediente = '$nom_ingrediente', descripcion = '$descripcion'  WHERE id_ingrediente = '$id_ingrediente'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }
}
/////////////Delete user record /////////

if(isset($_POST['id_ingrediente']))
{

	$id_ingrediente = $_POST['id_ingrediente']; 

	$deletequery = " DELETE from ingredientes where id_ingrediente ='$id_ingrediente' ";
	if (!$result = mysqli_query($conn,$deletequery)) {
        exit(mysqli_error());

}

}

?>
