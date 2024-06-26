/*************************************************
 funcion que evitar el doble click . para boton en cajas
*************************************************/
function isDoubleClicked(element) {
    //if already clicked return TRUE to indicate this click is not allowed
    if (element.data("isclicked")) return true;

    //se marcka el clikado pi 1 segundo
    element.data("isclicked", true);
    setTimeout(function () {
        element.removeData("isclicked");
    }, 1000);

    //return FALSE to indicate this click was allowed
    return false;
}

function showConfirmSwal({
    accion = "sin accion",
    entidad = "none",
    id = "",
    name = "",
    message = "",
    icon = "question",
    reference = "",
}) {
    if (accion == "crear") {
        message = `Se creara el ${entidad}: <b> ${name}</b>`;
    }
    if (accion == "actualizar") {
        message = `El ${entidad}: <b>${name}</b> se actualizará con los datos ingresados`;
    }
    if (accion == "eliminar") {
        message = `Esta acción no se puede deshacer,<br> eliminará el <b>${entidad} : ${reference}</b>  con <b>id nro: ${id}  </b><br> y todos sus registros asociados`;
    }

    return Swal.fire({
        title: `¿Desea ${accion} el ${entidad}?`,
        html: message,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        focusCancel: true,
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            return true;
        } else {
            return null;
        }
    });
}

function swal_message_response(respuesta) {
    if (respuesta["success"] == true) {
        Swal.fire({
            icon: "success",
            title: respuesta["title"],
            html: respuesta["message"],
            showConfirmButton: true,
        });
        $("#modal").modal("hide");

        return true;
    } else if (respuesta["success"] == false) {
        Swal.fire({
            icon: "error",
            title: respuesta["title"],
            html: respuesta["message"],
            showConfirmButton: true,
        });

        return false;
    } else {
        Swal.fire({
            icon: "error",
            title: "Hubo un error",
            html: respuesta,
            showConfirmButton: true,
        });

        return false;
    }
}
function show_validate_errors(errors) {
    clean_validate_errors();
    $(".content-errors").removeClass("d-none");
    $(".message_errors").text(errors.responseJSON.message);

    $.each(errors.responseJSON.errors, function (key, value) {
        $(".validate_errors").append("<li>" + value + "</li>");
    });
}
function clean_validate_errors() {
    $(".validate_errors").html("");
    $(".content-errors").addClass("d-none");
    $(".message_errors").text("");
    $(".btn-save").prop("disabled", true);
}
function activate_button_on_input_change() {
    /* $(':input').keypress(function(){
        $('.btn-save').prop('disabled', false);
     });
    $(':input').change(function(){
        $('.btn-save').prop('disabled', false);
     }); */
    $(":input").keyup(function (e) {
        if (
            event.keyCode != 37 &&
            event.keyCode != 38 &&
            event.keyCode != 39 &&
            event.keyCode != 40 &&
            this.value != ""
        ) {
            $(".btn-save").prop("disabled", false);
        }
    });
    $("#modal select").change(function () {
        $(".btn-save").prop("disabled", false);
    });
}
function clean_form_input() {
    $(':input:not([name="_token"],#id)').val("");
}
function load_Input_for_edit(object) {
    for (prop in object) {
        $("#" + prop).val(object[prop]);
    }
}

function no_send_form(idform = "#form") {
    $(idform).submit(function (e) {
        e.preventDefault();
    });
}

function darkmode() {
    $("body").toggleClass("dark-mode");
}

function destroy_record(id, model, csrf, table) {
    //old functions 
    showConfirmSwal({
        accion: "eliminar",
        entidad: model.nombre,
        id: id,

    }).then((confirm) => {
        if (confirm == null) {
            return;
        }
        $.ajax({
            url: model.route + "/" + id,
            type: "DELETE",
            data: {
                _token: csrf,
            },
            success: function (respuesta) {
                swal_message_response(respuesta) ? table.ajax.reload() : null;
            },
        });
    });
}
function destroy_register(data) {
    
    showConfirmSwal({
        accion: "eliminar",
        entidad: data.model.nombre,
        id: data.id,
        reference: data.reference
    }).then((confirm) => {
      if (confirm == null) {
        return;
      }
  
      const ajaxdata = {
        accion: "destroy",
        csrf: data.csrf,
        id: data.id,
      };
      $.ajax({
        url: data.model.route + "/" + data.id,
            type: "DELETE",
            data: {
                _token: data.csrf,
        },
        success: function (respuesta) {
          // error succes por seccess
          swal_message_response(respuesta) ? data.table.ajax.reload() : null;
        },
      });
    });
  }
  
