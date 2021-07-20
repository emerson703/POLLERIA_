<?php
include "header.php";
?>

<div class="container">
<h1 class="display-5">ESTAMOS EN LA PAGINA DE PRODUCTOS</h1>
	<div class="my-3">
		<button type="button" class="btn btn-primary" id="btnNuevo">
			nuevo producto
		</button>
	</div>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>DESCRIPCION</th>
				<th>PRECIO</th>
				<th>STOCK</th>
				<th>DETALLE</th>
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
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalUsuariosLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalUsuariosLabel">Agregar nuevo Producto</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="" id="formularioProducto">
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ID usuario" name="txtID" id="txtID" readonly>
					</div>

					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ingresar Descripcion" name="txtDescripcion" id="txtDescripcion">
					</div>
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ingresar Precio" name="txtPrecio" id="txtPrecio">
					</div>
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ingresar el Stock" name="txtStock" id="txtStock">
					</div>
					<div class="mt-2">
						<input type="text" class="form-control" placeholder="ingresar la Detalle" name="txtDetalle" id="txtDetalle">
					</div>
					<div class="row mt-2">
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
				<button type="button" class="btn btn-primary" id="btnGuardar">Guardar Producto</button>
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
	function listarProducto() {
		const tempUser = document.querySelector("#template_user").content;
		const fragmento = new DocumentFragment();
		const listaR = document.querySelector("#registro");

		$.ajax({
			url: "../controlador/procesosProd.php",
			data: "action=listar",
			type: "POST",
			dataType: "json",
			success: function(response) {
				console.log(response)
				listaR.innerHTML = "";
				let contador = 1;
				if (response.estado == "ok") {
					response.datos.forEach(item => {
						const clonar = tempUser.cloneNode(true);
						clonar.querySelectorAll("td")[0].textContent = contador;
						clonar.querySelectorAll("td")[1].textContent = item.Descripcion;
						clonar.querySelectorAll("td")[2].textContent = item.Precio;
						clonar.querySelectorAll("td")[3].textContent = item.Stock;
						clonar.querySelectorAll("td")[4].textContent = item.Detalle;
						clonar.querySelectorAll("td")[5].textContent = item.Estado;
						clonar.querySelectorAll("a")[0].setAttribute("href", "javascript:mostrarID(" + item.IdProducto + ")");
						clonar.querySelectorAll("a")[1].setAttribute("href", "javascript:Eliminar(" + item.IdProducto + ")");
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
			url: "../controlador/procesosProd.php",
			data: "&action=mostrarID&id=" + id,
			type: "POST",
			dataType: "json",
			success: function(response) {
				console.log(response);
				if (response.estado == "ok") {
					$("#txtID").val(response.datos.IdProducto)
					$("#txtDescripcion").val(response.datos.Descripcion)
					$("#txtPrecio").val(response.datos.Precio)
					$("#txtStock").val(response.datos.Stock)
					$("#txtDetalle").val(response.datos.Detalle)
					if (response.datos.Estado == 1) {
						$("#cboEstado1").attr('checked', true);
					} else {
						$("#cboEstado2").attr('checked', true);
					}
					$("#modalProducto").modal("show");
					$("#btnGuardar").text("Modificar Producto");
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

	function Eliminar(id) {
		const confirmacion = confirm("Desea Eliminar éste Producto?");
		if (confirmacion) {
			$.ajax({
				url: "../controlador/procesosProd.php",
				data: "&action=eliminar&id=" + id,
				type: "POST",
				dataType: "json",
				success: function(response) {
					console.log(response);
					if (response.estado == "ok") {
						$("#msg").html(`<div class='alert alert-success'>${response.datos}</div>`).show(100).delay(2000).hide(100);
						listarProducto();
					} else {}
				},
				error: function(response) {
					console.log(response);
				}
			});
		}
	}
	$(function() {
		listarProducto();
		$("#btnNuevo").click(function() {
			$("#modalProducto").modal("show");
			$("#btnGuardar").text("Guardar Usuario");
			$("#formularioProducto")[0].reset();
			$('input[name="cboTipo"]').attr('checked', false);
			$('input[name="cboEstado"]').attr('checked', false);
		})
		// Funcion Guardar Usuarios
		$("#btnGuardar").click(function(e) {
			e.preventDefault();
			const datos = $("#formularioProducto").serialize();
			let boton;
			if ($(this).text() == "Guardar Usuario") {
				boton = "Guardar";
			} else {
				boton = "Modificar";
			}
			$.ajax({
				url: "../controlador/procesosProd.php",
				data: datos + "&action=registrar&btn=" + boton,
				type: "POST",
				dataType: "json",
				success: function(response) {
					console.log(response);
					if (response.estado == "ok") {
						$("#msg").html(`<div class='alert alert-success'>${response.datos}</div>`).show(100).delay(2000).hide(100);
						listarProducto();
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