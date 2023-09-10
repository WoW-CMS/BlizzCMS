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
 * @Translator IkuSenpai
 * @copyright  Copyright (c) 2017 - 2023, WoW-CMS.
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://wow-cms.com
 * @since   Version 1.0.1
 * @filesource
 */

/*通知标题语言*/
$lang['notification_title_success'] = '成功';
$lang['notification_title_warning'] = '警告';
$lang['notification_title_error'] = '错误';
$lang['notification_title_info'] = '信息';

/*通知消息（登录/注册）语言*/
$lang['notification_username_empty'] = '用户名为空。';
$lang['notification_account_not_created'] = '无法创建帐户。请检查数据并重试。';
$lang['notification_email_empty'] = '电子邮件为空。';
$lang['notification_password_empty'] = '密码为空。';
$lang['notification_user_error'] = '用户名或密码不正确，请重试！';
$lang['notification_email_error'] = '电子邮件或密码不正确，请重试！';
$lang['notification_check_email'] = '用户名或电子邮件不正确，请重试！';
$lang['notification_checking'] = '正在检查。。。';
$lang['notification_redirection'] = '连接到您的帐户。。。';
$lang['notification_new_account'] = '新帐户已创建。正在重定向到登录页面。。。';
$lang['notification_email_sent'] = '电子邮件已发送，请检查您的电子邮件。。。';
$lang['notification_account_activation'] = '电子邮件已发送，请检查您的电子邮件以激活您的帐户。';
$lang['notification_captcha_error'] = '请检查验证码。';
$lang['notification_password_length_error'] = '密码长度错误。请使用5到16个字符的密码。';
$lang['notification_account_already_exist'] = '此帐户已存在。';
$lang['notification_password_not_match'] = '密码不匹配。';
$lang['notification_same_password'] = '密码相同。';
$lang['notification_currentpass_not_match'] = '旧密码不匹配。';
$lang['notification_usernamepass_not_match'] = '此用户名的密码不匹配。';
$lang['notification_used_email'] = '电子邮件已在使用中。';
$lang['notification_email_not_match'] = '电子邮件不匹配。';
$lang['notification_username_not_match'] = '用户名不匹配。';
$lang['notification_expansion_not_found'] = '未找到扩展。';
$lang['notification_valid_key'] = '帐户已激活。';
$lang['notification_valid_key_desc'] = '现在您可以使用您的帐户登录。';
$lang['notification_invalid_key'] = '提供的激活密钥无效。';

/*通知消息（常规）语言*/
$lang['notification_email_changed'] = '电子邮件已更改。';
$lang['notification_username_changed'] = '用户名已更改。';
$lang['notification_password_changed'] = '密码已更改。';
$lang['notification_avatar_changed'] = '头像已更改。';
$lang['notification_wrong_values'] = '值不正确。';
$lang['notification_select_type'] = '选择类型。';
$lang['notification_select_priority'] = '选择优先级。';
$lang['notification_select_category'] = '选择类别。';
$lang['notification_select_realm'] = '选择领域。';
$lang['notification_select_character'] = '选择角色。';
$lang['notification_select_item'] = '选择物品。';
$lang['notification_report_created'] = '报告已创建。';
$lang['notification_title_empty'] = '标题为空。';
$lang['notification_description_empty'] = '描述为空。';
$lang['notification_name_empty'] = '名称为空。';
$lang['notification_id_empty'] = 'ID为空。';
$lang['notification_reply_empty'] = '回复为空。';
$lang['notification_reply_created'] = '回复已发送。';
$lang['notification_reply_deleted'] = '回复已删除。';
$lang['notification_topic_created'] = '主题已创建。';
$lang['notification_donation_successful'] = '捐赠已成功完成，请检查您的帐户中的捐赠点数。';
$lang['notification_donation_canceled'] = '捐赠已取消。';
$lang['notification_donation_error'] = '交易中提供的信息不匹配。';
$lang['notification_store_chars_error'] = '在每个物品中选择您的角色。';
$lang['notification_store_item_insufficient_points'] = '您没有足够的点数购买。';
$lang['notification_store_item_purchased'] = '物品已购买，请在游戏内的邮件中查看。';
$lang['notification_store_item_added'] = '所选物品已添加到购物车。';
$lang['notification_store_item_removed'] = '所选物品已从购物车中移除。';
$lang['notification_store_cart_error'] = '购物车更新失败，请重试。';

