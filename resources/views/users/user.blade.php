{{-- @extends('layouts.admin2')
@section('content')
    section contents
@endsection('content');   --}}

{{-- @component('layouts.admin')
    desde el componente;
@endcomponent --}}

<x-admin-layout>
    <x-slot name="titulo">Datos de usuario</x-slot>
    @if ($user == null)
        <div class="alert alert-danger" role="alert">
            No se encontro el usuario o no existe.
        </div>
    @else
        <div class="col-md-8 col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informacion de Usuario</h3>
                    <div class="card-tools">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->
                        <span class="badge badge-primary">Activo</span>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
    
                    <div class="mb-2 row">
                        <div class="col-md-3 ">
                            <img class="rounded" src="../storage/{{ $user->profile_photo_path }}" alt="image"
                                width="180px ">
                        </div>
                        <div class="col-md-9 ">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="border-bottom bg-gray-200 pb-2 mb-3">{{ $user->name }}</h4>
                                    <b>Id: </b> {{ $user->id }}<br>
                                    <b>Username: </b> {{ $user->username }}<br>
                                    <b>Rol: </b> {{ $user->role }}<br>
                                    <b>E-mail: </b> {{ $user->email }}<br>
                                    <b>Creado: </b> {{ $user->created_at }}<br>
                                    <b>Actualizado: </b>{{ $user->updated_at }}<br>
   
                                </div>
                                
                            </div>
    
                        </div>
                    </div>
    
                </div>
                <!-- /.card-body -->
                <div class="pb-3 card-footer">
                    <a href="{{ route('users') }}" class="btn btn-primary float-right">Regresar</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->

        </div>

        
    @endif


</x-admin-layout>

<script>
    $(document).ready(function() {
        let model = {
            nombre: 'usuario'
        };
        let accion = '';
        let method = '';
        let url = '';



        let csrf = $('input[name="_token"]').val();


        // Edit record
        $(document).on("click", ".btn-edit", function() {

            clean_validate_errors();
            $('#modal').modal('show');
            $('.modal-title').text('Editar ' + model.nombre);

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
                    id: $('#id').val(),
                    name: $('#name').val(),
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
                            swal_message_response(data) ? table.ajax.reload() : null
                        },
                        error: function(errors) {
                            show_validate_errors(errors);
                        }
                    });
                })
            } else {
                alert('no valido');
            }
        });
        // Delete a record
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
