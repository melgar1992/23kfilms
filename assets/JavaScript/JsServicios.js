$(document).ready(function () {
	var base_url = $("#base_url").val();
	$(".btn-vista").on("click", function () {

		const id = $(this).val();
		console.log(id);
		$.ajax({
			url: base_url + "Mantenimiento/Servicios/vista/" + id,
			type: "POST",
			success: function (resp) {

				$("#modal-default").modal("show");

				$(".modal-body").append(resp);
				$('#modal-default').on('hidden.bs.modal', function (resp) {
					$(this).removeData('bs.modal');
					$(this).find('.modal-body').empty();
				})
				//alert(resp);
			}

		});

	});
	$(".btn-borrar").on("click", function (e) {
		e.preventDefault();
		var ruta = $(this).attr("href");
		Swal.fire({
			title: 'Esta seguro de elimar?',
			text: "El servicio se eliminara!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, deseo elimniar!',
			cancelButtonText: 'Cancelar'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: ruta,
					type: "POST",
					success: function (resp) {
						window.location.href = base_url + resp;
					}
				});
			}
		})

	});



})
