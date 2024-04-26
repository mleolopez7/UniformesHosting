let tblUsuarios, tblRoles, tblProveedores, tblProductosb, tblClientes, tblTallas, tblInventario, tblKardex,
    tblMateriaPrima, tblProduccion, tblCatalogo;
document.addEventListener("DOMContentLoaded", function () {
    cargarProveedores();
    cargarClientes();
    cargarMateriaPrima();
    cargarProductosBase();
    cargarTallas();



    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        }
        ,
        columns: [
            {
                'data': 'id'
            },
            {
                'data': 'usuario'
            },
            {
                'data': 'nombre'
            },
            {
                'data': 'correo'
            },
            {
                'data': 'caja'
            },
            {
                'data': 'rol'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de usuarios',
            filename: 'Reporte de usuarios',
            text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge badge-light" style="background-color: grey;"><i class="fas fa-print"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    });

    //Fin de la tabla usuarios

    tblRoles = $('#tblRoles').DataTable({
        ajax: {
            url: base_url + "Roles/listar",
            dataSrc: ''
        }
        ,
        columns: [
            {
                'data': 'id'
            },
            {
                'data': 'rol'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de Roles',
            filename: 'Reporte de Roles',
            text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de Roles',
            filename: 'Reporte de Roles',
            text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge badge-light" style="background-color: grey;"><i class="fas fa-print"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    });

    //tabla de compras con proveedores
    tblProveedores = $('#tblProveedores').DataTable({
        ajax: {
            url: base_url + "Proveedores/listar",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'proveedores_id'
            },
            {
                'data': 'nombre_proveedor'
            },
            {
                'data': 'direccion'
            },
            {
                'data': 'telefono'
            },
            {
                'data': 'condiciones_pago'
            },
            {
                'data': 'plazo_entrega'
            },
            {
                'data': 'estado'
            },
            {
                'data': 'acciones'
            }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de Proveedores',
            filename: 'Reporte de Proveedores',
            text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de Proveedores',
            filename: 'Reporte de Proveedores',
            text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge badge-light" style="background-color: grey;"><i class="fas fa-print"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    });

    //fin de la tabla Proveedores


    //tabla compras realizadas
    $('#tblrealizadas').DataTable({
        ajax: {
            url: base_url + "Compras/listar_realizadas",
            dataSrc: ''
        },
        columns: [
            {
                'data': 'factura'
            },
            {
                'data': 'total'
            },
            {
                'data': 'fecha'
            },
            {
                'data': 'acciones'
            }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de Compras Realizadas',
            filename: 'Reporte de Compras Realizadas',
            text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de Compras Realizadas',
            filename: 'Reporte de Compras Realizadas',
            text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge badge-light" style="background-color: grey;"><i class="fas fa-print"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    });



    //tabla de productos base
    tblProductosb = $('#tblProductosb').DataTable({
        ajax: {
            url: base_url + "Productos/listar",
            dataSrc: ''
        }
        ,
        columns: [
            {
                'data': 'id_productob'
            },
            {
                'data': 'codigo_productob'
            },
            {
                'data': 'nombrepb'
            },
            {
                'data': 'descripcionpb'
            },
            {
                'data': 'tipo_productob'
            },
            {
                'data': 'estadopb'
            },
            {
                'data': 'acciones'
            }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [{
            //Botón para Excel
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',

            //Aquí es donde generas el botón personalizado
            text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
        },
        //Botón para PDF
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de Productos',
            filename: 'Reporte de Productos',
            text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para copiar
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de Productos',
            filename: 'Reporte de Productos',
            text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, ':visible']
            }
        },
        //Botón para print
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge badge-light" style="background-color: grey;"><i class="fas fa-print"></i></span>'
        },
        //Botón para cvs
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
        ]
    });

});


//tabla de clientes

tblClientes = $('#tblClientes').DataTable({
    ajax: {
        url: base_url + "Clientes/listar",
        dataSrc: ''
    },
    columns: [
        {
            'data': 'ClienteID'
        },
        {
            'data': 'NombreCompleto'
        },
        {
            'data': 'Identificacion'
        },
        {
            'data': 'Telefono'
        },
        {
            'data': 'Estado'
        },
        {
            'data': 'acciones'
        }
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    },
    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [{
        //Botón para Excel
        extend: 'excelHtml5',
        footer: true,
        title: 'Archivo',
        filename: 'Export_File',

        //Aquí es donde generas el botón personalizado
        text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
    },
    //Botón para PDF
    {
        extend: 'pdfHtml5',
        download: 'open',
        footer: true,
        title: 'Reporte de Clientes',
        filename: 'Reporte de Clientes',
        text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    //Botón para copiar
    {
        extend: 'copyHtml5',
        footer: true,
        title: 'Reporte de Clientes',
        filename: 'Reporte de Clientes',
        text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    //Botón para print
    {
        extend: 'print',
        footer: true,
        filename: 'Export_File_print',
        text: '<span class="badge badge-light" style="background-color: grey;"><i class="fas fa-print"></i></span>'
    },
    //Botón para cvs
    {
        extend: 'csvHtml5',
        footer: true,
        filename: 'Export_File_csv',
        text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
    },
    {
        extend: 'colvis',
        text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
        postfixButtons: ['colvisRestore']
    }
    ]
});


//Tabla Tallas

tblTallas = $('#tblTallas').DataTable({
    ajax: {
        url: base_url + "Tallas/listar",
        dataSrc: ''
    },
    columns: [
        {
            'data': 'TallasID'
        },
        {
            'data': 'TipoTalla'
        },
        {
            'data': 'estado'
        },
        {
            'data': 'acciones'
        }
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    },
    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [{
        //Botón para Excel
        extend: 'excelHtml5',
        footer: true,
        title: 'Archivo',
        filename: 'Export_File',

        //Aquí es donde generas el botón personalizado
        text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
    },
    //Botón para PDF
    {
        extend: 'pdfHtml5',
        download: 'open',
        footer: true,
        title: 'Reporte de Tallas',
        filename: 'Reporte de Tallas',
        text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    //Botón para copiar
    {
        extend: 'copyHtml5',
        footer: true,
        title: 'Reporte de Tallas',
        filename: 'Reporte de Tallas',
        text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    //Botón para print
    {
        extend: 'print',
        footer: true,
        filename: 'Export_File_print',
        text: '<span class="badge badge-light" style="background-color: grey;"><i class="fas fa-print"></i></span>'
    },
    //Botón para cvs
    {
        extend: 'csvHtml5',
        footer: true,
        filename: 'Export_File_csv',
        text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
    },
    {
        extend: 'colvis',
        text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
        postfixButtons: ['colvisRestore']
    }
    ]
});


//Tabla inventario

tblInventario = $('#tblInventario').DataTable({
    ajax: {
        url: base_url + "Inventario/listar",
        dataSrc: ''
    },
    columns: [
        {
            'data': 'id_inventario'
        },
        {
            'data': 'proveedor'
        },
        {
            'data': 'id_producto'
        },
        {
            'data': 'producto'
        },
        {
            'data': 'descripcion'
        },
        {
            'data': 'cantidad'
        },
        {
            'data': 'fecha_entrada'
        },
        {
            'data': 'almacen'
        }
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    },
    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [{
        //Botón para Excel
        extend: 'excelHtml5',
        footer: true,
        title: 'Archivo',
        filename: 'Export_File',

        //Aquí es donde generas el botón personalizado
        text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
    },
    //Botón para PDF
    {
        extend: 'pdfHtml5',
        download: 'open',
        footer: true,
        title: 'Reporte de Inventario',
        filename: 'Reporte de Inventario',
        text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    //Botón para copiar
    {
        extend: 'copyHtml5',
        footer: true,
        title: 'Reporte de Inventario',
        filename: 'Reporte de Inventario',
        text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    //Botón para print
    {
        extend: 'print',
        footer: true,
        filename: 'Export_File_print',
        text: '<span class="badge badge-light" style="background-color: grey;"><i class="fas fa-print"></i></span>'
    },
    //Botón para cvs
    {
        extend: 'csvHtml5',
        footer: true,
        filename: 'Export_File_csv',
        text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
    },
    {
        extend: 'colvis',
        text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
        postfixButtons: ['colvisRestore']
    }
    ]
});



//Tabla Kardex
tblKardex = $('#tblKardex').DataTable({
    ajax: {
        url: base_url + "Kardex/listar",
        dataSrc: ''
    },
    columns: [
        {
            'data': 'id_kardex'
        },
        {
            'data': 'id_inventario'
        },
        {
            'data': 'proveedor'
        },
        {
            'data': 'id_producto'
        },
        {
            'data': 'producto'
        },
        {
            'data': 'descripcion'
        },
        {
            'data': 'tipo_kardex'
        },
        {
            'data': 'fecha_entrada'
        },
        {
            'data': 'cantidad_entrada'
        },
        {
            'data': 'fecha_salida'
        },
        {
            'data': 'factura'
        },
        {
            'data': 'cantidad_salida'
        },
        {
            'data': 'motivo_salida'
        },
        {
            'data': 'precio_unitario'
        },
        {
            'data': 'costo_total'
        }
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    },
    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [{
        //Botón para Excel
        extend: 'excelHtml5',
        footer: true,
        title: 'Archivo',
        filename: 'Export_File',

        //Aquí es donde generas el botón personalizado
        text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
    },
    //Botón para PDF
    {
        extend: 'pdfHtml5',
        download: 'open',
        footer: true,
        title: 'Reporte de Kardex',
        filename: 'Reporte de Kardex',
        text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    //Botón para copiar
    {
        extend: 'copyHtml5',
        footer: true,
        title: 'Reporte de Kardex',
        filename: 'Reporte de Kardex',
        text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    //Botón para print
    {
        extend: 'print',
        footer: true,
        filename: 'Export_File_print',
        text: '<span class="badge badge-light" style="background-color: grey;"><i class="fas fa-print"></i></span>'
    },
    //Botón para cvs
    {
        extend: 'csvHtml5',
        footer: true,
        filename: 'Export_File_csv',
        text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
    },
    {
        extend: 'colvis',
        text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
        postfixButtons: ['colvisRestore']
    }
    ]
});


//Tabla Materia Prima
tblMateriaPrima = $('#tblMateriaPrima').DataTable({
    ajax: {
        url: base_url + "MateriaPrima/listar",
        dataSrc: ''
    },
    columns: [
        {
            'data': 'id_producto'
        },
        {
            'data': 'producto'
        },
        {
            'data': 'descripcion'
        },
        {
            'data': 'estado'
        },
        {
            'data': 'acciones'
        }
    ]
});


//Tabla para produccion
tblProduccion = $('#tblProduccion').DataTable({
    ajax: {
        url: base_url + "Produccion/listar",
        dataSrc: ''
    },
    columns: [
        {
            'data': 'factura'
        },
        {
            'data': 'cliente'
        },
        {
            'data': 'identificacion'
        },
        {
            'data': 'telefono'
        },
        {
            'data': 'fecha_entrega'
        },
        {
            'data': 'total'
        },
        {
            'data': 'saldo'
        },
        {
            'data': 'acciones'
        }
    ]
});



// Table venntas realizadas

$('#tblvrealizadas').DataTable({
    ajax: {
        url: base_url + "Ventas/listar_realizadas",
        dataSrc: ''
    },
    columns: [
        {
            'data': 'factura'
        },
        {
            'data': 'cliente'
        },
        {
            'data': 'telefono'
        },
        {
            'data': 'identificacion'
        },
        {
            'data': 'fecha_actual'
        },
        {
            'data': 'fecha_entrega'
        },
        {
            'data': 'cajero'
        },
        {
            'data': 'comentario'
        },
        {
            'data': 'descuento'
        },
        {
            'data': 'total'
        },
        {
            'data': 'abono'
        },
        {
            'data': 'saldo'
        },
        {
            'data': 'acciones'
        }
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    },
    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [
        {
            extend: 'excelHtml5',
            footer: true,
            title: 'Archivo',
            filename: 'Export_File',
            text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
        },
        {
            extend: 'pdfHtml5',
            download: 'open',
            footer: true,
            title: 'Reporte de Ventas Realizadas',
            filename: 'Reporte de Ventas Realizadas',
            text: '<span class="badge badge-danger"><i class="fas fa-file-pdf"></i></span>',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
            }
        },
        {
            extend: 'copyHtml5',
            footer: true,
            title: 'Reporte de Ventas Realizadas',
            filename: 'Reporte de Ventas Realizadas',
            text: '<span class="badge badge-primary"><i class="fas fa-copy"></i></span>',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
            }
        },
        {
            extend: 'print',
            footer: true,
            filename: 'Export_File_print',
            text: '<span class="badge badge-light" style="background-color: grey;"><i class="fas fa-print"></i></span>'
        },
        {
            extend: 'csvHtml5',
            footer: true,
            filename: 'Export_File_csv',
            text: '<span class="badge badge-success"><i class="fas fa-file-csv"></i></span>'
        },
        {
            extend: 'colvis',
            text: '<span class="badge badge-info"><i class="fas fa-columns"></i></span>',
            postfixButtons: ['colvisRestore']
        }
    ]
});


//Tabla Catalogo de productos vendidos
tblCatalogo = $('#tblCatalogo').DataTable({
    ajax: {
        url: base_url + "Catalogo/listar",
        dataSrc: ''
    },
    columns: [
        {
            'data': 'tipo_productob'
        },
        {
            'data': 'descripcionpb'
        },
        {
            'data': 'cantidad'
        },
        {
            'data': 'precio'
        },
        {
            'data': 'talla'
        },
        {
            'data': 'color'
        },
        {
            'data': 'imagen'
        },
        {
            'data': 'acciones'
        }
    ],
    language: {
        "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
    },
    dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [{
        //Botón para Excel
        extend: 'excelHtml5',
        footer: true,
        title: 'Archivo',
        filename: 'Export_File',

        //Aquí es donde generas el botón personalizado
        text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
    },
    //Botón para PDF
    {
        extend: 'pdfHtml5',
        download: 'open',
        footer: true,
        title: 'Reporte de Productos',
        filename: 'Reporte de Productos',
        text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    //Botón para copiar
    {
        extend: 'copyHtml5',
        footer: true,
        title: 'Reporte de Productos',
        filename: 'Reporte de Productos',
        text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
        exportOptions: {
            columns: [0, ':visible']
        }
    },
    //Botón para print
    {
        extend: 'print',
        footer: true,
        filename: 'Export_File_print',
        text: '<span class="badge badge-light" style="background-color: grey;"><i class="fas fa-print"></i></span>'
    },
    //Botón para cvs
    {
        extend: 'csvHtml5',
        footer: true,
        filename: 'Export_File_csv',
        text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
    },
    {
        extend: 'colvis',
        text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
        postfixButtons: ['colvisRestore']
    }
    ]
});

//LOGIN Y SEGURIDAD JEVIN
function frmLogin(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");
    const activo = document.getElementById("activo");
    if (usuario.value == "") {
        clave.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    } else if (clave.value == "") {
        usuario.classList.remove("is-invalid");
        clave.classList.add("is-invalid");
        clave.focus();
    } else if (activo.value == 0) {
        Swal.fire({
            icon: "error",
            title: "Usuario inactivo ",
            text: "La contraseña que ingresó es insegura, debe de tener mayusculas, signos y números.",
        });
    } else {
        const url = base_url + "Usuarios/validar";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "ok") {
                    window.location = base_url + "Administracion/home";
                } else {
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML = res;
                }
            }
        }
    }
}

function frmCambiarPass(e) {
    e.preventDefault();
    const actual = document.getElementById("clave_actual").value;
    const nueva = document.getElementById("clave_nueva").value;
    const confirmar = document.getElementById("confirmar_clave").value;
    let validarContraseñalarga = /^.{8,}$/
    let validarContraseñasegura = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/
    if (actual == '' || nueva == '' || confirmar == '') {
        Swal.fire({
            icon: "warning",
            title: "Todos los campos con obligatorios"
        });
        return false;
    } else if (!validarContraseñalarga.test(nueva)) {
        Swal.fire({
            icon: "error",
            title: "Contraseña muy corta",
            text: "La contraseña que ingresó es corta, debe de contener mínimo 8 caracteres.",
        });
    } else if (!validarContraseñasegura.test(nueva)) {
        Swal.fire({
            icon: "error",
            title: "Contraseña insegura",
            text: "La contraseña que ingresó es insegura, debe de tener mayusculas, signos y números.",
        });
    } else {
        if (nueva != confirmar) {
            Swal.fire({
                icon: "warning",
                title: "Las contraseñas no coinciden"
            });
            return false;
        } else {
            const url = base_url + "Usuarios/cambiarPass";
            const frm = document.getElementById("frmCambiarPass");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    $("#cambiarPass").modal("hide");
                    frm.reset();
                }
            }
        }
    }
}

function frmUsuario() {
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("usuarios").classList.remove("d-none");
    document.getElementById("nombres").classList.remove("d-none");
    document.getElementById("correos").classList.remove("d-none");
    document.getElementById("frmUsuarios").reset();
    $("#nuevo_usuario").modal("show");
    document.getElementById("id").value = "";
}


function registrarUser(e) {  //ventana emergente para registrar
    e.preventDefault();
    //validación en el frontend
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const correo = document.getElementById("correo");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    const caja = document.getElementById("caja");
    const rol = document.getElementById("rol");
    let validarUsuario = /^(?!.*(\w)\1{10,})[a-zA-Z]{4,27}$/;
    let validarNombre = /^(?!.*(\w)\1{10,})[a-zA-ZÀ-ÿ\s]{1,40}$/;
    let validarCorreo = /^(?!.*(\w)\1{10})[a-zA-Z0-9_.%+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]{1,3}$/;
    let validarContraseñalarga = /^.{8,}$/
    let validarContraseñasegura = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/
    var valorCaja = caja.value;
    var valorRol = rol.value;

    if (usuario.value == "" || nombre.value == "" || correo.value == "" || clave.value == "" || confirmar.value == "" || caja.value == "" || rol.value == "") {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        });
    } else if (!validarUsuario.test(usuario.value)) {
        Swal.fire({
            icon: "error",
            title: "Usuario incorrecto",
            text: "El usuario debe contener entre 4 y 27 caracteres alfabéticos exclusivamente, sin permitir el uso de símbolos ni números.",
        });
    } else if (!validarNombre.test(nombre.value)) {
        Swal.fire({
            icon: "error",
            title: "Nombre incorrecto",
            text: "El nombre debe exclusivamente contener caracteres alfabéticos, espacios y acentos.",
        });
    } else if (!validarCorreo.test(correo.value)) {
        Swal.fire({
            icon: "error",
            title: "Correo incorrecto",
            text: "El correo que ingresó es incorrecto.",
        });
    } else if (!validarContraseñalarga.test(clave.value)) {
        Swal.fire({
            icon: "error",
            title: "Contraseña muy corta",
            text: "La contraseña que ingresó es corta, debe de contener mínimo 8 caracteres.",
        });
    } else if (!validarContraseñasegura.test(clave.value)) {
        Swal.fire({
            icon: "error",
            title: "Contraseña insegura",
            text: "La contraseña que ingresó es insegura, debe de tener mayusculas, signos y números.",
        });
    } else if (valorCaja === "Seleccionar") {
        Swal.fire({
            title: "Caja vacio",
            text: "Elija una opción para la caja asociada a este usuario.",
            icon: "question"
        });
    } else if (valorRol === "Seleccionar") {
        Swal.fire({
            title: "Rol vacio",
            text: "Elija una opción para el rol que se le asignará a este usuario.",
            icon: "question"
        });
    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuarios");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Usuario Registrado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            }
        }
    }
}


function modificarUser(e) {
    e.preventDefault();
    const caja = document.getElementById("caja");
    const rol = document.getElementById("rol");
    var valorCaja = caja.value;
    var valorRol = rol.value;
    if (valorCaja === "Seleccionar") {
        Swal.fire({
            title: "Caja vacio",
            text: "Elija una opción para la caja asociada a este usuario.",
            icon: "question"
        });
    } else if (valorRol === "Seleccionar") {
        Swal.fire({
            title: "Rol vacio",
            text: "Elija una opción para el rol que se le asignará a este usuario.",
            icon: "question"
        });
    } else {
        const url = base_url + "Usuarios/modificarUsuario";
        const frm = document.getElementById("frmUsuarios");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "modificado") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Usuario modificado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_usuario").modal("hide");
                    tblUsuarios.ajax.reload();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            }
        }
    }



}

function btnEditarUser(id) {
    document.getElementById("title").innerHTML = "Modificar Usuario";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Usuarios/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("usuarios").classList.add("d-none");
            document.getElementById("nombres").classList.add("d-none");
            document.getElementById("correos").classList.add("d-none");
            document.getElementById("caja").value = res.id_caja;
            document.getElementById("rol").value = res.id_rol;
            document.getElementById("claves").classList.add("d-none");
            $("#nuevo_usuario").modal("show");
        }
    }

}

function btnEliminarUser(id) {
    Swal.fire({
        title: "¿Está seguro de eliminar este usuario?",
        text: "¡El usuario no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Usuario eliminado correctamente.",
                            icon: "success"
                        });
                        tblUsuarios.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }

        }
    });
}

