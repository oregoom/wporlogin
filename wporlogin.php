<?php
/**
* Plugin Name: WPOrLogin - Personalizar login de WordPress
* Plugin URI: https://oregoom.com
* Description: Plugin para personalizar el login de WordPress.
* Version: 1.1
* Author: Oregoom.com
* Author URI:https://oregoom.com
* License: GPL2
*/

require_once plugin_dir_path(__FILE__) .'includes/wporloginpage.php';

function wporlogin_insert_script_upload(){
    
    wp_enqueue_media();//PARA ABRIR LA BIBLIOTEMA MEDIOS
    
    //REGISTRAR EL SCRIPT JS
    wp_register_script('wporlogin_my_upload', plugin_dir_url( __FILE__ ).'js/img-fondo.js', array('jquery'), '1', true );
    wp_enqueue_script('wporlogin_my_upload'); //MOSTRAR EL SCRIPT JS EN ADMIN
} 
add_action("admin_enqueue_scripts", "wporlogin_insert_script_upload");

////////////////////////////////////////////////////////////////////////////////
// WP LOGIN: AGREGAR NUEVO LOGO EN LUGAR DE WORDPRESS
////////////////////////////////////////////////////////////////////////////////

function wporlogin_page_login() {
    
    //COMPROBANDO SI LA VARIABLE ES NULO O VACIO
    if(get_option("wporlogin_url_img_fondo")){
        $wporlogin_url_img_fondo_val = esc_html(get_option("wporlogin_url_img_fondo"));
    } else {
        //IMPRIMIR IMG DE FONDO POR DEFECTO DE LA CARPETA DE PLUGIN
        $wporlogin_url_img_fondo_val = esc_html(plugin_dir_url( __FILE__ ).'img/wporlogin-img-fondo.jpg');    
    }
    ?>
    <style type="text/css" media="screen">

        @media (min-width: 415px) {
            /*
            ESTILOS PARA IMAGEN DE FONDO DE LOGIN
            */
            body.login {
                background-image: url(<?php echo esc_url($wporlogin_url_img_fondo_val); ?>); 
                background-position: center;
                background-size: cover; 
                background-attachment: fixed;
                margin: 0; 
                color: #444;
                font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;
            }
            
            body.login div#login {
                min-height: 100vh !important; 
                background-color: #ffffff !important; 
                width: 420px !important;
                /*max-width: 420px !important;*/ 
                margin-left: 10% !important; 
                display: flex !important;
                flex-direction: column !important;
                -moz-box-align: center !important;
                align-items: center !important;
                box-shadow: 0 0 15px rgba(0,0,0,.8) !important;
                
                padding: 0; /* CSS de Oregoom */
            }
            
            body.login div#login form#loginform, form#registerform, form#lostpasswordform {
                margin-top: 20px;
                margin-left: 0;
                padding: 26px 50px 46px;
                font-weight: 400;
                overflow: hidden;
                box-shadow: 0 1px 3px rgba(0,0,0,.04);
            }
            
        } /*@media (min-width: 415px) */
         
        body.login{
            background-color: #ffffff !important;        
        }
        
        body.login div#login h1 {
            text-align: center; 
            margin: 0; 
            padding: 15% 0 0 0;
        }
        
        body.login div#login h1 a {
/*            background-image: url(https://avesexoticas.org/wp-admin/images/wordpress-logo.svg?ver=20131107); 
            background-size: 84px;
            background-position: center top;
            background-repeat: no-repeat; */
            
            color: #444;
            
            /*height: 84px;*/
            
            font-size: 20px;
            font-weight: 400;
            line-height: 1.3;
            margin: 0 auto 25px;
            padding: 0;
            text-decoration: none;   
            
            /*width: 84px;*/
            
            text-indent: -9999px;
            outline: 0;
            overflow: hidden;
            display: block;
                
            <?php
        
            if(get_option("wporlogin_url_logotipo")){?>                
                background-image: url(<?php echo esc_url(get_option('wporlogin_url_logotipo')); ?>) !important;
                background-size: 200px;
                background-position: center top;
                background-repeat: no-repeat;  
                width: 200px;
                height: 84px;                      
                <?php 
            } else {
                    
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            
                /*
                 *  CONDICIÓN PARA SABER SI EL TEMA YA LO TIENE
                 *  ASIGNADO UN LOGO
                 * 
                 *  SI ES VERDAD, ENTONCES MUESTRA EL LOGO ASIGNADO
                 *  SI ES FALSO, MUESTRA EL LOGO DE WORDPRESS
                 */
                if($image[0]){
                    ?>                
                    background-image: url(<?php echo esc_url($image[0]); ?>) !important;
                    background-size: 200px;
                    background-position: center top;
                    background-repeat: no-repeat;
                    width: 200px;       
                    <?php       
                }
            }?>
        }
        
        body.login div#login form#loginform, form#registerform, form#lostpasswordform {
            margin-top: 20px;
            margin-left: 0;
            /*padding: 26px 50px 46px;*/
            font-weight: 400;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,.04);   
            
            border: none !important;
            padding-bottom: 10px;
        }
        
        body.login div#login form#loginform p {
            margin-bottom: 0;
        }
        
