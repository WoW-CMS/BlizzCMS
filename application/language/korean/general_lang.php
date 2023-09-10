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

/*브라우저 탭 메뉴*/
$lang['tab_news'] = '뉴스';
$lang['tab_forum'] = '포럼';
$lang['tab_store'] = '상점';
$lang['tab_bugtracker'] = '버그 트래커';
$lang['tab_changelogs'] = '변경 로그';
$lang['tab_pvp_statistics'] = 'PvP 통계';
$lang['tab_login'] = '로그인';
$lang['tab_register'] = '등록';
$lang['tab_home'] = '홈';
$lang['tab_donate'] = '기부';
$lang['tab_vote'] = '투표';
$lang['tab_cart'] = '장바구니';
$lang['tab_account'] = '내 계정';
$lang['tab_reset'] = '비밀번호 복구';
$lang['tab_error'] = '오류 404';
$lang['tab_maintenance'] = '유지 보수';
$lang['tab_online'] = '온라인 플레이어';
$lang['tab_download'] = '다운로드';

/*패널 네비게이션 바*/
$lang['navbar_vote_panel'] = '투표 패널';
$lang['navbar_donate_panel'] = '기부 패널';

/*버튼 언어*/
$lang['button_register'] = '등록';
$lang['button_login'] = '로그인';
$lang['button_logout'] = '로그아웃';
$lang['button_forgot_password'] = '비밀번호를 잊으셨나요?';
$lang['button_user_panel'] = '사용자 패널';
$lang['button_admin_panel'] = '관리자 패널';
$lang['button_mod_panel'] = '모드 패널';
$lang['button_change_avatar'] = '아바타 변경';
$lang['button_add_personal_info'] = '개인 정보 추가';
$lang['button_create_report'] = '신고 작성';
$lang['button_new_topic'] = '새 주제';
$lang['button_edit_topic'] = '주제 편집';
$lang['button_save_changes'] = '변경 사항 저장';
$lang['button_cancel'] = '취소';
$lang['button_send'] = '보내기';
$lang['button_read_more'] = '더 읽기';
$lang['button_add_reply'] = '답장 추가';
$lang['button_remove'] = '제거';
$lang['button_create'] = '생성';
$lang['button_save'] = '저장';
$lang['button_close'] = '닫기';
$lang['button_reply'] = '답장';
$lang['button_donate'] = '기부';
$lang['button_account_settings'] = '계정 설정';
$lang['button_cart'] = '장바구니에 추가';
$lang['button_view_cart'] = '장바구니 보기';
$lang['button_checkout'] = '결제';
$lang['button_buying'] = '구매 계속하기';

/*알림 언어*/
$lang['alert_successful_purchase'] = '아이템이 성공적으로 구매되었습니다.';
$lang['alert_upload_error'] = '이미지는 jpg 또는 png 형식이어야 합니다';
$lang['alert_changelog_not_found'] = '현재 서버에는 알릴 변경 로그가 없습니다';
$lang['alert_points_insufficient'] = '포인트가 부족합니다';

/*상태 언어*/
$lang['offline'] = '오프라인';
$lang['online'] = '온라인';
$lang['unknown'] = '알 수 없음';

/*라벨 언어*/
$lang['label_open'] = '열기';
$lang['label_closed'] = '닫기';

/*양식 라벨 언어*/
$lang['label_login_info'] = '로그인 정보';

