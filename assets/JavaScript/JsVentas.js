$(document).ready(function () {
	var base_url = $("#base_url").val();
	sumar();
	$('#tablaProdcutos').DataTable({
		responsive: "true",
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
	$(document).on("click", ".btn-check-empleado", function () {

		empleado = $(this).val();
		infocliente = empleado.split("*");
		$("#idempleado").val(infocliente[0]);
		$("#empleado").val(infocliente[1] + ' ' + infocliente[2]);
		$("#modal-empleados").modal("hide");
	});
	$(document).on("click", ".btn-check-producto", function () {

		producto = $(this).val();
		agregarProducto(producto);
		$("#modal-productos").modal("hide");
	});
    $(document).on("click", ".btn-check-categoria", function () {
		agregarTablaCategoria();
	});
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
					url: base_url + 'Mantenimiento/Empleado/borrar/' + id,
					type: 'POST',
					success: function (resp) {
						window.location.href = base_url + resp;
					}
				})


			}
		})
	})

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

function agregarProducto(producto) {
	data = producto;
	if (data != '') {
		infoproducto = data.split("*");
		html = "<tr>";
		html += "<td><input type='hidden' name= 'idproductos[]' value ='" + infoproducto[0] + "'>" + infoproducto[1] + "</td>";
		html += "<td>" + infoproducto[2] + "</td>";
		html += "<td><input type='hidden' name = 'precios[]' value ='" + infoproducto[3] + "'>" + infoproducto[3] + "</td>";
		html += "<td>" + infoproducto[4] + "</td>";
		html += "<td><input type = 'number' class='cantidades' min = '0' max = '" + infoproducto[4] + "' name = 'cantidades[]' value = '1'></td>";
		html += "<td><input type ='hidden' name = 'importes[]' value ='" + infoproducto[3] + "'><p>" + infoproducto[3] + "</p></td>";
		html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
		html += "</tr>";
		$("#tbventas tbody").append(html);
		sumar();
		$("#btn-agregar").val(null);
		$("#producto").val(null);
	} else {
		alert("seleccione un producto");
	}
}

function agregarTablaCategoria() {



    html = "<div class = 'form-group'>"
    html += "<div class = 'col-md-1'>"
    html += "<button class='btn btn-primary btn-flat btn-block' type='button' data-toggle='modal' data-target='#modal-servicios'><span class='fa fa-search'></span> Buscar</button>";
    html += "</div>";
    html += "<div class = 'col-md-1 col-md-offset-10'>"
    html += "<button id = '' class='btn btn-danger btn-flat' type='button' title = 'Eliminar Tabla!'><span class='fa fa-remove'></span></button>";
    html += "</div>";
    html += "</div>";
    html += "<table id='' class='table table-hover'>";
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
    html += "</tr>";
    html += "</thead>";
    html += "<tbody>";
    html += "</tbody>";
    html += "</table>";

    $("#tablas-categorias").append(html);

}
