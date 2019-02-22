<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?= base_url('theme/'.$this->config->item('theme_name').'/images/favicon.ico'); ?>">
    <title><?= $this->config->item('ProjectName'); ?> | <?= $this->lang->line('button_admin_panel'); ?></title>
    <link rel="stylesheet" href="<?= base_url('includes/core/uikit/css/uikit.min.css'); ?>"/>
    <script src="<?= base_url('includes/core/uikit/js/uikit.min.js'); ?>"></script>
    <script src="<?= base_url('includes/core/uikit/js/uikit-icons.min.js'); ?>"></script>
    <script src="<?= base_url('includes/core/fontawesome/js/all.js'); ?>" defer></script>
    <link rel="stylesheet" href="<?= base_url('includes/core/css/admin.css'); ?>"/>
    <script src="<?= base_url('includes/core/js/jquery-3.3.1.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?= base_url('includes/core/amaranjs/css/amaran.min.css') ?>"/>
  </head>
  <body>
    <aside class="admin-sidebar uk-visible@m">
      <div class="sidebar-head uk-text-center">
        <a class="uk-logo" href="<?= base_url('admin'); ?>">BlizzCMS</a>
      </div>
      <div class="uk-position-relative">
        <ul class="uk-nav-default uk-nav-parent-icon" data-uk-nav>
          <li><a href="<?= base_url('admin'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: home"></span> <?= $this->lang->line('admin_dashboard'); ?></a></li>
          <li class="uk-parent">
            <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: settings"></span> <?= $this->lang->line('admin_settings'); ?></a>
            <ul class="uk-nav-sub">
              <li><a href="<?= base_url('admin/settings'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: cog"></span><?= $this->lang->line('admin_website_settings'); ?></a></li>
              <li><a href="<?= base_url('admin/managerealms'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: server"></span><?= $this->lang->line('admin_manage_realms'); ?></a></li>
              <li><a href="<?= base_url('admin/manageslides'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: image"></span><?= $this->lang->line('admin_manage_slides'); ?></a></li>
            </ul>
          </li>
          <li class="uk-parent">
            <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: users"></span> <?= $this->lang->line('admin_users'); ?></a>
            <ul class="uk-nav-sub">
              <li><a href="<?= base_url('admin/accounts'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_users_list'); ?></a></li>
              <li><a href="<?= base_url('admin/characters'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_chars_list'); ?></a></li>
            </ul>
          </li>
          <li class="uk-parent">
            <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: thumbnails"></span> <?= $this->lang->line('admin_website'); ?></a>
            <ul class="uk-nav-sub">
              <li><a href="<?= base_url('admin/managenews'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: file-text"></span><?= $this->lang->line('admin_news'); ?></a></li>
              <li><a href="<?= base_url('admin/managechangelogs'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: history"></span><?= $this->lang->line('admin_changelogs'); ?></a></li>
              <li><a href="<?= base_url('admin/managepages'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: file"></span><?= $this->lang->line('admin_pages'); ?></a></li>
              <li><a href="<?= base_url('admin/managefaq'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: question"></span><?= $this->lang->line('admin_faq'); ?></a></li>
            </ul>
          </li>
          <li class="uk-parent">
            <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: cart"></span> <?= $this->lang->line('admin_store'); ?></a>
            <ul class="uk-nav-sub">
              <li><a href="<?= base_url('admin/managegroups'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_manage_groups'); ?></a></li>
              <li><a href="<?= base_url('admin/manageitems'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_manage_items'); ?></a></li>
            </ul>
          </li>
          <li class="uk-parent">
            <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: grid"></span> <?= $this->lang->line('admin_points_system'); ?></a>
            <ul class="uk-nav-sub">
              <li><a href="<?= base_url('admin/donate'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: credit-card"></span><?= $this->lang->line('admin_manage_donations'); ?></a></li>
              <li><a href="<?= base_url('admin/managetopsites'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: star"></span><?= $this->lang->line('admin_manage_topsites'); ?></a></li>
            </ul>
          </li>
          <li class="uk-parent">
            <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: comments"></span> <?= $this->lang->line('admin_forums'); ?></a>
            <ul class="uk-nav-sub">
              <li><a href="<?= base_url('admin/managecategories'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_manage_categories'); ?></a></li>
              <li><a href="<?= base_url('admin/manageforums'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_manege_forums'); ?></a></li>
            </ul>
          </li>
        </ul>
      </div>
    </aside>
    <div class="admin-content">
      <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar="mode: click">
        <div class="uk-navbar-left"></div>
        <div class="uk-navbar-right">
          <ul class="uk-navbar-nav">
            <li>
              <a href="javascript:void(0)">
                <?php if($this->m_general->getUserInfoGeneral($this->session->userdata('fx_sess_id'))->num_rows()) { ?>
                <img class="uk-border-circle profile-img" src="<?= base_url('includes/images/profiles/').$this->m_data->getNameAvatar($this->m_data->getImageProfile($this->session->userdata('fx_sess_id'))); ?>" alt="">
                <?php } else { ?>
                <img class="uk-border-circle profile-img" src="<?= base_url('includes/images/profiles/default.png'); ?>"  alt="">
                <?php } ?>
                <span class="uk-text-middle uk-text-bold"><?= $this->session->userdata('fx_sess_username'); ?><i class="fas fa-caret-down"></i></span>
              </a>
              <div class="uk-navbar-dropdown">
                <ul class="uk-nav uk-navbar-dropdown-nav">
                  <li><a href="<?= base_url(); ?>"><span data-uk-icon="icon: home"></span> Visit Site</a></li>
                  <li><a href="<?= base_url('panel'); ?>"><span data-uk-icon="icon: settings"></span> <?= $this->lang->line('button_user_panel'); ?></a></li>
                </ul>
              </div>
            </li>
          </ul>
          <div class="uk-navbar-item">
            <a href="<?= base_url('logout'); ?>" class="uk-icon-button" uk-icon="icon: sign-out"></a>
          </div>
          <a class="uk-navbar-toggle uk-hidden@m" uk-navbar-toggle-icon href="#admin-mobile" uk-toggle></a>
          <div class="uk-offcanvas-content">
            <div id="admin-mobile" data-uk-offcanvas="overlay: true">
              <div class="uk-offcanvas-bar">
                <div class="sidebar-head uk-text-center">
                  <a class="uk-logo" href="<?= base_url('admin'); ?>">BlizzCMS</a>
                </div>
                <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                  <li><a href="<?= base_url('admin'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: home"></span> <?= $this->lang->line('admin_dashboard'); ?></a></li>
                  <li class="uk-parent">
                    <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: settings"></span> <?= $this->lang->line('admin_settings'); ?></a>
                    <ul class="uk-nav-sub">
                      <li><a href="<?= base_url('admin/settings'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: cog"></span><?= $this->lang->line('admin_website_settings'); ?></a></li>
                      <li><a href="<?= base_url('admin/managerealms'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: server"></span><?= $this->lang->line('admin_manage_realms'); ?></a></li>
                      <li><a href="<?= base_url('admin/manageslides'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: image"></span><?= $this->lang->line('admin_manage_slides'); ?></a></li>
                    </ul>
                  </li>
                  <li class="uk-parent">
                    <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: users"></span> <?= $this->lang->line('admin_users'); ?></a>
                    <ul class="uk-nav-sub">
                      <li><a href="<?= base_url('admin/accounts'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_users_list'); ?></a></li>
                      <li><a href="<?= base_url('admin/characters'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_chars_list'); ?></a></li>
                    </ul>
                  </li>
                  <li class="uk-parent">
                    <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: thumbnails"></span> <?= $this->lang->line('admin_website'); ?></a>
                    <ul class="uk-nav-sub">
                      <li><a href="<?= base_url('admin/managenews'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: file-text"></span><?= $this->lang->line('admin_news'); ?></a></li>
                      <li><a href="<?= base_url('admin/managechangelogs'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: history"></span><?= $this->lang->line('admin_changelogs'); ?></a></li>
                      <li><a href="<?= base_url('admin/managepages'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: file"></span><?= $this->lang->line('admin_pages'); ?></a></li>
                      <li><a href="<?= base_url('admin/managefaq'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: question"></span><?= $this->lang->line('admin_faq'); ?></a></li>
                    </ul>
                  </li>
                  <li class="uk-parent">
                    <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: cart"></span> <?= $this->lang->line('admin_store'); ?></a>
                    <ul class="uk-nav-sub">
                      <li><a href="<?= base_url('admin/managegroups'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_manage_groups'); ?></a></li>
                      <li><a href="<?= base_url('admin/manageitems'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_manage_items'); ?></a></li>
                    </ul>
                  </li>
                  <li class="uk-parent">
                    <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: grid"></span> <?= $this->lang->line('admin_points_system'); ?></a>
                    <ul class="uk-nav-sub">
                      <li><a href="<?= base_url('admin/donate'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: credit-card"></span><?= $this->lang->line('admin_manage_donations'); ?></a></li>
                      <li><a href="<?= base_url('admin/managetopsites'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: star"></span><?= $this->lang->line('admin_manage_topsites'); ?></a></li>
                    </ul>
                  </li>
                  <li class="uk-parent">
                    <a href="javascript:void(0)"><span class="uk-margin-small-right" data-uk-icon="icon: comments"></span> <?= $this->lang->line('admin_forums'); ?></a>
                    <ul class="uk-nav-sub">
                      <li><a href="<?= base_url('admin/managecategories'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_manage_categories'); ?></a></li>
                      <li><a href="<?= base_url('admin/manageforums'); ?>"><span class="uk-margin-small-right" data-uk-icon="icon: list"></span><?= $this->lang->line('admin_manege_forums'); ?></a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
