$(document).ready(function () {

    $('#form-SalesBySeller').on('submit', function (e) {
        e.preventDefault();
        $("#listadoReporte1").html("");
        $("#listadoReporte2").html("");
        
        var tabla = '<div class="box-body table-responsive no-padding"><table id="registros" class="table table-bordered table-striped"><thead><tr><th>Fecha</th><th>Factura No°</th><th>Cliente</th><th>Fecha de vencimiento</th><th>Método de pago</th><th>Envío No°</th><th>Anticipo</th><th>Total</th><th><i class="fa fa-cogs"></i> Acciones</th></tr></thead><tbody class="contenidoRPT"></tbody><tfoot><tr><th>Fecha</th><th>Factura No°</th><th>Cliente</th><th>Fecha de vencimiento</th><th>Método de pago</th><th>Envío No°</th><th>Entrega No°</th><th>Anticipo</th><th>Total</th><th><span class="fa fa-cogs"></span></th></tr></tfoot></table></div><button type="button" onclick="printReport2()" class="btn bg-teal-active btn-sm"><i class="fa fa-print"></i> Imprimir</button><a id="btn_avanzar" href="#tab_2" data-toggle="tab" class="btn btn-flat pull-right text-bold btn_avanzar" hidden><i class="glyphicon glyphicon-forward"></i> Avanzar a la venta seleccionada...</a>';

        $("#listadoReporte2").append(tabla);
        
        var datos = $(this).serializeArray();

        swal({
            title: 'Generando el reporte...'
        });

        swal.showLoading();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            datatype: 'json',
            success: function (data) {
                console.log(data);
                $.each(data, function (key, registro) {
                    var contenido = "<tr>";
                    contenido += "<td><input class='idVen' type='hidden' value='" + registro._idSeller + "'>" + registro.dateStart + "</td>";
                    contenido += '<td><small class="text-orange text-muted">Factura No°</small><br><small>'+ registro.serie +' '+ registro.noBill +'</small><br><small class="text-olive text-muted">Remision No°</small><br><small>'+ registro.noDeliver +'</small></td>';
                    contenido += "<td><input class='fp"+ registro.idSale +"' type='hidden' value='" + registro.fechapago + "'>" + registro.customer + "</td>";
                    contenido += "<td><input class='fv"+ registro.idSale +"' type='hidden' value='" + registro.dateEnd + "'>" + registro.dateEnd + "</td>";
                    contenido += "<td>" + registro.paymentMethod + "</td>";
                    contenido += "<td>" + registro.noShipment + "</td>";
                    contenido += "<td>" + registro.advance + "</td>";
                    contenido += "<td>" + registro.totalSale + "</td>";
                    contenido += '<td><div class="btn-group-vertical"><a href="#tab_2" onclick="listarDetallerpt2('+ registro.idSale +')" data-toggle="tab" class="btn bg-teal btn-flat margin detalle_rpt2"><i class="fa fa-info"></i></a></div></td>';
                    contenido += '</tr>';
                    $(".contenidoRPT").append(contenido);
                });
                swal.close();
                funciones();
                
            },
            error: function (data) {
                swal({
                    type: 'error',
                    title: 'Error',
                    text: 'Algo ha salido mal, intentalo más tarde',
                })
            }

        });
    });

    $('#form-rpt1').on('submit', function (e) {
        e.preventDefault();

        $("#listadoReporte1").html("");
        $("#listadoReporte2").html("");

        var datos = $(this).serializeArray();

        swal({
            title: 'Generando el reporte...'
        });

        swal.showLoading();

        var tabla = '<div class="box-body table-responsive no-padding"><table id="registros" class="table table-bordered table-striped"><thead><tr><th>Ruta</th><th>Vendedor</th><th>Cliente</th><th>Factura No°</th><th>Adelanto</th><th>Total</th><th>Fecha de Venta</th><th>Fecha de Vencimiento</th><th>Envío No°</th><th>Días</th><th>30 días</th><th>60 días</th><th>90 días</th></tr></thead><tbody class="contenidoRPT1"></tbody><tfoot><tr><th>Ruta</th><th>Vendedor</th><th>Cliente</th><th>Factura No°</th><th>Adelanto</th><th>Total</th><th>Fecha de Venta</th><th>Fecha de Vencimiento</th><th>Envío No°</th><th>Días</th><th>30 días</th><th>60 días</th><th>90 días</th></tr></tfoot></table></div><button type="button" onclick="printReport1()" class="btn bg-teal-active btn-sm"><i class="fa fa-print"></i> Imprimir</button>';

        $("#listadoReporte1").append(tabla);

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            datatype: 'json',
            success: function (data) {
                console.log(data);
                $.each(data, function (key, registro) {
                    var contenido = "<tr>";
                    contenido += "<td>" + registro.route + "</td>";
                    contenido += "<td>" + registro.seller + "</td>";
                    contenido += "<td>" + registro.customer + "</td>";
                    contenido += '<td><small class="text-orange text-muted">Factura No°</small><br><small>'+ registro.serie +' '+ registro.noBill +'</small><br><small class="text-olive text-muted">Remision No°</small><br><small>'+ registro.noDeliver +'</small></td>';
                    contenido += "<td>" + registro.advance + "</td>";
                    contenido += "<td>" + registro.totalSale + "</td>";
                    contenido += "<td>" + registro.dateStart + "</td>";
                    contenido += "<td>" + registro.dateEnd + "</td>";
                    contenido += "<td>" + registro.noShipment + "</td>";
                    contenido += "<td>" + registro.days + "</td>";
                    contenido += "<td>" + registro.mora30 + "</td>";
                    contenido += "<td>" + registro.mora60 + "</td>";
                    contenido += "<td>" + registro.mora90 + "</td>";
                    contenido += '</tr>';
                    $(".contenidoRPT1").append(contenido);
                });
                
                swal.close();
                funciones();
            },
            error: function (data) {
                swal({
                    type: 'error',
                    title: 'Error',
                    text: 'Algo ha salido mal, intentalo más tarde',
                })
            }
        });
    })

});

