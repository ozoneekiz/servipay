
/*************************************************
 funcion que evitar el doble click . para boton en cajas
*************************************************/
function isDoubleClicked(element) {
    //if already clicked return TRUE to indicate this click is not allowed
    if (element.data("isclicked")) return true;

    //se marcka el clikado pi 1 segundo
    element.data("isclicked", true);
    setTimeout(function() {
        element.removeData("isclicked");
    }, 1000);

    //return FALSE to indicate this click was allowed
    return false;
}

function showConfirmSwal({accion = 'sin accion', entidad ='none', id='',name='', message = '', icon ='question'}) {
    
    if (accion == 'crear') {
        message = `Se creara el ${entidad}: <b> ${name}</b>`;
    }   
    if (accion == 'actualizar') {
        message = `El ${entidad}: <b>${id}</b> se actualizará con los datos ingresados`;
    }   
    if (accion == 'eliminar') {
        message = `Esta acción no se puede deshacer, eliminará el ${entidad} <b>${id}  ${name}</b> y todos sus registros asociados`;
    }   

    return Swal.fire({
        title: `¿Desea ${accion} el ${entidad}?`,
        html: message,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.isConfirmed) {
            return true
        } else {
            return null
        }
    })
}
function showConfirm_delete_Swal(swaldata) {
    return Swal.fire({
        title: `¿Desea Borrar el ${swaldata}?`,
        html: `Esta acción no se puede deshacer, eliminará el ${swaldata} y todos sus registros asociados`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then((result) => {
        if (result.isConfirmed) {
            return true
        } else {
            return null
        }
    })
}
function swal_message_response(respuesta) {
    if (respuesta['success'] == true) {
        Swal.fire({
            icon: 'success',
            title: respuesta['title'],
            html: respuesta['message'],
            showConfirmButton: true,

        });
        $("#modal").modal("hide");


        return true;
    } else if (respuesta['success'] == false) {
        Swal.fire({
            icon: 'error',
            title: respuesta['title'],
            html: respuesta['message'],
            showConfirmButton: true,
        });
       
        

        return false;
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Hubo un error',
            html: respuesta,
            showConfirmButton: true,

        });
        
        return false;
    }
}
function show_validate_errors(errors) {
    clean_validate_errors();
    $('.content-errors').removeClass('d-none');
    $('.message_errors').text(errors.responseJSON.message);

    $.each(errors.responseJSON.errors, function(key, value) {
          $('.validate_errors').append('<li>' + value + '</li>');
    });
}
function clean_validate_errors() {
    $('.validate_errors').html('');
    $('.content-errors').addClass('d-none');
    $('.message_errors').text('');
    $('.btn-save').prop('disabled', true);
}
function activate_button_on_input_change() {
  
    /* $(':input').keypress(function(){
        $('.btn-save').prop('disabled', false);
     });
    $(':input').change(function(){
        $('.btn-save').prop('disabled', false);
     }); */
     $(':input').keyup(function(e){
         
         if (event.keyCode != 37 && event.keyCode != 38 && event.keyCode != 39 && event.keyCode != 40
            && this.value != ''
            ){
            $('.btn-save').prop('disabled', false);
        } 
            
    });
    
}
function clean_form_input() {

    $(':input:not(#iptcsrf,#iptid)').val("");

}
function darkmode(){
        $('body').toggleClass("dark-mode");
}