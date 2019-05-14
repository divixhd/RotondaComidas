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

  <h2 style="background-color: #1e3928 ; color: white; font-size: 38px; font-family: 'Anton', sans-serif;" class="text-uppercase text-center"> Clientes de Rotonda de Comidas  </h2>
  <a href="http://localhost/PaginaArq/Carrito/index.php">Carrito de Compras</a>
	<div class="d-flex flex-row justify-content-end ">
		<button type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#myModal">
		 Insertar Cliente
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
        <h4 class="modal-title">Insercion del Cliente</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
      	<div class="form-group">
      		<label>  Nombre Cliente: </label>
      		<input type="text" name="nombre" id="nombre" class="form-control">
      	</div>

      	<div class="form-group">
      		<label> Dirección: </label>
      		<input type="text" name="direccion" id="direccion" class="form-control">
      	</div>

      	<div class="form-group">
      		<label> Telefono: </label>
      		<input type="text" name="telefono" id="telefono" class="form-control">
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
      		<label> Nombre </label>
      		<input type="text" name="nombre" id="update_nombre" class="form-control">
      	</div>

      	<div class="form-group">
      		<label> Direccion </label>
      		<input type="text" name="direccion" id="update_direccion"  class="form-control">
      	</div>

      	<div class="form-group">
      		<label> Telefono </label>
      		<input type="text" name="telefono" id="update_telefono"  class="form-control">
      	</div>



      </div>

      <!-- Modal footer -->
     <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Actualizar</button>
	                <input type="hidden" id="id_cliente">
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

		var nombre =  $("#nombre").val();
		var direccion =  $("#direccion").val();
		var telefono =  $("#telefono").val();

		$.ajax({

			url:"backend.php",
			type:'POST',
			data: {
				nombre:nombre,
				direccion:direccion,
				telefono:telefono
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
			url:"backend.php",
			type:"POST",
			data:{readrecords:readrecords},
			success:function(data,status){
				$('#records_content').html(data);
			},

		});
	}


/////////////delete userdetails ////////////
function DeleteUser(id_cliente){

	var conf = confirm("Seguro que vas a eliminar");
	if(conf == true) {
	$.ajax({
		url:"backend.php",
		type:'POST',
		data: {  id_cliente: id_cliente},

		success:function(data, status){
			readRecords();
		}
	});
	}
}



function GetUserDetails(id_cliente){
	  $("#id_cliente").val(id_cliente);
	  $.post("backend.php", {
            id_cliente: id_cliente
        },
        function (data, status) {
            alert(data);
            //JSON.parse() parses a string, written in JSON format, and returns a JavaScript object.
            var user = JSON.parse(data);
            alert(user);

            $("#update_nombre").val(user.nombre);
            $("#update_direccion").val(user.direccion);
            $("#update_telefono").val(user.telefono);
        }
    );
    $("#update_user_modal").modal("show");
}




function UpdateUserDetails() {
    var nombre = $("#update_nombre").val();
    var direccion = $("#update_direccion").val();
    var telefono = $("#update_telefono").val();
    var id_cliente = $("#id_cliente").val();
    $.post("backend.php", {
            id_cliente: id_cliente,
            nombre: nombre,
            direccion: direccion,
            telefono: telefono
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