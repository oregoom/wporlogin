jQuery(document).ready(function($){
    

  
    
	var mediaUploaderLogo;
	var mediaUploader;

        /*  
         *  ///////////////////////////////////////////////////////////////////////
         *  Script de JavaScript para seleccionar imagen de fondo, de la biblioteca
         *  de WordPress. 
         *  ///////////////////////////////////////////////////////////////////////
         */
	$('#wporlogin_url_logotipo_button').click(function(e) {
            e.preventDefault();

            // Si el objeto del cargador ya se ha creado, vuelva a abrir el cuadro de diálogo
            if (mediaUploaderLogo) {
                mediaUploaderLogo.open();
                return;
            }

            // Extiende el objeto wp.media
            mediaUploaderLogo = wp.media.frames.file_frame = wp.media({
                title: 'Imagen de fondo',
                button: {
                text: 'Seleccionar imagen de fondo'
            }, multiple: false });

            // Cuando se selecciona un archivo, toma la URL y configúra como el valor del campo de texto
            mediaUploaderLogo.on('select', function() {
                attachment = mediaUploaderLogo.state().get('selection').first().toJSON();
                $('#wporlogin_url_logotipo_text').val(attachment.url);
                $('#wporlogin_url_logotipo_img').attr('src', attachment.url);
            });

            // Abre el diálogo del cargador
            mediaUploaderLogo.open();        
	});
        
        /*  
        *  ///////////////////////////////////////////////////////////////////////
        *  Script de JavaScript para seleccionar Logotipo, de la biblioteca
        *  de WordPress. 
        *  ///////////////////////////////////////////////////////////////////////
        */
        $('#wporlogin_url_img_fondo_button').click(function(e) {
            e.preventDefault();

            // Si el objeto del cargador ya se ha creado, vuelva a abrir el cuadro de diálogo
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }

            // Extiende el objeto wp.media
            mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Logotipo',
                    button: {
                    text: 'Seleccionar Logo'
                }, multiple: false });

            // Cuando se selecciona un archivo, toma la URL y configúra como el valor del campo de texto
            mediaUploader.on('select', function() {
                    attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#wporlogin_url_img_fondo_text').val(attachment.url);                    
                    $('#wporlogin_url_img_fondo_img').attr('src', attachment.url);
		});

            // Abre el diálogo del cargador
            mediaUploader.open();
	});
});