function btnReingresarUser(id) {
    Swal.fire({
        title: "¿Está seguro de reingresar este usuario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Usuario reingresado correctamente.",
                            icon: "success"
                        });
                        tblUsuarios.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }

        }
    });
}

function registrarPermiso(e) {
    e.preventDefault();
    const url = base_url + "Usuarios/registrarPermiso";
    const frm = document.getElementById("formulario");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res != '') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Permiso asignado!',
                    showConfirmButton: false,
                    timer: 3000
                })
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Error',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        }
    }
}

//FIN DE LOGIN Y SEGURIDAD



//ROLES JEVIN
function frmRol() {
    document.getElementById("title").innerHTML = "Nuevo Rol";
    document.getElementById("btnAccionRol").innerHTML = "Registrar";
    document.getElementById("frmRol").reset();
    $("#nuevo_rol").modal("show");
    document.getElementById("id").value = "";

}

function registrarRol(e) {  //ventana emergente para registrar
    e.preventDefault();
    const rol = document.getElementById("rol");
    let validarRol = /^[a-zA-Z]{4,10}$/
    if (rol.value == "") {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        });
    } else if (!validarRol.test(rol.value)) {
        Swal.fire({
            icon: "error",
            title: "Rol incorrecto",
            text: "El rol debe contener entre 4 a 10 caracteres alfabéticos exclusivamente, sin permitir el uso de símbolos ni números.",
        });
    }else{
        const url = base_url + "Roles/registrar";
        const frm = document.getElementById("frmRol");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Rol registrado con exito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_rol").modal("hide");
                    tblRoles.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Rol modificado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_rol").modal("hide");
                    tblRoles.ajax.reload();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            }
        }
    }

}