/*通知消息（管理员）语言*/
$lang['notification_changelog_created'] = '已创建变更日志。';
$lang['notification_changelog_edited'] = '已编辑变更日志。';
$lang['notification_changelog_deleted'] = '已删除变更日志。';
$lang['notification_forum_created'] = '已创建论坛。';
$lang['notification_forum_edited'] = '已编辑论坛。';
$lang['notification_forum_deleted'] = '已删除论坛。';
$lang['notification_category_created'] = '已创建类别。';
$lang['notification_category_edited'] = '已编辑类别。';
$lang['notification_category_deleted'] = '已删除类别。';
$lang['notification_menu_created'] = '已创建菜单。';
$lang['notification_menu_edited'] = '已编辑菜单。';
$lang['notification_menu_deleted'] = '已删除菜单。';
$lang['notification_news_deleted'] = '已删除新闻。';
$lang['notification_page_created'] = '已创建页面。';
$lang['notification_page_edited'] = '已编辑页面。';
$lang['notification_page_deleted'] = '已删除页面。';
$lang['notification_realm_created'] = '已创建领域。';
$lang['notification_realm_edited'] = '已编辑领域。';
$lang['notification_realm_deleted'] = '已删除领域。';
$lang['notification_slide_created'] = '已创建幻灯片。';
$lang['notification_slide_edited'] = '已编辑幻灯片。';
$lang['notification_slide_deleted'] = '已删除幻灯片。';
$lang['notification_item_created'] = '已创建物品。';
$lang['notification_item_edited'] = '已编辑物品。';
$lang['notification_item_deleted'] = '已删除物品。';
$lang['notification_top_created'] = '已创建顶级物品。';
$lang['notification_top_edited'] = '已编辑顶级物品。';
$lang['notification_top_deleted'] = '已删除顶级物品。';
$lang['notification_topsite_created'] = '已创建顶级网站。';
$lang['notification_topsite_edited'] = '已编辑顶级网站。';
$lang['notification_topsite_deleted'] = '已删除顶级网站。';

$lang['notification_settings_updated'] = '已更新设置。';
$lang['notification_module_enabled'] = '已启用模块。';
$lang['notification_module_disabled'] = '已禁用模块。';
$lang['notification_migration'] = '已设置设置。';

$lang['notification_donation_added'] = '已添加捐赠。';
$lang['notification_donation_deleted'] = '已删除捐赠。';
$lang['notification_donation_updated'] = '已更新捐赠。';
$lang['notification_points_empty'] = '点数为空。';
$lang['notification_tax_empty'] = '税费为空。';
$lang['notification_price_empty'] = '价格为空。';
$lang['notification_incorrect_update'] = '意外的更新。';

$lang['notification_route_inuse'] = '路由已在使用中，请选择另一个。';

$lang['notification_account_updated'] = '已更新帐户。';
$lang['notification_dp_vp_empty'] = 'DP/VP为空。';
$lang['notification_account_banned'] = '已封禁帐户。';
$lang['notification_reason_empty'] = '原因为空。';
$lang['notification_account_ban_remove'] = '已移除帐户中的封禁。';
$lang['notification_rank_empty'] = '等级为空。';
$lang['notification_rank_granted'] = '已授予等级。';
$lang['notification_rank_removed'] = '已删除等级。';

$lang['notification_cms_updated'] = '已更新CMS。';
$lang['notification_cms_update_error'] = '无法更新CMS。';
$lang['notification_cms_not_updated'] = '未找到新版本以进行更新。';

$lang['notification_select_category'] = '这不是子类别。';
$lang['notification_delete_comment_error'] = '删除评论失败。';