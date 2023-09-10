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

/* ブラウザのタブメニュー */
$lang['tab_news'] = 'ニュース';
$lang['tab_forum'] = 'フォーラム';
$lang['tab_store'] = 'ストア';
$lang['tab_bugtracker'] = 'バグトラッカー';
$lang['tab_changelogs'] = '変更履歴';
$lang['tab_pvp_statistics'] = 'PvP 統計';
$lang['tab_login'] = 'ログイン';
$lang['tab_register'] = '登録';
$lang['tab_home'] = 'ホーム';
$lang['tab_donate'] = '寄付';
$lang['tab_vote'] = '投票';
$lang['tab_cart'] = 'カート';
$lang['tab_account'] = 'マイアカウント';
$lang['tab_reset'] = 'パスワードリセット';
$lang['tab_error'] = 'エラー 404';
$lang['tab_maintenance'] = 'メンテナンス';
$lang['tab_online'] = 'オンラインプレイヤー';
$lang['tab_download'] = 'ダウンロード';

/* パネルナビゲーションバー */
$lang['navbar_vote_panel'] = '投票パネル';
$lang['navbar_donate_panel'] = '寄付パネル';

/* ボタンの言語 */
$lang['button_register'] = '登録';
$lang['button_login'] = 'ログイン';
$lang['button_logout'] = 'ログアウト';
$lang['button_forgot_password'] = 'パスワードを忘れましたか？';
$lang['button_user_panel'] = 'ユーザーパネル';
$lang['button_admin_panel'] = '管理者パネル';
$lang['button_mod_panel'] = 'モデレーターパネル';
$lang['button_change_avatar'] = 'アバターを変更';
$lang['button_add_personal_info'] = '個人情報を追加';
$lang['button_create_report'] = 'レポートを作成';
$lang['button_new_topic'] = '新しいトピック';
$lang['button_edit_topic'] = 'トピックを編集';
$lang['button_save_changes'] = '変更を保存';
$lang['button_cancel'] = 'キャンセル';
$lang['button_send'] = '送信';
$lang['button_read_more'] = '詳細を読む';
$lang['button_add_reply'] = 'リプライを追加';
$lang['button_remove'] = '削除';
$lang['button_create'] = '作成';
$lang['button_save'] = '保存';
$lang['button_close'] = '閉じる';
$lang['button_reply'] = '返信';
$lang['button_donate'] = '寄付';
$lang['button_account_settings'] = 'アカウント設定';
$lang['button_cart'] = 'カートに追加';
$lang['button_view_cart'] = 'カートを表示';
$lang['button_checkout'] = 'チェックアウト';
$lang['button_buying'] = '購入を続ける';

/* アラートの言語 */
$lang['alert_successful_purchase'] = 'アイテムの購入が成功しました。';
$lang['alert_upload_error'] = '画像はjpgまたはpng形式である必要があります。';
$lang['alert_changelog_not_found'] = 'サーバーには現在通知する変更履歴がありません。';
$lang['alert_points_insufficient'] = 'ポイントが不足しています。';

/* ステータスの言語 */
$lang['offline'] = 'オフライン';
$lang['online'] = 'オンライン';
$lang['unknown'] = '不明';

/* ラベルの言語 */
$lang['label_open'] = 'オープン';
$lang['label_closed'] = 'クローズ';

/* フォームラベルの言語 */
$lang['label_login_info'] = 'ログイン情報';

/* 入力フィールドのプレースホルダーの言語 */
$lang['placeholder_username'] = 'ユーザー名';
$lang['placeholder_email'] = 'メールアドレス';
$lang['placeholder_password'] = 'パスワード';
$lang['placeholder_re_password'] = 'パスワードを再入力';
$lang['placeholder_current_password'] = '現在のパスワード';
$lang['placeholder_new_password'] = '新しいパスワード';
$lang['placeholder_new_username'] = '新しいユーザー名';
$lang['placeholder_confirm_username'] = '新しいユーザー名を確認';
$lang['placeholder_new_email'] = '新しいメールアドレス';
$lang['placeholder_confirm_email'] = '新しいメールアドレスを確認';
$lang['placeholder_create_bug_report'] = 'バグレポートを作成';
$lang['placeholder_title'] = 'タイトル';
$lang['placeholder_type'] = 'タイプ';
$lang['placeholder_description'] = '説明';
$lang['placeholder_url'] = 'URL';
$lang['placeholder_uri'] = 'フレンドリーURL（例：tos）';
$lang['placeholder_highl'] = 'ハイライト';
$lang['placeholder_lock'] = 'ロック';
$lang['placeholder_subject'] = 'サブジェクト';

