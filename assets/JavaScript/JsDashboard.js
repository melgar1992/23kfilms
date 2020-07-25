$(document).ready(function () {
	var base_url = $('#base_url').val();
	var tablaPresupuestos = $('#tablaPresupuestos').DataTable({
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
	$(document).on('click', '.btn-view-presupuestoTablas', function () {
		valor_id = $(this).val();
		$.ajax({
			url: base_url + 'Movimientos/Presupuesto/vista_tablas',
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
	$(document).on('click', '.btn-view-presupuestoLista', function () {
		valor_id = $(this).val();
		$.ajax({
			url: base_url + 'Movimientos/Presupuesto/vista_lista',
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
});
