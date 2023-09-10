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

/* ナビゲーションバーの言語 */
$lang['admin_nav_dashboard'] = 'ダッシュボード';
$lang['admin_nav_system'] = 'システム';
$lang['admin_nav_manage_settings'] = '設定管理';
$lang['admin_nav_manage_modules'] = 'モジュール管理';
$lang['admin_nav_users'] = 'ユーザー';
$lang['admin_nav_accounts'] = 'アカウント';
$lang['admin_nav_website'] = 'ウェブサイト';
$lang['admin_nav_menu'] = 'メニュー';
$lang['admin_nav_realms'] = 'レルム';
$lang['admin_nav_slides'] = 'スライド';
$lang['admin_nav_news'] = 'ニュース';
$lang['admin_nav_changelogs'] = '変更ログ';
$lang['admin_nav_pages'] = 'ページ';
$lang['admin_nav_donate_methods'] = '寄付方法';
$lang['admin_nav_topsites'] = 'トップサイト';
$lang['admin_nav_donate_logs'] = '寄付ログ';
$lang['admin_nav_vote_logs'] = '投票ログ';
$lang['admin_nav_store'] = 'ストア';
$lang['admin_nav_manage_store'] = 'ストア管理';
$lang['admin_nav_forum'] = 'フォーラム';
$lang['admin_nav_manage_forum'] = 'フォーラム管理';
$lang['admin_nav_logs'] = 'ログシステム';
$lang['admin_nav_download'] = 'ダウンロード';
$lang['admin_nav_Tickets'] = 'チケット';
$lang['admin_nav_manage_tickets'] = 'チケット管理';

/* セクションの言語 */
$lang['section_general_settings'] = '一般設定';
$lang['section_module_settings'] = 'モジュール設定';
$lang['section_optional_settings'] = 'オプション設定';
$lang['section_seo_settings'] = 'SEO設定';
$lang['section_update_cms'] = 'CMSの更新';
$lang['section_check_information'] = '情報の確認';
$lang['section_forum_categories'] = 'フォーラムカテゴリ';
$lang['section_forum_elements'] = 'フォーラム要素';
$lang['section_store_categories'] = 'ストアカテゴリ';
$lang['section_store_items'] = 'ストアアイテム';
$lang['section_store_top'] = 'ストアトップアイテム';
$lang['section_logs_dp'] = '寄付ログ';
$lang['section_logs_vp'] = '投票ログ';

/* ボタンの言語 */
$lang['button_select'] = '選択';
$lang['button_update'] = '更新';
$lang['button_unban'] = '禁止解除';
$lang['button_ban'] = '禁止';
$lang['button_remove'] = '削除';
$lang['button_grant'] = '許可';
$lang['button_update_version'] = '最新バージョンに更新';

/* テーブルヘッダーの言語 */
$lang['table_header_subcategory'] = 'サブカテゴリを選択';
$lang['table_header_race'] = '種族';
$lang['table_header_class'] = 'クラス';
$lang['table_header_level'] = 'レベル';
$lang['table_header_money'] = 'お金';
$lang['table_header_time_played'] = 'プレイ時間';
$lang['table_header_actions'] = 'アクション';
$lang['table_header_id'] = '#ID';
$lang['table_header_tax'] = '税金';
$lang['table_header_points'] = 'ポイント';
$lang['table_header_type'] = 'タイプ';
$lang['table_header_module'] = 'モジュール';
$lang['table_header_payment_id'] = '支払いID';
$lang['table_header_hash'] = 'ハッシュ';
$lang['table_header_total'] = '合計';
$lang['table_header_create_time'] = '作成時間';
$lang['table_header_guid'] = 'GUID';
$lang['table_header_information'] = '情報';
$lang['table_header_value'] = '値';

