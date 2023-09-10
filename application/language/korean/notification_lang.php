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

/*알림 제목 언어*/
$lang['notification_title_success'] = '성공';
$lang['notification_title_warning'] = '경고';
$lang['notification_title_error'] = '오류';
$lang['notification_title_info'] = '정보';

/*알림 메시지 (로그인/등록) 언어*/
$lang['notification_username_empty'] = '사용자 이름이 비어 있습니다';
$lang['notification_account_not_created'] = '계정을 만들 수 없습니다. 데이터를 확인하고 다시 시도하세요.';
$lang['notification_email_empty'] = '이메일이 비어 있습니다';
$lang['notification_password_empty'] = '비밀번호가 비어 있습니다';
$lang['notification_user_error'] = '사용자 이름 또는 비밀번호가 올바르지 않습니다. 다시 시도하세요!';
$lang['notification_email_error'] = '이메일 또는 비밀번호가 올바르지 않습니다. 다시 시도하세요!';
$lang['notification_check_email'] = '사용자 이름 또는 이메일이 올바르지 않습니다. 다시 시도하세요!';
$lang['notification_checking'] = '확인 중...';
$lang['notification_redirection'] = '계정에 연결 중...';
$lang['notification_new_account'] = '새 계정이 생성되었습니다. 로그인 페이지로 이동 중...';
$lang['notification_email_sent'] = '이메일이 전송되었습니다. 이메일을 확인하세요...';
$lang['notification_account_activation'] = '이메일이 전송되었습니다. 계정 활성화를 위해 이메일을 확인하세요.';
$lang['notification_captcha_error'] = '자동 확인 코드를 확인하세요';
$lang['notification_password_lenght_error'] = '비밀번호 길이가 올바르지 않습니다. 5자에서 16자 사이의 비밀번호를 사용하세요';
$lang['notification_account_already_exist'] = '이 계정은 이미 존재합니다';
$lang['notification_password_not_match'] = '비밀번호가 일치하지 않습니다';
$lang['notification_same_password'] = '비밀번호가 동일합니다.';
$lang['notification_currentpass_not_match'] = '이전 비밀번호가 일치하지 않습니다';
$lang['notification_usernamepass_not_match'] = '이 사용자 이름에 대한 비밀번호가 일치하지 않습니다';
$lang['notification_used_email'] = '사용 중인 이메일';
$lang['notification_email_not_match'] = '이메일이 일치하지 않습니다';
$lang['notification_username_not_match'] = '사용자 이름이 일치하지 않습니다';
$lang['notification_expansion_not_found'] = '확장팩을 찾을 수 없습니다';
$lang['notification_valid_key'] = '계정 활성화됨';
$lang['notification_valid_key_desc'] = '이제 계정으로 로그인할 수 있습니다.';
$lang['notification_invalid_key'] = '제공된 활성화 키가 유효하지 않습니다.';

/*일반 알림 메시지 언어*/
$lang['notification_email_changed'] = '이메일이 변경되었습니다.';
$lang['notification_username_changed'] = '사용자 이름이 변경되었습니다.';
$lang['notification_password_changed'] = '비밀번호가 변경되었습니다.';
$lang['notification_avatar_changed'] = '아바타가 변경되었습니다.';
$lang['notification_wrong_values'] = '값이 잘못되었습니다';
$lang['notification_select_type'] = '유형을 선택하세요';
$lang['notification_select_priority'] = '우선순위를 선택하세요';
$lang['notification_select_category'] = '카테고리를 선택하세요';
$lang['notification_select_realm'] = '렐름을 선택하세요';
$lang['notification_select_character'] = '캐릭터를 선택하세요';
$lang['notification_select_item'] = '아이템을 선택하세요';
$lang['notification_report_created'] = '신고가 작성되었습니다.';
$lang['notification_title_empty'] = '제목이 비어 있습니다';
$lang['notification_description_empty'] = '설명이 비어 있습니다';
$lang['notification_name_empty'] = '이름이 비어 있습니다';
$lang['notification_id_empty'] = 'ID가 비어 있습니다';
$lang['notification_reply_empty'] = '답장이 비어 있습니다';
$lang['notification_reply_created'] = '답장이 전송되었습니다.';
$lang['notification_reply_deleted'] = '답장이 삭제되었습니다.';
$lang['notification_topic_created'] = '주제가 작성되었습니다.';
$lang['notification_donation_successful'] = '기부가 성공적으로 완료되었습니다. 계정에서 기부 포인트를 확인하세요.';
$lang['notification_donation_canceled'] = '기부가 취소되었습니다.';
$lang['notification_donation_error'] = '거래 정보가 일치하지 않습니다.';
$lang['notification_store_chars_error'] = '각 항목에서 캐릭터를 선택하세요.';
$lang['notification_store_item_insufficient_points'] = '구매할 포인트가 충분하지 않습니다.';
$lang['notification_store_item_purchased'] = '아이템이 구매되었습니다. 게임 내 메일을 확인하세요.';
$lang['notification_store_item_added'] = '선택한 아이템이 장바구니에 추가되었습니다.';
$lang['notification_store_item_removed'] = '선택한 아이템이 장바구니에서 제거되었습니다.';
$lang['notification_store_cart_error'] = '장바구니 업데이트에 실패했습니다. 다시 시도하세요.';