function listarDetallerpt2(idv) {
    jQuery('.btn_avanzar').attr('hidden', false);
    $("#listadoDetalle2").html("");
    
    var tabla = '<div class="box-body table-responsive no-padding"><table id="registros2" class="table table-bordered table-striped"><thead><tr><th>Codigo de Product</th><th>Nombre</th><th>Marca</th><th>Cantidad</th><th>Precio</th><th>Descuento</th><th>SubTotal</th><th>Comisión</th></tr></thead><tbody class="contenidorptDetalle2"></tbody><tfoot><tr><th>Codigo de Product</th><th>Nombre</th><th>Marca</th><th>Cantidad</th><th>Precio</th><th>Descuento</th><th>SubTotal</th><th>Comisión</th></tr></tfoot></table></div><button type="button" onclick="printrptDetail2('+idv+')" class="btn bg-teal-active btn-sm"><i class="fa fa-print"></i> Imprimir</button>';

    $("#listadoDetalle2").append(tabla);
    
    
    var fecha1 = $('.fp'+idv).val();
    var fecha2 = $('.fv'+idv).val();
    var date1 = new Date(fecha1);
    var date2 = new Date(fecha2);
    console.log(date1);
    console.log(date2);

    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
    console.log(diffDays);

    swal({
        title: 'Generando el reporte...'
    });

    swal.showLoading();

    $.ajax({
        type: 'POST',
        data: {
            'idVenta': idv
        },
        url: 'BLL/rptDetailSalesBySeller.php',
        success(data) {
            console.log(data);
            $.each(data, function (key, registro) {
                var sub = registro.quantity * (parseFloat(Math.round(registro.priceS * 100) / 100).toFixed(2) - parseFloat(Math.round(registro.discount * 100) / 100).toFixed(2));
                var contenido = "<tr>";
                contenido += "<td>" + registro.codigo + "</td>";
                contenido += "<td>" + registro.nombre + "</td>";
                contenido += "<td>" + registro.marca + "</td>";
                contenido += "<td>" + registro.quantity + "</td>";
                contenido += "<td>" + registro.priceS + "</td>";
                contenido += "<td>" + registro.discount + "</td>";
                contenido += "<td>" + sub.toFixed(2) + "</td>";
                contenido += "<td>" + comision(diffDays, registro.marca, sub.toFixed(2)) + "</td>";
                contenido += '</tr>';
                $(".contenidorptDetalle2").append(contenido);
            });
            swal.close();
            funciones2();
        },
        error: function (data) {
            swal({
                type: 'error',
                title: 'Error',
                text: 'Algo ha salido mal, intentalo más tarde',
            })
        }
    })
}