/* 入力プレースホルダーの言語 */
$lang['placeholder_manage_account'] = 'アカウント管理';
$lang['placeholder_update_information'] = 'アカウント情報を更新';
$lang['placeholder_donation_logs'] = '寄付ログ';
$lang['placeholder_store_logs'] = 'ストアログ';
$lang['placeholder_create_changelog'] = '変更ログを作成';
$lang['placeholder_edit_changelog'] = '変更ログを編集';
$lang['placeholder_create_category'] = 'カテゴリを作成';
$lang['placeholder_edit_category'] = 'カテゴリを編集';
$lang['placeholder_create_forum'] = 'フォーラムを作成';
$lang['placeholder_edit_forum'] = 'フォーラムを編集';
$lang['placeholder_create_menu'] = 'メニューを作成';
$lang['placeholder_edit_menu'] = 'メニューを編集';
$lang['placeholder_create_news'] = 'ニュースを作成';
$lang['placeholder_edit_news'] = 'ニュースを編集';
$lang['placeholder_create_page'] = 'ページを作成';
$lang['placeholder_edit_page'] = 'ページを編集';
$lang['placeholder_create_realm'] = 'レルムを作成';
$lang['placeholder_edit_realm'] = 'レルムを編集';
$lang['placeholder_create_slide'] = 'スライドを作成';
$lang['placeholder_edit_slide'] = 'スライドを編集';
$lang['placeholder_create_item'] = 'アイテムを作成';
$lang['placeholder_edit_item'] = 'アイテムを編集';
$lang['placeholder_create_topsite'] = 'トップサイトを作成';
$lang['placeholder_edit_topsite'] = 'トップサイトを編集';
$lang['placeholder_create_top'] = 'トップアイテムを作成';
$lang['placeholder_edit_top'] = 'トップアイテムを編集';
$lang['placeholder_select_category'] = 'カテゴリを選択';
$lang['placeholder_create_download'] = 'ダウンロードを作成';
$lang['placeholder_edit_download'] = 'ダウンロードを編集';

$lang['placeholder_upload_image'] = '画像をアップロード';
$lang['placeholder_icon_name'] = 'アイコン名';
$lang['placeholder_category'] = 'カテゴリ';
$lang['placeholder_name'] = '名前';
$lang['placeholder_item'] = 'アイテム';
$lang['placeholder_image_name'] = '画像名';
$lang['placeholder_reason'] = '理由';
$lang['placeholder_gmlevel'] = 'GM レベル';
$lang['placeholder_url'] = 'URL';
$lang['placeholder_child_menu'] = 'サブメニュー';
$lang['placeholder_url_type'] = 'URL タイプ';
$lang['placeholder_route'] = 'ルート';
$lang['placeholder_hours'] = '時間';
$lang['placeholder_soap_hostname'] = 'Soap ホスト名';
$lang['placeholder_soap_port'] = 'Soap ポート';
$lang['placeholder_soap_user'] = 'Soap ユーザー';
$lang['placeholder_soap_password'] = 'Soap パスワード';
$lang['placeholder_db_character'] = 'キャラクター';
$lang['placeholder_db_hostname'] = 'データベース ホスト名';
$lang['placeholder_db_name'] = 'データベース名';
$lang['placeholder_db_user'] = 'データベース ユーザー';
$lang['placeholder_db_password'] = 'データベース パスワード';
$lang['placeholder_account_points'] = 'アカウント ポイント';
$lang['placeholder_account_ban'] = 'アカウントを禁止';
$lang['placeholder_account_unban'] = 'アカウントの禁止を解除';
$lang['placeholder_account_grant_rank'] = 'GM ランクを付与';
$lang['placeholder_account_remove_rank'] = 'GM ランクを削除';
$lang['placeholder_command'] = 'コマンド';
$lang['placeholder_emulator'] = 'エミュレータ';
$lang['placeholder_size'] = 'サイズ';
$lang['placeholder_select_type'] = 'タイプを選択';

/* 設定言語 */
$lang['conf_website_name'] = 'ウェブサイト名';
$lang['conf_realmlist'] = 'リアルムリスト';
$lang['conf_discord_invid'] = 'Discord 招待 ID';
$lang['conf_timezone'] = 'タイムゾーン';
$lang['conf_theme_name'] = 'テーマ名';
$lang['conf_maintenance_mode'] = 'メンテナンスモード';
$lang['conf_social_facebook'] = 'Facebook URL';
$lang['conf_social_twitter'] = 'Twitter URL';
$lang['conf_social_youtube'] = 'Youtube URL';
$lang['conf_paypal_currency'] = 'PayPal 通貨';
$lang['conf_paypal_currency_symbol'] = 'PayPal 通貨記号';
$lang['conf_paypal_mode'] = 'PayPal モード';
$lang['conf_paypal_client'] = 'PayPal クライアント ID';
$lang['conf_paypal_secretpass'] = 'PayPal シークレットパスワード';
$lang['conf_default_description'] = 'デフォルトの説明';
$lang['conf_admin_gmlvl'] = '管理者 GM レベル';
$lang['conf_mod_gmlvl'] = 'モデレーター GM レベル';
$lang['conf_recaptcha_key'] = 'reCaptcha サイトキー';
$lang['conf_account_activation'] = 'アカウントの有効化';
$lang['conf_smtp_hostname'] = 'SMTP ホスト名';
$lang['conf_smtp_port'] = 'SMTP ポート';
$lang['conf_smtp_encryption'] = 'SMTP 暗号化';
$lang['conf_smtp_username'] = 'SMTP ユーザー名';
$lang['conf_smtp_password'] = 'SMTP パスワード';
$lang['conf_sender_email'] = '送信者のメールアドレス';
$lang['conf_sender_name'] = '送信者の名前';

