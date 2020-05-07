$(document).ready(function () {
    
    oTable = $('#ordersHome').DataTable({

        language: {
            "decimal": "",
            "emptyTable": "No hay pedidos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },

        "processing": true,
        "serverSide": true,
        "ajax": "/userorders",
        "columns": [
            { data: 'id' },
            { data: 'product.name' },
            { data: 'product.value' },
            { data: 'status',
            "render": function (table, type, row) {
 
                if (row.status === 'PAYED') {
                    return '<p class="btn btn-success">PAGADO</p>';
                }
                else if (row.status === 'REJECTED') {
                    return '<form action="/retrypayment" method="GET">'+
                    '<input type="hidden" value="'+row.id+'" name="order_id" id="order_id" readonly>'+
                    '<input type="hidden" value="'+row.product_id+'" name="product_id" id="product_id" readonly>'+
                    '<button type="submit" class="btn btn-danger"> RECHAZADO REINTENTAR</button>'+
                    '</form>'
                    ;
                    //return 'RECHAZADO';
                } else{
                    return '<a class="btn btn-info" href="'+row.processUrl+'">PENDIENTE</a>';
                    //return 'PENDIENTE';
                }
                }
            },
            {data: null, "render": function ( data, type, row ) {
                return '<a class="btn btn-primary" href="/orderpayment/'+row.id+'">Más información</a>';
            }}
        ]

    })

    oTable2 = $('#orders').DataTable({

        language: {
            "decimal": "",
            "emptyTable": "No hay pedidos",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },

        "processing": true,
        "serverSide": true,
        "ajax": "/alldtorders",
        "columns": [
            { data: 'id' },
            { data: 'product.name' },
            { data: 'product.value' },
            { data: 'status',
            "render": function (table, type, row) {
 
                if (row.status === 'PAYED') {
                    return '<p class="btn btn-success">PAGADO</p>';
                }
                else if (row.status === 'REJECTED') {
                    return '<p class="btn btn-danger">RECHAZADO</p>';
                    //return 'RECHAZADO';
                } else{
                    return '<a class="btn btn-info">PENDIENTE</a>';
                    //return 'PENDIENTE';
                }
                }
            },
        ]

    })
});
