<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Cormorant+Unicase" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cormorant+Unicase|Eater" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Anton|Cormorant+Unicase" rel="stylesheet">
</head>
<body>

<h1 class="text-center text-uppercase display-4 font-weight-bold" style="background-color: #74B3CE; color: white; font-family: 'Cormorant Unicase', serif;"> Rotonda de Comidas</h1>
<div class="container">
<a href="http://localhost/PaginaArq/index.php">Tabla de Clientes</a>
<a href="http://localhost/PaginaArq/ingredientes.php">Tabla de Ingredientes</a>
<a href="http://localhost/PaginaArq/menu.php">Tabla de Menu</a>
<a href="http://localhost/PaginaArq/productos.php">Tabla de Productos</a>
<a href="http://localhost/PaginaArq/proveedores.php">Tabla de Proveedores</a>
<a href="http://localhost/PaginaArq/stock.php">Tabla de Stock</a>

  <h2 style="background-color: #1e3928 ; color: white; font-size: 38px; font-family: 'Anton', sans-serif;" class="text-uppercase text-center"> Menú para la Rotonda de Comidas  </h2>
	<div class="d-flex flex-row justify-content-end ">
		<button type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#myModal">
		 Insertar Menú
		</button>
	</div>

	<div >
		<h2 style="color: #062f4f; font-family: 'Cormorant Unicase', serif;" class="font-weight-bold mb-4"> Registros </h2>
		<div id="records_content">	</div>
	</div>
  

</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Insercion del Menu</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
      	<div class="form-group">
      		<label>  Id Cliente: </label>
      		<input type="text" name="id_cliente" id="id_cliente" class="form-control">
      	</div>

      	<div class="form-group">
      		<label> Id Producto: </label>
      		<input type="text" name="id_producto" id="id_producto" class="form-control">
      	</div>
        <div class="form-group">
          <label> Id Stock: </label>
          <input type="text" name="id_stock" id="id_stock" class="form-control">
        </div>


      	<div class="form-group">
      		<label> Cantidad: </label>
      		<input type="text" name="cantidad" id="cantidad" class="form-control">
      	</div>
        <div class="form-group">
          <label> Valor Unitario: </label>
          <input type="text" name="valor_unitario" id="valor_unitario" class="form-control">
        </div>
        <div class="form-group">
          <label> Total: </label>
          <input type="text" name="total" id="total" class="form-control">
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">Insertar</button>

         <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>



    </div>
  </div>
</div>


<!-- //////////////// after update ////////////////// -->
<div class="modal fade" id="update_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Actualizacion</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
      		<div class="form-group">
      		<label> Id Cliente </label>
      		<input type="text" name="id_cliente" id="update_idcliente" class="form-control">
      	</div>
        <div class="form-group">
          <label> Id Producto </label>
          <input type="text" name="id_producto" id="update_idproducto" class="form-control">
        </div>
        <div class="form-group">
          <label> Id Stock </label>
          <input type="text" name="id_stock" id="update_idstock" class="form-control">
        </div>
      	<div class="form-group">
      		<label> Cantidad </label>
      		<input type="text" name="cantidad" id="update_cantidad"  class="form-control">
      	</div>
        <div class="form-group">
          <label> Valor Unitario </label>
          <input type="text" name="valor_unitario" id="update_valorunitario" class="form-control">
        </div>
      	<div class="form-group">
      		<label> Total </label>
      		<input type="text" name="total" id="update_total"  class="form-control">
      	</div>



      </div>

      <!-- Modal footer -->
     <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Actualizar</button>
	                <input type="hidden" id="id_menu">
	 </div>



    </div>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

<script>
	
$(document).ready(function () {
    readRecords(); 
	});

	function addRecord(){
    var id_cliente =  $("#id_cliente").val();
		var id_producto =  $("#id_producto").val();
		var id_stock =  $("#id_stock").val();
		var cantidad =  $("#cantidad").val();
    var valor_unitario =  $("#valor_unitario").val();
    var total =  $("#total").val();
		$.ajax({

			url:"backend_menu.php",
			type:'POST',
			data: {
				id_cliente:id_cliente,
        id_producto:id_producto,
        id_stock:id_stock,
				cantidad:cantidad,
				valor_unitario:valor_unitario,
        total:total,
			},
			success:function(data, status){
				readRecords();
			},

		});

	}

//////////////////Display Records
	function readRecords(){
		
		var readrecords = "readrecords";
		$.ajax({
			url:"backend_menu.php",
			type:"POST",
			data:{readrecords:readrecords},
			success:function(data,status){
				$('#records_content').html(data);
			},

		});
	}


/////////////delete userdetails ////////////
function DeleteUser(id_menu){

	var conf = confirm("Seguro que vas a eliminar");
	if(conf == true) {
	$.ajax({
		url:"backend_menu.php",
		type:'POST',
		data: {  id_menu: id_menu},

		success:function(data, status){
			readRecords();
		}
	});
	}
}



function GetUserDetails(id_menu){
	  $("#id_menu").val(id_menu);
	  $.post("backend_menu.php", {
            id_menu: id_menu
        },
        function (data, status) {
            alert(data);
            //JSON.parse() parses a string, written in JSON format, and returns a JavaScript object.
            var user = JSON.parse(data);
            alert(user);

            $("#update_idcliente").val(user.id_cliente);
            $("#update_idproducto").val(user.id_producto);
            $("#update_idstock").val(user.id_stock);
            $("#update_cantidad").val(user.cantidad);
            $("#update_valorunitario").val(user.valor_unitario);
            $("#update_total").val(user.total);
        }
    );
    $("#update_user_modal").modal("show");
}




function UpdateUserDetails() {
    var id_cliente = $("#update_idcliente").val();
    var id_producto = $("#update_idproducto").val();
    var id_stock = $("#update_idstock").val();
    var cantidad = $("#update_cantidad").val();
    var valor_unitario = $("#update_valorunitario").val();
    var total= $("#update_total").val();
    $.post("backend_menu.php", {
            id_cliente: id_cliente,
            id_producto: id_producto,
            id_stock: id_stock,
            cantidad: cantidad,
            valor_unitario: valor_unitario,
            total: total
        },
        function (data, status) {
            $("#update_user_modal").modal("hide");
            readRecords();
        }
    );
}

</script>

</body>
</html>