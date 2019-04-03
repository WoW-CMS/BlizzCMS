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
    <link rel="stylesheet" href="<?= base_url('includes/core/amaranjs/css/amaran.min.css'); ?>"/>
  </head>
  <body>
    <header class="uk-background-primary">
      <div class="uk-container">
        <nav class="uk-navbar" uk-navbar>
          <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo" href="<?= base_url('admin'); ?>">BlizzCMS<sup class="uk-text-success">+</sup></a>
            <div class="uk-navbar-item"><span class="rev-label">Version: 1.0.X</span></div>
          </div>
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav uk-visible@m">
              <li><a href="<?= base_url(); ?>"><i class="fas fa-home fa-lg"></i></a></li>
              <li>
                <a href="javascript:void(0)">
                  <?php if($this->m_general->getUserInfoGeneral($this->session->userdata('fx_sess_id'))->num_rows()) { ?>
                  <img class="uk-border-rounded profile-img" src="<?= base_url('includes/images/profiles/').$this->m_data->getNameAvatar($this->m_data->getImageProfile($this->session->userdata('fx_sess_id'))); ?>" alt="">
                  <?php } else { ?>
                  <img class="uk-border-rounded profile-img" src="<?= base_url('includes/images/profiles/default.png'); ?>"  alt="">
                  <?php } ?>
                  <span class="uk-text-middle uk-text-bold"><?= $this->session->userdata('fx_sess_username'); ?><span uk-icon="icon: triangle-down"></span></span>
                </a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('button_user_panel'); ?></a></li>
                    <li><a href="<?= base_url('settings'); ?>"><i class="fas fa-cog"></i> Panel de Moderación</a></li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="<?= base_url('logout'); ?>"><i class="fas fa-sign-out-alt"></i> <?= $this->lang->line('button_logout'); ?></a></li>
                  </ul>
                </div>
              </li>
            </ul>
            <a class="uk-navbar-toggle uk-hidden@m" uk-navbar-toggle-icon href="#admin-mobile" uk-toggle></a>
            <div class="uk-offcanvas-content">
              <div id="admin-mobile" data-uk-offcanvas="overlay: true">
                <div class="uk-offcanvas-bar">
                  <div class="sidebar-head uk-text-center">
                    <a class="uk-logo" href="<?= base_url('admin'); ?>">BlizzCMS<sup class="uk-text-success">+</sup></a>
                  </div>
                  <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                    <li><a href="<?= base_url('admin'); ?>"><span class="uk-margin-small-right"><i class="fas fa-tachometer-alt"></i></span><?= $this->lang->line('admin_nav_dashboard'); ?></a></li>
                    <li class="uk-parent">
                      <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-sliders-h"></i></span><?= $this->lang->line('admin_nav_settings'); ?></a>
                      <ul class="uk-nav-sub">
                        <li><a href="<?= base_url('admin/settings'); ?>"><span class="admin-subnav-icon"><i class="fas fa-cogs"></i></span><?= $this->lang->line('admin_nav_website_settings'); ?></a></li>
                        <li><a href="<?= base_url('admin/modules'); ?>"><span class="admin-subnav-icon"><i class="fas fa-puzzle-piece"></i></span><?= $this->lang->line('admin_nav_manage_modules'); ?></a></li>
                        <li><a href="<?= base_url('admin/realms'); ?>"><span class="admin-subnav-icon"><i class="fas fa-server"></i></span><?= $this->lang->line('admin_nav_manage_realms'); ?></a></li>
                        <li><a href="<?= base_url('admin/slides'); ?>"><span class="admin-subnav-icon"><i class="fas fa-images"></i></span><?= $this->lang->line('admin_nav_manage_slides'); ?></a></li>
                      </ul>
                    </li>
                    <li class="uk-parent">
                      <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-users"></i></span><?= $this->lang->line('admin_nav_users'); ?></a>
                      <ul class="uk-nav-sub">
                        <li><a href="<?= base_url('admin/accounts'); ?>"><span class="admin-subnav-icon"><i class="fas fa-list-ul"></i></span><?= $this->lang->line('admin_nav_users_list'); ?></a></li>
                        <li><a href="<?= base_url('admin/characters'); ?>"><span class="admin-subnav-icon"><i class="fas fa-list-ul"></i></span><?= $this->lang->line('admin_nav_chars_list'); ?></a></li>
                      </ul>
                    </li>
                    <li class="uk-parent">
                      <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-mouse-pointer"></i></span><?= $this->lang->line('admin_nav_website'); ?></a>
                      <ul class="uk-nav-sub">
                        <li><a href="<?= base_url('admin/news'); ?>"><span class="admin-subnav-icon"><i class="fas fa-newspaper"></i></span><?= $this->lang->line('admin_nav_news'); ?></a></li>
                        <li><a href="<?= base_url('admin/changelogs'); ?>"><span class="admin-subnav-icon"><i class="fas fa-scroll"></i></span><?= $this->lang->line('admin_nav_changelogs'); ?></a></li>
                        <li><a href="<?= base_url('admin/pages'); ?>"><span class="admin-subnav-icon"><i class="fas fa-file-alt"></i></span><?= $this->lang->line('admin_nav_pages'); ?></a></li>
                        <li><a href="<?= base_url('admin/faq'); ?>"><span class="admin-subnav-icon"><i class="fas fa-question-circle"></i></span><?= $this->lang->line('admin_nav_faq'); ?></a></li>
                        <li><a href="<?= base_url('admin/donate'); ?>"><span class="admin-subnav-icon"><i class="fab fa-paypal"></i></span><?= $this->lang->line('admin_nav_donations'); ?></a></li>
                        <li><a href="<?= base_url('admin/topsites'); ?>"><span class="admin-subnav-icon"><i class="fas fa-tasks"></i></span><?= $this->lang->line('admin_nav_topsites'); ?></a></li>
                      </ul>
                    </li>
                    <li class="uk-parent">
                      <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-store"></i></span><?= $this->lang->line('admin_nav_store'); ?></a>
                      <ul class="uk-nav-sub">
                        <li><a href="<?= base_url('admin/groups'); ?>"><span class="admin-subnav-icon"><i class="fas fa-tags"></i></span><?= $this->lang->line('admin_nav_manage_groups'); ?></a></li>
                        <li><a href="<?= base_url('admin/items'); ?>"><span class="admin-subnav-icon"><i class="fas fa-boxes"></i></span><?= $this->lang->line('admin_nav_manage_items'); ?></a></li>
                      </ul>
                    </li>
                    <li class="uk-parent">
                      <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-comments"></i></span><?= $this->lang->line('admin_nav_forum'); ?></a>
                      <ul class="uk-nav-sub">
                        <li><a href="<?= base_url('admin/categories'); ?>"><span class="admin-subnav-icon"><i class="fas fa-bookmark"></i></span><?= $this->lang->line('admin_nav_manage_categories'); ?></a></li>
                        <li><a href="<?= base_url('admin/forums'); ?>"><span class="admin-subnav-icon"><i class="fas fa-comment-dots"></i></span><?= $this->lang->line('admin_nav_manege_forums'); ?></a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <nav class="uk-navbar-container uk-visible@m">
      <div class="uk-container">
        <div class="uk-navbar" uk-navbar="mode: click">
          <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
              <li class="uk-active"><a href="<?= base_url('admin'); ?>"><span class="uk-margin-small-right"><i class="fas fa-tachometer-alt"></i></span><?= $this->lang->line('admin_nav_dashboard'); ?></a></li>
              <li>
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-sliders-h"></i></span><?= $this->lang->line('admin_nav_settings'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('admin/settings'); ?>"><span class="admin-subnav-icon"><i class="fas fa-cogs"></i></span><?= $this->lang->line('admin_nav_website_settings'); ?></a></li>
                    <li><a href="<?= base_url('admin/modules'); ?>"><span class="admin-subnav-icon"><i class="fas fa-puzzle-piece"></i></span><?= $this->lang->line('admin_nav_manage_modules'); ?></a></li>
                    <li><a href="<?= base_url('admin/realms'); ?>"><span class="admin-subnav-icon"><i class="fas fa-server"></i></span><?= $this->lang->line('admin_nav_manage_realms'); ?></a></li>
                    <li><a href="<?= base_url('admin/slides'); ?>"><span class="admin-subnav-icon"><i class="fas fa-images"></i></span><?= $this->lang->line('admin_nav_manage_slides'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-users"></i></span><?= $this->lang->line('admin_nav_users'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('admin/accounts'); ?>"><span class="admin-subnav-icon"><i class="fas fa-list-ul"></i></span><?= $this->lang->line('admin_nav_users_list'); ?></a></li>
                    <li><a href="<?= base_url('admin/characters'); ?>"><span class="admin-subnav-icon"><i class="fas fa-list-ul"></i></span><?= $this->lang->line('admin_nav_chars_list'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="javascript:void(0)"><span class="uk-margin-small-right" ><i class="fas fa-mouse-pointer"></i></span><?= $this->lang->line('admin_nav_website'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('admin/news'); ?>"><span class="admin-subnav-icon"><i class="fas fa-newspaper"></i></span><?= $this->lang->line('admin_nav_news'); ?></a></li>
                    <li><a href="<?= base_url('admin/changelogs'); ?>"><span class="admin-subnav-icon"><i class="fas fa-scroll"></i></span><?= $this->lang->line('admin_nav_changelogs'); ?></a></li>
                    <li><a href="<?= base_url('admin/pages'); ?>"><span class="admin-subnav-icon"><i class="fas fa-file-alt"></i></span><?= $this->lang->line('admin_nav_pages'); ?></a></li>
                    <li><a href="<?= base_url('admin/faq'); ?>"><span class="admin-subnav-icon"><i class="fas fa-question-circle"></i></span><?= $this->lang->line('admin_nav_faq'); ?></a></li>
                    <li><a href="<?= base_url('admin/donate'); ?>"><span class="admin-subnav-icon"><i class="fab fa-paypal"></i></span><?= $this->lang->line('admin_nav_donations'); ?></a></li>
                    <li><a href="<?= base_url('admin/topsites'); ?>"><span class="admin-subnav-icon"><i class="fas fa-tasks"></i></span><?= $this->lang->line('admin_nav_topsites'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                 <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-store"></i></span><?= $this->lang->line('admin_nav_store'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('admin/groups'); ?>"><span class="admin-subnav-icon"><i class="fas fa-tags"></i></span><?= $this->lang->line('admin_nav_manage_groups'); ?></a></li>
                    <li><a href="<?= base_url('admin/items'); ?>"><span class="admin-subnav-icon"><i class="fas fa-boxes"></i></span><?= $this->lang->line('admin_nav_manage_items'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-comments"></i></span><?= $this->lang->line('admin_nav_forum'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('admin/categories'); ?>"><span class="admin-subnav-icon"><i class="fas fa-bookmark"></i></span><?= $this->lang->line('admin_nav_manage_categories'); ?></a></li>
                    <li><a href="<?= base_url('admin/forums'); ?>"><span class="admin-subnav-icon"><i class="fas fa-comment-dots"></i></span><?= $this->lang->line('admin_nav_manege_forums'); ?></a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
          <div class="uk-navbar-right"></div>
        </div>
      </div>
    </nav>
