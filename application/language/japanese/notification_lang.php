<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * BlizzCMS
 *
 * 「World of Warcraft」用のオープンソースCMS
 *
 * このコンテンツはMITライセンス（MIT）の下でリリースされています。
 *
 * 著作権（c）2017年 - 2023年、WoW-CMS
 *
 * 以下に定める条件に従い、本ソフトウェアおよび関連文書のファイル（以下「ソフトウェア」）の複製を取得するすべての人に対し、
 * ソフトウェアを無制限に扱うことを無償で許可します。これには、ソフトウェアの複製を使用、複写、変更、結合、掲載、頒布、
 * サブライセンス、および/または販売する権利、およびソフトウェアを提供する相手に同じことを許可する権利も無制限に含まれます。
 * 
 * 上記の著作権表示および本許諾表示を、ソフトウェアのすべての複製または重要な部分に記載するものとします。
 * 
 * ソフトウェアは「現状のまま」で、明示であるか暗黙であるかを問わず、何らの保証もなく提供されます。ここでいう保証とは、
 * 商品性、特定の目的への適合性、および権利非侵害についての保証も含みますが、それに限定されるものではありません。 
 * 作者または著作権者は、契約行為、不法行為、またはそれ以外であろうと、ソフトウェアに起因または関連し、
 * あるいはソフトウェアの使用またはその他の扱いによって生じる一切の請求、損害、その他の義務について何らの責任も負わないものとします。
 * 
 *
 * @著者  WoW-CMS
 * @翻訳者 IkuSenpai
 * @著作権  著作権（c）2017年 - 2023年、WoW-CMS。
 * @リンク https://licenses.opensource.jp/MIT/MIT.html MIT License
 * @ソースファイル    https://wow-cms.com
 * @since   Version 1.0.1
 * @filesource
 */

/*通知タイトルの言語*/
$lang['notification_title_success'] = '成功';
$lang['notification_title_warning'] = '警告';
$lang['notification_title_error'] = 'エラー';
$lang['notification_title_info'] = '情報';

/*通知メッセージ（ログイン/登録）の言語*/
$lang['notification_username_empty'] = 'ユーザー名は空です。';
$lang['notification_account_not_created'] = 'アカウントを作成できませんでした。データを確認して再試行してください。';
$lang['notification_email_empty'] = '電子メールが空です。';
$lang['notification_password_empty'] = 'パスワードが空です。';
$lang['notification_user_error'] = 'ユーザー名またはパスワードが正しくありません。もう一度お試しください！';
$lang['notification_email_error'] = '電子メールまたはパスワードが正しくありません。もう一度お試しください！';
$lang['notification_check_email'] = 'ユーザー名または電子メールが正しくありません。もう一度お試しください！';
$lang['notification_checking'] = '確認中。。。';
$lang['notification_redirection'] = 'アカウントに接続中。。。';
$lang['notification_new_account'] = '新しいアカウントが作成されました。ログインページにリダイレクトしています。。。';
$lang['notification_email_sent'] = 'メールを送信しました。メールを確認してください。。。';
$lang['notification_account_activation'] = 'メールを送信しました。アカウントを有効化するためにメールを確認してください。';
$lang['notification_captcha_error'] = 'キャプチャを確認してください。';
$lang['notification_password_length_error'] = 'パスワードの長さが正しくありません。5文字から16文字のパスワードを使用してください。';
$lang['notification_account_already_exist'] = 'このアカウントは既に存在しています。';
$lang['notification_password_not_match'] = 'パスワードが一致しません。';
$lang['notification_same_password'] = 'パスワードは同じです。';
$lang['notification_currentpass_not_match'] = '古いパスワードが一致しません。';
$lang['notification_usernamepass_not_match'] = 'このユーザー名に対してパスワードが一致しません。';
$lang['notification_used_email'] = 'このメールアドレスは既に使用中です。';
$lang['notification_email_not_match'] = 'メールアドレスが一致しません。';
$lang['notification_username_not_match'] = 'ユーザー名が一致しません。';
$lang['notification_expansion_not_found'] = 'ゲームの拡張が見つかりません。';
$lang['notification_valid_key'] = 'アカウントが有効化されました。';
$lang['notification_valid_key_desc'] = '今、アカウントでサインインできます。';
$lang['notification_invalid_key'] = '提供されたアクティベーションキーは無効です。';

