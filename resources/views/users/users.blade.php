{{-- @extends('layouts.admin2')
@section('content')
    section contents
@endsection('content');   --}}

{{-- @component('layouts.admin')
    desde el componente;
@endcomponent --}}

<x-admin-layout>
    <x-slot name="titulo">Usuarios</x-slot>
    <table id="table" class="stripe hover bordered">
        
        <thead class="custom-bg2">
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Username</th>
                <th>Rol</th>
                <th>Correo</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody >

        </tbody>
    </table>

    <div class="modal" tabindex="-1" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                   
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">

                    <form action="" method="POST" id="form">
                        @csrf
                        
                        <input type="hidden" class="form-control" id="id" name="id" >

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" 
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <input type="text" class="form-control" id="role" name="role" 
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="text" class="form-control" id="email" name="email" 
                                required>
                        </div>
                    </form>
                </div>
                <div class="content-errors d-none">  
                    <div class="message_errors col-11 mx-auto"></div><br>
                    <div class=" alert alert-danger col-11 mx-auto">
                        <ul class="validate_errors">
                        
                        </ul>
                    </div>
                </div>  
                   
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-save" disabled>Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

<script>
    $(document).ready(function() {
        let model ={nombre:'usuario'};
        let accion = '';
        let method = '';
        let url = '';


        // Iniciamos el datatable
        let table = $('#table').DataTable({
            autoWidth: false,
            dom: 'Bfrtip',

            "buttons": [
                {
                    text: 'Crear '+ model.nombre,
                    className: 'text-white bg-primary',
                    action: function ( e, dt, node, config ) {
                        newRecord();
                    }
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    autoPrint: false,
                    messageTop: 'MensajeTop',
                    messageBotton: '<div class="bg-olive" >Mesaje abajo</div>',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function(win) {
                        $(win.document.body).find('h1')
                            //.css( 'font-size', '10pt' )
                            .before('<div>esta es una prueba before</div>')
                            .after('<div >esta es una prueba after</div>')
                            .prepend(
                                '<div>esta es una prueba dentro prepend</div>'
                            );

                        //$(win.document.body).find( 'table' )
                        //.removeClass( 'table' )
                        //.css( 'font-size', 'inherit' );
                    }
                },
                "copy", "excel", "colvis", 'pageLength'
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            },
            "ajax": {
                "url": "{{ route('user.index') }}",
                "dataSrc": ""
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "username"
                },
                {
                    "data": "role"
                },
                {
                    "data": "email"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "id"
                },
            ],
            "columnDefs": [{
                    "targets": [0, 6],
                    'className': 'text-center',

                },
                {
                    "targets": [6],
                    "className": 'd-print-none acciones',

                    "render": function(data, type, row) {
                        return `
                                <button type="button" class="btn btn-primary btn-sm btn-edit">Editar</button>
                                <button type="button" class="btn btn-primary btn-sm btn-delete" id=${data}>Eliminar</button>
                            `;
                    }
                }
            ]
        });
        let csrf = $('input[name="_token"]').val();
        // Create record
        function newRecord() {
            accion = 'crear';
            method = 'POST';
            url = 'user';
            clean_validate_errors();
            clean_form_input();
            $('#modal').modal('show');
            $('.modal-title').text('Crear '+ model.nombre);
           
            activate_button_on_input_change();
        };
        
        // Edit record
        $(document).on("click", ".btn-edit", function() {
            
            clean_validate_errors();
            $('#modal').modal('show');
            $('.modal-title').text('Editar '+ model.nombre);

            let data = ($(this).parents('tr').hasClass('child')) ?
                table.row($(this).parents().prev('tr')).data() :
                table.row($(this).parents('tr')).data()

            $('#id').val(data['id']);
            $('#name').val(data['name']);
            $('#username').val(data['username']);
            $('#role').val(data['role']);
            $('#email').val(data['email']);
            
            accion = 'actulizar';
            method = 'PUT';
            url = 'user/' + data['id'];

            activate_button_on_input_change();
        });
        // Save record
        $('.modal-footer').on('click', '.btn-save', function() {
            let form = document.getElementById('form');
            
            if (form.checkValidity()) {
                showConfirmSwal({
                    accion: accion,
                    entidad: model.nombre,
                    id:     $('#id').val(),
                    name:   $('#name').val(),
                }).then(confirm => {
                if (confirm == null) {
                    return
                }
                    $.ajax({
                        type: method,
                        url: url,
                        data: {
                            '_token': csrf,
                            'id': $('#id').val(),
                            'name': $('#name').val(),
                            'username': $('#username').val(),
                            'role': $('#role').val(),
                            'email': $('#email').val(),
                        },
                        success: function(data) {
                            swal_message_response(data) ? table.ajax.reload():null
                        },
                        error: function(errors) {
                            show_validate_errors(errors);
                        }
                    });
                })
            }else{
                alert('no valido');
            }
        });
        // Delete a record
        $(document).on("click", ".btn-delete", function() {
            let user_id = $(this).attr('id');

            showConfirmSwal({accion:'eliminar',entidad:'usuario',id:user_id }).then(confirm => {
                if (confirm == null) {
                    return
                }
                $.ajax({
                    url: 'user/' + user_id,
                    type: "DELETE",
                    data: {
                        _token: csrf
                    },
                    //dataType: 'json',
                    success: function(respuesta) {
                        swal_message_response(respuesta) ? table.ajax.reload() :
                            null
                    }
                });

            })


        });
    });
</script>