function printReport2() {
    
    var idSeller = $('.idVen').val();
    var f1 = $("[name='dateSrpt2']").val();
    var f2 = $("[name='dateErpt2']").val();
    changeReport('salesBySeller.php?idVendedor='+idSeller+'&fecha1='+f1+'&fecha2='+f2);
    $('#modal-reporte').modal('show');
}

function printReport1() {
    
    changeReport('ventasVencidas.php');
    $('#modal-reporte').modal('show');
}

function printrptDetail2(idVent) {
    
    var fec1 = $('.fp'+idVent).val();
    var fec2 = $('.fv'+idVent).val();
    changeReport('salesBySellerDetail.php?idVenta='+idVent+'&fecha1='+fec1+'&fecha2='+fec2);
    $('#modal-reporte').modal('show');
}

function convertDate(dateString) {
    var p = dateString.split(/\D/g)
    return [p[2], p[1], p[0]].join("-")
}

function comision(dif, marca, subtotal) {
    var comision;
    if (marca == 'SCHLENKER') {
        if (dif <= 30) {
            comision = subtotal * 0.1;
        } else if (dif > 30 && dif <= 60) {
            comision = subtotal * 0.08;
        } else if (dif > 60 && dif <= 90) {
            comision = subtotal * 0.05;
        } else {
            comision = 0;
        }
    } else {
        if (dif <= 30) {
            comision = subtotal * 0.05;
        } else if (dif > 30 && dif <= 60) {
            comision = subtotal * 0.03;
        } else {
            comision = 0;
        }
    }

    return comision.toFixed(2);
}

function funciones() {
    $('#registros').DataTable({
        'paging'      : true,
        'lengthChange': true,
        "aLengthMenu" : [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'language'    : {
          paginate: {
            next:     'Siguiente',
            previous: 'Anterior',
            first:    'Primero',
            last:     'Último'
          },
          info: 'Mostrando _START_-_END_ de _TOTAL_ registros',
          empyTable:  'No hay registros',
          infoEmpty:  '0 registros',
          lengthChange: 'Mostrar ',
          infoFiltered: "(Filtrado de _MAX_ total de registros)",
          lengthMenu: "Mostrar _MENU_ registros",
          loadingRecords: "Cargando...",
          processing: "Procesando...",
          search: "Buscar:",
          zeroRecords: "Sin resultados encontrados"
        }
    });
}

function funciones2() {
    $('#registros2').DataTable({
        'paging'      : true,
        'lengthChange': true,
        "aLengthMenu" : [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true,
        'language'    : {
          paginate: {
            next:     'Siguiente',
            previous: 'Anterior',
            first:    'Primero',
            last:     'Último'
          },
          info: 'Mostrando _START_-_END_ de _TOTAL_ registros',
          empyTable:  'No hay registros',
          infoEmpty:  '0 registros',
          lengthChange: 'Mostrar ',
          infoFiltered: "(Filtrado de _MAX_ total de registros)",
          lengthMenu: "Mostrar _MENU_ registros",
          loadingRecords: "Cargando...",
          processing: "Procesando...",
          search: "Buscar:",
          zeroRecords: "Sin resultados encontrados"
        }
    });
}