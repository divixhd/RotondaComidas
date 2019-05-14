<?php

include"conn.php";
extract($_POST);

if(isset($_POST['readrecords'])){

	$data =  '<table class="table table-bordered table-striped ">
						<tr class="bg-dark text-white">
							<th>Id</th>
							<th>Nombre del Proveedor</th>
							<th>Descirpcion</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>'; 

	$displayquery = " SELECT * FROM `proveedor` "; 
	$result = mysqli_query($conn,$displayquery);

	if(mysqli_num_rows($result) > 0){
			$num=1;
		
		while ($row = mysqli_fetch_array($result)) {
			
			$data .= '<tr>  
				<td>'.$row['id_proveedor'].'</td>
				<td>'.$row['nom_proveedor'].'</td>
				<td>'.$row['descripcion'].'</td>
				<td>
					<button onclick="GetUserDetails('.$row['id_proveedor'].')" class="btn btn-success">Edit</button>
				</td>
				<td>
					<button onclick="DeleteUser('.$row['id_proveedor'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		
    		$num++;
		}
	} 
	 $data .= '</table>';
    	echo $data;

}

//adding records in database
if(isset($_POST['nom_proveedor']) && isset($_POST['descripcion']) )
	{
		$query = " INSERT INTO `proveedor`( `nom_proveedor`, `descripcion`) VALUES('$nom_proveedor', '$descripcion' )   ";

		if($result = mysqli_query($conn,$query)){
			exit(mysqli_error());
		}else{
			echo "1 record added";
		}


	}
	// pass id on modal
if(isset($_POST['id_proveedor']) && isset($_POST['id_proveedor']) != "")
{
    $id_proveedor = $_POST['id_proveedor'];
    $query = "SELECT * FROM proveedor WHERE id_proveedor = '$id_proveedor'";
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

if(isset($_POST['id_proveedor']))
{
    // get values
    $id_proveedor = $_POST['id_proveedor'];
    $nom_proveedor = $_POST['nom_proveedor'];
    $descripcion = $_POST['descripcion'];
    $query = "UPDATE proveedor SET nom_proveedor = '$nom_proveedor', descripcion = '$descripcion'  WHERE id_proveedor = '$id_proveedor'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }
}
/////////////Delete user record /////////

if(isset($_POST['id_proveedor']))
{

	$id_proveedor = $_POST['id_proveedor']; 

	$deletequery = " DELETE from proveedor where id_proveedor ='$id_proveedor' ";
	if (!$result = mysqli_query($conn,$deletequery)) {
        exit(mysqli_error());

}

}

?>
