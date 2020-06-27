$(document).ready(function () {
	var base_url = $("#base_url").val();
	sumar();
	var tabla_productos = $('#tablaProdcutos').DataTable({
		responsive: "true",
		"columnDefs": [{
			"targets": -1,
			"data": null,
			"defaultContent": "<button type='button' class='btn btn-success btn-check-servicio' value=''><span class='fa fa-check'></span></button>",
		}],
		"language": {
			'lengthMenu': "Mostrar _MENU_ registros",
			"zeroRecords": "No se encontraron resultados",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registro",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch": "Buscar",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Ultimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior",

			},
			"sProcesing": "Procesando...",
		}

	});
	$('#comprobantes').on('change', function () {
		option = $(this).val();

		if (option != '') {
			infocomprobante = option.split('*');

			$('#idcomprobante').val(infocomprobante[0]);
			$('#igv').val(infocomprobante[2]);
			$('#serie').val(infocomprobante[3]);
			$('#numero').val(infocomprobante[1]);

		} else {
			$('#idcombrobante').val(null);
			$('#igv').val(null);
			$('#serie').val(null);
			$('#numero').val(null);

		}
		sumar();

	})
	$('#descuento_porcentaje').on('change', function () {
		sumar();

	});
	$(document).on("click", ".btn-check", function () {

		cliente = $(this).val();
		infocliente = cliente.split("*");
		$("#idcliente").val(infocliente[0]);
		$("#cliente").val(infocliente[1]);
		$("#modal-default").modal("hide");
	});
	$(document).on("click", ".btn-check-servicio", function () {

		empleado = $(this).val();
		infocliente = empleado.split("*");
		$("#idempleado").val(infocliente[0]);
		$("#empleado").val(infocliente[1] + ' ' + infocliente[2]);
		$("#modal-empleados").modal("hide");
	});

	// Funciones de las tablas de categorias
	$(document).on("click", ".btn-check-servicio", function () {

		fila = $(this).closest('tr');
		servicio = new Array;
		servicio['id_servicio'] = parseInt(fila.find('td:eq(0)').text());
		servicio['nombre_servicio'] = fila.find('td:eq(1)').text();
		servicio['descripcion'] = fila.find('td:eq(2)').text();
		servicio['nombre_categoria'] = fila.find('td:eq(3)').text();
		agregarServicio(servicio);

	});
	$(document).on("click", ".btn-check-categoria", function () {
		categoria = $(this).val();
		id_categoria = categoria.split('*');
		id_categoria = id_categoria['0'];
		if ($(".tabla-categoria-" + id_categoria).length > 0) {
			Swal.fire({
				type: 'error',
				icon: 'error',
				title: 'Error, la tabla de categoria ya existe!!',
				text: '',
			});
		} else {
			agregarTablaCategoria(categoria);
		}

	});
	$(document).on("click", ".eliminar-tabla-categoria", function () {

		id_tabla_eliminar = $(this).val();
		$("." + id_tabla_eliminar).remove();
	});
	$(document).on('click', '#buscar-servicios-categoria', function () {
		id_categoria = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url + "Movimientos/Ventas/getServiciosCategoria",
			data: {
				id_categoria: id_categoria,
			},
			dataType: "json",
			success: function (servicios) {
				tabla_productos.clear().draw();
				for (let i = 0; i < servicios.length; i++) {
					tabla_productos.row.add([
						servicios[i]['id_servicio'],
						servicios[i]['nombre'],
						servicios[i]['descripcion'],
						servicios[i]['categoria'],
					]).draw();
				}
			},
		});
	});

	//Terminan las funciones de tablas de categorias
	$(document).on("click", ".btn-remove-producto", function () {

		$(this).closest("tr").remove();
		sumar();
	});
	$(document).on("change", "#tbventas input.cantidades", function () {


		cantidad = $(this).val();
		precio = $(this).closest("tr").find("td:eq(2)").text();
		importe = cantidad * precio;
		$(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
		$(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
		sumar();
	});
	$(document).on('click', '.btn-view-venta', function () {
		valor_id = $(this).val();
		$.ajax({
			url: base_url + 'Movimientos/Ventas/vista',
			type: 'POST',
			dataType: 'html',
			data: {
				id: valor_id
			},
			success: function (data) {

				$('#modal-default .modal-body').html(data);
			}
		});
	});

	$(document).on('click', '.btn-print', function () {

		$("#modal-default .modal-body").print({
			title: 'Comprobante de venta',
		});
	});

	$(document).on('click', '.btn-borrar', function () {

		Swal.fire({
			title: 'Esta seguro de elimar?',
			text: "La salida de vestuario se eliminara!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, deseo elimniar!',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {

				var id = $(this).val();

				$.ajax({
					url: base_url + 'Movimientos/Ventas/borrar/' + id,
					type: 'POST',
					success: function (resp) {
						window.location.href = base_url + resp;
					}
				})


			}
		})
	});


})