/*        body.login div#login form#loginform p label {
            display: none;
            visibility: hidden;
        }*/

        body.login div#login form#loginform input#user_login, 
        form#registerform input#user_login, 
        form#registerform input#user_email, 
        form#lostpasswordform input#user_login{
            font-size: 15px !important;
            line-height: 1.33333333 !important;
            width: 100% !important;
            margin: 0 6px 16px 0 !important;
            min-height: 40px !important;
            max-height: none !important;
            border: none !important;
            border-radius: 0 !important;
            border-bottom: #a4a7b5 1px solid !important;
            padding: 0 !important;
        }
        body.login div#login form#loginform p input#user_login:focus, 
        form#registerform input#user_login:focus, 
        form#registerform input#user_email:focus, 
        form#lostpasswordform input#user_login:focus {
            outline: 0 none !important;
            border-bottom: #006fff 1px solid !important;
            box-shadow: none;
        }
        
        body.login div#login form#loginform input#user_pass {
            font-size: 15px !important;
            line-height: 1.33333333 !important;
            width: 100% !important;
            margin: 0 6px 16px 0 !important;
            min-height: 40px !important;
            max-height: none !important;
            border: none !important;
            border-radius: 0 !important;
            border-bottom: #a4a7b5 1px solid !important;
            padding: 0 !important;
        }
        body.login div#login form#loginform input#user_pass:focus {
            outline: 0 none !important;
            border-bottom: #006fff 1px solid !important;
            box-shadow: none;
        }
        
        body.login div#login form#loginform button.button-secondary {
            color: #1a73e8;
        }
        
        
    
        body.login div#login form#loginform p.submit input#wp-submit, form#registerform p.submit input#wp-submit, form#lostpasswordform p.submit input#wp-submit {
            /*background-color: #0780F9 !important;*/
            background-color: #1a73e8 !important;
            border: solid 1px #1a73e8 !important;
            float: none !important;
            width: 100%;
            height: 50px;
            font-size: 15px;
            margin-top: 10px;
            border-radius: 6px;
            font-family: Lato, sans-serif;
        }
        body.login div#login form#loginform p.submit input#wp-submit:hover, form#registerform p.submit input#wp-submit:hover, form#lostpasswordform p.submit input#wp-submit:hover {
            background-color: #287ae6 !important;
        }
        body.login div#login form#loginform p.submit input#wp-submit:focus, form#registerform p.submit input#wp-submit:focus, form#lostpasswordform p.submit input#wp-submit:focus {
            box-shadow: none;
        }
        
        body.login div#login p#nav {
            text-align: center;
            padding-bottom: 30px;
        }
        
        body.login div#login p#nav a:hover {
            color: #1a73e8 !important;
        }
        body.login div#login p#nav a:focus {
            box-shadow: none;
        }
        
        
        #login .message{
            box-shadow: none !important;
        }
    
        #login #login_error{
            box-shadow: none !important;
        }
        
    
        #login #backtoblog{
            display: none;
        }
    
    </style>
    <script>
    
    $(document).ready(function(){
        jQuery('form#loginform').append('<p><strong>texto de prueba</strong></p>');
    });
    
    
    </script>
    <?php

    
}
add_action('login_enqueue_scripts', 'wporlogin_page_login');



// define the login_footer callback 
function wporlogin_add_menu_login_footer() { 
    echo '<div><h1>hola como</h1></div>';
}
//add_action( 'login_footer', 'wporlogin_add_menu_login_footer', 10, 2 ); 



///////////////////////////////////////////////////////////////////////////////////////
//    WP LOGIN: CAMBIAR LA URL POR DEFECTO DEL LOGO 
///////////////////////////////////////////////////////////////////////////////////////

function wporlogin_mostrar_ruta_url_logotipo() {
    if(get_option("wporlogin_ruta_url_logotipo")){
        return esc_url(get_option('wporlogin_ruta_url_logotipo'));
    }else{
        return home_url();
    }
}
add_filter('login_headerurl', 'wporlogin_mostrar_ruta_url_logotipo');
 

function wporlogin_mostrar_logotipo_title() {
    if(get_option("wporlogin_titulo_logotipo")){
        return esc_html(get_option('wporlogin_titulo_logotipo'));
    }
}
add_filter('login_headertext', 'wporlogin_mostrar_logotipo_title');