/* テーブルヘッダーの言語 */
$lang['table_header_name'] = '名前';
$lang['table_header_faction'] = '陣営';
$lang['table_header_total_kills'] = '合計キル数';
$lang['table_header_today_kills'] = '今日のキル数';
$lang['table_header_yersterday_kills'] = '昨日のキル数';
$lang['table_header_team_name'] = 'チーム名';
$lang['table_header_members'] = 'メンバー';
$lang['table_header_rating'] = '評価';
$lang['table_header_games'] = 'ゲーム';
$lang['table_header_id'] = 'ID';
$lang['table_header_status'] = 'ステータス';
$lang['table_header_priority'] = '優先度';
$lang['table_header_date'] = '日付';
$lang['table_header_author'] = '著者';
$lang['table_header_time'] = '時間';
$lang['table_header_icon'] = 'アイコン';
$lang['table_header_realm'] = 'レルム';
$lang['table_header_zone'] = 'ゾーン';
$lang['table_header_character'] = 'キャラクター';
$lang['table_header_price'] = '価格';
$lang['table_header_item_name'] = 'アイテム名';
$lang['table_header_items'] = 'アイテム数';
$lang['table_header_quantity'] = '数量';

/* クラスの言語 */
$lang['class_warrior'] = 'ウォリアー';
$lang['class_paladin'] = 'パラディン';
$lang['class_hunter'] = 'ハンター';
$lang['class_rogue'] = 'ローグ';
$lang['class_priest'] = 'プリースト';
$lang['class_dk'] = 'デスナイト';
$lang['class_shamman'] = 'シャーマン';
$lang['class_mage'] = 'メイジ';
$lang['class_warlock'] = 'ウォーロック';
$lang['class_monk'] = 'モンク';
$lang['class_druid'] = 'ドルイド';
$lang['class_demonhunter'] = 'デーモンハンター';

/* 陣営の言語 */
$lang['faction_alliance'] = 'アライアンス';
$lang['faction_horde'] = 'ホード';

/* 性別の言語 */
$lang['gender_male'] = '男性';
$lang['gender_female'] = '女性';

/* 種族の言語 */
$lang['race_human'] = 'ヒューマン';
$lang['race_orc'] = 'オーク';
$lang['race_dwarf'] = 'ドワーフ';
$lang['race_night_elf'] = 'ナイトエルフ';
$lang['race_undead'] = 'アンデッド';
$lang['race_tauren'] = 'タウレン';
$lang['race_gnome'] = 'ノーム';
$lang['race_troll'] = 'トロール';
$lang['race_goblin'] = 'ゴブリン';
$lang['race_blood_elf'] = 'ブラッドエルフ';
$lang['race_draenei'] = 'ドレナイ';
$lang['race_worgen'] = 'ウォーゲン';
$lang['race_panda_neutral'] = 'パンダレン（中立）';
$lang['race_panda_alli'] = 'パンダレン（アライアンス）';
$lang['race_panda_horde'] = 'パンダレン（ホード）';
$lang['race_nightborde'] = 'ナイトボーン';
$lang['race_void_elf'] = 'ヴォイドエルフ';
$lang['race_lightforged_draenei'] = '光の鍛えられたドレナイ';
$lang['race_highmountain_tauren'] = 'ハイマウンテンタウレン';
$lang['race_dark_iron_dwarf'] = 'ダークアイアンドワーフ';
$lang['race_maghar_orc'] = 'マグハールオーク';
$lang['race_vulpera'] = 'ヴァルペラ';

