$(document).ready(function () {
	var base_url = $('#base_url').val();

	$('#tablaProdcutos').DataTable({
		pageLength: 100,
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
		},
		"footerCallback": function (row, data, start, end, display, tfoot) {
			var api = this.api(),
				data;

			// Remove the formatting to get integer data for summation
			var intVal = function (i) {
				return typeof i === 'string' ?
					i.replace(/[\$,]/g, '') * 1 :
					typeof i === 'number' ?
						i : 0;
			};

			// Total over all pages
			total = api
				.column(8)
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Total over this page
			pageTotal = api
				.column(8, {
					page: 'current'
				})
				.data()
				.reduce(function (a, b) {
					return intVal(a) + intVal(b);
				}, 0);

			// Update footer
			$(api.column(8).footer()).html(
				pageTotal
			);
			$('tr:eq(1) th:eq(1)', api.table().footer()).html(total);
		},

		dom: 'Bfrtip',
		responsive: "true",
		buttons: [
			{
				extend: 'excelHtml5',
				title: "Reporte de productos en inventario",
				footer: true,
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
				}

			},
			{
				extend: 'pdfHtml5',
				title: "Reporte de productos en inventario",
				footer: true,
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],
				}
			},
			{
				extend: 'print',
				title: "Reporte de productos en inventario",
				footer: true,
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7, 8, 9],

				}
			},


		],
	});
	$('#tabla_salida_productos').DataTable({
		pageLength: 100,
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
		},
		
		dom: 'Bfrtip',
		responsive: "true",
		buttons: [
			{
				extend: 'excelHtml5',
				title: "Reporte de productos en inventario",
				footer: true,
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7],
				}

			},
			{
				extend: 'pdfHtml5',
				title: "Reporte de productos en inventario",
				footer: true,
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7],
				}
			},
			{
				extend: 'print',
				title: "Reporte de productos en inventario",
				footer: true,
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7],

				}
			},


		],
	});
	$('#tabla_descarte').DataTable({
		pageLength: 100,
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
		},
		
		dom: 'Bfrtip',
		responsive: "true",
		buttons: [
			{
				extend: 'excelHtml5',
				title: "Reporte de productos en inventario",
				footer: true,
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7],
				}

			},
			{
				extend: 'pdfHtml5',
				title: "Reporte de productos en inventario",
				footer: true,
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7],
				}
			},
			{
				extend: 'print',
				title: "Reporte de productos en inventario",
				footer: true,
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7],

				}
			},


		],
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
});