function btnEditarRol(id) {
    document.getElementById("title").innerHTML = "Modificar Rol";
    document.getElementById("btnAccionRol").innerHTML = "Modificar";
    const url = base_url + "Roles/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("rol").value = res.rol;
            $("#nuevo_rol").modal("show");
        }
    }

}

function btnEliminarRol(id) {
    Swal.fire({
        title: "¿Está seguro de eliminar este rol?",
        text: "¡El rol no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Roles/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Rol eliminado correctamente.",
                            icon: "success"
                        });
                        tblRoles.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }

        }
    });
}

function btnReingresarRol(id) {
    Swal.fire({
        title: "¿Está seguro de reingresar este rol?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Roles/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Rol reingresado correctamente.",
                            icon: "success"
                        });
                        tblRoles.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }

        }
    });
}



//Funciones de la empreas para arreglar cuando tenga mas tienmpo xd
function modificarEmpresa() {
    const frm = document.getElementById('frmEmpresa');
    const url = base_url + "Administracion/modificar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText)
            if (res == 'ok') {
                Swal.fire({
                    text: "Modificado.",
                    icon: "success"
                });
                tblRoles.ajax.reload();
            }
        }
    }
}



//compras YANIOR

function cargarProveedores() {
    const url = base_url + "Compras/listarProveedores";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            try {
                const res = JSON.parse(this.responseText);
                const select = document.getElementById('proveedor');
                select.innerHTML = '';  // Limpiar contenido existente

                // Crear la opción "Seleccionar Proveedor" y añadirlo al principio
                const defaultOption = document.createElement('option');
                defaultOption.value = "";
                defaultOption.text = "-Seleccionar-";
                defaultOption.selected = true;
                defaultOption.disabled = true;
                select.appendChild(defaultOption);

                res.forEach(function (proveedor) {
                    const option = document.createElement('option');
                    option.value = proveedor.proveedores_id;
                    option.text = proveedor.nombre_proveedor;
                    select.appendChild(option);
                });
            } catch (error) {
                console.error('Error al analizar la respuesta JSON:', error);
            }
        }
    }
}


