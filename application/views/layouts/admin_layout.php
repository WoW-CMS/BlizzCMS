<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $template['title']; ?></title>
    <link rel="icon" type="image/x-icon" href="<?= $template['assets'].'images/favicon.ico' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'uikit/css/uikit.min.css' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'amaranjs/css/amaran.min.css'; ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'css/panel.css' ?>">
    <script src="<?= $template['assets'].'uikit/js/uikit.min.js' ?>"></script>
    <script src="<?= $template['assets'].'uikit/js/uikit-icons.min.js' ?>"></script>
    <script src="<?= $template['assets'].'js/jquery.min.js'; ?>"></script>
    <script src="<?= $template['assets'].'fontawesome/js/all.js'; ?>" defer></script>
    <script src="<?= $template['assets'].'amaranjs/js/jquery.amaran.min.js'; ?>"></script>
  </head>
  <body>
    <header class="uk-background-primary">
      <div class="uk-container">
        <nav class="uk-navbar" uk-navbar>
          <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo" href="<?= site_url('admin'); ?>">BlizzCMS<sup class="uk-text-success">+</sup></a>
          </div>
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav uk-visible@m">
              <li><a href="<?= site_url(); ?>"><i class="fas fa-home fa-lg"></i></a></li>
              <li>
                <a href="#">
                  <img class="uk-border-circle profile-img" src="<?= $template['uploads'].'avatars/'.$this->website->user_avatar(); ?>" alt="Avatar">
                  <span class="uk-text-middle uk-text-bold"><?= $this->session->userdata('nickname'); ?><span uk-icon="icon: triangle-down"></span></span>
                </a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= site_url('user'); ?>"><i class="fas fa-user-circle"></i> <?= lang('user_panel'); ?></a></li>
                    <?php if ($this->auth->is_moderator()): ?>
                    <li><a href="<?= site_url('mod'); ?>"><i class="fas fa-gavel"></i> <?= lang('mod_panel'); ?></a></li>
                    <?php endif; ?>
                    <li class="uk-nav-divider"></li>
                    <li><a href="<?= site_url('logout'); ?>"><i class="fas fa-sign-out-alt"></i> <?= lang('logout'); ?></a></li>
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
              <a class="uk-logo" href="<?= site_url('admin'); ?>">BlizzCMS<sup class="uk-text-success">+</sup></a>
            </div>
            <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
              <li><a href="<?= site_url('admin'); ?>"><span class="uk-margin-small-right"><i class="fas fa-tachometer-alt"></i></span><?= lang('admin_nav_dashboard'); ?></a></li>
              <li class="uk-parent">
                <a href="#"><span class="uk-margin-small-right"><i class="fas fa-cogs"></i></span><?= lang('admin_nav_system'); ?></a>
                <ul class="uk-nav-sub">
                  <li><a href="<?= site_url('admin/settings'); ?>"><i class="fas fa-sliders-h"></i> <?= lang('admin_nav_manage_settings'); ?></a></li>
                  <li><a href="<?= site_url('admin/modules'); ?>"><i class="fas fa-puzzle-piece"></i> <?= lang('admin_nav_manage_modules'); ?></a></li>
                </ul>
              </li>
              <li class="uk-parent">
                <a href="#"><span class="uk-margin-small-right"><i class="fas fa-users"></i></span><?= lang('admin_nav_users'); ?></a>
                <ul class="uk-nav-sub">
                  <li><a href="<?= site_url('admin/users'); ?>"><i class="fas fa-users-cog"></i> <?= lang('admin_nav_accounts'); ?></a></li>
                </ul>
              </li>
              <li class="uk-parent">
                <a href="#"><span class="uk-margin-small-right"><i class="fas fa-mouse-pointer"></i></span><?= lang('admin_nav_website'); ?></a>
                <ul class="uk-nav-sub">
                  <li><a href="<?= site_url('admin/menu'); ?>"><i class="fas fa-link"></i> <?= lang('admin_nav_menu'); ?></a></li>
                  <li><a href="<?= site_url('admin/realms'); ?>"><i class="fas fa-server"></i> <?= lang('admin_nav_realms'); ?></a></li>
                  <li><a href="<?= site_url('admin/slides'); ?>"><i class="fas fa-images"></i> <?= lang('admin_nav_slides'); ?></a></li>
                  <li><a href="<?= site_url('admin/news'); ?>"><i class="fas fa-newspaper"></i> <?= lang('admin_nav_news'); ?></a></li>
                  <li><a href="<?= site_url('admin/changelogs'); ?>"><i class="fas fa-scroll"></i> <?= lang('admin_nav_changelogs'); ?></a></li>
                  <li><a href="<?= site_url('admin/pages'); ?>"><i class="fas fa-file-alt"></i> <?= lang('admin_nav_pages'); ?></a></li>
                </ul>
              </li>
              <li class="uk-parent">
                <a href="#"><span class="uk-margin-small-right"><i class="fas fa-store"></i></span><?= lang('admin_nav_store'); ?></a>
                <ul class="uk-nav-sub">
                  <li><a href="<?= site_url('admin/store'); ?>"><i class="fas fa-shopping-cart"></i> <?= lang('admin_nav_manage_store'); ?></a></li>
                  <li><a href="<?= site_url('admin/donate'); ?>"><i class="fas fa-donate"></i> <?= lang('admin_nav_donate_methods'); ?></a></li>
                  <li><a href="<?= site_url('admin/topsites'); ?>"><i class="fas fa-star"></i> <?= lang('admin_nav_topsites'); ?></a></li>
                </ul>
              </li>
              <li class="uk-parent">
                <a href="#"><span class="uk-margin-small-right"><i class="fas fa-comments"></i></span><?= lang('admin_nav_forum'); ?></a>
                <ul class="uk-nav-sub">
                  <li><a href="<?= site_url('admin/forum'); ?>"><i class="fas fa-bookmark"></i> <?= lang('admin_nav_manage_forum'); ?></a></li>
                </ul>
              </li>
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
              <li class="uk-active"><a href="<?= site_url('admin'); ?>"><span class="uk-margin-small-right"><i class="fas fa-tachometer-alt"></i></span><?= lang('admin_nav_dashboard'); ?></a></li>
              <li>
                <a href="#"><span class="uk-margin-small-right"><i class="fas fa-cogs"></i></span><?= lang('admin_nav_system'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= site_url('admin/settings'); ?>"><i class="fas fa-sliders-h"></i> <?= lang('admin_nav_manage_settings'); ?></a></li>
                    <li><a href="<?= site_url('admin/modules'); ?>"><i class="fas fa-puzzle-piece"></i> <?= lang('admin_nav_manage_modules'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#"><span class="uk-margin-small-right"><i class="fas fa-users"></i></span><?= lang('admin_nav_users'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= site_url('admin/users'); ?>"><i class="fas fa-users-cog"></i> <?= lang('admin_nav_accounts'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#"><span class="uk-margin-small-right" ><i class="fas fa-mouse-pointer"></i></span><?= lang('admin_nav_website'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= site_url('admin/menu'); ?>"><i class="fas fa-link"></i> <?= lang('admin_nav_menu'); ?></a></li>
                    <li><a href="<?= site_url('admin/realms'); ?>"> <i class="fas fa-server"></i> <?= lang('admin_nav_realms'); ?></a></li>
                    <li><a href="<?= site_url('admin/slides'); ?>"><i class="fas fa-images"></i> <?= lang('admin_nav_slides'); ?></a></li>
                    <li><a href="<?= site_url('admin/news'); ?>"><i class="fas fa-newspaper"></i> <?= lang('admin_nav_news'); ?></a></li>
                    <li><a href="<?= site_url('admin/changelogs'); ?>"><i class="fas fa-scroll"></i> <?= lang('admin_nav_changelogs'); ?></a></li>
                    <li><a href="<?= site_url('admin/pages'); ?>"><i class="fas fa-file-alt"></i> <?= lang('admin_nav_pages'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                 <a href="#"><span class="uk-margin-small-right"><i class="fas fa-store"></i></span><?= lang('admin_nav_store'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= site_url('admin/store'); ?>"><i class="fas fa-shopping-cart"></i> <?= lang('admin_nav_manage_store'); ?></a></li>
                    <li><a href="<?= site_url('admin/donate'); ?>"><i class="fas fa-donate"></i> <?= lang('admin_nav_donate_methods'); ?></a></li>
                    <li><a href="<?= site_url('admin/topsites'); ?>"><i class="fas fa-star"></i> <?= lang('admin_nav_topsites'); ?></a></li>
                    <li><a href="<?= site_url('admin/logs'); ?>"><i class="fas fa-receipt"></i> <?= lang('admin_nav_donate_vote_logs'); ?></a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#"><span class="uk-margin-small-right"><i class="fas fa-comments"></i></span><?= lang('admin_nav_forum'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= site_url('admin/forum'); ?>"><i class="fas fa-bookmark"></i> <?= lang('admin_nav_manage_forum'); ?></a></li>
                  </ul>
                </div>
              </li>
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
        <p class="uk-text-small uk-text-center uk-text-right@s">Copyright <i class="far fa-copyright"></i> <?= date('Y'); ?> <span class="uk-text-bold">WoW-CMS</span>. <?= lang('footer_rights'); ?></p>
      </div>
    </section>
    <script src="<?= $template['assets'].'js/jquery.countTo.js'; ?>"></script>
    <script type="text/javascript">$('.blizzcms-count').countTo();</script>
  </body>
</html>
