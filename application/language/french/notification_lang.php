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
$lang['notification_title_success'] = 'Succés';
$lang['notification_title_warning'] = 'Avertissement';
$lang['notification_title_error'] = 'Erreur';
$lang['notification_title_info'] = 'Information';

/*Notification Message (Login/Register) Lang*/
$lang['notification_username_empty'] = 'Le nom d\'utilisateur est vide';
$lang['notification_account_not_created'] = 'Le compte n\'a pas pu être créé. Vérifiez les données et réessayez.';
$lang['notification_email_empty'] = 'L\'e-mail est vide';
$lang['notification_password_empty'] = 'Le mot de passe est vide';
$lang['notification_user_error'] = 'Le pseudo ou mot de passe est incorect. Veuillez réessayer!';
$lang['notification_email_error'] = 'L\'email ou le mot de passe est incorrect. Veuillez réessayer!';
$lang['notification_check_email'] = 'Le nom d\'utilisateur ou l\'e-mail est incorrect. Veuillez réessayer!';
$lang['notification_checking'] = 'Vérification...';
$lang['notification_redirection'] = 'Connexion à votre compte...';
$lang['notification_new_account'] = 'Nouveau compte créé. redirection vers la connexion...';
$lang['notification_email_sent'] = 'Email envoyé. Merci de consulter vos emails...';
$lang['notification_account_activation'] = 'Email envoyé. s\'il vous plaît vérifier votre email pour activer votre compte.';
$lang['notification_captcha_error'] = 'Veuillez vérifier le captcha';
$lang['notification_password_lenght_error'] = 'Longueur de mot de passe incorrecte. veuillez utiliser un mot de passe entre 5 et 16 caractères';
$lang['notification_account_already_exist'] = 'Ce compte existe déjà';
$lang['notification_password_not_match'] = 'Les mots de passe ne correspondent pas';
$lang['notification_same_password'] = 'Les mot de passes correspondent.';
$lang['notification_currentpass_not_match'] = 'L\'ancien mot de passe ne correspond pas';
$lang['notification_usernamepass_not_match'] = 'Le mot de passe ne correspond pas à ce nom d\'utilisateur';
$lang['notification_used_email'] = 'Email en cours d\'utilisation';
$lang['notification_email_not_match'] = 'L\'e-mail ne correspond pas';
$lang['notification_username_not_match'] = 'Le nom d\'utilisateur ne correspond pas';
$lang['notification_expansion_not_found'] = 'Extension introuvable';
$lang['notification_valid_key'] = 'Compte activé';
$lang['notification_valid_key_desc'] = 'Vous pouvez maintenant vous connecter avec votre compte.';
$lang['notification_invalid_key'] = 'La clé d\'activation fournie n\'est pas valide.';

/*Notification Message (General) Lang*/
$lang['notification_email_changed'] = 'L\'e-mail a été modifié.';
$lang['notification_username_changed'] = 'Le nom d\'utilisateur a été modifié.';
$lang['notification_password_changed'] = 'Le mot de passe a été modifié.';
$lang['notification_avatar_changed'] = 'L\'avatar a été modifié.';
$lang['notification_wrong_values'] = 'Les valeurs sont fausses';
$lang['notification_select_type'] = 'Sélectionnez un type';
$lang['notification_select_priority'] = 'Sélectionnez une priorité';
$lang['notification_select_category'] = 'Choisir une catégorie';
$lang['notification_select_realm'] = 'Sélectionnez un royaume';
$lang['notification_select_character'] = 'Sélectionnez un personnage';
$lang['notification_select_item'] = 'Sélectionnez un élément';
$lang['notification_report_created'] = 'Le rapport a été créé.';
$lang['notification_title_empty'] = 'Le titre est vide';
$lang['notification_description_empty'] = 'La description est vide';
$lang['notification_name_empty'] = 'Le nom est vide';
$lang['notification_id_empty'] = 'L\'identifiant est vide';
$lang['notification_reply_empty'] = 'La réponse est vide';
$lang['notification_reply_created'] = 'La réponse a été envoyée.';
$lang['notification_reply_deleted'] = 'La réponse a été supprimée.';
$lang['notification_topic_created'] = 'Le sujet a été créé.';
$lang['notification_donation_successful'] = 'Le don a été effectué avec succès, vérifiez vos points donateurs dans votre compte.';
$lang['notification_donation_canceled'] = 'Le don a été annulé.';
$lang['notification_donation_error'] = 'Les informations fournies dans la transaction ne correspondent pas.';
$lang['notification_store_chars_error'] = 'Sélectionnez votre personnage dans chaque élément.';
$lang['notification_store_item_insufficient_points'] = 'Vous n\'avez pas assez de points pour finaliser l\'achat.';
$lang['notification_store_item_purchased'] = 'Les objets ont été achetés, veuillez vérifier votre courrier dans le jeu.';
$lang['notification_store_item_added'] = 'L\'item sélectionné a été ajouté à votre panier.';
$lang['notification_store_item_removed'] = 'L\'item sélectionné a été supprimé de votre panier.';
$lang['notification_store_cart_error'] = 'La mise à jour du panier a échoué, veuillez réessayer.';

