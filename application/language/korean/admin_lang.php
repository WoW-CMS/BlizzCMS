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

/*네비게이션 언어*/
$lang['admin_nav_dashboard'] = '대시보드';
$lang['admin_nav_system'] = '시스템';
$lang['admin_nav_manage_settings'] = '설정 관리';
$lang['admin_nav_manage_modules'] = '모듈 관리';
$lang['admin_nav_users'] = '사용자';
$lang['admin_nav_accounts'] = '계정';
$lang['admin_nav_website'] = '웹사이트';
$lang['admin_nav_menu'] = '메뉴';
$lang['admin_nav_realms'] = '렐름';
$lang['admin_nav_slides'] = '슬라이드';
$lang['admin_nav_news'] = '뉴스';
$lang['admin_nav_changelogs'] = '변경 로그';
$lang['admin_nav_pages'] = '페이지';
$lang['admin_nav_donate_methods'] = '기부 방법';
$lang['admin_nav_topsites'] = '탑사이트';
$lang['admin_nav_donate_logs'] = '기부 로그';
$lang['admin_nav_vote_logs'] = '투표 로그';
$lang['admin_nav_store'] = '상점';
$lang['admin_nav_manage_store'] = '상점 관리';
$lang['admin_nav_forum'] = '포럼';
$lang['admin_nav_manage_forum'] = '포럼 관리';
$lang['admin_nav_logs'] = '로그 시스템';
$lang['admin_nav_download'] = '다운로드';
$lang['admin_nav_Tickets'] = '티켓';
$lang['admin_nav_manage_tickets'] = '티켓 관리';

/*섹션 언어*/
$lang['section_general_settings'] = '일반 설정';
$lang['section_module_settings'] = '모듈 설정';
$lang['section_optional_settings'] = '선택 설정';
$lang['section_seo_settings'] = 'SEO 설정';
$lang['section_update_cms'] = 'CMS 업데이트';
$lang['section_check_information'] = '정보 확인';
$lang['section_forum_categories'] = '포럼 카테고리';
$lang['section_forum_elements'] = '포럼 요소';
$lang['section_store_categories'] = '상점 카테고리';
$lang['section_store_items'] = '상점 아이템';
$lang['section_store_top'] = '상점 TOP 아이템';
$lang['section_logs_dp'] = '기부 로그';
$lang['section_logs_vp'] = '투표 로그';

/*버튼 언어*/
$lang['button_select'] = '선택';
$lang['button_update'] = '업데이트';
$lang['button_unban'] = '차단 해제';
$lang['button_ban'] = '차단';
$lang['button_remove'] = '제거';
$lang['button_grant'] = '부여';
$lang['button_update_version'] = '최신 버전으로 업데이트';

/*테이블 헤더 언어*/
$lang['table_header_subcategory'] = '하위 카테고리 선택';
$lang['table_header_race'] = '종족';
$lang['table_header_class'] = '직업';
$lang['table_header_level'] = '레벨';
$lang['table_header_money'] = '돈';
$lang['table_header_time_played'] = '플레이 시간';
$lang['table_header_actions'] = '동작';
$lang['table_header_id'] = '#ID';
$lang['table_header_tax'] = '세금';
$lang['table_header_points'] = '포인트';
$lang['table_header_type'] = '유형';
$lang['table_header_module'] = '모듈';
$lang['table_header_payment_id'] = '결제 ID';
$lang['table_header_hash'] = '해시';
$lang['table_header_total'] = '합계';
$lang['table_header_create_time'] = '생성 시간';
$lang['table_header_guid'] = 'Guid';
$lang['table_header_information'] = '정보';
$lang['table_header_value'] = '값';

