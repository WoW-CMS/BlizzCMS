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
$lang['slides'] = 'Slides';

$lang['general'] = 'General';
$lang['captcha'] = 'Captcha';
$lang['mail_smtp'] = 'Mail SMTP';

$lang['recaptcha'] = 'reCaptcha';
$lang['hcaptcha'] = 'hCaptcha';
$lang['light'] = 'Light';
$lang['dark'] = 'Dark';
$lang['mail'] = 'Mail';
$lang['sendmail'] = 'Sendmail';
$lang['smtp'] = 'SMTP';

$lang['select_theme'] = 'Seleccionar un tema';

$lang['manage_account'] = 'Administrar cuenta';
$lang['update_information'] = 'Actualizar información de la cuenta';
$lang['add_ban'] = 'Add ban';
$lang['view_ban'] = 'View ban';
$lang['create_menu'] = 'Crear menú';
$lang['edit_menu'] = 'Editar menú';
$lang['create_news'] = 'Crear noticia';
$lang['edit_news'] = 'Editar noticia';
$lang['create_page'] = 'Crear página';
$lang['edit_page'] = 'Editar página';
$lang['create_realm'] = 'Crear reino';
$lang['edit_realm'] = 'Editar reino';
$lang['create_slide'] = 'Crear slide';
$lang['edit_slide'] = 'Editar slide';

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
$lang['view'] = 'View';
$lang['logs'] = 'Logs';
$lang['ban_date'] = 'Ban date';
$lang['unban_date'] = 'Unban date';
$lang['ban_by'] = 'Ban by';
$lang['reason'] = 'Razón';
$lang['unban_user'] = 'Unban User';

$lang['count_accounts_created'] = 'Cuentas Creadas';
$lang['count_accounts_banned'] = 'Cuentas Baneadas';
$lang['total_accounts_registered'] = 'Total cuentas registradas.';
$lang['total_accounts_banned'] = 'Total cuentas baneadas.';

$lang['optional_settings'] = 'Configuraciones opcionales';
$lang['option_status'] = 'Estado de la opción';
$lang['social_configuration'] = 'Configuración de redes sociales';
$lang['main_ranks_configuration'] = 'Configuración de rangos principales';
$lang['characters_database'] = 'Characters database';
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
$lang['settings_updated'] = 'Settings data has been updated';
$lang['cache_error'] = 'Unable to delete cache files, please check that you have the necessary permissions on the folder.';
$lang['cache_deleted'] = 'All cache files have been removed';
$lang['module_installed'] = 'The module <b>%1$s</b> has been installed';
$lang['module_uninstalled'] = 'The module <b>%1$s</b> has been uninstalled and its data deleted';
$lang['module_updated'] = 'The module <b>%1$s</b> has been updated';
$lang['module_deleted'] = 'The module folder <b>%1$s</b> has been deleted';
$lang['file_uploaded'] = 'The file has been uploaded and extracted';
$lang['file_name_match'] = 'The file extraction could not be completed because the file name matches the name of a folder in the directory';
$lang['user_updated'] = 'The user has been updated';
$lang['user_banned'] = 'The user has been banned';
$lang['user_unbanned'] = 'The user has been unbanned';
$lang['user_not_found'] = 'The user could not be found';
$lang['user_already_banned'] = 'The user is already banned';
$lang['realm_created'] = 'The new realm has been created';
$lang['realm_updated'] = 'The realm data has been updated';
$lang['realm_deleted'] = 'The realm has been deleted';
$lang['menu_created'] = 'The new menu item has been created';
$lang['menu_updated'] = 'The menu item data has been updated';
$lang['menu_deleted'] = 'The menu item has been deleted';
$lang['news_created'] = 'The new news has been created';
$lang['news_updated'] = 'The news data has been updated';
$lang['news_deleted'] = 'The news has been deleted';
$lang['page_created'] = 'The new page has been created';
$lang['page_updated'] = 'The page data has been updated';
$lang['page_deleted'] = 'The page has been deleted';
$lang['slide_created'] = 'The new slide has been created';
$lang['slide_updated'] = 'The slide data has been updated';
$lang['slide_deleted'] = 'The slide has been deleted';