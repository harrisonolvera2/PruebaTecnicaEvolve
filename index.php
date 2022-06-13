<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Prueba Técnica Evolve</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="container">

	<h1 class="text-center">Registrese por favor</h1><br>
	<form class="form">
		<div class="row">
			<div class="col-md-4">
				<label for="email" class="form-label">* Correo eléctronico</label>
				<input type="email" class="form-control" id="email" name="email" required placeholder="Ingrese su correo" autocomplete="off">
			</div>
			<div class="col-md-4">
				<label for="password" class="form-label">* Contraseña</label>
				<input type="password" class="form-control" id="password" name="password" required placeholder="Ingrese contraseña" autocomplete="off">
			</div>
			<div class="col-md-4">
				<label for="color" class="form-label">* Color</label>
				<select class="form-control" id="color" class="color" autocomplete="off">
					<option value=0>Seleccione un color</option>
					<option value="1">Azul</option>
					<option value="2">Amarillo</option>
					<option value="3">Rojo</option>
				</select>
			</div>			
		</div><br>
		<div class="row">
			<div class="col align-self-center">
				<button type="button" id="registrar" name="registrar" class="btn btn-primary">Registrarse</button>
			</div>			
		</div>
	</form>


	<h1 class="text-center">Si ya tienes cuenta, inicia sesión</h1><br>
	<form class="form">
		<div class="row">
			<div class="col-md-6">
				<label for="email" class="form-label">* Correo eléctronico</label>
				<input type="email" class="form-control" id="emailses" name="emailses" required placeholder="Ingrese su correo" autocomplete="off">
			</div>
			<div class="col-md-6">
				<label for="password" class="form-label">* Contraseña</label>
				<input type="password" class="form-control" id="passwordses" name="passwordses" required placeholder="Ingrese contraseña" autocomplete="off">
			</div>			
		</div><br>
		<div class="row">
			<div class="col align-self-center">
				<button type="button" id="sesion" name="sesion" class="btn btn-primary">Iniciar sesión</button>
			</div>			
		</div>
	</form>

</body>

<script type="text/javascript">

	$("#sesion").on("click", function(){

		email = $("#emailses").val();
		password = $("#passwordses").val();

		if(!validaEmail(email)){

			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'El formato del correo electrónico no es válido.'
			})

		}else if(password == ''){

			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Por favor ingrese su contraseña.'
			})

		}else{
			var formData = new FormData();
                
            formData.append('log', 'log001');
            formData.append('email',email);
            formData.append('password',password);

			$.ajax({
                url: 'control/registro',
                data: formData,
                dataType:"json",
                type: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                beforeSend: function () {
                    $("#lockscreen").show();
                },
                success: function (data) {
                    $("#lockscreen").hide();

                    if (data.success) {
                        Swal.fire({
						  //position: 'top-end',
						  icon: 'success',
						  title: data.msg,
						  showConfirmButton: false,
						  timer: 1500
						})

						window.location="view/home.php";
                    }else{
                        Swal.fire({
						  icon: 'error',
						  title: 'Oops...',
						  text: data.msg
						})
                    }
                },
                error: function (err) {                
                    Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Ha ocurrido un error, por favor intenté más tarde.'
					})
                }
            }); 
		}

	});

	$("#registrar").on("click", function(){

		email = $("#email").val();
		password = $("#password").val();
		color = $("#color").val();

		if(!validaEmail(email)){

			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'El formato del correo electrónico no es válido.'
			})

		}else if(password == '' || password.length < 10){

			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Por favor ingrese una contraseña con mínimo 10 caracteres.'
			})

		}else if (color == '' || color == 0) {

			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Por favor seleccione un color.'
			})

		}else{

			var formData = new FormData();
                
            formData.append('reg', 'reg001');
            formData.append('email',email);
            formData.append('password',password);
            formData.append('color',color);

			$.ajax({
                url: 'control/registro',
                data: formData,
                dataType:"json",
                type: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                beforeSend: function () {
                    $("#lockscreen").show();
                },
                success: function (data) {
                    $("#lockscreen").hide();

                    if (data.success) {
                        Swal.fire({
						  //position: 'top-end',
						  icon: 'success',
						  title: data.msg,
						  showConfirmButton: false,
						  timer: 1500
						})
                    }else{
                        Swal.fire({
						  icon: 'error',
						  title: 'Oops...',
						  text: data.msg
						})
                    }
                },
                error: function (err) {                
                    Swal.fire({
						  icon: 'error',
						  title: 'Oops...',
						  text: 'Ha ocurrido un error, por favor intenté más tarde.'
						})
                }
            }); 
		}

	});

	function validaEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }


    
	
	
</script>
</html>