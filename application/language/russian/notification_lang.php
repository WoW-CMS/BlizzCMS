<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * BlizzCMS
 *
 * An Open Source CMS for "World of Warcraft"
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017 - 2023, WoW-CMS
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
 * @translator IkuSenpai
 * @copyright  Copyright (c) 2017 - 2023, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 * @since   Version 1.0.1
 * @filesource
 */

/*Уведомления (Заголовок) Язык*/
$lang['notification_title_success'] = 'Успешно';
$lang['notification_title_warning'] = 'Предупреждение';
$lang['notification_title_error'] = 'Ошибка';
$lang['notification_title_info'] = 'Информация';

/*Уведомления (Логин/Регистрация) Язык*/
$lang['notification_username_empty'] = 'Имя пользователя пустое';
$lang['notification_account_not_created'] = 'Учетная запись не может быть создана. Проверьте данные и повторите попытку.';
$lang['notification_email_empty'] = 'Email пуст';
$lang['notification_password_empty'] = 'Пароль пуст';
$lang['notification_user_error'] = 'Имя пользователя или пароль неверны. Пожалуйста, попробуйте снова!';
$lang['notification_email_error'] = 'Email или пароль неверны. Пожалуйста, попробуйте снова!';
$lang['notification_check_email'] = 'Имя пользователя или email неверны. Пожалуйста, попробуйте снова!';
$lang['notification_checking'] = 'Проверка...';
$lang['notification_redirection'] = 'Подключение к вашей учетной записи...';
$lang['notification_new_account'] = 'Создана новая учетная запись. Перенаправление на страницу входа...';
$lang['notification_email_sent'] = 'Email отправлен. Пожалуйста, проверьте свою почту...';
$lang['notification_account_activation'] = 'Email отправлен. Пожалуйста, проверьте свою почту, чтобы активировать вашу учетную запись.';
$lang['notification_captcha_error'] = 'Пожалуйста, проверьте капчу';
$lang['notification_password_length_error'] = 'Неверная длина пароля. Пожалуйста, используйте пароль от 5 до 16 символов';
$lang['notification_account_already_exist'] = 'Эта учетная запись уже существует';
$lang['notification_password_not_match'] = 'Пароли не совпадают';
$lang['notification_same_password'] = 'Пароль совпадает с текущим.';
$lang['notification_currentpass_not_match'] = 'Старый пароль не совпадает';
$lang['notification_usernamepass_not_match'] = 'Пароль не совпадает с этим именем пользователя';
$lang['notification_used_email'] = 'Email уже используется';
$lang['notification_email_not_match'] = 'Email не совпадает';
$lang['notification_username_not_match'] = 'Имя пользователя не совпадает';
$lang['notification_expansion_not_found'] = 'Расширение не найдено';
$lang['notification_valid_key'] = 'Аккаунт активирован';
$lang['notification_valid_key_desc'] = 'Теперь вы можете войти в свою учетную запись.';
$lang['notification_invalid_key'] = 'Предоставленный ключ активации недействителен.';

/*Уведомления (Общие) Язык*/
$lang['notification_email_changed'] = 'Email был изменен.';
$lang['notification_username_changed'] = 'Имя пользователя было изменено.';
$lang['notification_password_changed'] = 'Пароль был изменен.';
$lang['notification_avatar_changed'] = 'Аватар был изменен.';
$lang['notification_wrong_values'] = 'Неверные значения';
$lang['notification_select_type'] = 'Выберите тип';
$lang['notification_select_priority'] = 'Выберите приоритет';
$lang['notification_select_category'] = 'Выберите категорию';
$lang['notification_select_realm'] = 'Выберите мир';
$lang['notification_select_character'] = 'Выберите персонажа';
$lang['notification_select_item'] = 'Выберите предмет';
$lang['notification_report_created'] = 'Отчет был создан.';
$lang['notification_title_empty'] = 'Заголовок пуст';
$lang['notification_description_empty'] = 'Описание пусто';
$lang['notification_name_empty'] = 'Имя пусто';
$lang['notification_id_empty'] = 'ID пуст';
$lang['notification_reply_empty'] = 'Ответ пуст';
$lang['notification_reply_created'] = 'Ответ отправлен.';
$lang['notification_reply_deleted'] = 'Ответ удален.';
$lang['notification_topic_created'] = 'Тема была создана.';
$lang['notification_donation_successful'] = 'Пожертвование успешно выполнено, проверьте ваши донорские очки в своей учетной записи.';
$lang['notification_donation_canceled'] = 'Пожертвование отменено.';
$lang['notification_donation_error'] = 'Информация, предоставленная в транзакции, не соответствует.';
$lang['notification_store_chars_error'] = 'Выберите своего персонажа для каждого предмета.';
$lang['notification_store_item_insufficient_points'] = 'У вас недостаточно очков для покупки.';
$lang['notification_store_item_purchased'] = 'Предметы были куплены, проверьте свою почту в игре.';
$lang['notification_store_item_added'] = 'Выбранный предмет добавлен в вашу корзину.';
$lang['notification_store_item_removed'] = 'Выбранный предмет удален из вашей корзины.';
$lang['notification_store_cart_error'] = 'Обновление корзины не удалось, попробуйте снова.';

