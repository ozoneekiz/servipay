<x-admin-layout>
    <x-slot name="menu">
        <x-menuInstitucion></x-menuInstitucion>
    </x-slot>


    <x-slot name="titulo">Usuarios</x-slot>

    <x-table>
        <th>id</th>
        <th>Nro de Padron</th>
        <th>Nombres</th>
        <th>Apellido Paterno</th>
        <th>apellido materno</th>
        <th>Stands</th>
        <th>DNI</th>
        <th>estado de pago</th>
        <th>estado</th>
        <th>Acciones</th>
    </x-table>

    <x-modal>
        <x-slot name="size">modal-lg</x-slot>
        @csrf
        <input type="hidden" id="id" name="id">
        <div class="row">
            <div class="mb-3 col-3">
                <label for="numerodepadron" class="form-label">Número de padrón</label>
                <input type="text" class="form-control" id="numerodepadron" name="numerodepadron" pattern="[0-9]{0,8}" title="El numero de padron debe contener 4 digitos" required>
            </div>
            <div class="mb-3 col-3">
                <label for="nombres" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombres" name="nombres" pattern="[a-zA-ZáéíóúüÁÉÍÓÚÜñÑ\s]{3,255}" title="El nombre solo debe contener letras" required>
            </div>



            <div class="mb-3 col-3">
                <label for="apellidopaterno" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control" id="apellidopaterno" name="apellidopaterno" pattern="[a-zA-ZáéíóúÁÉÍÓÚÜüñÑ\s]{3,255}" title="El apellido paterno solo debe contener letras" required>
            </div>

            <div class="mb-3 col-3">
                <label for="apellidomaterno" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control" id="apellidomaterno" name="apellidomaterno" pattern="[a-zA-ZáéíóúÁÉÍÓÚÜüñÑ\s]{3,255}" title="El apellido materno solo debe contener letras" required>
            </div>
        </div>
        
        <div class="row">
            <div class="mb-3 col-4">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" pattern="[0-9]{8}" title="El DNI solo debe contener 8 digitos" required>
            </div>

            <div class="mb-3 col-4">
                <label for="estadodepago" class="form-label">Estado de pago</label>
                <select class="form-control" id="estadodepago" name="estadodepago" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>

                </select>
            </div>

            <div class="mb-3 col-4">
                <label for="estado" class="form-label">Estado 2</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="activo">Activo</option>
                    <option value="observado">Observado</option>
                    <option value="transferido">transferido</option>
                    <option value="blanco">blanco</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="gradoestudio">Grado de estudio:</label>
                    <select class="form-control" id="gradoestudio" name="gradoestudio" required>
                        <option value="primaria">Primaria</option>
                        <option value="secundaria">Secundaria</option>
                        <option value="tecnico">Tecnico</option>
                        <option value="universitario">Universitario</option>
                        <option value="postgrado">Postgrado</option>
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">

                    <label for="actividad">Actividad:</label>
                    <input type="text" class="form-control" id="actividad" name="actividad" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select class="form-control" id="sexo" name="sexo" required>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="fechanacimiento">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" required>
                </div>
            </div>


            <div class="col-3">
                <div class="form-group">

                    <label for="distrito">Distrito de Nac.:</label>
                    <input type="text" class="form-control" id="distrito" name="distrito" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="provincia">Provincia de Nac.:</label>
                    <input type="text" class="form-control" id="provincia" name="provincia" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="departamento">Departamento de Nac.:</label>
                    <input type="text" class="form-control" id="departamento" name="departamento" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="estadocivil">Estado civil:</label>
                    <select class="form-control" id="estadocivil" name="estadocivil" required>
                        <option value="SOLTERO">Soltero</option>
                        <option value="CASADO">Casado</option>
                        <option value="CONVIVIENTE">Conviviente</option>
                        <option value="DIVORCIADO">Divorciado</option>
                        <option value="VIUDO">Viudo</option>
                    </select>
                </div>
            </div>




            <div class="col-6">
                <div class="form-group">

                    <label for="conyuge">Nombre del Conyuge:</label>
                    <input type="text" class="form-control" id="conyuge" name="conyuge">

                </div>
            </div>
            <div class="col-3">
                <div class="form-group">

                    <label for="dniconyuge">DNI del conyuge:</label>
                    <input type="number" class="form-control" id="dniconyuge" name="dniconyuge">
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-12">
                <div class="form-group">

                    <label for="domicilioactual">Domicilio Actual:</label>
                    <input type="text" class="form-control" id="domicilioactual" name="domicilioactual" required>
                </div>
            </div>

            <div class="col-6">

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="number" class="form-control" id="telefono" name="telefono" required>
                </div>

            </div>
            <div class="col-6">
                <div class="form-group">

                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">

                <div class="form-group">
                    <label for="formaadquisicion">Forma de adquisición:</label>
                    <select class="form-control" id="formaadquisicion" name="formaadquisicion" required>
                        <option value="FUNDADOR">Fundador</option>
                        <option value="TRANSFERENCIA">Transferencia</option>

                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="fechadeingreso" class="text-danger">Fecha de ingreso</label>
                    <input type="date" class="form-control" id="fechadeingreso" name="fechadeingreso">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="coposesionario">Coposesionario:</label>
                    <select class="form-control" id="coposesionario" name="coposesionario" required>
                        <option value="SI">Si</option>
                        <option value="NO">No</option>
                    </select>
                </div>
            </div>

            <div class="col-4">
                <div class="form-group">
                    <label for="año">Padron Antecedente:</label>
                    <input type="number" class="form-control" id="año" name="año" required>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">

                    <label for="tomo">Tomo:</label>

                    <select class="form-control" id="tomo" name="tomo" required>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                    </select>
                </div>
            </div>



            <div class="col-2">
                <div class="form-group">
                    <label for="folio">Folio:</label>
                    <input type="number" class="form-control" id="folio" name="folio" required>
                </div>
            </div>


        </div>
        <div class="historialdepadron row mb-5">
            <div class="col-12"><span class="text-bold mr-3">Historial de Padrones antecedentes:</span><span>
                    <span class="btn btn-primary btn-sm" id="btn-add-padron-antecedente">Agregar</span>
                </span></div>
            <div class="col-12 mt-3">
                <table id="tablaHistorial" class="table table-bordered">
                    <thead class="bg-secondary">
                        <tr>
                            <th>Libro padron</th>
                            <th>Tomo</th>
                            <th>Folio</th>
                            <th>estado</th>
                            <th>fecha de empadronamiento</th>
                            <th>nota</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="familia row mb-5">
            <div class="col-12"><span class="text-bold mr-3">Apellidos y Nombres de la familia:</span><span>
                    <span class="btn btn-primary btn-sm" id="btn-add-familia">Agregar</span>
                </span></div>
            <div class="col-12 mt-3">
                <table id="tablaFamilia" class="table table-bordered">
                    <thead class="bg-secondary">
                        <tr>
                            <th>APELLIDOS</th>
                            <th>NOMBRES</th>
                            <th>DNI</th>
                            <th>FILIACION</th>
                            <th>ESTADO CIVIL</th>
                            <th>EDAD</th>
                            <th>COPOSESIONARIO</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="coposesionario">Notas:</label>
                    <textarea class="form-control" id="notas" name="notas"></textarea>
                </div>
            </div>
        </div>
    </x-modal>

    <div class="modal fade" id="modal-addfamilia">
        <div class="modal-dialog ">
            <div class="modal-content">

                <div class="modal-header bg-olive">
                    <h5 class="modal-title">Agregar padron antecedente</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">

                    @csrf
                    <input type="hidden" id="iptidpadron" name="iptidpadron" value="0">
                    <input type="hidden" id="iptidpersona" name="iptidpersona" value="0">
                    <div class="row">

                        <div class="form-group col-6">

                            <label for="iptnombres">Nombres</label>
                            <input type="text" class="form-control" id="iptnombres" name="iptnombres">
                        </div>
                        <div class="form-group col-6">
                            <label for="iptapellidos">Apellidos</label>
                            <input type="text" class="form-control" id="iptapellidos" name="iptapellidos">
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="iptdni">DNI</label>
                            <input type="number" class="form-control" id="iptdni" name="iptdni">
                        </div>
                        <div class="form-group col-6">
                            <label for="iptedad">Edad</label>
                            <input type="number" class="form-control" id="iptedad" name="iptedad">
                        </div>
                    </div>
                    <div class="row">


                        <div class="form-group col-6">
                            <label for="iptfiliacion">Filiación</label>
                            <input type="text" class="form-control" id="iptfiliacion" name="iptfiliacion">
                        </div>

                        <div class="form-group col-6">
                            <label for="slcestadocivil">Estado Civil</label>
                            <select class="form-control" id="slcestadocivil" name="slcestadocivil">
                                <option value="SOLTERO">Soltero</option>
                                <option value="CASADO">Casado</option>
                                <option value="CONVIVIENTE">Conviviente</option>
                                <option value="DIVORCIADO">Divorciado</option>
                                <option value="VIUDO">Viudo</option>
                            </select>
                        </div>

                        <div class="form-group col-6 mx-auto">
                            <label for="slccoposesionario">Coposesionario</label>
                            <select class="form-control" id="slccoposesionario" name="slccoposesionario">
                                <option value="NO">No</option>
                                <option value="SI">Si</option>
                            </select>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn bg-olive btn-save" disabled>Agregar padron antecedente</button>
                </div>

            </div>
        </div>
    </div>