/*입력 플레이스홀더 언어*/
$lang['placeholder_manage_account'] = '계정 관리';
$lang['placeholder_update_information'] = '계정 정보 업데이트';
$lang['placeholder_donation_logs'] = '기부 로그';
$lang['placeholder_store_logs'] = '상점 로그';
$lang['placeholder_create_changelog'] = '변경 로그 생성';
$lang['placeholder_edit_changelog'] = '변경 로그 편집';
$lang['placeholder_create_category'] = '카테고리 생성';
$lang['placeholder_edit_category'] = '카테고리 편집';
$lang['placeholder_create_forum'] = '포럼 생성';
$lang['placeholder_edit_forum'] = '포럼 편집';
$lang['placeholder_create_menu'] = '메뉴 생성';
$lang['placeholder_edit_menu'] = '메뉴 편집';
$lang['placeholder_create_news'] = '뉴스 생성';
$lang['placeholder_edit_news'] = '뉴스 편집';
$lang['placeholder_create_page'] = '페이지 생성';
$lang['placeholder_edit_page'] = '페이지 편집';
$lang['placeholder_create_realm'] = '렐름 생성';
$lang['placeholder_edit_realm'] = '렐름 편집';
$lang['placeholder_create_slide'] = '슬라이드 생성';
$lang['placeholder_edit_slide'] = '슬라이드 편집';
$lang['placeholder_create_item'] = '아이템 생성';
$lang['placeholder_edit_item'] = '아이템 편집';
$lang['placeholder_create_topsite'] = '탑사이트 생성';
$lang['placeholder_edit_topsite'] = '탑사이트 편집';
$lang['placeholder_create_top'] = 'TOP 아이템 생성';
$lang['placeholder_edit_top'] = 'TOP 아이템 편집';
$lang['placeholder_select_category'] = '카테고리 선택';
$lang['placeholder_create_download'] = '다운로드 생성';
$lang['placeholder_edit_download'] = '다운로드 편집';

$lang['placeholder_upload_image'] = '이미지 업로드';
$lang['placeholder_icon_name'] = '아이콘 이름';
$lang['placeholder_category'] = '카테고리';
$lang['placeholder_name'] = '이름';
$lang['placeholder_item'] = '아이템';
$lang['placeholder_image_name'] = '이미지 이름';
$lang['placeholder_reason'] = '이유';
$lang['placeholder_gmlevel'] = 'GM 레벨';
$lang['placeholder_url'] = 'URL';
$lang['placeholder_child_menu'] = '하위 메뉴';
$lang['placeholder_url_type'] = 'URL 유형';
$lang['placeholder_route'] = '경로';
$lang['placeholder_hours'] = '시간';
$lang['placeholder_soap_hostname'] = 'Soap 호스트명';
$lang['placeholder_soap_port'] = 'Soap 포트';
$lang['placeholder_soap_user'] = 'Soap 사용자';
$lang['placeholder_soap_password'] = 'Soap 비밀번호';
$lang['placeholder_db_character'] = '캐릭터';
$lang['placeholder_db_hostname'] = '데이터베이스 호스트명';
$lang['placeholder_db_name'] = '데이터베이스 이름';
$lang['placeholder_db_user'] = '데이터베이스 사용자';
$lang['placeholder_db_password'] = '데이터베이스 비밀번호';
$lang['placeholder_account_points'] = '계정 포인트';
$lang['placeholder_account_ban'] = '계정 차단';
$lang['placeholder_account_unban'] = '계정 차단 해제';
$lang['placeholder_account_grant_rank'] = 'GM 랭크 부여';
$lang['placeholder_account_remove_rank'] = 'GM 랭크 제거';
$lang['placeholder_command'] = '명령';
$lang['placeholder_emulator'] = '에뮬레이터';
$lang['placeholder_size'] = '크기';
$lang['placeholder_select_type'] = '유형 선택';

/*설정 언어*/
$lang['conf_website_name'] = '웹사이트 이름';
$lang['conf_realmlist'] = '리얼리스트';
$lang['conf_discord_invid'] = '디스코드 초대 ID';
$lang['conf_timezone'] = '시간대';
$lang['conf_theme_name'] = '테마 이름';
$lang['conf_maintenance_mode'] = '유지 보수 모드';
$lang['conf_social_facebook'] = '페이스북 URL';
$lang['conf_social_twitter'] = '트위터 URL';
$lang['conf_social_youtube'] = '유튜브 URL';
$lang['conf_paypal_currency'] = 'PayPal 통화';
$lang['conf_paypal_currency_symbol'] = 'PayPal 통화 기호';
$lang['conf_paypal_mode'] = 'PayPal 모드';
$lang['conf_paypal_client'] = 'PayPal 클라이언트 ID';
$lang['conf_paypal_secretpass'] = 'PayPal 비밀 암호';
$lang['conf_default_description'] = '기본 설명';
$lang['conf_admin_gmlvl'] = '관리자 GM 레벨';
$lang['conf_mod_gmlvl'] = '모더레이터 GM 레벨';
$lang['conf_recaptcha_key'] = 'reCaptcha 사이트 키';
$lang['conf_account_activation'] = '계정 활성화';
$lang['conf_smtp_hostname'] = 'SMTP 호스트명';
$lang['conf_smtp_port'] = 'SMTP 포트';
$lang['conf_smtp_encryption'] = 'SMTP 암호화';
$lang['conf_smtp_username'] = 'SMTP 사용자 이름';
$lang['conf_smtp_password'] = 'SMTP 비밀번호';
$lang['conf_sender_email'] = '발신자 이메일';
$lang['conf_sender_name'] = '발신자 이름';

