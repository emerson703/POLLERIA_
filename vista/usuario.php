<?php
include "header.php";
?>

<div class="container">
<h1 class="display-5">ESTAMOS EN LA PAGINA DE USUARIO</h1>
	<div class="my-3">
		<button type="button" class="btn btn-primary" id="btnNuevo">
			nuevo usuario
		</button>
	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>DNI</th>
				<th>NOMBRES</th>
				<th>APELLIDOS</th>
				<th>DIRECCION</th>
				<th>TELEFONO</th>
				<th>FECHA INGRESO</th>
				<th>USUARIO</th>
				<th>CLAVE</th>
				<th>PRIVILEGIO</th>
				<th>ESTADO</th>
				<th>ACCIONES</th>
			</tr>
		</thead>
		<tbody id="registro">

		</tbody>
	</table>

</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="modalUsuarios" tabindex="-1" aria-labelledby="modalUsuariosLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalUsuariosLabel">Agregar nuevo Usuario</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="" id="formularioUsuario">
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ID usuario" name="txtID" id="txtID" readonly>
					</div>
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ingresar el dni" name="txtDni" id="txtDni">
					</div>
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ingresar Nombres" name="txtNombres" id="txtNombres">
					</div>
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ingresar Apellidos" name="txtApellidos" id="txtApellidos">
					</div>
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ingresar la Direccion" name="txtDireccion" id="txtDireccion">
					</div>
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ingresar el telefono" name="txtTelefono" id="txtTelefono">
					</div>
					<div class="mt-2">
						<input type="date" class="form-control" placeholder="ingresar la Fecha de Ingreso" name="txtFechaI" id="txtFechaI">
					</div>
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ingresar Correo del Usuario" name="txtCorreo" id="txtCorreo">
					</div>
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ingresar la Clave" name="txtClave" id="txtClave">
					</div>
					<div class="row mt-2">
						<div class="col-6">
							<label>Tipo de Usuario</label>
							<div class="form-check mt-2">
								<input class="form-check-input" type="radio" name="cboTipo" id="cboTipo1" value="1">
								<label class="form-check-label" for="cboTipo1">Administrador</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="cboTipo" id="cboTipo2" value="2">
								<label class="form-check-label" for="cboTipo2">Usuario</label>
							</div>
						</div>
						<div class="col-6">
							<label>Estado</label>
							<div class="form-check mt-2">
								<input class="form-check-input" type="radio" name="cboEstado" id="cboEstado1" value="1">
								<label class="form-check-label" for="cboEstado1">Activo</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="cboEstado" id="cboEstado2" value="0">
								<label class="form-check-label" for="cboEstado2">Inactivo</label>
							</div>
						</div>
					</div>
				</form>
				<div id="msg"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btnGuardar">Guardar Usuario</button>
			</div>
		</div>
	</div>
</div>

<template id="template_user">
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>
			<a class="btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i></a>
			<a class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>
		</td>
	</tr>
</template>

<?php
include "footer.php";
?>