/* ヘッダーの言語 */
$lang['header_cookie_message'] = 'このウェブサイトは、最高のエクスペリエンスを提供するためにクッキーを使用しています。 ';
$lang['header_cookie_button'] = '了解しました！';

/* フッターの言語 */
$lang['footer_rights'] = '全著作権所有。';

/* 404ページの言語 */
$lang['page_404_title'] = '404 ページが見つかりません';
$lang['page_404_description'] = 'お探しのページが見つかりませんでした';

/* パネルの言語 */
$lang['panel_acc_rank'] = 'アカウントランク';
$lang['panel_dp'] = 'ドナーポイント';
$lang['panel_vp'] = '投票ポイント';
$lang['panel_expansion'] = '拡張';
$lang['panel_member'] = '加入日';
$lang['panel_chars_list'] = 'キャラクターリスト';
$lang['panel_account_details'] = 'アカウントの詳細';
$lang['panel_last_ip'] = '最終IP';
$lang['panel_change_email'] = 'メールアドレスの変更';
$lang['panel_change_username'] = 'ユーザー名の変更';
$lang['panel_change_password'] = 'パスワードの変更';
$lang['panel_replace_pass_by'] = 'パスワードの置換';
$lang['panel_current_username'] = '現在のユーザー名';
$lang['panel_current_email'] = '現在のメールアドレス';
$lang['panel_replace_email_by'] = 'メールアドレスの置換';

/* ホームの言語 */
$lang['home_latest_news'] = '最新ニュース';
$lang['home_discord'] = 'Discord';
$lang['home_server_status'] = 'サーバーステータス';
$lang['home_realm_info'] = '現在のレルムは';

/* PvP 統計の言語 */
$lang['statistics_top_20'] = 'TOP 20';
$lang['statistics_top_2v2'] = 'TOP 2V2';
$lang['statistics_top_3v3'] = 'TOP 3V3';
$lang['statistics_top_5v5'] = 'TOP 5V5';

/* ニュースの言語 */
$lang['news_recent_list'] = '最新ニュースリスト';
$lang['news_comments'] = 'コメント';

/* バグトラッカーの言語 */
$lang['bugtracker_report_notfound'] = 'レポートが見つかりません';
$lang['bugtracker_answered'] = '回答者：';

/* 寄付の言語 */
$lang['donate_get'] = '取得';

/* 投票の言語 */
$lang['vote_next_time'] = '次の投票まで:';

/* フォーラムの言語 */
$lang['forum_posts_count'] = '投稿数';
$lang['forum_topic_locked'] = 'このトピックはロックされています。';
$lang['forum_comment_locked'] = '何か言いたいことがありますか？ 会話に参加するにはログインしてください。';
$lang['forum_comment_header'] = '会話に参加';
$lang['forum_not_authorized'] = '認可されていません';
$lang['forum_post_history'] = '投稿履歴を表示';
$lang['forum_topic_list'] = 'トピックリスト';
$lang['forum_last_activity'] = '最新アクティビティ';
$lang['forum_last_post_by'] = '最後に投稿したユーザー：';
$lang['forum_whos_online'] = 'オンラインユーザー';
$lang['forum_replies_count'] = '返信数';
$lang['forum_topics_count'] = 'トピック数';
$lang['forum_users_count'] = 'ユーザー数';

/* ストアの言語 */
$lang['store_categories'] = 'ストアカテゴリ';
$lang['store_top_items'] = 'トップアイテム';
$lang['store_cart_added'] = '以下をショッピングカートに追加しました：';
$lang['store_cart_in_your'] = 'ショッピングカートに';
$lang['store_cart_no_items'] = 'カートにアイテムがありません。';

/* SOAPの言語 */
$lang['soap_send_subject'] = 'ストア購入';
$lang['soap_send_body'] = '当ストアでのご購入、誠にありがとうございます！';

/* メールの言語 */
$lang['email_password_recovery'] = 'パスワードのリカバリ';
$lang['email_account_activation'] = 'アカウントの有効化';
