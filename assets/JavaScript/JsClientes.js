$(document).ready(function() {
    var base_url = $("#base_url").val();
    $(document).on('click', '.btn-borrar', function() {


        Swal.fire({
            title: 'Esta seguro de elimar?',
            text: "El cliente se eliminara!",
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
                    url: base_url + 'Mantenimiento/Clientes/borrar/' + id,
                    type: 'POST',
                    success: function(resp) {

                        window.location.href = base_url + resp;
                    }
                })


            }
        })


    });
    $(".btn-vista-cliente").on("click", function() {

        const id = $(this).val();
        console.log(id);
        $.ajax({
            url: base_url + "Mantenimiento/Clientes/vista/" + id,
            type: "POST",
            success: function(resp) {


                $("#modal-default").modal("show");

                $(".modal-body").append(resp);
                $('#modal-default').on('hidden.bs.modal', function(resp) {
                    $(this).removeData('bs.modal');
                    $(this).find('.modal-body').empty();

                })
            }


        });

    });

});