<script>
	// Funcion Listar Usuarios
	function listarUsuarios() {
		const tempUser = document.querySelector("#template_user").content;
		const fragmento = new DocumentFragment();
		const listaR = document.querySelector("#registro");
		$.ajax({
			url: "../controlador/procesosU.php",
			data: "action=listar",
			type: "POST",
			dataType: "json",
			success: function(response) {
        listaR.innerHTML ="";
        let contador = 1;
				if (response.estado == "ok") {
					response.datos.forEach(item => {
						const clonar = tempUser.cloneNode(true);
						clonar.querySelectorAll("td")[0].textContent = contador;
						clonar.querySelectorAll("td")[1].textContent = item.Dni;
						clonar.querySelectorAll("td")[2].textContent = item.Nombres;
						clonar.querySelectorAll("td")[3].textContent = item.Apellidos;
						clonar.querySelectorAll("td")[4].textContent = item.Direccion;
						clonar.querySelectorAll("td")[5].textContent = item.Telefono;
						clonar.querySelectorAll("td")[6].textContent = item.FechaIngreso;
						clonar.querySelectorAll("td")[7].textContent = item.Usuario;
						clonar.querySelectorAll("td")[8].textContent = item.Clave;
						clonar.querySelectorAll("td")[9].textContent = item.IdPrivilegio;
						clonar.querySelectorAll("td")[10].textContent = item.Estado;
						clonar.querySelectorAll("a")[0].setAttribute("href", "javascript:mostrarID(" + item.IdUsuario + ")");
						clonar.querySelectorAll("a")[1].setAttribute("href", "javascript:Eliminar(" + item.IdUsuario + ")");
						fragmento.appendChild(clonar);
            contador++;
					});
					listaR.appendChild(fragmento)
				} else {
					location.href = "vista/home.php";
				}
			},
			error: function(response) {
				console.log(response);
			}
		});
	}

	function mostrarID(id) {
		$.ajax({
			url: "../controlador/procesosU.php",
			data: "&action=mostrarID&id=" + id,
			type: "POST",
			dataType: "json",
			success: function(response) {
				console.log(response);
				if (response.estado == "ok") {
					$("#txtID").val(response.datos.IdUsuario)
					$("#txtDni").val(response.datos.Dni)
					$("#txtNombres").val(response.datos.Nombres)
					$("#txtApellidos").val(response.datos.Apellidos)
					$("#txtDireccion").val(response.datos.Direccion)
					$("#txtTelefono").val(response.datos.Telefono)
					$("#txtFechaI").val(response.datos.FechaIngreso)
					$("#txtCorreo").val(response.datos.Usuario)
					$("#txtClave").val(response.datos.Clave)
					if (response.datos.IdPrivilegio == 1) {
						$("#cboTipo1").attr('checked', true);
					} else {
						$("#cboTipo2").attr('checked', true);
					}
					if (response.datos.Estado == 1) {
						$("#cboEstado1").attr('checked', true);
					} else {
						$("#cboEstado2").attr('checked', true);
					}
					$("#modalUsuarios").modal("show");
					$("#btnGuardar").text("Modificar Usuario");
				} else {
					// $("#msg").html("Usuario No registrados");
				}
			},
			error: function(response) {
				console.log(response);
			}
		});
	}

  //Funcion Eliminar

  function Eliminar(id){
    const confirmacion  = confirm("Desea Eliminar éste Usuario?");
    if (confirmacion) {
      $.ajax({
        url: "../controlador/procesosU.php",
        data: "&action=eliminar&id=" + id,
        type: "POST",
        dataType: "json",
        success: function(response) {
          console.log(response);
          if (response.estado == "ok") {
            $("#msg").html(`<div class='alert alert-success'>${response.datos}</div>`).show(100).delay(2000).hide(100);
          listarUsuarios();
          } else {
          }
        },
        error: function(response) {
          console.log(response);
        }
      });
    }
  }
	$(function() {
		listarUsuarios();
		$("#btnNuevo").click(function() {
			$("#modalUsuarios").modal("show");
			$("#btnGuardar").text("Guardar Usuario");
      $("#formularioUsuario")[0].reset();
      $('input[name="cboTipo"]').attr('checked', false);
      $('input[name="cboEstado"]').attr('checked', false);
		})
		// Funcion Guardar Usuarios
		$("#btnGuardar").click(function(e) {
			e.preventDefault();
			const datos = $("#formularioUsuario").serialize();
			let boton;
			if ($(this).text() == "Guardar Usuario") {
				boton = "Guardar";
			} else {
				boton = "Modificar";
			}
			$.ajax({
				url: "../controlador/procesosU.php",
				data: datos + "&action=registrar&btn=" + boton,
				type: "POST",
				dataType: "json",
				success: function(response) {
					console.log(response);
					if (response.estado == "ok") {
						$("#msg").html(`<div class='alert alert-success'>${response.datos}</div>`).show(100).delay(2000).hide(100);
            listarUsuarios();
          } else {
						$("#msg").html(response.datos);
					}
				},
				error: function(response) {
					console.log(response);
				}
			});


		})

	})
</script>