function cargarMateriaPrima() {
    const url = base_url + "Compras/listarMateriaPrima";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            try {
                const res = JSON.parse(this.responseText);
                const select = document.getElementById('materiaPrima');
                const descripcionInput = document.getElementById('descripcion');

                select.innerHTML = '';  // Limpiar contenido existente

                // Crear la opción "Seleccionar Materia Prima" y añadirlo al principio
                const defaultOption = document.createElement('option');
                defaultOption.value = "";
                defaultOption.text = "-Seleccionar-";
                defaultOption.selected = true;
                defaultOption.disabled = true;
                select.appendChild(defaultOption);

                res.forEach(function (materiaPrima) {
                    const option = document.createElement('option');
                    option.value = materiaPrima.id_producto;
                    option.text = materiaPrima.producto;
                    select.appendChild(option);
                });

                // Asociar el evento onchange para mostrar la descripción
                select.onchange = function () {
                    const selectedOption = select.options[select.selectedIndex];
                    const selectedProductId = selectedOption.value;

                    // Buscar la descripción correspondiente al producto seleccionado
                    const selectedProduct = res.find(producto => producto.id_producto == selectedProductId);

                    // Mostrar la descripción en el input de descripción
                    if (selectedProduct) {
                        descripcionInput.value = selectedProduct.descripcion;
                    } else {
                        descripcionInput.value = "";
                    }
                };

            } catch (error) {
                console.error('Error al analizar la respuesta JSON:', error);
            }
        }
    }
}


function calcularPrecio(e) {
    e.preventDefault();

    const cantidadInput = document.getElementById('cantidad_compra');
    const precioInput = document.getElementById('precio_compra');
    const subTotalInput = document.getElementById('sub_total');

    if (cantidadInput && precioInput && subTotalInput) {
        const cantidad = parseFloat(cantidadInput.value);
        const precio = parseFloat(precioInput.value);

        if (!isNaN(cantidad) && !isNaN(precio)) {
            const subTotal = (cantidad * precio).toFixed(2);
            subTotalInput.value = subTotal;

            if (e.which === 13 && cantidad > 0) {
                const proveedorSelect = document.getElementById("proveedor");
                const proveedor = proveedorSelect.options[proveedorSelect.selectedIndex].text;
                const materiaPrimaSelect = document.getElementById("materiaPrima");
                const productoId = materiaPrimaSelect.value;
                const materiaPrima = materiaPrimaSelect.options[materiaPrimaSelect.selectedIndex].text;
                const frmCompra = document.getElementById("frmCompra");

                if (productoId && frmCompra) {
                    const url = base_url + "Compras/ingresar/";
                    const http = new XMLHttpRequest();
                    const formData = new FormData(frmCompra);
                    formData.append('sub_total', subTotal);
                    formData.append('id_producto', productoId);
                    formData.append('proveedor', proveedor);
                    formData.append('materiaPrima', materiaPrima);

                    http.open("POST", url, true);
                    http.send(formData);

                    http.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log(this.responseText);
                            const res = JSON.parse(this.responseText);
                            if (res == 'ok') {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Compra ingresada',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                frmCompra.reset();
                            }
                            location.reload();
                        }
                    };
                } else {
                    console.error("Proveedor o formulario no válido");
                }
            }
        } else {
            console.error("La cantidad o el precio no son números válidos");
        }
    } else {
        console.error("No se encontraron los elementos 'cantidad_compra', 'precio_compra' o 'sub_total'");
    }
}



cargarDetalle();

function cargarDetalle() {
    const url = base_url + "Compras/listar/";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            const res = JSON.parse(this.responseText);
            let html = "";
            res.detalle.forEach(row => {
                html += `<tr>
                      <td>${row['usuario_id']}</td>
                      <td>${row['proveedor']}</td>
                      <td>${row['producto']}</td>
                      <td>${row['descripcion']}</td>
                      <td>${row['cantidad']}</td>
                      <td>${row['precio']}</td>
                      <td>${row['sub_total']}</td>
                      <td>
                      <button class="btn btn-danger" type="button" onclick="deleteDetalle(${row['detalle_id']})">
                      <i class="fas fa-trash-alt"></i></button>
                      </td>
                      </tr>`
            });
            document.getElementById('tblDetalle').innerHTML = html;
            document.getElementById('total').value = res.total_pagar.total;

        }

    }

}


function deleteDetalle(detalle_id) {
    const url = base_url + "Compras/delete/" + detalle_id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Compra eliminada',
                    showConfirmButton: false,
                    timer: 3000
                })

                cargarDetalle();
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Error al eliminar la compra',
                    showConfirmButton: false,
                    timer: 3000
                })
                location.reload();
            }
        }
    }
}


function generarCompra() {
    Swal.fire({
        title: "¿Está seguro de realizar la compra?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"

    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Compras/registrarCompra/";
            const frm = document.getElementById("frmCompra");
            const http = new XMLHttpRequest();
            const formData = new FormData(frm);

            formData.append('isv', parseFloat(document.getElementById('isv').value) || 0);
            formData.append('descuento', parseFloat(document.getElementById('descuento').value) || 0);
            formData.append('factura', parseFloat(document.getElementById('factura').value) || 0);
            formData.append('fecha', document.getElementById('fecha').value);
            http.open("POST", url, true);
            http.send(formData);


            http.onreadystatechange = function () {
                if (http.readyState == 4) {
                    if (http.status == 200) {
                        console.log(this.responseText);
                        const res = JSON.parse(http.responseText);
                        handleApiResponse(res);
                    } else {
                        console.error('Error en la solicitud. Código de estado HTTP:', http.status);
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error en el servidor. Por favor, inténtalo de nuevo.',
                            icon: 'error'
                        }).then(() => {
                            Swal.close();
                        });
                    }
                }
            };
        }
    });
}




function handleApiResponse(response) {
    if (response.msg === "ok") {
        Swal.fire({
            title: "Mensaje!",
            text: "Compra generada.",
            icon: "success"
        });

        const ruta = base_url + 'Compras/generarPdf/' + response.id_compra;
        window.open(ruta);

        setTimeout(() => {
            window.location.reload();
        }, 300);
    } else {
        Swal.fire('Mensaje!', response.msg, 'error');
    }
}




//Materia Prima

function frmMateriaPrima() {
    document.getElementById("title").innerHTML = "Nueva Materia Prima";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmMateriaPrima").reset();
    $("#nuevo_materia_prima").modal("show");
    document.getElementById("id_producto").value = "";
}

function registrarMateriaPrima(e) {
    e.preventDefault();
    const nombreProducto = document.getElementById("producto");
    const descripcion = document.getElementById("descripcion");
    let validarProducto = /^(?!(.)\1{10,})[\p{L}0-9\s]{5,20}$/u;
    let validarDescripcion = /^(?!(.)\1{10,})[\p{L}0-9\s!@#$%^&*()-+=<>?/.,;:'"¡¿]{5,30}$/u;

    if (nombreProducto.value == "" || descripcion.value == "") {
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        });
    }else if (!validarProducto.test(nombreProducto.value)) {
        Swal.fire({
            icon: "error",
            title: "Producto incorrecto",
            text: "El producto debe contener entre 5 y 20 caracteres alfabéticos exclusivamente, sin permitir el uso de símbolos.",
        });
    } else if (!validarDescripcion.test(descripcion.value)) {
        Swal.fire({
            icon: "error",
            title: "Descripción incorrecto",
            text: "La descripción no puede tomar nombres largos y pegados y debe contener 5 caracteres mínimo.",
        });
    } else {
        const url = base_url + "MateriaPrima/registrar";
        const frm = document.getElementById("frmMateriaPrima");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));

        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);

                if (res == "si") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Materia prima registrada con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    frm.reset();
                    $("#nuevo_materia_prima").modal("hide");
                    tblMateriaPrima.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Materia prima modificada con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#nuevo_materia_prima").modal("hide");
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    tblMateriaPrima.ajax.reload();
                }
            }
        }
    }
}

