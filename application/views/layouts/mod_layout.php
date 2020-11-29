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
            <a class="uk-navbar-item uk-logo" href="<?= base_url('mod'); ?>">BlizzCMS<sup class="uk-text-success">+</sup></a>
            <div class="uk-navbar-item uk-visible@s"><span class="rev-label">Moderation</span></div>
          </div>
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav uk-visible@m">
              <li><a href="<?= base_url(); ?>"><i class="fas fa-home fa-lg"></i></a></li>
              <li>
                <a href="javascript:void(0)">
                  <?php if($this->base->getUserInfoGeneral($this->session->userdata('id'))->num_rows()): ?>
                  <img class="uk-border-rounded profile-img" src="<?= base_url('assets/images/profiles/').$this->website->getNameAvatar($this->website->getImageProfile($this->session->userdata('id'))); ?>" alt="Avatar">
                  <?php else: ?>
                  <img class="uk-border-rounded profile-img" src="<?= base_url('assets/images/profiles/default.png'); ?>" alt="Avatar">
                  <?php endif; ?>
                  <span class="uk-text-middle uk-text-bold"><?= $this->session->userdata('nickname'); ?><span uk-icon="icon: triangle-down"></span></span>
                </a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= lang('button_user_panel'); ?></a></li>
                    <?php if($this->website->getIsAdmin()): ?>
                    <li><a href="<?= base_url('admin'); ?>"><i class="fas fa-cog"></i> <?= lang('button_admin_panel'); ?></a></li>
                    <?php endif; ?>
                    <li class="uk-nav-divider"></li>
                    <li><a href="<?= base_url('logout'); ?>"><i class="fas fa-sign-out-alt"></i> <?= lang('button_logout'); ?></a></li>
                  </ul>
                </div>
              </li>
            </ul>
            <a class="uk-navbar-toggle uk-hidden@m" uk-navbar-toggle-icon href="#mod-mobile" uk-toggle></a>
            <div class="uk-offcanvas-content">
              <div id="mod-mobile" data-uk-offcanvas="overlay: true">
                <div class="uk-offcanvas-bar">
                  <div class="sidebar-head uk-text-center">
                    <a class="uk-logo" href="<?= base_url('mod'); ?>">BlizzCMS<sup class="uk-text-success">+</sup></a>
                  </div>
                  <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                    <li><a href="<?= base_url('mod'); ?>"><span class="uk-margin-small-right"><i class="fas fa-tachometer-alt"></i></span><?= lang('admin_nav_dashboard'); ?></a></li>
                    <li class="uk-parent">
                      <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-comment-alt"></i></span>Forum and Post</a>
                      <ul class="uk-nav-sub">
                        <li><a href="<?= base_url('mod/queue'); ?>"><span class="admin-subnav-icon"><i class="fas fa-list-alt"></i></span>Moderation Queue</a></li>
                        <li><a href="<?= base_url('mod/reports'); ?>"><span class="admin-subnav-icon"><i class="fas fa-gavel"></i></span>Reports</a></li>
                        <li><a href="<?= base_url('mod/logs'); ?>"><span class="admin-subnav-icon"><i class="fas fa-book"></i></span>Moderator Logs</a></li>
                      </ul>
                    </li>
                    <li class="uk-parent">
                      <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-users"></i></span><?= lang('admin_nav_users'); ?></a>
                      <ul class="uk-nav-sub">
                        <li><a href="<?= base_url('mod/bannings'); ?>"><span class="admin-subnav-icon"><i class="fas fa-ban"></i></span>Bannings</a></li>
                        <li><a href="<?= base_url('mod/warnings'); ?>"><span class="admin-subnav-icon"><i class="fas fa-exclamation-triangle"></i></span>Warnings</a></li>
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
              <li class="uk-active"><a href="<?= base_url('mod'); ?>"><span class="uk-margin-small-right"><i class="fas fa-tachometer-alt"></i></span><?= lang('admin_nav_dashboard'); ?></a></li>
              <li>
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-comment-alt"></i></span>Forum and Post<span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('mod/queue'); ?>"><span class="admin-subnav-icon"><i class="fas fa-list-alt"></i></span>Moderation Queue</a></li>
                    <li><a href="<?= base_url('mod/reports'); ?>"><span class="admin-subnav-icon"><i class="fas fa-gavel"></i></span>Reports</a></li>
                    <li><a href="<?= base_url('mod/logs'); ?>"><span class="admin-subnav-icon"><i class="fas fa-book"></i></span>Guardian Logs</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="javascript:void(0)"><span class="uk-margin-small-right"><i class="fas fa-users"></i></span><?= lang('admin_nav_users'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= base_url('mod/bannings'); ?>"><span class="admin-subnav-icon"><i class="fas fa-ban"></i></span>Bannings</a></li>
                    <li><a href="<?= base_url('mod/warnings'); ?>"><span class="admin-subnav-icon"><i class="fas fa-exclamation-triangle"></i></span>Warnings</a></li>
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
    <script src="<?= base_url('assets/core/js/jquery.countTo.js'); ?>"></script>
    <script type="text/javascript">$('.blizzcms-count').countTo();</script>
  </body>
</html>
