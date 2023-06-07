/* By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License */

// DISEÑO INPUT FILES

var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
    var label	 = input.nextElementSibling,
        labelVal = label.innerHTML;

    input.addEventListener( 'change', function( e )
    {
        var fileName = '';
        if( this.files && this.files.length > 1 )
            fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
        else
            fileName = e.target.value.split( '\\' ).pop();

        if( fileName )
            label.querySelector( 'span' ).innerHTML = fileName;
        else
            label.innerHTML = labelVal;
    });
});

// VISTA PREVIA IMAGENES

function showImagePreview(e){
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();
    let input = e.currentTarget;
    let file = input.files[0];
    
    if(file){
        // Leemos el archivo subido y se lo pasamos a nuestro fileReader
        reader.readAsDataURL(file);

          // Le decimos que cuando este listo ejecute el código interno
          reader.onload = function(){

            let preview = input.parentElement.querySelector('.image-preview'),
                    image = document.createElement('img');

            image.src = reader.result;

            preview.innerHTML = '';
            preview.append(image);
          };
    } else {
        let preview = input.parentElement.querySelector('.image-preview'),
                    image = document.createElement('img');
            preview.innerHTML = 'Vista previa';
    }
}

let inputs_imagen = document.querySelectorAll('.inputfile');

inputs_imagen.forEach(input => {
    input.addEventListener('change', showImagePreview);
})