/*입력란 플레이스홀더 언어*/
$lang['placeholder_username'] = '사용자 이름';
$lang['placeholder_email'] = '이메일 주소';
$lang['placeholder_password'] = '비밀번호';
$lang['placeholder_re_password'] = '비밀번호 재입력';
$lang['placeholder_current_password'] = '현재 비밀번호';
$lang['placeholder_new_password'] = '새 비밀번호';
$lang['placeholder_new_username'] = '새 사용자 이름';
$lang['placeholder_confirm_username'] = '새 사용자 이름 확인';
$lang['placeholder_new_email'] = '새 이메일';
$lang['placeholder_confirm_email'] = '새 이메일 확인';
$lang['placeholder_create_bug_report'] = '버그 리포트 작성';
$lang['placeholder_title'] = '제목';
$lang['placeholder_type'] = '유형';
$lang['placeholder_description'] = '설명';
$lang['placeholder_url'] = 'URL';
$lang['placeholder_uri'] = '친화적인 URL (예: tos)';
$lang['placeholder_highl'] = '강조';
$lang['placeholder_lock'] = '잠금';
$lang['placeholder_subject'] = '제목';

/*테이블 헤더 언어*/
$lang['table_header_name'] = '이름';
$lang['table_header_faction'] = '파벌';
$lang['table_header_total_kills'] = '총 킬 수';
$lang['table_header_today_kills'] = '오늘 킬 수';
$lang['table_header_yesterday_kills'] = '어제 킬 수';
$lang['table_header_team_name'] = '팀 이름';
$lang['table_header_members'] = '멤버';
$lang['table_header_rating'] = '평가';
$lang['table_header_games'] = '게임';
$lang['table_header_id'] = 'ID';
$lang['table_header_status'] = '상태';
$lang['table_header_priority'] = '우선순위';
$lang['table_header_date'] = '날짜';
$lang['table_header_author'] = '작성자';
$lang['table_header_time'] = '시간';
$lang['table_header_icon'] = '아이콘';
$lang['table_header_realm'] = '렐름';
$lang['table_header_zone'] = '지역';
$lang['table_header_character'] = '캐릭터';
$lang['table_header_price'] = '가격';
$lang['table_header_item_name'] = '아이템 이름';
$lang['table_header_items'] = '아이템(들)';
$lang['table_header_quantity'] = '수량';

/*직업 언어*/
$lang['class_warrior'] = '전사';
$lang['class_paladin'] = '성기사';
$lang['class_hunter'] = '사냥꾼';
$lang['class_rogue'] = '도적';
$lang['class_priest'] = '사제';
$lang['class_dk'] = '죽음의 기사';
$lang['class_shamman'] = '주술사';
$lang['class_mage'] = '마법사';
$lang['class_warlock'] = '흑마법사';
$lang['class_monk'] = '수도사';
$lang['class_druid'] = '드루이드';
$lang['class_demonhunter'] = '악마사냥꾼';

/*파벌 언어*/
$lang['faction_alliance'] = '얼라이언스';
$lang['faction_horde'] = '호드';

/*성별 언어*/
$lang['gender_male'] = '남성';
$lang['gender_female'] = '여성';

/*종족 언어*/
$lang['race_human'] = '인간';
$lang['race_orc'] = '오크';
$lang['race_dwarf'] = '드워프';
$lang['race_night_elf'] = '나이트 엘프';
$lang['race_undead'] = '언데드';
$lang['race_tauren'] = '타우렌';
$lang['race_gnome'] = '놈';
$lang['race_troll'] = '트롤';
$lang['race_goblin'] = '고블린';
$lang['race_blood_elf'] = '블러드 엘프';
$lang['race_draenei'] = '드레나이';
$lang['race_worgen'] = '월곡인';
$lang['race_panda_neutral'] = '판다렌 (중립)';
$lang['race_panda_alli'] = '판다렌 (얼라이언스)';
$lang['race_panda_horde'] = '판다렌 (호드)';
$lang['race_nightborde'] = '나이트본';
$lang['race_void_elf'] = '보이드 엘프';
$lang['race_lightforged_draenei'] = '빛벼림 드레나이';
$lang['race_highmountain_tauren'] = '높은산 타우렌';
$lang['race_dark_iron_dwarf'] = '어둠무쇠 드워프';
$lang['race_maghar_orc'] = '마그하르 오크';
$lang['race_vulpera'] = '불페라';

