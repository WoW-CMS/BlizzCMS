<?php
/**
 * BlizzCMS
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2021, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['dashboard'] = 'Panel';
$lang['settings'] = 'Ajustes';
$lang['system'] = 'Sistema';
$lang['modules'] = 'Módulos';
$lang['realms'] = 'Reinos';
$lang['users'] = 'Usuarios';
$lang['all_users'] = 'Todos los usuarios';
$lang['banned_users'] = 'Usuarios baneados';
$lang['sections'] = 'Secciones';
$lang['pages'] = 'Páginas';
$lang['slides'] = 'Diapositivas';

$lang['general'] = 'General';
$lang['mail_smtp'] = 'Mail SMTP';

$lang['recaptcha'] = 'reCaptcha';
$lang['hcaptcha'] = 'hCaptcha';
$lang['light'] = 'Claro';
$lang['dark'] = 'Oscuro';
$lang['mail'] = 'Mail';
$lang['sendmail'] = 'Sendmail';
$lang['smtp'] = 'SMTP';

$lang['select_theme'] = 'Seleccionar un tema';

$lang['manage_account'] = 'Administrar cuenta';
$lang['update_information'] = 'Actualizar información de la cuenta';
$lang['add_ban'] = 'Agregar ban';
$lang['view_ban'] = 'Ver ban';
$lang['create_menu'] = 'Crear menú';
$lang['edit_menu'] = 'Editar menú';
$lang['create_news'] = 'Crear noticia';
$lang['edit_news'] = 'Editar noticia';
$lang['create_page'] = 'Crear página';
$lang['edit_page'] = 'Editar página';
$lang['create_realm'] = 'Crear reino';
$lang['edit_realm'] = 'Editar reino';
$lang['create_slide'] = 'Crear diapositiva';
$lang['edit_slide'] = 'Editar diapositiva';

$lang['discord_server'] = 'Discord (ID servidor)';
$lang['theme'] = 'Tema';
$lang['facebook_url'] = 'Facebook URL';
$lang['twitter_url'] = 'Twitter URL';
$lang['youtube_url'] = 'Youtube URL';
$lang['secret_password'] = 'Contraseña secreta';
$lang['admin_access_level'] = 'GMLevel para rango de administrador';
$lang['mod_access_level'] = 'GMLevel para rango de moderador';
$lang['sender'] = 'Remitente';
$lang['public_key'] = 'Llave pública';
$lang['private_key'] = 'Llave privada';
$lang['empty_now'] = 'Vaciar ahora';
$lang['check_soap'] = 'Comprobar SOAP';
$lang['view'] = 'Ver';
$lang['logs'] = 'Registros';
$lang['ban_date'] = 'Fecha de baneo';
$lang['unban_date'] = 'Fecha de desbaneo';
$lang['banned_by'] = 'Baneado por';
$lang['reason'] = 'Razón';
$lang['unban_user'] = 'Desbanear usuario';

$lang['count_accounts_created'] = 'Cuentas Creadas';
$lang['count_accounts_banned'] = 'Cuentas Baneadas';
$lang['total_accounts_registered'] = 'Total cuentas registradas.';
$lang['total_accounts_banned'] = 'Total cuentas baneadas.';

$lang['optional_settings'] = 'Configuraciones opcionales';
$lang['option_status'] = 'Estado de la opción';
$lang['social_configuration'] = 'Configuración de redes sociales';
$lang['main_ranks_configuration'] = 'Configuración de rangos principales';
$lang['characters_database'] = 'Base de datos de personajes';
$lang['soap_configuration'] = 'Configuración SOAP';
$lang['check_realm_status'] = 'Verificar el estado del reino';
$lang['captcha_on_pages'] = 'Captcha en las páginas';
$lang['enable_captcha_login'] = '¿Habilitar captcha en la página de inicio de sesión?';
$lang['enable_captcha_register'] = '¿Habilitar captcha en la página de registro?';
$lang['enable_captcha_forgot'] = '¿Habilitar captcha en la página de contraseña olvidada?';
$lang['register_validation'] = 'Validación de registro';
$lang['enable_register_validation'] = '¿Habilitar la validación del registro?';
$lang['cache'] = 'Cache';
$lang['cache_info'] = 'Borrar todos los archivos de caché relacionados con este sitio.<br><span class="uk-text-bold uk-text-danger">Advertencia:</span> ¡La primera carga del sitio web puede ser lenta!';
$lang['sessions'] = 'Sesiones';
$lang['sessions_info'] = 'Borrar los datos de las sesiones almacenados en el sitio.<br><span class="uk-text-bold uk-text-danger">Advertencia:</span> ¡Se desconectará después de realizar esta acción!';
$lang['enable_news_comments'] = '¿Permitir comentarios en las noticias?';
$lang['attach_zip_file'] = 'Adjunte un archivo zip colocándolos aquí o';
$lang['selecting_one'] = 'seleccionando uno';

/**
 * Alerts
*/
$lang['settings_updated'] = 'Se actualizaron los datos de configuración';
$lang['cache_error'] = 'Los archivos de caché no se pudieron eliminar. por favor verifique que tiene los permisos necesarios en la carpeta';
$lang['cache_deleted'] = 'Todos los archivos de caché han sido eliminados';
$lang['module_installed'] = 'El módulo <b>%1$s</b> ha sido instalado';
$lang['module_uninstalled'] = 'El módulo <b>%1$s</b> ha sido desinstalado y sus datos eliminados';
$lang['module_updated'] = 'El módulo <b>%1$s</b> ha sido actualizado';
$lang['module_deleted'] = 'La carpeta del módulo <b>%1$s</b> ha sido eliminada';
$lang['file_uploaded'] = 'El archivo ha sido subido y extraído';
$lang['file_name_match'] = 'La extracción del archivo no se pudo completar porque el nombre del archivo coincide con el nombre de una carpeta en el directorio';
$lang['user_updated'] = 'El usuario ha sido actualizado';
$lang['user_banned'] = 'El usuario ha sido baneado';
$lang['user_unbanned'] = 'El usuario ha sido desbaneado';
$lang['user_not_found'] = 'El usuario no pudo ser encontrado';
$lang['user_already_banned'] = 'El usuario ya está baneado';
$lang['realm_created'] = 'El nuevo reino ha sido creado';
$lang['realm_updated'] = 'Los datos del reino se han actualizado';
$lang['realm_deleted'] = 'El reino ha sido eliminado';
$lang['menu_created'] = 'El nuevo elemento del menú ha sido creado';
$lang['menu_updated'] = 'Los datos del elemento del menú se han actualizado';
$lang['menu_deleted'] = 'El elemento del menú ha sido eliminado';
$lang['news_created'] = 'La nueva noticia ha sido creada';
$lang['news_updated'] = 'Los datos de la noticia se han actualizado';
$lang['news_deleted'] = 'La noticia ha sido eliminada';
$lang['page_created'] = 'La nueva página ha sido creada';
$lang['page_updated'] = 'Los datos de la página se han actualizado';
$lang['page_deleted'] = 'La página ha sido eliminada';
$lang['slide_created'] = 'La nueva diapositiva ha sido creada';
$lang['slide_updated'] = 'Los datos de la diapositiva se han actualizado';
$lang['slide_deleted'] = 'La diapositiva ha sido eliminada';