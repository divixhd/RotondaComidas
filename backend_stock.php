<?php

include"conn.php";
extract($_POST);

if(isset($_POST['readrecords'])){

	$data =  '<table class="table table-bordered table-striped ">
						<tr class="bg-dark text-white">
							<th>Id</th>
							<th>Id Ingrediente</th>
							<th>Id Producto</th>
							<th>Cantidad Disponible</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>'; 

	$displayquery = " SELECT * FROM `stock` "; 
	$result = mysqli_query($conn,$displayquery);

	if(mysqli_num_rows($result) > 0){
			$num=1;
		
		while ($row = mysqli_fetch_array($result)) {
			
			$data .= '<tr>  
				<td>'.$row['id_stock'].'</td>
				<td>'.$row['id_ingrediente'].'</td>
				<td>'.$row['id_producto'].'</td>
				<td>'.$row['cantidad_disponible'].'</td>
				<td>
					<button onclick="GetUserDetails('.$row['id_stock'].')" class="btn btn-success">Edit</button>
				</td>
				<td>
					<button onclick="DeleteUser('.$row['id_stock'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		
    		$num++;
		}
	} 
	 $data .= '</table>';
    	echo $data;

}

//adding records in database
if(isset($_POST['id_ingrediente']) &&  isset($_POST['id_producto']) && isset($_POST['cantidad_disponible']) )
	{
		$query = " INSERT INTO `stock`( `id_ingrediente`, `id_producto`, `cantidad_disponible`) VALUES('$id_ingrediente', '$id_producto', '$cantidad_disponible' )   ";

		if($result = mysqli_query($conn,$query)){
			exit(mysqli_error());
		}else{
			echo "1 record added";
		}


	}
	// pass id on modal
if(isset($_POST['id_stock']) && isset($_POST['id_stock']) != "")
{
    $id_stock = $_POST['id_stock'];
    $query = "SELECT * FROM stock WHERE id_stock = '$id_stock'";
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

if(isset($_POST['id_stock']))
{
    // get values
    $id_stock = $_POST['id_stock'];
    $id_ingrediente = $_POST['id_ingrediente'];
    $id_producto = $_POST['id_producto'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    $query = "UPDATE stock SET id_ingrediente = '$id_ingrediente', id_producto = '$id_producto', cantidad_disponible = '$cantidad_disponible'  WHERE id_stock = '$id_stock'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }
}
/////////////Delete user record /////////

if(isset($_POST['id_stock']))
{

	$id_stock = $_POST['id_stock']; 

	$deletequery = " DELETE from stock where id_stock ='$id_stock' ";
	if (!$result = mysqli_query($conn,$deletequery)) {
        exit(mysqli_error());

}

}

?>