/*헤더 언어*/
$lang['header_cookie_message'] = '이 웹사이트는 최상의 경험을 위해 쿠키를 사용합니다. ';
$lang['header_cookie_button'] = '알겠습니다!';

/*풋터 언어*/
$lang['footer_rights'] = '모든 권리 보유.';

/*페이지 404 언어*/
$lang['page_404_title'] = '404 페이지를 찾을 수 없음';
$lang['page_404_description'] = '찾고 있는 페이지를 찾을 수 없는 것 같습니다.';

/*패널 언어*/
$lang['panel_acc_rank'] = '계정 등급';
$lang['panel_dp'] = '기부 포인트';
$lang['panel_vp'] = '투표 포인트';
$lang['panel_expansion'] = '확장팩';
$lang['panel_member'] = '가입한 날짜';
$lang['panel_chars_list'] = '캐릭터 목록';
$lang['panel_account_details'] = '계정 상세정보';
$lang['panel_last_ip'] = '마지막 IP';
$lang['panel_change_email'] = '이메일 주소 변경';
$lang['panel_change_username'] = '사용자 이름 변경';
$lang['panel_change_password'] = '비밀번호 변경';
$lang['panel_replace_pass_by'] = '비밀번호 대체';
$lang['panel_current_username'] = '현재 사용자 이름';
$lang['panel_current_email'] = '현재 이메일 주소';
$lang['panel_replace_email_by'] = '이메일 대체';

/*홈 언어*/
$lang['home_latest_news'] = '최신 뉴스';
$lang['home_discord'] = '디스코드';
$lang['home_server_status'] = '서버 상태';
$lang['home_realm_info'] = '현재 렘은';

/*PvP 통계 언어*/
$lang['statistics_top_20'] = '상위 20';
$lang['statistics_top_2v2'] = '상위 2v2';
$lang['statistics_top_3v3'] = '상위 3v3';
$lang['statistics_top_5v5'] = '상위 5v5';

/*뉴스 언어*/
$lang['news_recent_list'] = '최근 뉴스 목록';
$lang['news_comments'] = '댓글';

/*버그 추적기 언어*/
$lang['bugtracker_report_notfound'] = '보고서를 찾을 수 없습니다';
$lang['bugtracker_answered'] = '답변자:';

/*기부 언어*/
$lang['donate_get'] = '획득';

/*투표 언어*/
$lang['vote_next_time'] = '다음 투표까지:';

/*포럼 언어*/
$lang['forum_posts_count'] = '게시물';
$lang['forum_topic_locked'] = '이 주제는 잠겨 있습니다.';
$lang['forum_comment_locked'] = '말할 게 있나요? 대화에 참여하려면 로그인하세요.';
$lang['forum_comment_header'] = '대화 참여하기';
$lang['forum_not_authorized'] = '권한 없음';
$lang['forum_post_history'] = '게시물 기록 보기';
$lang['forum_topic_list'] = '주제 목록';
$lang['forum_last_activity'] = '최신 활동';
$lang['forum_last_post_by'] = '마지막 게시자:';
$lang['forum_whos_online'] = '온라인 사용자';
$lang['forum_replies_count'] = '답변';
$lang['forum_topics_count'] = '주제';
$lang['forum_users_count'] = '사용자';

/*상점 언어*/
$lang['store_categories'] = '상점 카테고리';
$lang['store_top_items'] = '인기 아이템';
$lang['store_cart_added'] = '추가하셨습니다';
$lang['store_cart_in_your'] = '장바구니에';
$lang['store_cart_no_items'] = '장바구니에 아이템이 없습니다.';

/*SOAP 언어*/
$lang['soap_send_subject'] = '상점 구매';
$lang['soap_send_body'] = '저희 상점에서 구매해 주셔서 감사합니다!';

/*이메일 언어*/
$lang['email_password_recovery'] = '비밀번호 복구';
$lang['email_account_activation'] = '계정 활성화';
