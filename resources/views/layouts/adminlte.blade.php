@extends('adminlte::page')

{{-- @section('title', $title) --}}

@section('content_header')

@stop

@section('content')
    {{ $slot }}
@stop


@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles

@stop


@section('js')
    @stack('modals')
    @livewireScripts
    {{-- CKEditor javascript  --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script> --}}

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    {{-- <script src="sweetalert2.all.min.js"></script> --}}

    {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ elementos por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrados de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });

        Livewire.on('table', () => {
            $('#myTable').DataTable().destroy();
            $('#myTable').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ elementos por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrados de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        })

        Livewire.on('alertDelete', id => {
            Livewire.emit('updateTable');
            Swal.fire({
                title: '¿Confirma la eliminación?',
                text: "La acción no podrá ser revertida!",
                icon: 'warning',
                showCancelButton: true,
                backdrop: '#333333',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar!',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('updateTable');
                    Livewire.emit('delete', id);
                    // Swal.fire(
                    // 'Borrado!',
                    // 'Ha sido eliminado con éxito.',
                    // 'success'
                    // )
                } else {
                    Livewire.emit('updateTable');
                }
            });
        });


        //emit mensaje negativo
        Livewire.on('mensajeNegativo', function (mensaje) {
            Swal.fire({
                title: 'Atencion',
                text: mensaje['mensaje'],
                icon: 'warning',
                showCloseButton: true
            })
        });


        //emit mensaje positivo
        Livewire.on('mensajePositivo', function (mensaje) {
            Swal.fire({
                title: 'Excelente!',
                text: mensaje['mensaje'],
                icon: 'success',
                showCloseButton: true,
                showconfirmButton: true
            })
        });

        // Funcion que refresca los datatables c/ vez que se vuelve a renderizar un componente
        // document.addEventListener('livewire:load', function() {

        // console.log(mensaje); // Mostrar mensaje en la consola
        // console.log('Livewire Load Event'); // Mensaje en consola

        // Livewire.on('actualizarDataTable', function() {

        // console.log('Evento actualizarDataTable recibido'); // Mensaje en consola
        // // Reinicializar DataTable
        // $('#miTabla').DataTable().destroy(); // Reemplaza 'miTabla' con tu ID de tabla
        // $('#miTabla').DataTable(); // Vuelve a inicializar DataTable
        // });
        // });

        // $('#rolesTable').DataTable();
        // $(document).ready(function() {
        // $('#rolesTable').DataTable({
        // "language": {
        // "sProcessing": "Procesando...",
        // "sLengthMenu": "Mostrar _MENU_ registros",
        // "sZeroRecords": "No se encontraron resultados",
        // "sEmptyTable": "Ningún dato disponible en esta tabla",
        // "sInfo": "Mostrando _START_ al _END_ de _TOTAL_ registros",
        // "sInfoEmpty": "Mostrando 0 al 0 de 0 registros",
        // "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        // "sInfoPostFix": "",
        // "sSearch": "Buscar:",
        // "sUrl": "",
        // "sInfoThousands": ",",
        // "sLoadingRecords": "Cargando...",
        // "oPaginate": {
        // "sFirst": "Primero",
        // "sLast": "Último",
        // "sNext": "Siguiente",
        // "sPrevious": "Anterior"
        // },
        // "oAria": {
        // "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        // "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        // }
        // }
        // });
        // // });

        // $('#usersTable').DataTable();

        // $('#miTabla').DataTable();
    </script>

@stop


{{-- @section('plugins.Datatables', true); --}}