</x-admin-layout>
<script>
    $(document).ready(function() {


        let model = {
            nombre: 'Asociado', // se muestra en vista
            route: '/asociado', // url del controlador
            column_swal_name: '#nombres', // Nombre de la columna para mostrar en mensajes de alerta
            reference: 'numerodepadron', // Nombre de la columna para mostrar enlas alertas
        };
        let csrf = $('input[name="_token"]').val();
        // Inicializamos las variables para tipo de envio por ajax en Store record
        let method = '';

        let table = new DataTable('#table', {
            autoWidth: false,
            dom: 'Bfrtip',
            "deferRender": true,
            destroy: true,

            "buttons": [{
                    text: 'Crear Padron de ' + model.nombre,
                    className: 'text-white bg-primary',
                    action: function(e, dt, node, config) {
                        method = 'POST';
                        create_New_Record(model.route, model);
                    }
                },
                data_Table_Top_Button(model)
            ],
            "ajax": {
                "url": model.route,
                "dataSrc": "",

            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "numerodepadron"
                },
                {
                    "data": "nombres"
                },
                {
                    "data": "apellidopaterno"
                },
                {
                    "data": "apellidomaterno"
                },
                {
                    "data": "stands"
                },
                {
                    "data": "dni"
                },
                {
                    "data": "estadodepago"
                },
                {
                    "data": "estado"
                },
                {
                    "data": "id"

                }
            ],


            "columnDefs": [{
                    "targets": [0, -1],
                    'className': 'text-center',

                },
                {
                    "targets": [1],
                    "render": function(data, type, row) {
                        return `<a href="${model.route}/${row['id']}">${data}</a>`;
                    }
                },
                render_actions_drow_Buttons({
                    "model": model,
                    "edit": true,
                    "destroy": true,
                    "custom1": {
                        namebutton: 'Estado de cuenta',
                        handler: 'btn-ver-estado-cuenta',
                        icon: '<i class="fa-solid fa-address-card"></i>',
                    },
                    "custom2": {
                        namebutton: 'Imprimir tarjeta',
                        handler: 'btn-imprimir-tarjeta',
                        icon: '<i class="fa-solid fa-print"></i>',

                    },
                    "custom3": {
                        namebutton: 'Revertir reempadronamiento',
                        handler: 'btn-revertir-reempadronamiento',
                        icon: '<i class="fa-solid fa-undo"></i>',
                    },
                })
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            }
        });

        // Edit record
        $('#table').on("click", ".btn-edit", function() {

            clean_validate_errors();

            let data = ($(this).parents('tr').hasClass('child')) ?
                table.row($(this).parents().prev('tr')).data() :
                table.row($(this).parents('tr')).data();

            load_Input_for_edit(data);

            $('#modal').modal('show');
            $('.modal-title').text('Editar ' + model.nombre + ' Id: ' + data['id']);

            accion = 'actualizar';
            method = 'PUT';
            url = model.route + '/' + data['id'];
            activate_button_on_input_change();
        });
        // Store record
        $(document).on('click', '.btn-save', function() {
            no_send_form('#form');

            let form = document.getElementById('form');
            if (!form.checkValidity()) {
                return;
            }
            showConfirmSwal({
                accion: accion,
                entidad: model.nombre,
                id: $('#id').val(),
                name: $('#numerodepadron').val(),
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
                        swal_message_response(data)
                        swal_message_response(data) ? table.ajax.reload() : null
                    },
                    error: function(errors) {
                        show_validate_errors(errors);
                    }
                });
            })

        });

        // Destroy record
        $('#table').on("click", ".btn-delete", function() {
            let id = $(this).attr('id');


            let data = {
                id: $(this).attr("id"),
                reference: $(this).attr(model.nombre),
                model: model,
                csrf: csrf,
                table: table
            }
            console.log(data);

            destroy_register(data);
        });
        // agregar familia al datatable por sin guardar el dato, solo agrgarlo al datable
        $("#btn-agregar-familiar").click(function() {


            let apellidos = $("#iptapellidos").val();
            let nombres = $("#iptnombres").val();
            let dni = $("#iptdni").val();
            let edad = $("#iptedad").val();
            let filiacion = $("#iptfiliacion").val();
            let estadocivil = $("#slcestadocivil").val();
            let coposesionario = $("#slccoposesionario").val();



            let fila = "<tr>" +
                "<td>" + apellidos + "</td>" +
                "<td>" + nombres + "</td>" +
                "<td>" + dni + "</td>" +
                "<td>" + filiacion + "</td>" +
                "<td>" + estadocivil + "</td>" +
                "<td>" + edad + "</td>" +
                "<td>" + coposesionario + "</td>" +
                "<td><span class='btn btn-danger btn-sm btn-eliminar-fila'>Eliminar</span></td>" +
                "</tr>";

            $("#tablaFamilia tbody").append(fila);

            $("#modal-addfamilia").modal("hide");
        });
        /**************************************
         * agregar familia
         *****************************************/
        $("#btn-add-familia").click(function() {
            $("#modal-addfamilia").modal('show');
        });
    });
</script>