/*通知メッセージ（一般）の言語*/
$lang['notification_email_changed'] = 'メールアドレスが変更されました。';
$lang['notification_username_changed'] = 'ユーザー名が変更されました。';
$lang['notification_password_changed'] = 'パスワードが変更されました。';
$lang['notification_avatar_changed'] = 'アバターが変更されました。';
$lang['notification_wrong_values'] = '値が間違っています。';
$lang['notification_select_type'] = 'タイプを選択してください。';
$lang['notification_select_priority'] = '優先順位を選択してください。';
$lang['notification_select_category'] = 'カテゴリを選択してください。';
$lang['notification_select_realm'] = 'レルムを選択してください。';
$lang['notification_select_character'] = 'キャラクターを選択してください。';
$lang['notification_select_item'] = 'アイテムを選択してください。';
$lang['notification_report_created'] = 'レポートが作成されました。';
$lang['notification_title_empty'] = 'タイトルが空です。';
$lang['notification_description_empty'] = '説明が空です。';
$lang['notification_name_empty'] = '名前が空です。';
$lang['notification_id_empty'] = 'IDが空です。';
$lang['notification_reply_empty'] = '返信が空です。';
$lang['notification_reply_created'] = '返信が送信されました。';
$lang['notification_reply_deleted'] = '返信が削除されました。';
$lang['notification_topic_created'] = 'トピックが作成されました。';
$lang['notification_donation_successful'] = '寄付が正常に完了しました。アカウント内の寄付ポイントを確認してください。';
$lang['notification_donation_canceled'] = '寄付がキャンセルされました。';
$lang['notification_donation_error'] = 'トランザクションで提供された情報が一致しません。';
$lang['notification_store_chars_error'] = '各アイテムでキャラクターを選択してください。';
$lang['notification_store_item_insufficient_points'] = '購入に十分なポイントがありません。';
$lang['notification_store_item_purchased'] = 'アイテムは購入されました。ゲーム内のメールを確認してください。';
$lang['notification_store_item_added'] = '選択したアイテムがカートに追加されました。';
$lang['notification_store_item_removed'] = '選択したアイテムがカートから削除されました。';
$lang['notification_store_cart_error'] = 'カートの更新に失敗しました。もう一度試してみてください。';

/*通知メッセージ（管理者）の言語*/
$lang['notification_changelog_created'] = '更新履歴が作成されました。';
$lang['notification_changelog_edited'] = '更新履歴が編集されました。';
$lang['notification_changelog_deleted'] = '更新履歴が削除されました。';
$lang['notification_forum_created'] = 'フォーラムが作成されました。';
$lang['notification_forum_edited'] = 'フォーラムが編集されました。';
$lang['notification_forum_deleted'] = 'フォーラムが削除されました。';
$lang['notification_category_created'] = 'カテゴリが作成されました。';
$lang['notification_category_edited'] = 'カテゴリが編集されました。';
$lang['notification_category_deleted'] = 'カテゴリが削除されました。';
$lang['notification_menu_created'] = 'メニューが作成されました。';
$lang['notification_menu_edited'] = 'メニューが編集されました。';
$lang['notification_menu_deleted'] = 'メニューが削除されました';
$lang['notification_news_deleted'] = 'ニュースが削除されました。';
$lang['notification_page_created'] = 'ページが作成されました。';
$lang['notification_page_edited'] = 'ページが編集されました。';
$lang['notification_page_deleted'] = 'ページが削除されました。';
$lang['notification_realm_created'] = 'レルムが作成されました。';
$lang['notification_realm_edited'] = 'レルムが編集されました。';
$lang['notification_realm_deleted'] = 'レルムが削除されました。';
$lang['notification_slide_created'] = 'スライドが作成されました。';
$lang['notification_slide_edited'] = 'スライドが編集されました。';
$lang['notification_slide_deleted'] = 'スライドが削除されました。';
$lang['notification_item_created'] = 'アイテムが作成されました。';
$lang['notification_item_edited'] = 'アイテムが編集されました。';
$lang['notification_item_deleted'] = 'アイテムが削除されました。';
$lang['notification_top_created'] = 'トップアイテムが作成されました。';
$lang['notification_top_edited'] = 'トップアイテムが編集されました。';
$lang['notification_top_deleted'] = 'トップアイテムが削除されました。';
$lang['notification_topsite_created'] = 'トップサイトが作成されました。';
$lang['notification_topsite_edited'] = 'トップサイトが編集されました。';
$lang['notification_topsite_deleted'] = 'トップサイトが削除されました。';

$lang['notification_settings_updated'] = '設定が更新されました。';
$lang['notification_module_enabled'] = 'モジュールが有効になりました。';
$lang['notification_module_disabled'] = 'モジュールが無効になりました。';
$lang['notification_migration'] = '設定が設定されました。';

$lang['notification_donation_added'] = '寄付が追加されました。';
$lang['notification_donation_deleted'] = '寄付が削除されました。';
$lang['notification_donation_updated'] = '寄付が更新されました。';
$lang['notification_points_empty'] = 'ポイントが空です。';
$lang['notification_tax_empty'] = '税金が空です。';
$lang['notification_price_empty'] = '価格が空です';
$lang['notification_incorrect_update'] = '予期しない更新。';

$lang['notification_route_inuse'] = 'ルートは既に使用中です、別のものを選択してください。';

$lang['notification_account_updated'] = 'アカウントが更新されました。';
$lang['notification_dp_vp_empty'] = 'DP/VPが空です。';
$lang['notification_account_banned'] = 'アカウントが禁止されました。';
$lang['notification_reason_empty'] = '理由が空です。';
$lang['notification_account_ban_remove'] = 'アカウントの禁止が解除されました。';
$lang['notification_rank_empty'] = 'ランクが空です。';
$lang['notification_rank_granted'] = 'ランクが付与されました。';
$lang['notification_rank_removed'] = 'ランクが削除されました。';

$lang['notification_cms_updated'] = 'CMSが更新されました。';
$lang['notification_cms_update_error'] = 'CMSを更新できませんでした。';
$lang['notification_cms_not_updated'] = '更新用の新しいバージョンが見つかりませんでした。';

$lang['notification_select_category'] = 'これはサブカテゴリではありません。';
$lang['notification_delete_comment_error'] = 'コメントの削除に失敗しました。';