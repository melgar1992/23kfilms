$(document).ready(function () {
	var base_url = $('#base_url').val();
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
		},
		
	});

	$(document).on("click", ".btn-check-producto", function () {

		producto = $(this).val();
		producto = producto.split('*');
		$("#id_productos").val(producto[0]);
		$("#producto").val(producto[2]);
		$("#categoria_producto").val(producto[5]);
		$("#cantidad").attr("max", producto[4]);
		$("#modal-productos").modal("hide");
	});
	$(document).on('click', '.btn-borrar', function () {

		Swal.fire({
			title: 'Esta seguro de elimar?',
			text: "La descarte de vestuario se eliminara!",
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
					url: base_url + 'Movimientos/Descarte/borrar/' + id,
					type: 'POST',
					success: function (resp) {
						window.location.href = base_url + resp;
					}
				})


			}
		})
	})

});
