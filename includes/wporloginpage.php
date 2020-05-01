<?php
if(!defined('ABSPATH'))exit;

/*
 * Function para agregar un Menú y Página del Plugin WPOrLogin
 * en Admin de WordPress
 */
function wporlogin_add_admin_menu_page(){
    
    //PD: https://codex.wordpress.org/Adding_Administration_Menus
    
    $page_title = 'Plugin WPOrLogin';           //Título de la página
    $menu_title = 'WPOrLogin';                  //Título para Menú
    $capability = 'manage_options';             //Capacidad - manage_option => Adminsitrar opción
    $menu_slug = 'wporlogin-plugin';            //El nombre del slug para referirse a este menú
    $function = 'wporlogin_content_page_menu';  //La función que muestra el contenido de la página del menú.
    $icon_url = 'dashicons-unlock';             //La url del icono que se utilizará para este menú.
    
    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url);
    
}
add_action('admin_menu','wporlogin_add_admin_menu_page');

/*
 * Function para agregar contenido HTML en la página del Plugin WPOrLogin
 */
function wporlogin_content_page_menu() {     
    ?>

    <div class="wrap">        
        <h1>Opciones de WPOrLogin</h1>        
        <p>Opciones para personalizar el Login de WordPress con <strong>WPOrLogin</strong></p>
         
        <?php settings_errors();//Muestra los mensajes de éxito o de error cuando se envía el formulario ?>
        
        <form method="post" action="<?php echo esc_url(admin_url('options.php') ); ?>">
            	    
            <?php 
            //Para proteger formularios
            wp_nonce_field(basename(__FILE__), 'wporlogin_form_nonce'); 
            ?>
            
            <?php settings_fields( 'wporlogin_custom_admin_settings_group' ); ?>
	    <?php do_settings_sections( 'wporlogin_custom_admin_settings_group' ); ?>
            
            <table class="form-table" role="presentation">
                <tbody>   
                    
                    <!--URL del LOGOTIPO-->
                    <tr>
                        <th scope="row"><label for="wporlogin_url_logotipo_text">Logotipo</label></th>
                        <td>
                            <?php
                            if(esc_url(get_option('wporlogin_url_logotipo'))){
                            ?>
                            <img id="wporlogin_url_logotipo_img" src="<?php echo esc_url(get_option('wporlogin_url_logotipo')); ?>" style="margin-bottom: 10px; width: 220px; padding: 10px; background-color: #ffffff; border: 2px dashed rgba(0,0,0,.1);"><br>
                            <?php
                            }
                            ?>
                            <input aria-label="Close" id="wporlogin_url_logotipo_text" type="text" name="wporlogin_url_logotipo" class="regular-text" style="margin-bottom: 10px;" value="<?php echo esc_url(get_option('wporlogin_url_logotipo')); ?>"/><br>
                            <input id="wporlogin_url_logotipo_button" type="button" class="button" value="Seleccionar el logotipo" />
                            <p class="description" id="tagline-description">Puedes subir tu logotipo desde aquí.</p>
                            <p class="description" id="tagline-description">Obtendrá los mejores resultados con una <strong>dimensiones de 200 por 84 píxeles.</strong></p>
                        </td>
                    </tr>
                        
                    <!--Ruta de URL en el LOGOTIPO-->
                    <tr>
                        <th scope="row"><label for="wporlogin_ruta_url_logotipo_text">URL del Logotipo</label></th>
                        <td>
                            <input id="wporlogin_ruta_url_logotipo_text" type="text" name="wporlogin_ruta_url_logotipo" class="regular-text" placeholder="https://example.com" value="<?php echo esc_html(get_option('wporlogin_ruta_url_logotipo')); ?>"/><br>
                            <p class="description" id="tagline-description">Cambiar la <strong>url del logo</strong> de login.</p>
                        </td>
                    </tr>
                             
                    <!--Titulo del LOGOTIPO-->
                    <tr>
                        <th scope="row"><label for="wporlogin_titulo_logotipo_text">Título del Logo</label></th>
                        <td>
                            <input id="wporlogin_titulo_logotipo_text" type="text" name="wporlogin_titulo_logotipo" class="regular-text" value="<?php echo esc_html(get_option('wporlogin_titulo_logotipo')); ?>"/><br>
                            <p class="description" id="tagline-description"> Cambiar el <strong>título del logo</strong> en login.</p>
                        </td>
                    </tr>
                    
                    <!--URL de IMG de fondo-->
                    <tr>
                        <th scope="row"><label for="wporlogin-img-fondo">Imagen de fondo</label></th>
                        <td>                            
                            <?php
                            if(esc_url(get_option('wporlogin_url_img_fondo'))){
                            ?>
                            <img id="wporlogin_url_img_fondo_img" src="<?php echo esc_url(get_option('wporlogin_url_img_fondo')); ?>" style="margin-bottom: 10px; width: 220px; padding: 10px; background-color: #ffffff; border: 2px dashed rgba(0,0,0,.1);"><br>
                            <?php
                            }
                            ?>
                            <input id="wporlogin_url_img_fondo_text" type="text" name="wporlogin_url_img_fondo" class="regular-text" style="margin-bottom: 10px;" value="<?php echo esc_html(get_option('wporlogin_url_img_fondo')); ?>"/><br>
                            <input id="wporlogin_url_img_fondo_button" type="button" class="button" value="Seleccionar imagen de fondo" />
                            <p class="description" id="tagline-description">Puedes subir una imagen de fondo desde aquí.</p>
                            <p class="description" id="tagline-description">Obtendrá los mejores resultados al utilizar imágenes con una <strong>dimensiones de 1920 por 1080 píxeles.</strong></p>
                        </td>
                    </tr>
                    
                    <!--BOTÓN DE DONACIÓN CON PAYPAL-->
                    <tr style="border-bottom: solid 1px #005d8c; border-top: 1px #005d8c solid;">
                        <th scope="row"><label>¿Cómo Donar?</label></th>
                        <td>
                            <a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PVGRWHPJVALTQ&source=url">
                                <img src="<?php echo esc_url(plugin_dir_url( __FILE__ ).'../img/btn_donar_paypal.gif'); ?>">
                            </a>
                            <p class="description" id="tagline-description">
                                <strong>Importante: </strong>Si valoras mi trabajo, considera una pequeña donación para mostrar tu agradecimiento. ¡Gracias!
                            </p>
                            <p class="description" id="tagline-description">Para <strong>donar ahora</strong> haga clic en el botón <strong>Donar</strong></p>
                        </td>
                    </tr>
                    
                </tbody>
            </table>   
            
            <?php submit_button(); ?>
            
        </form>
    
    </div>
    <?php
}

function wporlogin_register_options_admin_page() {
    
    register_setting( 'wporlogin_custom_admin_settings_group', 'wporlogin_url_logotipo');
    register_setting( 'wporlogin_custom_admin_settings_group', 'wporlogin_ruta_url_logotipo');
    register_setting( 'wporlogin_custom_admin_settings_group', 'wporlogin_titulo_logotipo');
    register_setting( 'wporlogin_custom_admin_settings_group', 'wporlogin_url_img_fondo');
    
}
add_action('admin_init','wporlogin_register_options_admin_page');