/*Notification Message (Admin) Lang*/
$lang['notification_changelog_created'] = 'Le changelog a été créé.';
$lang['notification_changelog_edited'] = 'Le changelog a été édité.';
$lang['notification_changelog_deleted'] = 'Le changelog a été supprimé.';
$lang['notification_forum_created'] = 'Le forum a été créé.';
$lang['notification_forum_edited'] = 'Le forum a été modifié.';
$lang['notification_forum_deleted'] = 'Le forum a été supprimé.';
$lang['notification_category_created'] = 'La catégorie a été créée.';
$lang['notification_category_edited'] = 'La catégorie a été modifiée.';
$lang['notification_category_deleted'] = 'La catégorie a été supprimée.';
$lang['notification_menu_created'] = 'Le menu a été créé.';
$lang['notification_menu_edited'] = 'Le menu a été modifié.';
$lang['notification_menu_deleted'] = 'Le menu a été supprimé.';
$lang['notification_news_deleted'] = 'L\'actualité a été supprimée.';
$lang['notification_page_created'] = 'La page a été créée.';
$lang['notification_page_edited'] = 'La page a été modifiée.';
$lang['notification_page_deleted'] = 'La page a été supprimée.';
$lang['notification_realm_created'] = 'Le royaume a été créé.';
$lang['notification_realm_edited'] = 'Le royaume a été modifié.';
$lang['notification_realm_deleted'] = 'Le royaume a été supprimé.';
$lang['notification_slide_created'] = 'Le slide a été créée.';
$lang['notification_slide_edited'] = 'Le slide a été modifié.';
$lang['notification_slide_deleted'] = 'Le slide a été supprimé.';
$lang['notification_item_created'] = 'L\'item a été créée.';
$lang['notification_item_edited'] = 'L\'item a été modifié.';
$lang['notification_item_deleted'] = 'L\'item a été supprimé';
$lang['notification_top_created'] = 'Le top item a été créée';
$lang['notification_top_edited'] = 'Le top item a été modifié';
$lang['notification_top_deleted'] = 'Le top item a été supprimé.';
$lang['notification_topsite_created'] = 'Le topsite a été créée';
$lang['notification_topsite_edited'] = 'Le topsite a été modifié';
$lang['notification_topsite_deleted'] = 'Le topsite a été supprimé';

$lang['notification_settings_updated'] = 'Les paramètres ont été mis à jour.';
$lang['notification_module_enabled'] = 'Le module a été activé.';
$lang['notification_module_disabled'] = 'Le module a été désactivé.';
$lang['notification_migration'] = 'Les paramètres ont été définis.';

$lang['notification_donation_added'] = 'Don ajouté';
$lang['notification_donation_deleted'] = 'Don supprimé';
$lang['notification_donation_updated'] = 'Don mis à jour';
$lang['notification_points_empty'] = 'Points est vide';
$lang['notification_tax_empty'] = 'La taxe est vide';
$lang['notification_price_empty'] = 'Le prix est vide';
$lang['notification_incorrect_update'] = 'Mise à jour inattendue';

$lang['notification_route_inuse'] = 'La route est déjà utilisé, veuillez en choisir un autre.';

$lang['notification_account_updated'] = 'Le compte a été mis à jour.';
$lang['notification_dp_vp_empty'] = 'DP/VP est vide';
$lang['notification_account_banned'] = 'Le compte a été banni.';
$lang['notification_reason_empty'] = 'La raison est vide';
$lang['notification_account_ban_remove'] = 'Le ban du compte a été supprimée.';
$lang['notification_rank_empty'] = 'Le rang est vide';
$lang['notification_rank_granted'] = 'Le rang a été accordé.';
$lang['notification_rank_removed'] = 'Le rang a été supprimé.';

$lang['notification_cms_updated'] = 'Le CMS a été mis à jour';
$lang['notification_cms_update_error'] = 'Le CMS n\'a pas pu être mis à jour';
$lang['notification_cms_not_updated'] = 'Une nouvelle version n\'a pas été trouvée pour la mise à jour';
$lang['notification_select_category'] = 'Ce n\'est pas une sous-catégorie';
?>