/* DATATABLE FUNCTIONS */
function create_New_Record(route, model) {
    accion = "Crear";
    method = "POST";
    url = route;
    clean_validate_errors();
    clean_form_input();
    $("#modal").modal("show");
    $("#modal.modal-title").text("Crear " + model.nombre);
    activate_button_on_input_change();
}

function data_Table_Top_Button(model) {
    (printButton = {
        extend: "print",
        text: "Imprimir",
        autoPrint: false,
        //messageTop: 'MensajeTop',
        messageBotton: '<div class="bg-olive" >Mesaje abajo</div>',
        exportOptions: {
            columns: ":visible",
        },
        customize: function (win) {
            $(win.document.body).find("h1");
            //.css( 'font-size', '10pt' )
            // .before('<div class="text-bold">Lista de '+model.nombre + 's</div>')
            //.after('<div>esta es una prueba after</div>')

            $(win.document.body).find("h1");
            //.removeClass( 'table' )
            //.addClass( 'd-none' )
            //.css( 'font-size', 'inherit' );
        },
    }),
        (buttons = ["copy", "excelHtml5", "colvis", "pageLength", printButton]);
    return buttons;
}

function render_actions_Buttons({
    model = false,
    col = -1,
    view = false,
    print = false,
    edit = false,
    destroy = false,
}) {
    return {
        targets: [col],
        className: "d-print-none acciones",

        render: function (data, type, row) {
            if (!model) {
                return "Error: no se especifico el modelo<b> {model: 'modelo'}</b>";
            }

            let buttons = "";

            if (view) {
                buttons += `<a type="button" class="btn btn-primary btn-sm mr-2" href="${model.route}/${data}">Ver</a>`;
            }
            if (print) {
                buttons += `<button type="button" class="btn btn-primary btn-sm btn-print mr-2" id=${data}>Imprimir</button>`;
            }
            if (edit) {
                buttons += `<button type="button" class="btn btn-primary btn-sm btn-edit mr-2">Editar</button>`;
            }
            if (destroy) {
                buttons += `<button type="button" class="btn btn-primary btn-sm btn-delete" id=${data}>Eliminar</button>`;
            }
            return buttons;
        },
    };
}
function render_actions_drow_Buttons({
    model = false,
    col = -1,
    view = false,
    print = false,
    edit = false,
    destroy = false,
    custom1 = false,
    custom2 = false,
    custom3 = false,
    custom4 = false,
    custom5 = false,
    custom6 = false,

}) {
    return {
        targets: [col],
        className: "d-print-none acciones",

        render: function (data, type, row) {
            if (!model) {
                return "Error: no se especifico el modelo<b> {model: 'modelo'}</b>";
            }

            let buttons = "";
            let custom_buttons = "";

            if (view) {
                buttons += `<a class="dropdown-item" href="${model.route}/${data}">Ver</a>`;
            }
            if (print) {
                buttons += `<a class="dropdown-item btn-print" id=${data}>Imprimir</a>`;
            }
            if (edit) {
                buttons += `<a  class="dropdown-item btn-edit">Editar</a>`;
            }
            if (destroy) {
                buttons += `<a  class="dropdown-item btn-delete" id="${data}" ${model.nombre}="${row[model.reference]}" >Eliminar</a>`;
            }
            if (custom1) {
                custom_buttons += `<a class="dropdown-item  ${custom1.handler}" id=${data}">
                             ${custom1.icon} ${custom1.namebutton}
                            </a>`;
            }
            if (custom2) {
                custom_buttons += `<a class="dropdown-item  ${custom2.handler}" id=${data}">
                             ${custom2.icon} ${custom2.namebutton}
                            </a>`;
            }
            if (custom3) {
                custom_buttons += `<a class="dropdown-item  ${custom3.handler}" id=${data}">
                             ${custom3.icon} ${custom3.namebutton}
                            </a>`;
            }
            if (custom4) {
                custom_buttons += `<a class="dropdown-item  ${custom4.handler}" id=${data}">
                             ${custom4.icon} ${custom4.namebutton}
                            </a>`;
            }
            if (custom5) {
                custom_buttons += `<a class="dropdown-item  ${custom5.handler}" id=${data}">
                             ${custom5.icon} ${custom5.namebutton}
                            </a>`;
            }
            if (custom6) {
                custom_buttons += `<a class="dropdown-item  ${custom6.handler}" id=${data}">
                             ${custom6.icon} ${custom6.namebutton}
                            </a>`;
            }

            let dropdown = `
            <div class="btn-group">
                    <button type="button" class="btn btn-primary">Acciones</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                        ${buttons}
                   
                    <div class="dropdown-divider"></div>
                        ${custom_buttons}
                    </div>
                    </div>
            `;
            return dropdown;
        },
    };
}