function sumar() {
	subtotal = 0;
	porcentaje_descuento = $('#descuento_porcentaje').val();
	$("#tbventas  tbody tr").each(function () {
		subtotal = subtotal + Number($(this).find("td:eq(5)").text());
	});
	$("input[name=subtotal]").val(subtotal.toFixed(2));
	porcentaje_descuento = (porcentaje_descuento / 100);
	$('input[name=descuento]').val((subtotal * porcentaje_descuento).toFixed(2));
	porcentaje = $("#igv").val();
	descuento = subtotal * porcentaje_descuento;
	total = subtotal - descuento;
	igv = total * (porcentaje / 100);
	$("input[name=igv]").val(igv.toFixed(2));
	$("input[name=total]").val(total.toFixed(2));
}

function generarNumero(numero) {
	if (numero >= 99999 && numero < 999999) {
		return (Number(numero) + 1);
	}
	if (numero >= 9999 && numero < 99999) {
		return '0' + (Number(numero) + 1);
	}
	if (numero >= 999 && numero < 9999) {
		return '00' + (Number(numero) + 1);
	}
	if (numero >= 99 && numero < 999) {
		return '000' + (Number(numero) + 1);
	}
	if (numero >= 9 && numero < 99) {
		return '0000' + (Number(numero) + 1);
	}
	if (numero < 9) {
		return '00000' + (Number(numero) + 1);
	}
}

function agregarServicio(servicio) {
	if (servicio['id_servicio'] > 0) {
		html = "<tr>";
		html += "<td><input type='hidden' name= 'id_servicio[]' value ='" + servicio['id_servicio'] + "'>" + servicio['nombre_servicio'] + "</td>";
		html += "<td><input type = 'number' class='cantidad form-control' min = '0' name = 'cantidad[]' value = ''></td>";
		html += "<td><input type = 'number' class='dias form-control' min = '0' name = 'dias[]' value = ''></td>";
		html += "<td><input type = 'number' class='costo form-control' min = '0' name = 'costo[]' value = ''></td>";
		html += "<td><input type = 'number' class='total form-control' min = '0' name = 'total[]' value = ''></td>";
		html += "<td><input type = 'number' class='real form-control' min = '0' name = 'real[]' value = ''></td>";
		html += "<td><input type = 'number' class='facturado form-control' min = '0' name = 'facturado[]' value = ''></td>";
		html += "<td><input type = 'number' class='sin_factura form-control' min = '0' name = 'sin_factura[]' value = ''></td>";
		html += "<td><input type = 'text' maxlength='100'  class='observaciones form-control' min = '0' name = 'observaciones[]' value = ''></td>";
		html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
		html += "</tr>";
		$("#tabla-categoria-" + servicio['nombre_categoria'] + " tbody").append(html);
	} else {
		alert("seleccione un producto");
	}
}

function agregarTablaCategoria(categoria) {

	categoria = categoria.split('*');
	id_categoria = categoria['0'];
	nombre_categoria = categoria['1'];
	descripcion = categoria['2'];


	html = "<div class = 'tabla-categoria-" + id_categoria + "'>";
	html += "<div class = 'form-group'>";
	html += "<div class = 'col-md-2'>";
	html += "<button class='btn btn-primary btn-flat btn-block' id = 'buscar-servicios-categoria' value = '" + id_categoria + "' type='button' data-toggle='modal' data-target='#modal-servicios'><span class='fa fa-search '></span><small> " + nombre_categoria + "</small></button>";
	html += "</div>";
	html += "<div class = 'col-md-1 col-md-offset-10'>"
	html += "<button id = 'eliminar-tabla-categoria' value = 'tabla-categoria-" + id_categoria + "' class='btn btn-danger btn-flat eliminar-tabla-categoria' type='button' title = 'Eliminar Tabla!'><span class='fa fa-remove'></span></button>";
	html += "</div>";
	html += "</div>";
	html += "<table id='tabla-categoria-" + nombre_categoria + "' class='table table-hover'>";
	html += "<thead>";
	html += "<tr>";
	html += "<th>Nombre</th>";
	html += "<th>Cantidad</th>";
	html += "<th>Dias</th>";
	html += "<th>Costo</th>";
	html += "<th>Total</th>";
	html += "<th>Real</th>";
	html += "<th>Facturado</th>";
	html += "<th>Sin factura</th>";
	html += "<th>Observaciones</th>";
	html += "<th>Opciones</th>";
	html += "</tr>";
	html += "</thead>";
	html += "<tbody>";
	html += "</tbody>";
	html += "</table>";
	html += "</div>";

	$("#tablas-categorias").append(html);

}
