<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $template['title']; ?></title>
    <link rel="icon" type="image/x-icon" href="<?= $template['assets'].'images/favicon.ico' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'uikit/css/uikit.min.css' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'css/panel.css' ?>">
    <script src="<?= $template['assets'].'uikit/js/uikit.min.js' ?>"></script>
    <script src="<?= $template['assets'].'uikit/js/uikit-icons.min.js' ?>"></script>
    <script src="<?= $template['assets'].'js/jquery.min.js'; ?>"></script>
    <script src="<?= $template['assets'].'fontawesome/js/all.js'; ?>" defer></script>
  </head>
  <body>
    <header class="uk-background-primary">
      <div class="uk-container">
        <nav class="uk-navbar" uk-navbar>
          <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo" href="<?= site_url('mod'); ?>">BlizzCMS<sup class="uk-text-success">+</sup></a>
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
                    <?php if($this->auth->is_admin()): ?>
                    <li><a href="<?= site_url('admin'); ?>"><i class="fas fa-cog"></i> <?= lang('admin_panel'); ?></a></li>
                    <?php endif; ?>
                    <li class="uk-nav-divider"></li>
                    <li><a href="<?= site_url('logout'); ?>"><i class="fas fa-sign-out-alt"></i> <?= lang('logout'); ?></a></li>
                  </ul>
                </div>
              </li>
            </ul>
            <a class="uk-navbar-toggle uk-hidden@m" uk-navbar-toggle-icon href="#mod-mobile" uk-toggle></a>
            <div class="uk-offcanvas-content">
              <div id="mod-mobile" data-uk-offcanvas="overlay: true">
                <div class="uk-offcanvas-bar">
                  <div class="sidebar-head uk-text-center">
                    <a class="uk-logo" href="<?= site_url('mod'); ?>">BlizzCMS<sup class="uk-text-success">+</sup></a>
                  </div>
                  <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                    <li><a href="<?= site_url('mod'); ?>"><span class="uk-margin-small-right"><i class="fas fa-tachometer-alt"></i></span><?= lang('admin_nav_dashboard'); ?></a></li>
                    <li class="uk-parent">
                      <a href="#"><span class="uk-margin-small-right"><i class="fas fa-comment-alt"></i></span>Forum and Post</a>
                      <ul class="uk-nav-sub">
                        <li><a href="<?= site_url('mod/queue'); ?>"><i class="fas fa-list-alt"></i> Moderation Queue</a></li>
                        <li><a href="<?= site_url('mod/reports'); ?>"><i class="fas fa-gavel"></i> Reports</a></li>
                        <li><a href="<?= site_url('mod/logs'); ?>"><i class="fas fa-book"></i> Moderator Logs</a></li>
                      </ul>
                    </li>
                    <li class="uk-parent">
                      <a href="#"><span class="uk-margin-small-right"><i class="fas fa-users"></i></span><?= lang('admin_nav_users'); ?></a>
                      <ul class="uk-nav-sub">
                        <li><a href="<?= site_url('mod/bannings'); ?>"><i class="fas fa-ban"></i> Bannings</a></li>
                        <li><a href="<?= site_url('mod/warnings'); ?>"><i class="fas fa-exclamation-triangle"></i> Warnings</a></li>
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
              <li class="uk-active"><a href="<?= site_url('mod'); ?>"><span class="uk-margin-small-right"><i class="fas fa-tachometer-alt"></i></span><?= lang('admin_nav_dashboard'); ?></a></li>
              <li>
                <a href="#"><span class="uk-margin-small-right"><i class="fas fa-comment-alt"></i></span>Forum and Post<span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= site_url('mod/queue'); ?>"><i class="fas fa-list-alt"></i> Moderation Queue</a></li>
                    <li><a href="<?= site_url('mod/reports'); ?>"><i class="fas fa-gavel"></i> Reports</a></li>
                    <li><a href="<?= site_url('mod/logs'); ?>"><i class="fas fa-book"></i> Guardian Logs</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#"><span class="uk-margin-small-right"><i class="fas fa-users"></i></span><?= lang('admin_nav_users'); ?><span class="uk-margin-xsmall-top" uk-icon="icon: triangle-down"></span></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= site_url('mod/bannings'); ?>"><i class="fas fa-ban"></i> Bannings</a></li>
                    <li><a href="<?= site_url('mod/warnings'); ?>"><i class="fas fa-exclamation-triangle"></i> Warnings</a></li>
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