function btnEditarMateriaPrima(id_producto) {
    document.getElementById("title").innerHTML = "Modificar Materia Prima";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "MateriaPrima/editar/" + id_producto;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("materia_prima_id").value = res.id_producto;
            document.getElementById("producto").value = res.producto;
            document.getElementById("descripcion").value = res.descripcion;
            $("#nuevo_materia_prima").modal("show");
            tblMateriaPrima.ajax.reload();
        }
    }
}

function btnEliminarMateriaPrima(id_producto) {
    Swal.fire({
        title: "¿Está seguro de eliminar esta materia prima?",
        text: "¡La materia prima no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "MateriaPrima/eliminar/" + id_producto;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Materia prima eliminada correctamente.",
                            icon: "success"
                        });
                        tblMateriaPrima.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }
        }
    });
}

function btnReingresarMateriaPrima(id_producto) {
    Swal.fire({
        title: "¿Está seguro de reingresar esta materia prima?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "MateriaPrima/reingresar/" + id_producto;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Materia prima reingresada correctamente.",
                            icon: "success"
                        });
                        tblMateriaPrima.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }
        }
    });
}





//proveedores
function frmProveedor() {
    document.getElementById("title").innerHTML = "Nuevo Proveedor";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmProveedores").reset();
    $("#nuevo_proveedor").modal("show");
    document.getElementById("proveedores_id").value = "";
}

function registrarProv(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre_proveedor");
    const direccion = document.getElementById("direccion");
    const telefono = document.getElementById("telefono");
    const condiciones = document.getElementById("condiciones_pago");
    const plazo = document.getElementById("plazo_entrega");
    let validarNombre = /^(?!.*(\w)\1{10})[a-zA-Z0-9áéíóúÁÉÍÓÚ\s]{2,20}$/;
    let validarDireccion = /^(?!.*(\w)\1{10})[\w\sáéíóúÁÉÍÓÚ!@#$%^&*()-+=<>?/.,;:'"¡¿]{3,40}$/;
    let validarTelefono = /^[0-9\-]{8,20}$/;
    let validarPago = /^(?!.*(\w)\1{10})[a-zA-Z0-9áéíóúÁÉÍÓÚ\s]{2,20}$/;
    let validarPlazo = /^(?!.*(\w)\1{10})[a-zA-Z0-9áéíóúÁÉÍÓÚ\s]{2,20}$/;

    if (nombre.value == "" || direccion.value == "" || telefono.value == "" || condiciones.value == "" || plazo.value == "") {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        });
    }else if (!validarNombre.test(nombre.value)) {
        Swal.fire({
            icon: "error",
            title: "Nombre incorrecto",
            text: "El nombre debe exclusivamente contener caracteres alfabéticos, espacios y acentos.",
        });
    }else if (!validarDireccion.test(direccion.value)) {
        Swal.fire({
            icon: "error",
            title: "Dirección incorrecta",
            text: "La dirección no puede contener nombres largos pegados.",
        });
    }else if (!validarTelefono.test(telefono.value)) {
        Swal.fire({
            icon: "error",
            title: "Teléfono incorrecto",
            text: "El teléfono solo puede contener números y puede tener guión para la separación",
        });
    }else if (!validarPago.test(condiciones.value)) {
        Swal.fire({
            icon: "error",
            title: "Condición de pago incorrecto",
            text: "La condición de pago no puede contener nombres largos pegados ni de un caracter de largo.",
        });
    }else if (!validarPlazo.test(plazo.value)) {
        Swal.fire({
            icon: "error",
            title: "Plazo incorrecto",
            text: "El plazo no puede contener nombres largos pegados.",
        });
    }else{
        const url = base_url + "Proveedores/registrar";
        const frm = document.getElementById("frmProveedores");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));

        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);

                if (res == "si") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Proveedor registrado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    frm.reset();
                    $("#nuevo_proveedor").modal("hide");
                    tblProveedores.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Proveedor modificado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#nuevo_proveedor").modal("hide");

                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000

                    });
                    tblProveedores.ajax.reload();
                }
            }
        }
    }
}

function btnEditarProveedor(proveedores_id) {
    document.getElementById("title").innerHTML = "Modificar Proveedor";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Proveedores/editar/" + proveedores_id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("proveedores_id").value = res.proveedores_id;
            document.getElementById("nombre_proveedor").value = res.nombre_proveedor;
            document.getElementById("direccion").value = res.direccion;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("condiciones_pago").value = res.condiciones_pago;
            document.getElementById("plazo_entrega").value = res.plazo_entrega;
            $("#nuevo_proveedor").modal("show");
            tblProveedores.ajax.reload();
        }

    }

}

function btnEliminarProveedor(proveedores_id) {
    Swal.fire({
        title: "¿Está seguro de eliminar este proveedor?",
        text: "¡El proveedor no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Proveedores/eliminar/" + proveedores_id; // Ajusta la URL según tu estructura de rutas
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Proveedor eliminado correctamente.",
                            icon: "success"
                        });
                        // Actualiza la tabla de proveedores (ajusta el nombre del objeto DataTable según tu código)
                        tblProveedores.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }
        }
    });
}


function btnReingresarProveedor(proveedores_id) {
    Swal.fire({
        title: "¿Está seguro de reingresar este proveedor?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Proveedores/reingresar/" + proveedores_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Proveedor reingresado correctamente.",
                            icon: "success"
                        });

                        tblProveedores.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }
        }
    });
}




//INICIO PRODUCTOS BASE MILTON
function frmProducto() {
    document.getElementById("title").innerHTML = "Nuevo Producto";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmProducto").reset();
    document.getElementById("id").value = "";
    $("#nuevo_producto").modal("show");
}

function registrarProb(e) {  //ventana emergente para registrar
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const nombre = document.getElementById("nombre");
    const descripcion = document.getElementById("descripcion");
    const tipopb = document.getElementById("tipopb");
    let validarCodigo = /^(?!.*(\w)\1{10})[A-Z]{2}\d{3}$/;
    let validarNombre = /^(?!.*(\w)\1{10})[a-zA-Z0-9áéíóúÁÉÍÓÚ\s]{2,20}$/;
    let validarDescripcion = /^(?!.*(\w)\1{10})[a-zA-ZáéíóúÁÉÍÓÚ\s,.-]{5,25}$/;
    let validarProducto = /^(?!.*(\w)\1{10})[a-zA-ZáéíóúÁÉÍÓÚ\s]{2,20}$/;


    if (codigo.value == "" || nombre.value == "" || descripcion.value == "" || tipopb.value == "") {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        });
    }else if (!validarCodigo.test(codigo.value)) {
        Swal.fire({
            icon: "error",
            title: "Código incorrecto",
            text: "El codigo unicamente puede tener dos letras en mayuscula que sean iniciales del producto y solamente 3 números despues de ésta.",
        });
    }else if (!validarNombre.test(nombre.value)) {
        Swal.fire({
            icon: "error",
            title: "Nombre incorrecto",
            text: "El nombre debe exclusivamente contener caracteres alfabéticos, espacios y acentos.",
        });
    } else if (!validarProducto.test(tipopb.value)) {
        Swal.fire({
            icon: "error",
            title: "Producto incorrecto",
            text: "El producto no puede contener carácteres especiales ni nombres largos y pegados.",
        });
    } else if (!validarDescripcion.test(descripcion.value)) {
        Swal.fire({
            icon: "error",
            title: "Descripción incorrecto",
            text: "La descripción no puede tomar nombres largos y pegados y debe contener 5 caracteres mínimo.",
        });
    } else {
        const url = base_url + "Productos/registrar";
        const frm = document.getElementById("frmProducto");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //console.log(this.responseText);      
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Producto Registrado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    frm.reset();
                    $("#nuevo_producto").modal("hide");
                    tblProductosb.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Producto modificado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    $("#nuevo_producto").modal("hide");
                    tblProductosb.ajax.reload();
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            }
        }
    }
}

