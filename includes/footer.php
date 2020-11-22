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
           className: 'btn btn-outline-primary'
          }
          
        ]
    } );

    table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
    })
  </script>