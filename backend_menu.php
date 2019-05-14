<?php

include"conn.php";
extract($_POST);

if(isset($_POST['readrecords'])){

	$data =  '<table class="table table-bordered table-striped ">
						<tr class="bg-dark text-white">
							<th>Id</th>
							<th>Id Cliente</th>
							<th>Id Producto</th>
							<th>Id Stock</th>
							<th>Cantidad</th>
							<th>Valor Unitario</th>
							<th>Total</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>'; 

	$displayquery = " SELECT * FROM `menu` "; 
	$result = mysqli_query($conn,$displayquery);

	if(mysqli_num_rows($result) > 0){
			$num=1;
		
		while ($row = mysqli_fetch_array($result)) {
			
			$data .= '<tr>  
				<td>'.$row['id_menu'].'</td>
				<td>'.$row['id_cliente'].'</td>
				<td>'.$row['id_producto'].'</td>
				<td>'.$row['id_stock'].'</td>
				<td>'.$row['cantidad'].'</td>
				<td>'.$row['valor_unitario'].'</td>
				<td>'.$row['total'].'</td>
				<td>
					<button onclick="GetUserDetails('.$row['id_menu'].')" class="btn btn-success">Edit</button>
				</td>
				<td>
					<button onclick="DeleteUser('.$row['id_menu'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		
    		$num++;
		}
	} 
	 $data .= '</table>';
    	echo $data;

}

//adding records in database
if(isset($_POST['id_cliente']) &&  isset($_POST['id_producto']) &&  isset($_POST['id_stock']) &&  isset($_POST['cantidad']) &&  isset($_POST['valor_unitario']) && isset($_POST['total']) )
	{
		$query = " INSERT INTO `menu`( `id_cliente`, `id_producto`, `id_stock`, `cantidad`, `valor_unitario`, `total`) VALUES('$id_cliente', '$id_producto', '$id_stock', '$cantidad', '$valor_unitario', '$total' )   ";

		if($result = mysqli_query($conn,$query)){
			exit(mysqli_error());
		}else{
			echo "1 record added";
		}


	}
	// pass id on modal
if(isset($_POST['id_menu']) && isset($_POST['id_menu']) != "")
{
    $id_menu = $_POST['id_menu'];
    $query = "SELECT * FROM menu WHERE id_menu = '$id_menu'";
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

if(isset($_POST['id_menu']))
{
    // get values
    $id_menu = $_POST['id_menu'];
    $id_cliente = $_POST['id_cliente'];
    $id_producto = $_POST['id_producto'];
    $id_stock = $_POST['id_stock'];
    $cantidad = $_POST['cantidad'];
    $valor_unitario = $_POST['valor_unitario'];
    $total = $_POST['total'];
    $query = "UPDATE menu SET id_cliente = '$id_cliente', id_producto = '$id_producto', id_stock = '$id_stock', cantidad = '$cantidad', valor_unitario = '$valor_unitario', total = '$total'  WHERE id_menu = '$id_menu'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysqli_error());
    }
}
/////////////Delete user record /////////

if(isset($_POST['id_menu']))
{

	$id_menu = $_POST['id_menu']; 

	$deletequery = " delete from menu where id_menu ='$id_menu' ";
	if (!$result = mysqli_query($conn,$deletequery)) {
        exit(mysqli_error());

}

}

?>