function btnEditarProb(id_productob) {
    document.getElementById("title").innerHTML = "Modificar Producto";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Productos/editar/" + id_productob;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id_productob;
            document.getElementById("codigo").value = res.codigo_productob;
            document.getElementById("nombre").value = res.nombrepb;
            document.getElementById("descripcion").value = res.descripcionpb;
            document.getElementById("tipopb").value = res.tipo_productob;
            $("#nuevo_producto").modal("show");
        }
    }

}

function btnEliminarProb(id) {
    Swal.fire({
        title: "¿Está seguro dar de baja a este producto?",
        text: "¡El producto no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Se ha dado de baja al producto de manera exitosa.",
                            icon: "success"
                        });
                        tblProductosb.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }

        }
    });
}

function btnReingresarProb(id) {
    Swal.fire({
        title: "¿Está seguro de reingresar este producto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Productos/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Producto reingresado correctamente.",
                            icon: "success"
                        });
                        tblProductosb.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }

        }
    });
}



function alertas(mensaje, icono) {
    Swal.fire({
        position: 'top-end',
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    });
}




//clientes Heyson y Sharon

function frmCliente() {
    document.getElementById("title").innerHTML = "Nuevo Cliente";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmClientes").reset();
    $("#nuevo_cliente").modal("show");
    document.getElementById("clientes_id").value = "";
}


function registrarCliente(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre_cliente");
    const identificacion = document.getElementById("identificacion");
    const telefono = document.getElementById("telefono");
    let validarCliente = /^(?!(.)\1{9,})[a-zA-ZÀ-ÿ\sáéíóúÁÉÍÓÚ]{10,40}$/;
    let validarIdentificacion = /^[0-9\-]{5,20}$/;
    let validarTelefono = /^[0-9\-]{8,20}$/;

    if (nombre.value == "" || identificacion.value == "" || telefono.value == "") {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        });
    } else if (!validarCliente.test(nombre.value)) {
        Swal.fire({
            icon: "error",
            title: "Nombre incorrecto",
            text: "El nombre debe exclusivamente contener caracteres alfabéticos, espacios y acentos."
        });
    } else if (!validarIdentificacion.test(identificacion.value)) {
        Swal.fire({
            icon: "error",
            title: "Identificación incorrecto",
            text: "La identificación debe exclusivamente contener números con guión para separación.",
        });
    }else if (!validarTelefono.test(telefono.value)) {
        Swal.fire({
            icon: "error",
            title: "Teléfono incorrecto",
            text: "El teléfono solo puede contener números y puede tener guión para la separación",
        });
    }else{
        const url = base_url + "Clientes/registrar";
        const frm = document.getElementById("frmClientes");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));

        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);

                if (res == "si") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Cliente registrado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    frm.reset();
                    $("#nuevo_cliente").modal("hide");
                    tblClientes.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Cliente modificado con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#nuevo_cliente").modal("hide");
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    tblClientes.ajax.reload();
                }
            }
        }
    }
}

function btnEditarCliente(clientes_id) {
    document.getElementById("title").innerHTML = "Modificar Cliente";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Clientes/editar/" + clientes_id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("clientes_id").value = res.ClienteID;
            document.getElementById("nombre_cliente").value = res.NombreCompleto;
            document.getElementById("identificacion").value = res.Identificacion;
            document.getElementById("telefono").value = res.Telefono;
            $("#nuevo_cliente").modal("show");
            tblClientes.ajax.reload();
        }

    }

}

function btnEliminarCliente(clientes_id) {
    Swal.fire({
        title: "¿Está seguro de eliminar este cliente?",
        text: "¡El cliente no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/eliminar/" + clientes_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Cliente eliminado correctamente.",
                            icon: "success"
                        });
                        tblClientes.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }
        }
    });
}

function btnReingresarCliente(clientes_id) {
    Swal.fire({
        title: "¿Está seguro de reingresar este cliente?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/reingresar/" + clientes_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Cliente reingresado correctamente.",
                            icon: "success"
                        });
                        tblClientes.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }
        }
    });
}




// Ventas Heyson Y Sharon

function cargarClientes() {
    const url = base_url + "Ventas/listarClientes";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            try {
                const res = JSON.parse(this.responseText);
                const select = document.getElementById('clientes');
                const telefonoInput = document.getElementById('telefono');
                const IdentificacionInput = document.getElementById('Identificacion');
                select.innerHTML = '';  // Limpiar contenido existente

                // Crear la opción "Seleccionar Cliente" y añadirlo al principio
                const defaultOption = document.createElement('option');
                defaultOption.value = "";
                defaultOption.text = "Clientes";
                defaultOption.selected = true;
                defaultOption.disabled = true;
                select.appendChild(defaultOption);

                res.forEach(function (cliente) {
                    const option = document.createElement('option');
                    option.value = cliente.NombreCompleto;  // Ajustar para utilizar el NombreCompleto
                    option.text = cliente.NombreCompleto;
                    select.appendChild(option);
                });

                // Asociar el evento onchange para llenar el campo de teléfono
                select.onchange = function () {
                    const selectedOption = select.options[select.selectedIndex];
                    const selectedClientName = selectedOption.value;

                    // Buscar el cliente correspondiente al cliente seleccionado
                    const selectedClient = res.find(cliente => cliente.NombreCompleto == selectedClientName);

                    // Llenar el campo de teléfono
                    if (selectedClient) {
                        telefonoInput.value = selectedClient.Telefono;
                    } else {
                        telefonoInput.value = "";
                    }

                    if (selectedClient) {
                        IdentificacionInput.value = selectedClient.Identificacion;
                    } else {
                        IdentificacionInput.value = "";
                    }
                };

            } catch (error) {
                console.error('Error al analizar la respuesta JSON:', error);
            }
        }
    };
}


function cargarTallas() {
    const url = base_url + "Ventas/listarTallas";

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('TallasText');
            select.innerHTML = '';  // Limpiar contenido existente

            // Crear la opción "Seleccionar Talla" y añadirlo al principio
            const defaultOption = new Option('Tallas', '', true, true);
            select.add(defaultOption);

            data.forEach(function (tallas) {
                const option = new Option(tallas.TipoTalla, tallas.TipoTalla);
                select.add(option);
            });
        })
        .catch(error => console.error('Error al obtener las tallas:', error));
}


function cargarProductosBase() {
    const url = base_url + "Ventas/listarProductoBase";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            try {
                const res = JSON.parse(this.responseText);
                const selectTipo = document.getElementById('tipo_productob');
                const descripcionInput = document.getElementById('descripcionpb');

                selectTipo.innerHTML = '';  // Limpiar contenido existente

                // Crear la opción "Seleccionar Tipo de Producto" y añadirlo al principio
                const defaultOptionTipo = document.createElement('option');
                defaultOptionTipo.value = "";
                defaultOptionTipo.text = "Tipo Producto";
                defaultOptionTipo.selected = true;
                defaultOptionTipo.disabled = true;
                selectTipo.appendChild(defaultOptionTipo);

                res.forEach(function (tipo_productob) {
                    const optionTipo = document.createElement('option');
                    optionTipo.value = tipo_productob.id_productob;
                    optionTipo.text = tipo_productob.tipo_productob;
                    selectTipo.appendChild(optionTipo);
                });

                // Asociar el evento onchange para cargar productos basados en el tipo seleccionado
                selectTipo.onchange = function () {
                    const selectedTipo = selectTipo.options[selectTipo.selectedIndex].value;
                    const productosFiltrados = res.filter(tipo_productob => tipo_productob.id_productob == selectedTipo);

                    // Mostrar la descripción en el input de descripción
                    if (productosFiltrados.length > 0) {
                        descripcionInput.value = productosFiltrados[0].descripcionpb;
                    } else {
                        descripcionInput.value = "";
                    }
                };

            } catch (error) {
                console.error('Error al analizar la respuesta JSON:', error);
            }
        }
    }
}


