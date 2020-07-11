$(document).ready(function() {
    var base_url = $("#base_url").val();

    var tabla_cliente = $('#tabla-cliente').DataTable({
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
    var tabla_cliente = $('#tabla-empleado').DataTable({
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
    $('#comprobantes').on('change', function() {
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

    })

    $(document).on("click", ".btn-check-cliente", function() {

        cliente = $(this).val();
        infocliente = cliente.split("*");
        $("#idcliente").val(infocliente[0]);
        $("#cliente").val(infocliente[1]);
        $("#modal-default").modal("hide");
    });
    $(document).on("click", ".btn-check-empleado", function() {

        empleado = $(this).val();
        infocliente = empleado.split("*");
        $("#idempleado").val(infocliente[0]);
        $("#empleado").val(infocliente[1] + ' ' + infocliente[2]);
        $("#modal-empleados").modal("hide");
    });

    // Funciones de las tablas de categorias
    $(document).on("click", "#agregar_fila", function() {

        id_categoria = $(this).val();
        agregarServicio(id_categoria);

    });
    $(document).on("click", ".btn-check-categoria", function() {
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
    $(document).on("click", ".eliminar-tabla-categoria", function() {

        id_tabla_eliminar = $(this).val();
        restarTabla(id_tabla_eliminar);
        $("." + id_tabla_eliminar).remove();
    });

    //Terminan las funciones de tablas de categorias
    $(document).on("click", ".btn-remove-producto", function() {

        id_tabla = $(this).closest('tr').closest('tbody').closest('table').attr('id');
        $(this).closest("tr").remove();
        sumarTabla(id_tabla);
    });

    $(document).on('click', '.btn-view-venta', function() {
        valor_id = $(this).val();
        $.ajax({
            url: base_url + 'Movimientos/Ventas/vista',
            type: 'POST',
            dataType: 'html',
            data: {
                id: valor_id
            },
            success: function(data) {

                $('#modal-default .modal-body').html(data);
            }
        });
    });

    $(document).on('click', '.btn-print', function() {

        $("#modal-default .modal-body").print({
            title: 'Comprobante de venta',
        });
    });

    $(document).on('click', '.btn-borrar', function() {

        Swal.fire({
            title: 'Esta seguro de elimar?',
            text: "El presupuesto se eliminara!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {

                var id = $(this).val();

                $.ajax({
                    url: base_url + 'Movimientos/Presupuesto/borrar/' + id,
                    type: 'POST',
                    success: function(resp) {
                        window.location.href = base_url + resp;

                    }
                })



            }
        })
    });

    $(document).on("change", ".costo, .cantidad, .dias", function() {

        id_tabla = $(this).closest('tr').closest('tbody').closest('table').attr('id');
        sumarTabla(id_tabla);
    });
    $(document).on('submit', '#guardar_presupuesto', function(e) {
        e.preventDefault();
        id_cliente = $.trim($('#idcliente').val());
        fecha = $.trim($('#fecha').val());
        proyecto = $.trim($('#proyecto').val());
        fase_proyecto = $.trim($('#fase_proyecto').val());
        id_empleado = $.trim($('#idempleado').val());
        importeTotal = $.trim($('#importeTotal').val());
        iva = $.trim($('#iva').val());
        facturaTotal = $.trim($('#facturaTotal').val());

        //Datos del detalle de presupuesto
        cantidad = new Array;
        dias = new Array;
        costo = new Array;
        total = new Array;
        facturado = new Array;
        observaciones = new Array;
        id_categoria = new Array;
        nombre = new Array;

        id_categoria2 = document.guardar_presupuesto.elements['id_categoria[]'];
        nombre2 = document.guardar_presupuesto.elements['nombre[]'];
        cantidad2 = document.guardar_presupuesto.elements['cantidad[]'];
        dias2 = document.guardar_presupuesto.elements['dias[]'];
        costo2 = document.guardar_presupuesto.elements['costo[]'];
        total2 = document.guardar_presupuesto.elements['total[]'];
        facturado2 = document.guardar_presupuesto.elements['facturado[]'];
        observaciones2 = document.guardar_presupuesto.elements['observaciones[]'];

        if (typeof cantidad2 !== 'undefined') {
            for (i = 0; i < cantidad2.length; i++) {
                id_categoria.push(id_categoria2[i].value);
                nombre.push(nombre2[i].value);
                cantidad.push(cantidad2[i].value);
                dias.push(dias2[i].value);
                costo.push(costo2[i].value);
                total.push(total2[i].value);
                facturado.push(facturado2[i].value);
                observaciones.push(observaciones2[i].value);
            }
        }

        $.ajax({
            type: "POST",
            url: base_url + "Movimientos/Presupuesto/guardar",
            data: {
                id_cliente: id_cliente,
                fecha: fecha,
                proyecto: proyecto,
                fase_proyecto: fase_proyecto,
                id_empleado: id_empleado,
                importeTotal: importeTotal,
                iva: iva,
                facturaTotal: facturaTotal,
                id_categoria: id_categoria,
                nombre: nombre,
                cantidad: cantidad,
                dias: dias,
                costo: costo,
                total: total,
                facturado: facturado,
                observaciones: observaciones,
            },
            dataType: "json",
            success: function(respuesta) {
                if (respuesta['tipo'] === 'Exitoso') {
                    window.location.href = base_url + "Movimientos/Presupuesto";
                } else {
                    swal({
                        title: 'Error',
                        text: respuesta['respuesta'],
                        type: 'error'
                    });
                }

            }
        });

    });
    $(document).on('submit', '#editar_presupuesto', function(e) {
        e.preventDefault();
        id_ventas = $.trim($('#id_ventas').val());
        id_cliente = $.trim($('#idcliente').val());
        fecha = $.trim($('#fecha').val());
        proyecto = $.trim($('#proyecto').val());
        fase_proyecto = $.trim($('#fase_proyecto').val());
        id_empleado = $.trim($('#idempleado').val());
        importeTotal = $.trim($('#importeTotal').val());
        iva = $.trim($('#iva').val());
        facturaTotal = $.trim($('#facturaTotal').val());

        //Datos del detalle de presupuesto
        cantidad = new Array;
        dias = new Array;
        costo = new Array;
        total = new Array;
        facturado = new Array;
        observaciones = new Array;
        id_categoria = new Array;
        nombre = new Array;

        id_categoria2 = document.editar_presupuesto.elements['id_categoria[]'];
        nombre2 = document.editar_presupuesto.elements['nombre[]'];
        cantidad2 = document.editar_presupuesto.elements['cantidad[]'];
        dias2 = document.editar_presupuesto.elements['dias[]'];
        costo2 = document.editar_presupuesto.elements['costo[]'];
        total2 = document.editar_presupuesto.elements['total[]'];
        facturado2 = document.editar_presupuesto.elements['facturado[]'];
        observaciones2 = document.editar_presupuesto.elements['observaciones[]'];

        if (typeof cantidad2 !== 'undefined') {
            for (i = 0; i < cantidad2.length; i++) {
                id_categoria.push(id_categoria2[i].value);
                nombre.push(nombre2[i].value);
                cantidad.push(cantidad2[i].value);
                dias.push(dias2[i].value);
                costo.push(costo2[i].value);
                total.push(total2[i].value);
                facturado.push(facturado2[i].value);
                observaciones.push(observaciones2[i].value);
            }
        }

        $.ajax({
            type: "POST",
            url: base_url + "Movimientos/Presupuesto/actualizar",
            data: {
                id_ventas: id_ventas,
                id_cliente: id_cliente,
                fecha: fecha,
                proyecto: proyecto,
                fase_proyecto: fase_proyecto,
                id_empleado: id_empleado,
                importeTotal: importeTotal,
                iva: iva,
                facturaTotal: facturaTotal,
                id_categoria: id_categoria,
                nombre: nombre,
                cantidad: cantidad,
                dias: dias,
                costo: costo,
                total: total,
                facturado: facturado,
                observaciones: observaciones,
            },
            dataType: "json",
            success: function(respuesta) {
                if (respuesta['tipo'] === 'Exitoso') {
                    window.location.href = base_url + "Movimientos/Presupuesto";
                } else {
                    swal({
                        title: 'Error',
                        text: respuesta['respuesta'],
                        type: 'error'
                    });
                }

            }
        });

    });

})

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

function agregarServicio(id_categoria) {
    if (id_categoria > 0) {
        html = "<tr>";
        html += "<td><input type ='hidden' class='id_categoria' name = 'id_categoria[]' value = '" + id_categoria + "'><input type='text' class='nombre form-control' name= 'nombre[]' value =''></td>";
        html += "<td><input type = 'number' step = '0.01' value = '1' class='cantidad form-control' min = '0' name = 'cantidad[]' ></td>";
        html += "<td><input type = 'number' step = '0.01' value = '1' class='dias form-control' min = '0' name = 'dias[]' ></td>";
        html += "<td><input type = 'number' step = '0.01' value = '0' class='costo form-control' min = '0' name = 'costo[]' ></td>";
        html += "<td><input type = 'number' step = '0.01' value = '0' readonly class='total form-control' min = '0' name = 'total[]'  ></td>";
        html += "<td><input type = 'number' step = '0.01' value = '0' readonly class='facturado form-control' min = '0' name = 'facturado[]' ></td>";
        html += "<td><input type = 'text' maxlength='100'  class='observaciones form-control' min = '0' name = 'observaciones[]' ></td>";
        html += "<td><button type='button' class='btn btn-danger btn-remove-producto' title = 'Eliminar fila!'><span class='fa fa-remove'></span></button></td>";
        html += "</tr>";
        $("#tabla-categoria-" + id_categoria + " tbody").append(html);
    } else {
        alert("seleccione una tabla");
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
    html += "<button class='btn btn-primary btn-flat btn-block' id = 'agregar_fila' value = '" + id_categoria + "' type='button'><span class='fa fa-plus '></span><small> " + nombre_categoria + "</small></button>";
    html += "</div>";
    html += "<div class = 'col-md-1 col-md-offset-10'>"
    html += "<button id = 'eliminar-tabla-categoria' value = 'tabla-categoria-" + id_categoria + "' class='btn btn-danger btn-flat eliminar-tabla-categoria' type='button' title = 'Eliminar Tabla!'><span class='fa fa-remove'></span></button>";
    html += "</div>";
    html += "</div>";
    html += "<table id='tabla-categoria-" + id_categoria + "' class='table jambo_table table-hover'>";
    html += "<thead>";
    html += "<tr>";
    html += "<th>Nombre</th>";
    html += "<th>Cantidad</th>";
    html += "<th>Dias</th>";
    html += "<th>Costo $</th>";
    html += "<th>Total $</th>";
    html += "<th>Facturado $</th>";
    html += "<th>Observaciones</th>";
    html += "<th>Opciones</th>";
    html += "</tr>";
    html += "</thead>";
    html += "<tbody>";
    html += "<tr>";
    html += "<td><input type ='hidden' class='id_categoria' name = 'id_categoria[]' value = '" + id_categoria + "'><input type='text' class='nombre form-control' name= 'nombre[]' value =''></td>";
    html += "<td><input type = 'number' step = '0.01' value = '1' class='cantidad form-control' min = '0' name = 'cantidad[]' ></td>";
    html += "<td><input type = 'number' step = '0.01' value = '1' class='dias form-control' min = '0' name = 'dias[]' ></td>";
    html += "<td><input type = 'number' step = '0.01' value = '0' class='costo form-control' min = '0' name = 'costo[]' ></td>";
    html += "<td><input type = 'number' step = '0.01' value = '0' readonly class='total form-control' min = '0' name = 'total[]'  ></td>";
    html += "<td><input type = 'number' step = '0.01' value = '0' readonly class='facturado form-control' min = '0' name = 'facturado[]' ></td>";
    html += "<td><input type = 'text' maxlength='100'  class='observaciones form-control' min = '0' name = 'observaciones[]' ></td>";
    html += "<td><button type='button' class='btn btn-danger btn-remove-producto' title = 'Eliminar fila!'><span class='fa fa-remove'></span></button></td>";
    html += "</tr>";
    html += "</tbody>";
    html += "<tfoot>";
    html += '<tr>';
    html += '<th colspan = "4">Totales </th>';
    html += '<th><p>0</p></th>';
    html += '<th><p>0</p></th>';
    html += '<th><p></p></th>';
    html += '<th><p></p></th>';
    html += '</tr>';
    html += "</tfoot>";
    html += "</table>";
    html += "<hr>";
    html += "</div>";

    $("#tablas-categorias").append(html);

}

function sumarTabla(id_tabla) {
    sumaTotal = 0;
    sumaFacturado = 0;
    $('#' + id_tabla + ' tbody tr').each(function() {
        cantidad = Number($(this).find("td:eq(1)").children('input').val());
        dias = Number($(this).find("td:eq(2)").children('input').val());
        costo = Number($(this).find("td:eq(3)").children('input').val());
        total = cantidad * dias * costo;
        facturado = (total * 1.16).toFixed(2);
        sumaTotal = sumaTotal + total;
        sumaFacturado = Number(sumaFacturado) + Number(facturado);
        $(this).find("td:eq(4)").children('input').val(total);
        $(this).find("td:eq(5)").children('input').val(facturado);
    });
    totalAnterio = Number($('#' + id_tabla + ' tfoot tr th:eq(1)').children('p').text());
    $('#' + id_tabla + ' tfoot tr th:eq(1)').children('p').text(sumaTotal.toFixed(2));
    $('#' + id_tabla + ' tfoot tr th:eq(2)').children('p').text(sumaFacturado.toFixed(2));
    difTotalTabla = sumaTotal - totalAnterio;
    sumarTotales(difTotalTabla);

}

function restarTabla(id_tabla) {
    sumaTotal = 0;
    sumaFacturado = 0;
    $('#' + id_tabla + ' tbody tr').each(function() {
        cantidad = Number($(this).find("td:eq(1)").children('input').val());
        dias = Number($(this).find("td:eq(2)").children('input').val());
        costo = Number($(this).find("td:eq(3)").children('input').val());
        total = cantidad * dias * costo;
        facturado = (total * 1.16).toFixed(2);
        sumaTotal = sumaTotal + total;
        sumaFacturado = Number(sumaFacturado) + Number(facturado);
        $(this).find("td:eq(4)").children('input').val(total);
        $(this).find("td:eq(5)").children('input').val(facturado);
    });
    totalAnterio = Number($('#' + id_tabla + ' tfoot tr th:eq(1)').children('p').text());
    $('#' + id_tabla + ' tfoot tr th:eq(1)').children('p').text(sumaTotal.toFixed(2));
    $('#' + id_tabla + ' tfoot tr th:eq(2)').children('p').text(sumaFacturado.toFixed(2));
    totalRestar = sumaTotal * -1;
    sumarTotales(totalRestar);
}

function sumarTotales(difTotalTabla) {

    total = $("input[name=importeTotal]").val();
    total = Number(total) + Number(difTotalTabla);
    totalFacturado = total * 1.16;
    iva = total * 0.16;
    $("input[name=importeTotal]").val(total.toFixed(2));
    $("input[name=iva]").val(iva.toFixed(2));
    $("input[name=facturaTotal]").val(totalFacturado.toFixed(2));

}