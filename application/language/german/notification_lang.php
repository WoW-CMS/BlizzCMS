<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * BlizzCMS
 *
 * An Open Source CMS for "World of Warcraft"
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017 - 2019, WoW-CMS
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author  WoW-CMS
 * @copyright  Copyright (c) 2017 - 2019, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 * @since   Version 1.0.1
 * @filesource
 */

/*Notification Title Lang*/
$lang['notification_title_success'] = 'Erfolgreich';
$lang['notification_title_warning'] = 'Warnung';
$lang['notification_title_error'] = 'Fehler';
$lang['notification_title_info'] = 'Information';

/*Notification Message (Login/Register) Lang*/
$lang['notification_username_empty'] = 'Benutzername nicht ausgefüllt';
$lang['notification_email_empty'] = 'Email nicht ausgefüllt';
$lang['notification_password_empty'] = 'Passwort nicht ausgefüllt';
$lang['notification_user_error'] = 'Benutzername oder Passwort falsch. Bitte versuch es erneut!';
$lang['notification_email_error'] = 'Email oder Passwort falsch. Bitte versuch es erneut!';
$lang['notification_check_email'] = 'Benutzername oder Email falsch. Bitte versuch es erneut!';
$lang['notification_checking'] = 'Überprüfe...';
$lang['notification_redirection'] = 'Verbinde zu deinem Account...';
$lang['notification_new_account'] = 'Neuer Account erstellt. Leite zum Anmelden weiter...';
$lang['notification_email_sent'] = 'Email gesendet. Bitte überprüfe deine Mails...';
$lang['notification_account_activation'] = 'Email gesendet. Bitte überprüfe deine Mail um dein Account zu aktievieren.';
$lang['notification_captcha_error'] = 'Bitte überprüfe den captcha';
$lang['notification_password_lenght_error'] = 'Falsche Passwort länge. Bitte nutze ein Passwort zwischen 5 und 16 Zeichen';
$lang['notification_account_already_exist'] = 'Dieser Account existiert bereits';
$lang['notification_password_not_match'] = 'Passwörter stimmen nicht überein';
$lang['notification_same_password'] = 'Das Passwort ist das gleiche.';
$lang['notification_currentpass_not_match'] = 'Altes Passwort falsch';
$lang['notification_usernamepass_not_match'] = 'Dieses passwort stimmt nicht mit dem Benutzernamen überein';
$lang['notification_used_email'] = 'Email wird bereits verwendet';
$lang['notification_email_not_match'] = 'Emails stimmen nicht überein';
$lang['notification_username_not_match'] = 'Benutzername falsch';
$lang['notification_expansion_not_found'] = 'Erweiterung nicht gefunden';
$lang['notification_valid_key'] = 'Account Aktiviert';
$lang['notification_valid_key_desc'] = 'Du kannst dich nun mit deinem Account anmelden.';
$lang['notification_invalid_key'] = 'Der Aktivierungs Schlüssel ist falsch.';

/*Notification Message (General) Lang*/
$lang['notification_email_changed'] = 'Deine Email wurde geändert.';
$lang['notification_username_changed'] = 'Deine Benutzername wurde geändert.';
$lang['notification_password_changed'] = 'Deine Passwort wurde geändert.';
$lang['notification_avatar_changed'] = 'Deine Avater wurde geändert.';
$lang['notification_wrong_values'] = 'Die Daten sind falsch';
$lang['notification_select_type'] = 'Wähle einen Typen';
$lang['notification_select_priority'] = 'Wähle eine Priorität';
$lang['notification_select_category'] = 'Wähle eine Kategorie';
$lang['notification_select_realm'] = 'Wähle einen Realm';
$lang['notification_select_character'] = 'Wähle einen Charakter';
$lang['notification_select_item'] = 'Wähle ein Item';
$lang['notification_report_created'] = 'Dein Report wurde erstellt.';
$lang['notification_title_empty'] = 'Titel ist nicht ausgefüllt';
$lang['notification_description_empty'] = 'Beschreibung ist nicht ausgefüllt';
$lang['notification_name_empty'] = 'Name ist nicht ausgefüllt';
$lang['notification_id_empty'] = 'Id ist nicht ausgefüllt';
$lang['notification_reply_empty'] = 'Antwort ist nicht ausgefüllt';
$lang['notification_reply_created'] = 'Antwort wurde gesendet.';
$lang['notification_reply_deleted'] = 'antwort wurde gelöscht.';
$lang['notification_topic_created'] = 'Das Thema wurde erstellt.';
$lang['notification_donation_successful'] = 'Die spende war erfolgreich. Bitte überprüfe deine Spenden Punkte.';
$lang['notification_donation_canceled'] = 'Die Spende wurde abgebrochen.';
$lang['notification_donation_error'] = 'Die Informationen in der Transaktion stimmen nicht überein.';
$lang['notification_store_chars_error'] = 'Bitte wähle dein Charakter für jedes Item.';
$lang['notification_store_item_insufficient_points'] = 'Dafür hast du nicht genug Punkte.';
$lang['notification_store_item_purchased'] = 'Das Item wurde gekauft, bitte überprüfe deine Post In-Game.';
$lang['notification_store_item_added'] = 'Das gewählte Item wurde deinem Einkaufswagen hinzugefügt.';
$lang['notification_store_item_removed'] = 'Das gewählte Item wurde aus deinem Einkaufswagen entfernt.';
$lang['notification_store_cart_error'] = 'Die aktuallisierung des Einkaufswagens ist fehlgeschlagen, bitte versuche es erneut.';