function calcularPreciov(e) {
    e.preventDefault();

    const cantidadInput = document.getElementById('cantidad');
    const precioInput = document.getElementById('precio');
    const subTotalInput = document.getElementById('sub_total');

    if (cantidadInput && precioInput && subTotalInput) {
        const cantidad = parseFloat(cantidadInput.value);
        const precio = parseFloat(precioInput.value);


        if (!isNaN(cantidad) && !isNaN(precio) && cantidad > 0) {
            const subTotal = (cantidad * precio).toFixed(2);
            subTotalInput.value = subTotal;

            const tipoProductoSelect = document.getElementById('tipo_productob');
            const tallasSelect = document.getElementById('TallasText');
            const tipo_productob = tipoProductoSelect.options[tipoProductoSelect.selectedIndex].text;
            const talla = tallasSelect.options[tallasSelect.selectedIndex].text;
            const frmDetallev = document.getElementById('frmDetallev');

            if (frmDetallev) {
                const url = base_url + 'Ventas/ingresar/';
                const http = new XMLHttpRequest();
                const formData = new FormData(frmDetallev);
                formData.append('sub_total', subTotal);
                formData.append('tipo_productob', tipo_productob);
                formData.append('talla', talla);
                //formData.append('color_letra', document.getElementById('color_letra').value);
                // formData.append('logo_izquierdo', document.getElementById('logo_izquierdo').value);
                // formData.append('logo_derecho', document.getElementById('logo_derecho').value);
                //formData.append('logo_delantero', document.getElementById('logo_delantero').value);
                //formData.append('logo_trasero', document.getElementById('logo_trasero').value);

                http.open('POST', url, true);
                http.send(formData);

                http.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        const res = JSON.parse(this.responseText);
                        if (res == 'ok') {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Venta ingresada',
                                showConfirmButton: false,
                                timer: 3000
                            });

                        }

                        cargarDetalleVenta();
                        document.getElementById("frmDetallev").reset();
                    }

                };
            } else {
                console.error("Tipo,Talla o formulario no válido");
            }
        }
    } else {
        console.error("La cantidad o el precio no son números válidos");
    }
}


function cargarDetalleVenta() {
    const url = base_url + "Ventas/listarVentas/";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            const res = JSON.parse(this.responseText);
            let html = "";
            res.detallev.forEach(row => {
                html += `<tr>
                      <td>${row['usuario_id']}</td>
                      <td>${row['tipo_productob']}</td>
                      <td>${row['descripcionpb']}</td>
                      <td>${row['talla']}</td>
                      <td>${row['color']}</td>
                      <td>${row['cantidad']}</td>
                      <td>${row['precio']}</td>
                      <td>${row['sub_total']}</td>
                      <td>
                      <button class="btn btn-danger" type="button" onclick="deleteDetalleVenta(${row['id_detallev']})">
                      <i class="fas fa-trash-alt"></i></button>
                      </td>
                      </tr>`;
            });
            document.getElementById('tblDetalleFactura').innerHTML = html;
            document.getElementById('total').value = res.total_pagar.total;

        }

    }
}

cargarDetalleVenta();


function deleteDetalleVenta(id_detallev) {
    const url = base_url + "Ventas/delete/" + id_detallev;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Detalle de venta eliminado',
                    showConfirmButton: false,
                    timer: 3000
                });

                cargarDetalleVenta();
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Error al eliminar el detalle de venta',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        }
    };
}


function generarVenta() {
    Swal.fire({
        title: "¿Está seguro de realizar la orden?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Ventas/registrarVenta/";
            const frmVentData = new FormData(document.getElementById("frmVent"));
            const frmVData = new FormData(document.getElementById("frmV"));
            const http = new XMLHttpRequest();

            // Fusionar los datos de ambos formularios en un solo FormData
            const formData = new FormData();
            for (const [key, value] of frmVentData) {
                formData.append(key, value);
            }
            for (const [key, value] of frmVData) {
                formData.append(key, value);
            }

            formData.append('factura', document.getElementById('factura').value);
            formData.append('clientes', document.getElementById('clientes').value);
            formData.append('telefono', document.getElementById('telefono').value);
            formData.append('Identificacion', document.getElementById('Identificacion').value);
            formData.append('fecha_actual', document.getElementById('fecha_actual').value);
            formData.append('fecha_entrega', document.getElementById('fecha_entrega').value);
            formData.append('cajero', document.getElementById('cajero').value);
            formData.append('abono', parseFloat(document.getElementById('abono').value) || 0);
            formData.append('descuento', parseFloat(document.getElementById('descuento').value) || 0);
            formData.append('comentario', document.getElementById('comentario').value);
            formData.append('total', parseFloat(document.getElementById('total').value) || 0);
            formData.append('color_letra', document.getElementById('color_letra').value);
            formData.append('logo_izquierdo', document.getElementById('logo_izquierdo').value);
            formData.append('logo_derecho', document.getElementById('logo_derecho').value);
            formData.append('logo_delantero', document.getElementById('logo_delantero').value);
            formData.append('logo_trasero', document.getElementById('logo_trasero').value);

            // También puedes agregar otros datos manualmente si es necesario
            formData.append('clientes', document.getElementById('clientes').value);

            http.open("POST", url, true);
            http.send(formData);

            http.onreadystatechange = function () {
                if (http.readyState == 4) {
                    if (http.status == 200) {
                        const res = JSON.parse(http.responseText);
                        handleApiResponse(res);
                    } else {
                        console.error('Error en la solicitud. Código de estado HTTP:', http.status);
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error en el servidor. Por favor, inténtalo de nuevo.',
                            icon: 'error'
                        }).then(() => {
                            Swal.close();
                        });
                    }
                }
            };
        }
    });
}



function handleApiResponse(response) {
    if (response.msg === "ok") {
        Swal.fire({
            title: "Mensaje!",
            text: "Venta generada.",
            icon: "success"
        });

        const ruta = base_url + 'Ventas/generarPdf/' + response.id_venta;
        window.open(ruta);

        setTimeout(() => {
            window.location.reload();
        }, 300);
    } else {
        Swal.fire('Mensaje!', response.msg, 'error');
    }
}


// Tallas


function frmTallas() {
    document.getElementById("title").innerHTML = "Nueva Talla";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmTallas").reset();
    $("#nuevo_talla").modal("show");
    document.getElementById("TallasID").value = "";
}

function registrarTallas(e) {
    e.preventDefault();
    const nombre = document.getElementById("TipoTalla");
    let validarTalla = /^(?!.*(\w)\1{5,})[a-zA-Z0-9\s]{1,40}$/;


    if (nombre.value == "") {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Todos los campos son obligatorios',
            showConfirmButton: false,
            timer: 3000
        });
    } else if (!validarTalla.test(nombre.value)) {
        Swal.fire({
            icon: "error",
            title: "Talla incorrecto",
            text: "Las tallas no pueden contener carácteres especiales.",
        });
    } else {
        const url = base_url + "Tallas/registrar";
        const frm = document.getElementById("frmTallas");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));

        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);

                if (res == "si") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Talla registrada con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    frm.reset();
                    $("#nuevo_talla").modal("hide");
                    tblClientes.ajax.reload();
                } else if (res == "modificado") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Talla modificada con éxito',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $("#nuevo_talla").modal("hide");
                } else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: res,
                        showConfirmButton: false,
                        timer: 3000
                    });

                }
                tblTallas.ajax.reload();
            }
        }
    }
}

function btnEditarTallas(TallasID) {
    document.getElementById("title").innerHTML = "Modificar Talla";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Tallas/editar/" + TallasID;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("TallasID").value = res.TallasID;
            document.getElementById("TipoTalla").value = res.TipoTalla;
            $("#nuevo_talla").modal("show");
            tblTallas.ajax.reload();
        }
    }
}

function btnEliminarTallas(TallasID) {
    Swal.fire({
        title: "¿Está seguro de eliminar esta talla?",
        text: "¡La talla no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Tallas/eliminar/" + TallasID;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Talla eliminada correctamente.",
                            icon: "success"
                        });
                        tblTallas.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }
        }
    });
}

function btnReingresarTallas(TallasID) {
    Swal.fire({
        title: "¿Está seguro de reingresar esta talla?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Tallas/reingresar/" + TallasID;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText)
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Talla reingresada correctamente.",
                            icon: "success"
                        });
                        tblTallas.ajax.reload();
                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                }
            }
        }
    });
}


//Produccion