/*Уведомления (Админ) Язык*/
$lang['notification_changelog_created'] = 'Создан журнал изменений.';
$lang['notification_changelog_edited'] = 'Журнал изменений отредактирован.';
$lang['notification_changelog_deleted'] = 'Журнал изменений удален.';
$lang['notification_forum_created'] = 'Форум создан.';
$lang['notification_forum_edited'] = 'Форум отредактирован.';
$lang['notification_forum_deleted'] = 'Форум удален.';
$lang['notification_category_created'] = 'Категория создана.';
$lang['notification_category_edited'] = 'Категория отредактирована.';
$lang['notification_category_deleted'] = 'Категория удалена.';
$lang['notification_menu_created'] = 'Меню создано.';
$lang['notification_menu_edited'] = 'Меню отредактировано.';
$lang['notification_menu_deleted'] = 'Меню удалено.';
$lang['notification_news_deleted'] = 'Новости удалены.';
$lang['notification_page_created'] = 'Страница создана.';
$lang['notification_page_edited'] = 'Страница отредактирована.';
$lang['notification_page_deleted'] = 'Страница удалена.';
$lang['notification_realm_created'] = 'Мир создан.';
$lang['notification_realm_edited'] = 'Мир отредактирован.';
$lang['notification_realm_deleted'] = 'Мир удален.';
$lang['notification_slide_created'] = 'Слайд создан.';
$lang['notification_slide_edited'] = 'Слайд отредактирован.';
$lang['notification_slide_deleted'] = 'Слайд удален.';
$lang['notification_item_created'] = 'Предмет создан.';
$lang['notification_item_edited'] = 'Предмет отредактирован.';
$lang['notification_item_deleted'] = 'Предмет удален.';
$lang['notification_top_created'] = 'Лучший предмет создан.';
$lang['notification_top_edited'] = 'Лучший предмет отредактирован.';
$lang['notification_top_deleted'] = 'Лучший предмет удален.';
$lang['notification_topsite_created'] = 'Лучший сайт создан.';
$lang['notification_topsite_edited'] = 'Лучший сайт отредактирован.';
$lang['notification_topsite_deleted'] = 'Лучший сайт удален.';

$lang['notification_settings_updated'] = 'Настройки обновлены.';
$lang['notification_module_enabled'] = 'Модуль включен.';
$lang['notification_module_disabled'] = 'Модуль отключен.';
$lang['notification_migration'] = 'Настройки установлены.';

$lang['notification_donation_added'] = 'Добавлено пожертвование';
$lang['notification_donation_deleted'] = 'Удалено пожертвование';
$lang['notification_donation_updated'] = 'Обновлено пожертвование';
$lang['notification_points_empty'] = 'Пункты пусты';
$lang['notification_tax_empty'] = 'Налог пуст';
$lang['notification_price_empty'] = 'Цена пуста';
$lang['notification_incorrect_update'] = 'Неожиданное обновление';

$lang['notification_route_inuse'] = 'Маршрут уже используется, выберите другой.';

$lang['notification_account_updated'] = 'Учетная запись обновлена.';
$lang['notification_dp_vp_empty'] = 'DP/VP пусты';
$lang['notification_account_banned'] = 'Учетная запись заблокирована.';
$lang['notification_reason_empty'] = 'Причина пуста';
$lang['notification_account_ban_remove'] = 'Блокировка учетной записи была удалена.';
$lang['notification_rank_empty'] = 'Ранг пуст';
$lang['notification_rank_granted'] = 'Ранг присвоен.';
$lang['notification_rank_removed'] = 'Ранг удален.';

$lang['notification_cms_updated'] = 'CMS обновлена';
$lang['notification_cms_update_error'] = 'Не удалось обновить CMS';
$lang['notification_cms_not_updated'] = 'Новая версия не найдена для обновления';

$lang['notification_select_category'] = 'Это не подкатегория';
$lang['notification_delete_comment_error'] = 'Не удалось удалить комментарий.';