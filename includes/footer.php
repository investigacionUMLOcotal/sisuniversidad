<footer class="mt-auto" style="background: #004D40;
    color: #fff;
    padding: 17px;
    text-align: center;
    border-top: 5px solid #d5e119;">
    <p>Derechos reservados &copy; 2020</p>
  </footer>
  <script src="js/jquery-3.5.1.slim.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/datatables.min.js"></script>
  <script type="text/javascript" src="js/datatables.bootstrap4.min.js"></script>
    <script>
    $(() => {
     let table =  $("table").DataTable({
       language:{
        "lengthMenu": "Ver _MENU_ Archivos por Página",
        "infoFiltered": "(Filtrado de un Total de _MAX_ Registros)",
        "zeroRecords": "Lo sentimos, no tenemos resultados",
        "info": "Mostrando Página _PAGE_ de _PAGES_",
        "infoEmpty": "Sin Registros para Mostrar",

         "paginate": {
                       "previous": "Anterior",
                       "next": "Siguiente"
                   },
                   "search": "Buscar",


       },
       dom: 'fBrtip',
        buttons: [
          {
           extend : 'excel',
           text: 'Exportar a excel',
           className: 'btn btn-outline-success'
          },
          {
           extend : 'pdf',
           text: 'Exportar a PDF',
           className: 'btn btn-outline-danger'
          },
          {
           extend : 'print',
           text: 'Imprimir',
           className: 'btn btn-outline-primary',
           customize: function(win) {
                        $(win.document.body)
                            .css('font-size', '12pt')
                            .prepend(
                                '<img src="https://www.mzdevocotal.com/sisumlquilali/imagenes/logoUML.png" style="position:absolute; top:0; left:0; opacity:0.1; width:400px; height:100px;" />'
                            );

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }

          },
          
          
        ]
    } );

    table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
    })
  </script>