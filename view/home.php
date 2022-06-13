<?php

session_start();
if ($_SESSION['id_usuario'] == '') {
	session_destroy();
	header("Location: ../index.php");
	exit();
}else{
	$id_usuario = $_SESSION['id_usuario'];
	$usuario = $_SESSION['email'];
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HOME</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
</head>
<body class="container">

	<div class="row">
		<h1 class="text-center">Bienvenido <?=$usuario?></h1>
	</div>
	<br><h3	>Gráfica de colores más usados</h2><br>
	<div class="row">
		<canvas id="grafica" style="height:300px;"></canvas>
	</div>
	<br><h3	>Usuarios Registrados</h2><br>
	<div class="row" id="tabla"></div>
	
</body>


<script type="text/javascript">

	$(function(){
		getTabla('<?=$id_usuario?>');
	});

	function getTabla(id_usuario){
		$.ajax({
            url: '../control/consultas', 
            data: {
                table:'table001',
                id_usuario:id_usuario
            },// pstw paso two, fstcrg first charge
            type: 'POST',
            dataType:"json",
            success: function (data) {
                if(data.success){
                                        
                    $('#tabla').html(data.tabla);

                    //llenando gráfica
                   	const ctx = document.getElementById('grafica').getContext('2d');
					const myChart = new Chart(ctx, {
					    type: 'bar',
					    data: {
					        labels: ['Rojos', 'Amarillos', 'Azules'],
					        datasets: [{
					            label: '# de usuarios',
					            data: [data.rojos, data.amarillos, data.azules],
					            backgroundColor: [
					                'rgba(255, 99, 132, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(255, 206, 86, 0.2)'
					            ],
					            borderColor: [
					                'rgba(255, 99, 132, 1)',
					                'rgba(54, 162, 235, 1)',
					                'rgba(255, 206, 86, 1)'
					            ],
					            borderWidth: 1
					        }]
					    },
					    options: {
					        scales: {
					            y: {
					                beginAtZero: true
					            }
					        }
					    }
					});
                    
                }else{
                    Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Error consultando la tabla de registros.'
					})
                }

            },
            error: function (err) {                
                Swal.fire({
				  icon: 'error',
				  title: 'Oops...',
				  text: 'Error consultando la tabla de registros.'
				})
            }
        }); 
	}
</script>
</html>