/*알림 메시지 (관리자) 언어*/
$lang['notification_changelog_created'] = '변경 로그가 생성되었습니다.';
$lang['notification_changelog_edited'] = '변경 로그가 편집되었습니다.';
$lang['notification_changelog_deleted'] = '변경 로그가 삭제되었습니다.';
$lang['notification_forum_created'] = '게시판이 생성되었습니다.';
$lang['notification_forum_edited'] = '게시판이 편집되었습니다.';
$lang['notification_forum_deleted'] = '게시판이 삭제되었습니다.';
$lang['notification_category_created'] = '카테고리가 생성되었습니다.';
$lang['notification_category_edited'] = '카테고리가 편집되었습니다.';
$lang['notification_category_deleted'] = '카테고리가 삭제되었습니다.';
$lang['notification_menu_created'] = '메뉴가 생성되었습니다.';
$lang['notification_menu_edited'] = '메뉴가 편집되었습니다.';
$lang['notification_menu_deleted'] = '메뉴가 삭제되었습니다.';
$lang['notification_news_deleted'] = '뉴스가 삭제되었습니다.';
$lang['notification_page_created'] = '페이지가 생성되었습니다.';
$lang['notification_page_edited'] = '페이지가 편집되었습니다.';
$lang['notification_page_deleted'] = '페이지가 삭제되었습니다.';
$lang['notification_realm_created'] = '렐름이 생성되었습니다.';
$lang['notification_realm_edited'] = '렐름이 편집되었습니다.';
$lang['notification_realm_deleted'] = '렐름이 삭제되었습니다.';
$lang['notification_slide_created'] = '슬라이드가 생성되었습니다.';
$lang['notification_slide_edited'] = '슬라이드가 편집되었습니다.';
$lang['notification_slide_deleted'] = '슬라이드가 삭제되었습니다.';
$lang['notification_item_created'] = '아이템이 생성되었습니다.';
$lang['notification_item_edited'] = '아이템이 편집되었습니다.';
$lang['notification_item_deleted'] = '아이템이 삭제되었습니다.';
$lang['notification_top_created'] = '최상위 아이템이 생성되었습니다.';
$lang['notification_top_edited'] = '최상위 아이템이 편집되었습니다.';
$lang['notification_top_deleted'] = '최상위 아이템이 삭제되었습니다.';
$lang['notification_topsite_created'] = '최상위 사이트가 생성되었습니다.';
$lang['notification_topsite_edited'] = '최상위 사이트가 편집되었습니다.';
$lang['notification_topsite_deleted'] = '최상위 사이트가 삭제되었습니다.';

$lang['notification_settings_updated'] = '설정이 업데이트되었습니다.';
$lang['notification_module_enabled'] = '모듈이 활성화되었습니다.';
$lang['notification_module_disabled'] = '모듈이 비활성화되었습니다.';
$lang['notification_migration'] = '설정이 설정되었습니다.';

$lang['notification_donation_added'] = '기부가 추가되었습니다';
$lang['notification_donation_deleted'] = '기부가 삭제되었습니다';
$lang['notification_donation_updated'] = '기부가 업데이트되었습니다';
$lang['notification_points_empty'] = '포인트가 비어 있습니다';
$lang['notification_tax_empty'] = '세금이 비어 있습니다';
$lang['notification_price_empty'] = '가격이 비어 있습니다';
$lang['notification_incorrect_update'] = '예상치 않은 업데이트';

$lang['notification_route_inuse'] = '경로는 이미 사용 중이므로 다른 경로를 선택하세요.';

$lang['notification_account_updated'] = '계정이 업데이트되었습니다.';
$lang['notification_dp_vp_empty'] = 'DP/VP가 비어 있습니다';
$lang['notification_account_banned'] = '계정이 차단되었습니다.';
$lang['notification_reason_empty'] = '이유가 비어 있습니다';
$lang['notification_account_ban_remove'] = '계정에서의 차단이 해제되었습니다.';
$lang['notification_rank_empty'] = '등급이 비어 있습니다';
$lang['notification_rank_granted'] = '등급이 부여되었습니다.';
$lang['notification_rank_removed'] = '등급이 삭제되었습니다.';

$lang['notification_cms_updated'] = 'CMS가 업데이트되었습니다';
$lang['notification_cms_update_error'] = 'CMS를 업데이트할 수 없습니다';
$lang['notification_cms_not_updated'] = '업데이트할 새 버전을 찾을 수 없습니다';

$lang['notification_select_category'] = '하위 카테고리가 아닙니다';
$lang['notification_delete_comment_error'] = '댓글 삭제에 실패했습니다.';