function calcularSalida(e) {
    e.preventDefault();

    const cantidadInput = document.getElementById('cantidad');
    const motivoInput = document.getElementById('motivo');
    const productoSelect = document.getElementById('materiaPrima');

    if (cantidadInput && motivoInput && productoSelect) {
        const cantidad = parseFloat(cantidadInput.value);
        const motivo = motivoInput.value;
        const materiaPrimaSelect = document.getElementById("materiaPrima");
        const materiaPrima = materiaPrimaSelect.options[materiaPrimaSelect.selectedIndex].text;
        const productoId = materiaPrimaSelect.value;

        if (!isNaN(cantidad) && cantidad > 0 && motivo.trim() !== "") {
            const frmUsado = document.getElementById('frmUsado');

            if (productoId && frmUsado) {
                const url = base_url + 'Produccion/ingresar/';
                const http = new XMLHttpRequest();
                const formData = new FormData(frmUsado);
                formData.append('cantidad', cantidad);
                formData.append('motivo', motivo);
                formData.append('materiaPrima', materiaPrima);
                formData.append('id_producto', productoId);
                http.open('POST', url, true);
                http.send(formData);

                http.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        const res = JSON.parse(this.responseText);
                        if (res == 'ok') {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Salida registrada',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                        //document.getElementById("frmUsado").reset();
                        cargarDetalleSalida();
                    }
                };
            } else {
                console.error("Formulario no válido");
            }
        } else {
            console.error("La cantidad, el motivo o el producto no son válidos");
        }
    } else {
        console.error("La cantidad, el motivo o el producto no fueron encontrados");
    }
}


cargarDetalleSalida();

function cargarDetalleSalida() {
    const url = base_url + "Produccion/listarDetalleSalida/";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let html = "";
            res.detalle_salida.forEach(row => {
                html += `<tr>
                          <td>${row['usuario_id']}</td>
                          <td>${row['producto']}</td>
                          <td>${row['cantidad']}</td>
                          <td>${row['motivo_salida']}</td>
                          <td>${row['fecha']}</td>
                          <td>
                              <button class="btn btn-danger" type="button" onclick="deleteDetalleSalida(${row['id']})">
                                  <i class="fas fa-trash-alt"></i>
                              </button>
                          </td>
                      </tr>`;
            });
            document.getElementById('tblDetalleSalida').innerHTML = html;
        }


    }
    //cargarDetalleSalida();
}


function deleteDetalleSalida(id) {
    const url = base_url + "Produccion/deleteSalida/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res == "ok") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Detalle de salida eliminado',
                    showConfirmButton: false,
                    timer: 3000
                });

                cargarDetalleSalida(); // Recarga los detalles de salida después de eliminar uno
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Error al eliminar el detalle de salida',
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        }
    };
}

function generarSalida() {
    const url = base_url + "Produccion/registrarSalidaKardex/";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);

    http.onreadystatechange = function () {
        if (http.readyState == 4) {
            if (http.status == 200) {
                const res = JSON.parse(http.responseText);
                if (res.msg === 'ok') {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Salida registrada en el kardex',
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Error al registrar la salida en el kardex',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            } else {
                console.error('Error en la solicitud. Código de estado HTTP:', http.status);
                Swal.fire({
                    title: 'Error',
                    text: 'Ocurrió un error en el servidor. Por favor, inténtalo de nuevo.',
                    icon: 'error'
                }).then(() => {
                    Swal.close();
                });
            }
            cargarDetalleSalida();
        }
    };

    http.send();
}

function btnDesactivarDventa(id) {
    Swal.fire({
        title: "¿Está seguro de desactivar este pedido?",
        text: "¡El pedido no se eliminara, solo cambiara su estado a inactivo!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Produccion/desactivar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res == "ok") {
                        Swal.fire({
                            title: "Mensaje!",
                            text: "Pedido descativado correctamente.",
                            icon: "success"
                        });

                    } else {
                        Swal.fire(
                            'Mensaje!',
                            res,
                            'error'
                        );
                    }
                    tblProduccion.ajax.reload();
                }
            }
        }
    });
}


// function frmCatalogo(){  //ventana emergente para subir foto (MODAL)
//     document.getElementById("title").innerHTML="Imagen del Producto";
//     document.getElementById("btnAccion").innerHTML="Subir Imagen";
//     document.getElementById("frmCatalogo").reset();
//     document.getElementById("id").value = "";
//     $("#foto_catalogo").modal("show");
//     deleteImg();
// }

// function SubirFotoCatalogo(e){  //ventana emergente para subir foto
//     e.preventDefault();
//     const codigo = document.getElementById("codigo");
//     const nombre = document.getElementById("nombre");
//     const descripcion = document.getElementById("descripcion");
//     const tipopb = document.getElementById("tipopb");
//     if (codigo.value == "" || nombre.value == "" || descripcion.value == "" || tipopb.value == ""){
//         Swal.fire({
//             position: 'center',
//             icon: 'error',
//             title: 'Todos los campos son obligatorios',
//             showConfirmButton: false,
//             timer: 3000
//           });          
//     }else{
//         const url = base_url + "Productos/registrar";
//         const frm = document.getElementById("frmCatalogo");
//         const http = new XMLHttpRequest();
//         http.open("POST", url, true);
//         http.send(new FormData(frm));
//         http.onreadystatechange = function(){
//             if(this.readyState == 4 && this.status == 200){   
//                 //console.log(this.responseText);      
//                 const res = JSON.parse(this.responseText);
//                 if (res == "si") {
//                     Swal.fire({
//                         position: 'center',
//                         icon: 'success',
//                         title: 'Producto Registrado con éxito',
//                         showConfirmButton: false,
//                         timer: 3000
//                       })
//                       frm.reset();
//                       $("#foto_catalogo").modal("hide");
//                       tblProductosb.ajax.reload();
//                 }else if (res == "modificado"){
//                     Swal.fire({
//                         position: 'center',
//                         icon: 'success',
//                         title: 'Producto modificado con éxito',
//                         showConfirmButton: false,
//                         timer: 3000
//                       })
//                       $("#foto_catalogo").modal("hide");
//                       tblProductosb.ajax.reload();
//                 }else{
//                     Swal.fire({
//                         position: 'top-end',
//                         icon: 'error',
//                         title: res,
//                         showConfirmButton: false,
//                         timer: 3000
//                       })  
//                 }
//             }
//         }
//     }
// }


// CATALOGO DE PRODUCTOS VENDIDOS MILTON LOPEZ

// function btnSubirFotocatalogo(e) {
//     e.preventDefault();
//     document.getElementById("title").innerHTML="Imagen del Producto";
//     document.getElementById("btnAccion").innerHTML="Subir Imagen";
//     const id = document.getElementById("id").value;
//     const url = base_url + "Catalogo/editar/" + id;
//     const formData = new FormData();
//     const imagen = document.getElementById("imagen").files[0];
//     formData.append('imagen', imagen);

//     const http = new XMLHttpRequest();
//     http.open("POST", url, true);
//     http.send();
//     http.onreadystatechange = function() {
//         if(this.readyState == 4 && this.status == 200) {
//             // Respuesta del servidor
//             const res = JSON.parse(this.responseText);  
//             document.getElementById("img-preview").value = base_url + 'Assets/img/' + res.foto; ;
//             $("#foto_catalogo").modal("show");
//         }
//     }
// }

function btnSubirFotocatalogo(id) {
    document.getElementById("title").innerHTML = "Imagen del Producto";
    document.getElementById("btnAccion").innerHTML = "Subir Imagen";
    const url = base_url + "Catalogo/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.getElementById("img-preview").value = base_url + 'Assets/img/' + res.foto;;
            // document.getElementById("icon-cerrar").innerHTML = `
            // <button class="btn btn-danger" onclick="deleteImg()"><i class="fas fa-times"></i></button>`;
            // document.getElementById("icon-image").classList.add("d-none");
            $("#foto_catalogo").modal("show");
        }
    }
}

function preview(e) { //Funcion para subir la imagen y previsualizar
    const url = e.target.files[0];
    const urlTmp = URL.createObjectURL(url);
    document.getElementById("img-preview").src = urlTmp;
    document.getElementById("icon-image").classList.add("d-none");
    document.getElementById("icon-cerrar").innerHTML = `
    <button class="btn btn-danger" onclick="deleteImg()"><i class="fas fa-times"></i></button>
    ${url[`name`]}`;
}

function deleteImg() {
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
}