/* ログ */
$lang['placeholder_logs_dp'] = '寄付';
$lang['placeholder_logs_quantity'] = '数量';
$lang['placeholder_logs_hash'] = 'ハッシュ';
$lang['placeholder_logs_voteid'] = '投票 ID';
$lang['placeholder_logs_points'] = 'ポイント';
$lang['placeholder_logs_lasttime'] = '最終時間';
$lang['placeholder_logs_expiredtime'] = '有効期限';

/* ステータス言語 */
$lang['status_completed'] = '完了';
$lang['status_cancelled'] = 'キャンセル';

/* オプション言語 */
$lang['option_normal'] = '通常';
$lang['option_dropdown'] = 'ドロップダウン';
$lang['option_image'] = '画像';
$lang['option_video'] = 'ビデオ';
$lang['option_iframe'] = 'Iframe';
$lang['option_enabled'] = '有効';
$lang['option_disabled'] = '無効';
$lang['option_ssl'] = 'SSL';
$lang['option_tls'] = 'TLS';
$lang['option_everyone'] = 'すべてのユーザー';
$lang['option_staff'] = 'スタッフ';
$lang['option_all'] = 'スタッフ - すべてのユーザー';
$lang['option_rename'] = '名前を変更';
$lang['option_customize'] = 'カスタマイズ';
$lang['option_change_faction'] = '陣営を変更';
$lang['option_change_race'] = '種族を変更';
$lang['option_dp'] = 'DP';
$lang['option_vp'] = 'VP';
$lang['option_dp_vp'] = 'DP & VP';
$lang['option_internal_url'] = '内部 URL';
$lang['option_external_url'] = '外部 URL';
$lang['option_on'] = 'オン';
$lang['option_off'] = 'オフ';

/* カウント言語 */
$lang['count_accounts_created'] = 'アカウント作成';
$lang['count_accounts_banned'] = 'アカウントバン';
$lang['count_news_created'] = 'ニュース作成';
$lang['count_changelogs_created'] = '変更履歴作成';
$lang['total_accounts_registered'] = '合計登録アカウント数';
$lang['total_accounts_banned'] = '合計バンアカウント数';
$lang['total_news_writed'] = '合計ニュース記事数';
$lang['total_changelogs_writed'] = '合計変更履歴記事数';

$lang['info_alliance_players'] = 'アライアンスプレイヤー';
$lang['info_alliance_playing'] = 'レルムでプレイ中のアライアンス';
$lang['info_horde_players'] = 'ホードプレイヤー';
$lang['info_horde_playing'] = 'レルムでプレイ中のホード';
$lang['info_players_playing'] = 'レルムでプレイ中のプレイヤー';

/* 警告言語 */
$lang['alert_smtp_activation'] = 'このオプションを有効にする場合、メールを送信するためにSMTPを設定する必要があります。';
$lang['alert_banned_reason'] = 'バンされました、理由：';

/* ログ言語 */
$lang['log_new_level'] = '新しいレベルを受け取りました';
$lang['log_old_level'] = '以前は';
$lang['log_new_name'] = '新しい名前を持っています';
$lang['log_old_name'] = '以前は';
$lang['log_unbanned'] = 'バンが解除されました';
$lang['log_customization'] = 'カスタマイズを受け取りました';
$lang['log_change_race'] = '種族変更を受け取りました';
$lang['log_change_faction'] = '陣営変更を受け取りました';
$lang['log_banned'] = 'バンされました';
$lang['log_gm_assigned'] = 'GMランクを受け取りました';
$lang['log_gm_removed'] = 'GMランクが削除されました';

/* CMS言語 */
$lang['cms_version_currently'] = '現在のバージョン';
$lang['cms_warning_update'] = 'CMSが更新されると、バージョンごとの変更に応じて設定がデフォルトに戻ることがあります。';
$lang['cms_php_version'] = 'PHPバージョン';
$lang['cms_allow_fopen'] = 'allow_url_fopen';
$lang['cms_allow_include'] = 'allow_url_include';
$lang['cms_loaded_modules'] = 'ロードされたモジュール';
$lang['cms_loaded_extensions'] = 'ロードされた拡張機能';