/*Notification Message (Admin) Lang*/
$lang['notification_changelog_created'] = 'Der changelog wurde erstellt.';
$lang['notification_changelog_edited'] = 'Der changelog wurde bearbeitet.';
$lang['notification_changelog_deleted'] = 'Der changelog wurde gelöscht.';
$lang['notification_forum_created'] = 'Das Forum wurde erstellt.';
$lang['notification_forum_edited'] = 'Das Forum wurde bearbeitet.';
$lang['notification_forum_deleted'] = 'Das Forum wurde gelöscht.';
$lang['notification_category_created'] = 'The category wurde erstellt.';
$lang['notification_category_edited'] = 'The category wurde bearbeitet.';
$lang['notification_category_deleted'] = 'The category wurde gelöscht.';
$lang['notification_menu_created'] = 'Das Menü wurde erstellt.';
$lang['notification_menu_edited'] = 'Das Menü wurde bearbeitet.';
$lang['notification_menu_deleted'] = 'Das Menü wurde gelöscht.';
$lang['notification_news_deleted'] = 'Die Neuigkeit wurde gelöscht.';
$lang['notification_page_created'] = 'Die Seite wurde erstellt.';
$lang['notification_page_edited'] = 'Die Seite wurde bearbeitet.';
$lang['notification_page_deleted'] = 'Die Seite wurde gelöscht.';
$lang['notification_realm_created'] = 'Der Realm wurde erstellt.';
$lang['notification_realm_edited'] = 'Der Realm wurde bearbeitet.';
$lang['notification_realm_deleted'] = 'Der Realm wurde gelöscht.';
$lang['notification_slide_created'] = 'Der Slide wurde erstellt.';
$lang['notification_slide_edited'] = 'Der Slide wurde bearbeitet.';
$lang['notification_slide_deleted'] = 'Der Slide wurde gelöscht.';
$lang['notification_item_created'] = 'Das Item wurde erstellt.';
$lang['notification_item_edited'] = 'Das Item wurde bearbeitet.';
$lang['notification_item_deleted'] = 'Das Item wurde gelöscht.';
$lang['notification_top_created'] = 'Das Top Item wurde erstellt.';
$lang['notification_top_edited'] = 'Das Top Item wurde bearbeitet.';
$lang['notification_top_deleted'] = 'Das Top Item wurde gelöscht.';
$lang['notification_topsite_created'] = 'Die Topseite wurde erstellt.';
$lang['notification_topsite_edited'] = 'Die Topseite wurde bearbeitet.';
$lang['notification_topsite_deleted'] = 'Die Topseite wurde gelöscht.';

$lang['notification_settings_updated'] = 'Die Einstellungen wurden aktuallisiert.';
$lang['notification_module_enabled'] = 'Das Modul wurde aktiviert.';
$lang['notification_module_disabled'] = 'Das Modul wurde deaktiviert.';
$lang['notification_migration'] = 'Die Einstellungen wurden gesetzt.';

$lang['notification_donation_added'] = 'Spende hinzugefügt';
$lang['notification_donation_deleted'] = 'Spende gelöscht';
$lang['notification_donation_updated'] = 'Spende aktualisiert';
$lang['notification_points_empty'] = 'Punkte sind leer';
$lang['notification_tax_empty'] = 'Steuern sind leer';
$lang['notification_price_empty'] = 'Preis ist leer';
$lang['notification_incorrect_update'] = 'Unerwartete aktualisierung';

$lang['notification_route_inuse'] = 'The route is already in use please choose another one.';

$lang['notification_account_updated'] = 'Der account wurde aktualisiert.';
$lang['notification_dp_vp_empty'] = 'DP/VP ist leer';
$lang['notification_account_banned'] = 'Der account wurde gebannt.';
$lang['notification_reason_empty'] = 'Grund ist leer';
$lang['notification_account_ban_remove'] = 'Der bann von dem Account wurde entfernt.';
$lang['notification_rank_empty'] = 'Rang ist leer';
$lang['notification_rank_granted'] = 'Der Rang wurde hinzugefügt.';
$lang['notification_rank_removed'] = 'Der Rang wurde gelöscht.';

$lang['notification_cms_updated'] = 'Das CMS wurde aktualisiert';
$lang['notification_cms_update_error'] = 'Das CMS ckonnte nicht aktualisiert werden';
$lang['notification_cms_not_updated'] = 'Es wurde keine neue Version gefunden';

$lang['notification_select_category'] = 'Das ist keine Unterkategorie';