/*로그*/
$lang['placeholder_logs_dp'] = '기부';
$lang['placeholder_logs_quantity'] = '수량';
$lang['placeholder_logs_hash'] = '해시';
$lang['placeholder_logs_voteid'] = '투표 ID';
$lang['placeholder_logs_points'] = '포인트';
$lang['placeholder_logs_lasttime'] = '마지막 시간';
$lang['placeholder_logs_expiredtime'] = '만료 시간';

/*상태 언어*/
$lang['status_completed'] = '완료됨';
$lang['status_cancelled'] = '취소됨';

/*옵션 언어*/
$lang['option_normal'] = '일반';
$lang['option_dropdown'] = '드롭다운';
$lang['option_image'] = '이미지';
$lang['option_video'] = '비디오';
$lang['option_iframe'] = '아이프레임';
$lang['option_enabled'] = '활성화됨';
$lang['option_disabled'] = '비활성화됨';
$lang['option_ssl'] = 'SSL';
$lang['option_tls'] = 'TLS';
$lang['option_everyone'] = '모두';
$lang['option_staff'] = '스탭';
$lang['option_all'] = '스탭 - 모두';
$lang['option_rename'] = '이름 변경';
$lang['option_customize'] = '사용자 정의';
$lang['option_change_faction'] = '진영 변경';
$lang['option_change_race'] = '종족 변경';
$lang['option_dp'] = 'DP';
$lang['option_vp'] = 'VP';
$lang['option_dp_vp'] = 'DP 및 VP';
$lang['option_internal_url'] = '내부 URL';
$lang['option_external_url'] = '외부 URL';
$lang['option_on'] = '켜짐';
$lang['option_off'] = '꺼짐';

/*카운트 언어*/
$lang['count_accounts_created'] = '계정 생성됨';
$lang['count_accounts_banned'] = '차단된 계정';
$lang['count_news_created'] = '작성된 뉴스';
$lang['count_changelogs_created'] = '작성된 변경 로그';
$lang['total_accounts_registered'] = '총 등록된 계정 수.';
$lang['total_accounts_banned'] = '총 차단된 계정 수.';
$lang['total_news_writed'] = '총 작성된 뉴스 수.';
$lang['total_changelogs_writed'] = '총 작성된 변경 로그 수.';

$lang['info_alliance_players'] = '얼라이언스 플레이어';
$lang['info_alliance_playing'] = '서버에서 플레이 중인 얼라이언스';
$lang['info_horde_players'] = '호드 플레이어';
$lang['info_horde_playing'] = '서버에서 플레이 중인 호드';
$lang['info_players_playing'] = '서버에서 플레이 중인 플레이어';

/*알림 언어*/
$lang['alert_smtp_activation'] = '이 옵션을 활성화하면 이메일을 보내기 위해 SMTP를 구성해야 합니다.';
$lang['alert_banned_reason'] = '차단되었습니다. 이유:';

/*로그 언어*/
$lang['log_new_level'] = '새로운 레벨을 얻었습니다.';
$lang['log_old_level'] = '이전 레벨은';
$lang['log_new_name'] = '새로운 이름을 가지고 있습니다.';
$lang['log_old_name'] = '이전 이름은';
$lang['log_unbanned'] = '차단이 해제되었습니다.';
$lang['log_customization'] = '맞춤 설정을 받았습니다.';
$lang['log_change_race'] = '종족 변경을 받았습니다.';
$lang['log_change_faction'] = '진영 변경을 받았습니다.';
$lang['log_banned'] = '차단되었습니다.';
$lang['log_gm_assigned'] = 'GM 랭크를 받았습니다.';
$lang['log_gm_removed'] = 'GM 랭크가 제거되었습니다.';

/*CMS 언어*/
$lang['cms_version_currently'] = '현재 이 버전을 실행 중입니다.';
$lang['cms_warning_update'] = 'CMS가 업데이트되면 각 버전에 따라 구성이 기본값으로 복원될 수 있습니다.';
$lang['cms_php_version'] = 'PHP 버전';
$lang['cms_allow_fopen'] = 'allow_url_fopen';
$lang['cms_allow_include'] = 'allow_url_include';
$lang['cms_loaded_modules'] = '로드된 모듈';
$lang['cms_loaded_extensions'] = '로드된 확장자';
