<!DOCTYPE html>
<html>
  <head>
    <title><?= $this->config->item('website_name'); ?> - <?= $pagetitle ?></title>
    <?= $template['metadata']; ?>
    <link rel="icon" type="image/x-icon" href="<?= $template['location'].'assets/images/favicon.ico' ?>" />
    <link rel="stylesheet" href="<?= $template['assets'].'core/uikit/css/uikit.min.css' ?>" />
    <link rel="stylesheet" href="<?= $template['location'].'assets/css/main.css' ?>" />
    <script src="<?= $template['assets'].'core/uikit/js/uikit.min.js' ?>"></script>
    <script src="<?= $template['assets'].'core/uikit/js/uikit-icons.min.js' ?>"></script>
  </head>
  <body>
    <header class="uk-background-primary">
      <div class="uk-container">
        <nav class="uk-navbar" uk-navbar>
          <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo" href="<?= base_url('admin'); ?>">BlizzCMS<sup class="uk-text-success">+</sup></a>
			<div class="uk-navbar-item uk-visible@s">
				<span class="rev-label"><a href="<?= base_url('admin/cms')?>" class="uk-link-reset">Version: <?= $this->updater->latest_version() ?></a></span>
			</div>
          </div>
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav uk-visible@m">
              <li><a href="<?= base_url(); ?>"><i class="fas fa-home fa-lg"></i></a></li>
              <li>
                <a href="javascript:void(0)">
                  <?php if($this->wowgeneral->getUserInfoGeneral($this->session->userdata('wow_sess_id'))->num_rows()): ?>
                  <img class="uk-border-rounded profile-img" src="<?= base_url('assets/images/profiles/').$this->wowauth->getNameAvatar($this->wowauth->getImageProfile($this->session->userdata('wow_sess_id'))); ?>" alt="">
                  <?php else: ?>
                  <img class="uk-border-rounded profile-img" src="<?= base_url('assets/images/profiles/default.png'); ?>"  alt="">
                  <?php endif; ?>
                  <span class="uk-text-middle uk-text-bold"><?= $this->session->userdata('wow_sess_username'); ?><span uk-icon="icon: triangle-down"></span></span>
                </a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('button_user_panel'); ?></a></li>
                    <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) >= config_item('mod_access_level')): ?>
                    <li><a href="<?= base_url('mod'); ?>"><i class="fas fa-gavel"></i> <?= $this->lang->line('button_mod_panel'); ?></a></li>
                    <?php endif; ?>
                    <li class="uk-nav-divider"></li>
                    <li><a href="<?= base_url('logout'); ?>"><i class="fas fa-sign-out-alt"></i> <?= $this->lang->line('button_logout'); ?></a></li>
                  </ul>
                </div>
              </li>
            </ul>
            <a class="uk-navbar-toggle uk-hidden@m" uk-navbar-toggle-icon href="#admin-mobile" uk-toggle></a>
          </div>
        </nav>
        <div id="admin-mobile" data-uk-offcanvas="overlay: true">
          <div class="uk-offcanvas-bar">
            <div class="sidebar-head uk-text-center">
              <a class="uk-logo" href="<?= base_url('admin'); ?>">BlizzCMS<sup class="uk-text-success">+</sup></a>
              <span class="rev-label uk-margin-small-bottom"><a href="<?= base_url('admin/cms')?>" class="uk-link-reset">Version: <?= $this->updater->latest_version(); ?></a></span>
            </div>
            <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
              <li><a href="<?= base_url('admin'); ?>"><span class="uk-margin-small-right"><i class="fas fa-tachometer-alt"></i></span><?= $this->lang->line('admin_nav_dashboard'); ?></a></li>
              <li class="uk-parent">
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-cogs"></i></span><?= $this->lang->line('admin_nav_system'); ?></a>
                <ul class="uk-nav-sub">
                  <li><a href="<?= base_url('admin/settings'); ?>"><span class="admin-subnav-icon"><i class="fas fa-sliders-h"></i></span><?= $this->lang->line('admin_nav_manage_settings'); ?></a></li>
                  <li><a href="<?= base_url('admin/modules'); ?>"><span class="admin-subnav-icon"><i class="fas fa-puzzle-piece"></i></span><?= $this->lang->line('admin_nav_manage_modules'); ?></a></li>
                </ul>
              </li>
              <li class="uk-parent">
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-users"></i></span><?= $this->lang->line('admin_nav_users'); ?></a>
                <ul class="uk-nav-sub">
                  <li><a href="<?= base_url('admin/accounts'); ?>"><span class="admin-subnav-icon"><i class="fas fa-users-cog"></i></span><?= $this->lang->line('admin_nav_accounts'); ?></a></li>
                </ul>
              </li>
              <li class="uk-parent">
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-mouse-pointer"></i></span><?= $this->lang->line('admin_nav_website'); ?></a>
                <ul class="uk-nav-sub">
                  <li><a href="<?= base_url('admin/menu'); ?>"><span class="admin-subnav-icon"><i class="fas fa-link"></i></span><?= $this->lang->line('admin_nav_menu'); ?></a></li>
                  <li><a href="<?= base_url('admin/realms'); ?>"><span class="admin-subnav-icon"><i class="fas fa-server"></i></span><?= $this->lang->line('admin_nav_realms'); ?></a></li>
                  <li><a href="<?= base_url('admin/slides'); ?>"><span class="admin-subnav-icon"><i class="fas fa-images"></i></span><?= $this->lang->line('admin_nav_slides'); ?></a></li>
                  <li><a href="<?= base_url('admin/news'); ?>"><span class="admin-subnav-icon"><i class="fas fa-newspaper"></i></span><?= $this->lang->line('admin_nav_news'); ?></a></li>
                  <li><a href="<?= base_url('admin/changelogs'); ?>"><span class="admin-subnav-icon"><i class="fas fa-scroll"></i></span><?= $this->lang->line('admin_nav_changelogs'); ?></a></li>
                  <li><a href="<?= base_url('admin/pages'); ?>"><span class="admin-subnav-icon"><i class="fas fa-file-alt"></i></span><?= $this->lang->line('admin_nav_pages'); ?></a></li>
                  <li><a href="<?= base_url('admin/download'); ?>"><span class="admin-subnav-icon"><i class="fas fa-download"></i></span><?= $this->lang->line('admin_nav_download'); ?></a></li>
                </ul>
              </li>
              <li class="uk-parent">
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-store"></i></span><?= $this->lang->line('admin_nav_store'); ?></a>
                <ul class="uk-nav-sub">
                  <li><a href="<?= base_url('admin/store'); ?>"><span class="admin-subnav-icon"><i class="fas fa-shopping-cart"></i></span><?= $this->lang->line('admin_nav_manage_store'); ?></a></li>
                  <li><a href="<?= base_url('admin/donate'); ?>"><span class="admin-subnav-icon"><i class="fas fa-donate"></i></span><?= $this->lang->line('admin_nav_donate_methods'); ?></a></li>
                  <li><a href="<?= base_url('admin/topsites'); ?>"><span class="admin-subnav-icon"><i class="fas fa-star"></i></span><?= $this->lang->line('admin_nav_topsites'); ?></a></li>
                </ul>
              </li>
              <li class="uk-parent">
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-comments"></i></span><?= $this->lang->line('admin_nav_forum'); ?></a>
                <ul class="uk-nav-sub">
                  <li><a href="<?= base_url('admin/forum'); ?>"><span class="admin-subnav-icon"><i class="fas fa-bookmark"></i></span><?= $this->lang->line('admin_nav_manage_forum'); ?></a></li>
                </ul>
              </li>
              <li><a href="<?= base_url('admin/tickets'); ?>"><span class="admin-subnav-icon"><i class="fas fa-scroll"></i></span><?= $this->lang->line('admin_nav_Tickets'); ?></a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>
    <nav class="uk-navbar-container uk-visible@m">
      <div class="uk-container">
        <div class="uk-navbar" uk-navbar="mode: click">
          <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
              <li class="uk-active"><a href="<?= base_url('admin'); ?>"><span class="uk-margin-small-right"><i class="fas fa-tachometer-alt"></i></span><?= $this->lang->line('admin_nav_dashboard'); ?></a></li>
              <li>
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-cogs"></i></span><?= $this->lang->line('admin_nav_system'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('admin/settings'); ?>"><span class="admin-subnav-icon"><i class="fas fa-sliders-h"></i></span><?= $this->lang->line('admin_nav_manage_settings'); ?></a></li>
                    <li><a href="<?= base_url('admin/modules'); ?>"><span class="admin-subnav-icon"><i class="fas fa-puzzle-piece"></i></span><?= $this->lang->line('admin_nav_manage_modules'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-users"></i></span><?= $this->lang->line('admin_nav_users'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('admin/accounts'); ?>"><span class="admin-subnav-icon"><i class="fas fa-users-cog"></i></span><?= $this->lang->line('admin_nav_accounts'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="javascript:void(0)"><span class="uk-margin-small-right" ><i class="fas fa-mouse-pointer"></i></span><?= $this->lang->line('admin_nav_website'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('admin/menu'); ?>"><span class="admin-subnav-icon"><i class="fas fa-link"></i></span><?= $this->lang->line('admin_nav_menu'); ?></a></li>
                    <li><a href="<?= base_url('admin/realms'); ?>"><span class="admin-subnav-icon"><i class="fas fa-server"></i></span><?= $this->lang->line('admin_nav_realms'); ?></a></li>
                    <li><a href="<?= base_url('admin/slides'); ?>"><span class="admin-subnav-icon"><i class="fas fa-images"></i></span><?= $this->lang->line('admin_nav_slides'); ?></a></li>
                    <li><a href="<?= base_url('admin/news'); ?>"><span class="admin-subnav-icon"><i class="fas fa-newspaper"></i></span><?= $this->lang->line('admin_nav_news'); ?></a></li>
                    <li><a href="<?= base_url('admin/changelogs'); ?>"><span class="admin-subnav-icon"><i class="fas fa-scroll"></i></span><?= $this->lang->line('admin_nav_changelogs'); ?></a></li>
                    <li><a href="<?= base_url('admin/pages'); ?>"><span class="admin-subnav-icon"><i class="fas fa-file-alt"></i></span><?= $this->lang->line('admin_nav_pages'); ?></a></li>
                    <li><a href="<?= base_url('admin/download'); ?>"><span class="admin-subnav-icon"><i class="fas fa-download"></i></span><?= $this->lang->line('admin_nav_download'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                 <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-store"></i></span><?= $this->lang->line('admin_nav_store'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('admin/store'); ?>"><span class="admin-subnav-icon"><i class="fas fa-shopping-cart"></i></span><?= $this->lang->line('admin_nav_manage_store'); ?></a></li>
                    <li><a href="<?= base_url('admin/donate'); ?>"><span class="admin-subnav-icon"><i class="fas fa-donate"></i></span><?= $this->lang->line('admin_nav_donate_methods'); ?></a></li>
                    <li><a href="<?= base_url('admin/topsites'); ?>"><span class="admin-subnav-icon"><i class="fas fa-star"></i></span><?= $this->lang->line('admin_nav_topsites'); ?></a></li>
                    <li><a href="<?= base_url('admin/donate/logs'); ?>"><span class="admin-subnav-icon"><i class="fas fa-receipt"></i></span><?= $this->lang->line('admin_nav_donate_logs'); ?></a></li>
                    <li><a href="<?= base_url('admin/vote/logs'); ?>"><span class="admin-subnav-icon"><i class="fas fa-receipt"></i></span><?= $this->lang->line('admin_nav_vote_logs'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-comments"></i></span><?= $this->lang->line('admin_nav_forum'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('admin/forum'); ?>"><span class="admin-subnav-icon"><i class="fas fa-bookmark"></i></span><?= $this->lang->line('admin_nav_manage_forum'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li><a href="<?= base_url('admin/tickets'); ?>"><span class="admin-subnav-icon"><i class="fas fa-scroll"></i></span><?= $this->lang->line('admin_nav_Tickets'); ?></a></li>
            </ul>
          </div>
          <div class="uk-navbar-right"></div>
        </div>
      </div>
    </nav>

    <?= $template['body']; ?>

    <section class="uk-section uk-section-xsmall">
      <div class="uk-container uk-container-expand">
        <hr class="uk-hr">
        <p class="uk-text-small uk-text-center uk-text-right@s">Copyright <i class="far fa-copyright"></i> <?= date('Y'); ?> <span class="uk-text-bold">WoW-CMS</span>. <?= $this->lang->line('footer_rights'); ?></p>
      </div>
    </section>
    <script src="<?= base_url('assets/core/js/jquery.countTo.js'); ?>"></script>
    <script type="text/javascript">$('.blizzcms-count').countTo();</script>
  </body>
</html>
