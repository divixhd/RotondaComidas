<?php

include"conn.php";
extract($_POST);

if(isset($_POST['readrecords'])){

	$data =  '<table class="table table-bordered table-striped ">
						<tr class="bg-dark text-white">
							<th>Id</th>
							<th>Id Ingrediente 1</th>
							<th>Id Ingrediente 2</th>
							<th>Nombre del Producto</th>
							<th>Descripcion</th>
							<th>Valor Unitario</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>'; 

	$displayquery = " SELECT * FROM `productos` "; 
	$result = mysqli_query($conn,$displayquery);

	if(mysqli_num_rows($result) > 0){
			$num=1;
		
		while ($row = mysqli_fetch_array($result)) {
			
			$data .= '<tr>  
				<td>'.$row['id_producto'].'</td>
				<td>'.$row['id_ingrediente1'].'</td>
				<td>'.$row['id_ingrediente2'].'</td>
				<td>'.$row['nom_producto'].'</td>
				<td>'.$row['descripcion'].'</td>
				<td>'.$row['valor'].'</td>
				<td>
					<button onclick="GetUserDetails('.$row['id_producto'].')" class="btn btn-success">Edit</button>
				</td>
				<td>
					<button onclick="DeleteUser('.$row['id_producto'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		
    		$num++;
		}
	} 
	 $data .= '</table>';
    	echo $data;

}

//adding records in database
if(isset($_POST['id_ingrediente1']) &&  isset($_POST['id_ingrediente2']) && isset($_POST['nom_producto']) && isset($_POST['descripcion']) && isset($_POST['valor']))
	{
		$query = " INSERT INTO `productos`( `id_ingrediente1`, `id_ingrediente2`, `nom_producto`, `descripcion`, `valor`) VALUES('$id_ingrediente1', '$id_ingrediente2', '$nom_producto', '$descripcion', '$valor')   ";

		if($result = mysqli_query($conn,$query)){
			exit(mysqli_error());
		}else{
			echo "1 record added";
		}


	}
	// pass id on modal
if(isset($_POST['id_producto']) && isset($_POST['id_producto']) != "")
{
    $user_id = $_POST['id_producto'];
    $query = "SELECT * FROM productos WHERE id_producto = '$id_producto'";
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

if(isset($_POST['id_producto']))
{
    // get values
    $id_producto = $_POST['id_producto'];
    $id_ingrediente1 = $_POST['id_ingrediente1'];
    $id_ingrediente2 = $_POST['id_ingrediente2'];
    $nom_producto = $_POST['nom_producto'];
    $descripcion = $_POST['descripcion'];
    $valor = $_POST['valor'];
    $query = "UPDATE productos SET id_ingrediente1 = '$id_ingrediente1', id_ingrediente2 = '$id_ingrediente2', nom_producto = '$nom_producto', descripcion='$descripcion', valor='$valor'  WHERE id_producto = '$id_producto'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }
}
/////////////Delete user record /////////

if(isset($_POST['id_producto']))
{

	$id_producto = $_POST['id_producto']; 

	$deletequery = " delete from productos where id_producto ='$id_producto' ";
	if (!$result = mysqli_query($conn,$deletequery)) {
        exit(mysqli_error());

}

}

?>
