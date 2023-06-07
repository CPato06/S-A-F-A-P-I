// CONSULTAS

$(buscar_datos());

function buscar_datos(consulta){
	$.ajax({
		url: 'validarVer.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {consulta: consulta},
        beforeSend:function(data){
            $('#autos').html('<img class="cargando" src="images/loading-45.gif" alt="Cargando..."/>');
        },
	})
	.done(function(respuesta){
		$("#autos").html(respuesta);
	})
	.fail(function(){
		console.log("Error");
	});
}


$(document).on('keyup','#auto', function(){
	var valor = $(this).val();
	if (valor != "") {
		buscar_datos(valor);
	}else{
		buscar_datos();
	}
});

// INSERTAR

$('#frmAjax').submit(function(e){
   e.preventDefault();

    let datos = new FormData(this);
    $.ajax({
        type: 'POST' ,
        url: 'validarProducto.php' ,
        dataType: 'html',
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        beforeSend:function(){
            $('#btnGuardar').attr('disabled', 'disabled');
            $('#process').css('display','block');
        },
        success: function(r){
            r = JSON.parse(r);
            var porcentaje = 0;
            var timer = setInterval(function(){
                    porcentaje = porcentaje + 20;
                    progress_bar_process(porcentaje,timer, r);
                }, 1000);
            
            if(r.estado){
                
                setTimeout(() => {
                    limpiar_preview();
                }, 5000);
            }
        }
    })
});

// ACTUALIZAR

$('#btnActuaz').on('click',function(e){
   e.preventDefault();
    
    let form = document.getElementById('frmAjax');
    let datos = new FormData(form);
    
    $.ajax({
        type: 'POST' ,
        url: 'validarActualizar.php' ,
        dataType: 'html',
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        beforeSend:function(){
            $('#btnGuardar').attr('disabled', 'disabled');
            $('#btnActuaz').attr('disabled', 'disabled');
            $('#process').css('display','block');
        },
        success: function(r){
            r = JSON.parse(r);
            var porcentaje = 0;
            var timer = setInterval(function(){
                    porcentaje = porcentaje + 20;
                    progress_bar_process(porcentaje,timer, r);
                }, 1000);
        }
    })
});


function progress_bar_process(porcetaje, timer, r){
    $('.progress-bar').css('width', porcetaje + '%');

    if(porcetaje > 100){
        clearInterval(timer);
        $('#frmAjax')[0].reset();
        $('#process').css('display', 'none');
        $('.progress-bar').css('width', '0%');
        $('#btnGuardar').attr('disabled', false);
        $('#btnActuaz').attr('disabled', false);

        if(r['estado']){
                Swal.fire({
                icon: 'success',
                title: r['titulo'],
                showConfirmButton: false,
                timer: 4000,
                background: '#2B2B2B' 
            });
            }else{
                Swal.fire({
                icon: 'error',
                title: r['titulo'],
                text: r['mensaje'],
                showConfirmButton: false,
                timer: 5000,
                background: '#2B2B2B' 
            }); 
            }
    }
}
function limpiar_preview() {
    let previews = document.querySelectorAll('.contenedor_inputFile');
    
    previews.forEach((contenedor_preview, index) =>{
       contenedor_preview.innerHTML = '';
        
        contenedor_preview.innerHTML = `<input type="file" name="foto_${index+1}" id="file-${index+1}" class="inputfile inputfile-2" accept="image/*"/>
                                    <label for="file-${index+1}"><i class="far fa-file-image"></i><span class="inputfileCustom">Agrega una foto</span></label>
                                    <div class="image-preview">
                                        <img src="" alt="" class="image-preview__img">
                                            <span class="image-preview__txt" id="image-preview__txt">Vista previa</span>
                                    </div>`;
    });
}

// ELIMINAR

function AlertaEliminacion(id) {
    
    Swal.fire({
        title: 'Estas seguro que deseas eliminar el auto?',
        text: 'El auto sera eliminado permanentemente',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Eliminar',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        background: '#2B2B2B' 
    }).then((result) => {
          if(result.value) {
            eliminarDatos(id);
          }
    })
}

function eliminarDatos(id) {

        $.ajax({
            type: 'POST' ,
            url: 'eliminarProductos.php' ,
            dataType: 'html',
            data: {id: id},
            beforeSend: function(){},
            success: function(){
                actualizar_tabla(id);
                Swal.fire({
                    icon: 'success',
                    title: 'El auto ha sido eliminado exitosamente!',
                    showConfirmButton: false,
                    timer: 2000,
                    background: '#2B2B2B' 
                })
            }
        });
}

function actualizar_tabla(id){
    let fila = document.querySelector('#fila_' + id);
    fila.remove();
}