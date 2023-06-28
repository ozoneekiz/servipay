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
        <tbody>

        </tbody>
    </table>
   
         
    <div class="modal fade"  id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">


                        
                        @csrf
                        {{-- <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"> --}}
                        <input type="hidden" id="id" name="id">

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name"
                                pattern="[a-zA-ZáéíóúüñÑ\s]{3,255}" title="El nombre solo debe contener letras"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                pattern="[a-zA-ZáéíóúüñÑ_]{3,255}"
                                title="El UserName solo debe contener letras y guiones bajos" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <input type="text" class="form-control" id="role" name="role"
                                pattern="[a-zA-ZáéíóúüñÑ]{3,30}" title="El Rol solo debe contener letras" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                    </div>
                    <div class="content-errors d-none">
                        <div class="message_errors col-11 mx-auto"></div><br>
                        <div class=" alert alert-danger col-11 mx-auto">
                            <ul class="validate_errors">

                            </ul>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary btn-save" disabled >Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>

<script>
    $(document).ready(function() {
        // Inicializamos las variables para el datatable y funciones
        let model = {
            model: 'user',
            nombre: 'usuario',
            route: '/user',
            actions_col: 6
        };
       
        let csrf = $('input[name="_token"]').val();
        // Inicializamos las variables para tipo de envio por ajax en Store record
        let method = '';
       
        // Iniciamos el datatable
        let table = $('#table').DataTable({
            autoWidth: false,
            dom: 'Bfrtip',
            "deferRender": true,
          
            "buttons": [{
                    text: 'Crear ' + model.nombre,
                    className: 'text-white bg-primary',
                    action: function(e, dt, node, config) {
                        method = 'POST';
                        create_New_Record(model.route, model);
                        console.log(method+' ---- '+url);
                    }
                },
                data_Table_Top_Button(model)
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            },
            "ajax": {
                "url": model.route,
                "dataSrc": "",
                              
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
                    "targets": [1],
                    "render": function(data, type, row) {
                        return `<a href="${model.route}/${row['id']}">${data}</a>`;
                    }
                },
                render_actions_Buttons({
                    "model": model.model,
                    "view": true, //default false
                    "edit": true,
                    "destroy": true,
                })
            ]
        });

        // Edit record
        $(document).on("click", ".btn-edit", function() {

            clean_validate_errors();
            

            let data = ($(this).parents('tr').hasClass('child')) ?
                table.row($(this).parents().prev('tr')).data() :
                table.row($(this).parents('tr')).data()

            ;
            /*  $('#id').val(data['id']);
             $('#name').val(data['name']);
             $('#username').val(data['username']);
             $('#role').val(data['role']);
             $('#email').val(data['email']); */

            load_Input_for_edit(data);

            $('#modal').modal('show');
            $('.modal-title').text('Editar ' + model.nombre + ' Id: ' + data['id']);

            accion = 'actualizar';
            method = 'PUT';
            url = model.route +'/'+data['id'];
            activate_button_on_input_change();
        });

        // Store record
        $(document).on('click', '.btn-save', function() {
            no_send_form(idform = '#form');

            let form = document.getElementById('form');
            
            if (form.checkValidity()) {

                showConfirmSwal({
                    accion: accion,
                    entidad: model.nombre,
                    id: $('#id').val(),
                    name: $('#name').val(),
                }).then(confirm => {
                    if (confirm == null) {
                        return
                    }
                    let data = $('#form').serialize();

                    $.ajax({
                        type: method,
                        url: url,
                        data: data,
                        success: function(data) {
                            swal_message_response(data) ? table.ajax.reload() : null
                        },
                        error: function(errors) {
                            show_validate_errors(errors);
                        }
                    });
                })
            }
        });

        // Destroy record
        $(document).on("click", ".btn-delete", function() {
            let user_id = $(this).attr('id');
            

            showConfirmSwal({
                accion: 'eliminar',
                entidad: 'usuario',
                id: user_id
            }).then(confirm => {
                if (confirm == null) {
                    return
                }
                $.ajax({
                    url: model.route +'/'+ user_id,
                    type: "DELETE",
                    data: {
                        _token: csrf
                    },
                   
                    success: function(respuesta) {
                        swal_message_response(respuesta) ? table.ajax.reload() :
                            null
                    }
                });

            })


        });
    });
</script>
