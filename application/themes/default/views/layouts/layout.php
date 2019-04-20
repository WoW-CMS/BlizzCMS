<!DOCTYPE html>
<html>
  <head>
    <title><?= $this->config->item('website_name'); ?> - <?= $pagetitle ?></title>
    <?= $template['metadata']; ?>
    <link rel="icon" type="image/x-icon" href="<?= $template['location'].'assets/images/favicon.ico'; ?>" />
    <link rel="stylesheet" href="<?= $template['assets'].'core/uikit/css/uikit.min.css'; ?>" />
    <link rel="stylesheet" href="<?= $template['location'].'assets/css/main.css'; ?>" />
    <script src="<?= $template['assets'].'core/uikit/js/uikit.min.js'; ?>"></script>
    <script src="<?= $template['assets'].'core/uikit/js/uikit-icons.min.js'; ?>"></script>
    <script src="<?= $template['assets'].'core/js/cookieinfo.min.js'; ?>" data-bg="#001b3c" data-fg="#ffffff" data-link="#0e86ca" data-divlink="#ffffff" data-divlinkbg="#0e86ca" data-cookie="<?= $this->config->item('website_name'); ?>-cookieinfo" data-text-align="left" data-close-text="<?= $this->lang->line('header_cookie_button'); ?>"></script>
  </head>
  <body>
    <div class="uk-navbar-container uk-navbar-transparent">
      <div class="uk-container">
        <nav class="uk-navbar" uk-navbar>
          <div class="uk-navbar-left">
            <a href="<?= base_url(); ?>" class="uk-navbar-item uk-logo uk-margin-small-right"><?= $this->config->item('website_name'); ?></a>
          </div>
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
              <?php if (!$this->wowauth->isLogged()): ?>
              <?php if($this->wowmodule->getRegisterStatus() == '1'): ?>
              <li class="uk-visible@m"><a href="<?= base_url('register'); ?>"><i class="fas fa-user-plus"></i>&nbsp;<?= $this->lang->line('button_register'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getLoginStatus() == '1'): ?>
              <li class="uk-visible@m"><a href="<?= base_url('login'); ?>"><i class="fas fa-sign-in-alt"></i>&nbsp;<?= $this->lang->line('button_login'); ?></a></li>
              <?php endif; ?>
              <?php endif; ?>
              <li class="uk-visible@m">
                <?php if ($this->wowauth->isLogged()): ?>
                  <a href="#">
                  <?php if($this->wowgeneral->getUserInfoGeneral($this->session->userdata('wow_sess_id'))->num_rows()): ?>
                  <img class="uk-border-circle" src="<?= base_url('assets/images/profiles/'.$this->wowauth->getNameAvatar($this->wowauth->getImageProfile($this->session->userdata('wow_sess_id')))); ?>" width="30" height="30" alt="Avatar">
                  <?php else: ?>
                  <img class="uk-border-circle" src="<?= base_url('assets/images/profiles/default.png'); ?>" width="30" height="30" alt="Avatar">
                  <?php endif; ?>
                  <span class="uk-text-middle uk-text-bold">&nbsp;<?= $this->session->userdata('wow_sess_username'); ?>&nbsp;<i class="fas fa-caret-down"></i></span></a>
                <?php endif; ?>
                <div class="uk-navbar-dropdown" uk-dropdown="boundary: .uk-container">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <?php if ($this->wowauth->isLogged()): ?>
                    <?php if($this->wowmodule->getUCPStatus() == '1'): ?>
                    <li><a href="<?= base_url('panel'); ?>"><i class="far fa-user-circle"></i> <?= $this->lang->line('button_user_panel'); ?></a></li>
                    <?php endif; ?>
                    <?php if($this->wowmodule->getACPStatus() == '1'): ?>
                    <?php if($this->wowauth->getIsAdmin($this->session->userdata('wow_sess_gmlevel'))): ?>
                    <li><a href="<?= base_url('admin'); ?>"><i class="fas fa-cog"></i> <?= $this->lang->line('button_admin_panel'); ?></a></li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <li><a href="<?= base_url('logout'); ?>"><i class="fas fa-sign-out-alt"></i> <?= $this->lang->line('button_logout'); ?></a></li>
                    <?php endif; ?>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <div class="uk-navbar-container">
      <div class="uk-container">
        <nav class="uk-navbar" uk-navbar="mode: click">
          <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
              <?php foreach ($this->wowgeneral->getMenu()->result() as $menulist): ?>
              <?php if($menulist->father == '1'): ?>
              <li class="uk-visible@m">
                <a href="#">
                  <i class="<?= $menulist->icon ?>"></i>&nbsp;<?= $menulist->name ?>&nbsp;<i class="fas fa-caret-down"></i>
                </a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <?php foreach ($this->wowgeneral->getMenuSon($menulist->id)->result() as $menusonlist): ?>
                      <li>
                        <?php if($menusonlist->type == '0'): ?>
                        <a href="<?= base_url($menusonlist->url); ?>">
                          <i class="<?= $menusonlist->icon ?>"></i>&nbsp;<?= $menusonlist->name ?>
                        </a>
                        <?php elseif($menusonlist->type == '1'): ?>
                        <a target="_blank" href="<?= $menusonlist->url ?>">
                          <i class="<?= $menusonlist->icon ?>"></i>&nbsp;<?= $menusonlist->name ?>
                        </a>
                        <?php endif; ?>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </li>
              <?php elseif($menulist->father == '0' && $menulist->son == '0'): ?>
              <li class="uk-visible@m">
                <?php if($menulist->type == '0'): ?>
                <a href="<?= base_url($menulist->url); ?>">
                  <i class="<?= $menulist->icon ?>"></i>&nbsp;<?= $menulist->name ?>
                </a>
                <?php elseif($menulist->type == '1'): ?>
                <a target="_blank" href="<?= $menulist->url ?>">
                  <i class="<?= $menulist->icon ?>"></i>&nbsp;<?= $menulist->name ?>
                </a>
                <?php endif; ?>
              </li>
              <?php endif; ?>
              <?php endforeach; ?>
            </ul>
            <a class="uk-navbar-toggle uk-hidden@m" uk-navbar-toggle-icon href="#mobile" uk-toggle></a>
            <div class="uk-offcanvas-content">
              <div id="mobile" uk-offcanvas="flip: true">
                <div class="uk-offcanvas-bar">
                  <button class="uk-offcanvas-close" type="button" uk-close></button>
                  <div class="uk-panel">
                    <p class="uk-logo uk-text-center uk-margin-small"><?= $this->config->item('website_name'); ?></p>
                    <?php if ($this->wowauth->isLogged()): ?>
                    <div class="uk-padding-small uk-padding-remove-vertical uk-margin-small uk-text-center">
                      <?php if($this->wowgeneral->getUserInfoGeneral($this->session->userdata('wow_sess_id'))->num_rows()): ?>
                      <img class="uk-border-circle" src="<?= base_url('assets/images/profiles/'.$this->wowauth->getNameAvatar($this->wowauth->getImageProfile($this->session->userdata('wow_sess_id')))); ?>" width="36" height="36" alt="Avatar">
                      <?php else: ?>
                      <img class="uk-border-circle" src="<?= base_url('assets/images/profiles/default.png'); ?>" width="36" height="36" alt="Avatar">
                      <?php endif; ?>
                      <span class="uk-label"><?= $this->session->userdata('wow_sess_username'); ?></span>
                    </div>
                    <?php endif; ?>
                    <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                      <?php if (!$this->wowauth->isLogged()): ?>
                      <?php if($this->wowmodule->getRegisterStatus() == '1'): ?>
                      <li><a href="<?= base_url('register'); ?>"><i class="fas fa-user-plus"></i> <?= $this->lang->line('button_register'); ?></a></li>
                      <?php endif; ?>
                      <?php if($this->wowmodule->getLoginStatus() == '1'): ?>
                      <li><a href="<?= base_url('login'); ?>"><i class="fas fa-sign-in-alt"></i> <?= $this->lang->line('button_login'); ?></a></li>
                      <?php endif; ?>
                      <?php endif; ?>
                      <?php if ($this->wowauth->isLogged()): ?>
                      <?php if($this->wowmodule->getUCPStatus() == '1'): ?>
                      <li><a href="<?= base_url('panel'); ?>"><i class="far fa-user-circle"></i> <?= $this->lang->line('button_user_panel'); ?></a></li>
                      <?php endif; ?>
                      <?php if($this->wowmodule->getACPStatus() == '1'): ?>
                      <?php if($this->wowauth->getIsAdmin($this->session->userdata('wow_sess_gmlevel'))): ?>
                      <li><a href="<?= base_url('admin'); ?>"><i class="fas fa-cog"></i> <?= $this->lang->line('button_admin_panel'); ?></a></li>
                      <?php endif; ?>
                      <?php endif; ?>
                      <li><a href="<?= base_url('logout'); ?>"><i class="fas fa-sign-out-alt"></i> <?= $this->lang->line('button_logout'); ?></a></li>
                      <?php endif; ?>
                      <?php foreach ($this->wowgeneral->getMenu()->result() as $menulist): ?>
                      <?php if($menulist->father == '1'): ?>
                      <li class="uk-parent">
                        <a href="#">
                          <i class="<?= $menulist->icon ?>"></i>&nbsp;<?= $menulist->name ?>
                        </a>
                        <ul class="uk-nav-sub">
                          <?php foreach ($this->wowgeneral->getMenuSon($menulist->id)->result() as $menusonlist): ?>
                          <li>
                            <?php if($menusonlist->type == '0'): ?>
                            <a href="<?= base_url($menusonlist->url); ?>">
                              <i class="<?= $menusonlist->icon ?>"></i>&nbsp;<?= $menusonlist->name ?>
                            </a>
                            <?php elseif($menusonlist->type == '1'): ?>
                            <a target="_blank" href="<?= $menusonlist->url ?>">
                              <i class="<?= $menusonlist->icon ?>"></i>&nbsp;<?= $menusonlist->name ?>
                            </a>
                            <?php endif; ?>
                          </li>
                          <?php endforeach; ?>
                        </ul>
                      </li>
                      <?php elseif($menulist->father == '0' && $menulist->son == '0'): ?>
                      <li>
                        <?php if($menulist->type == '0'): ?>
                        <a href="<?= base_url($menulist->url); ?>">
                          <i class="<?= $menulist->icon ?>"></i>&nbsp;<?= $menulist->name ?>
                        </a>
                        <?php elseif($menulist->type == '1'): ?>
                        <a target="_blank" href="<?= $menulist->url ?>">
                          <i class="<?= $menulist->icon ?>"></i>&nbsp;<?= $menulist->name ?>
                        </a>
                        <?php endif; ?>
                      </li>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-navbar-right">
            <?php if ($this->wowauth->isLogged()): ?>
            <div class="uk-navbar-item">
              <ul class="uk-subnav uk-subnav-divider subnav-points">
                <li><span uk-tooltip="title:<?=$this->lang->line('panel_dp'); ?>;pos: bottom"><i class="dp-icon"></i></span> <?= $this->wowgeneral->getCharDPTotal($this->session->userdata('wow_sess_id')); ?></li>
                <li><span uk-tooltip="title:<?=$this->lang->line('panel_vp'); ?>;pos: bottom"><i class="vp-icon"></i></span> <?= $this->wowgeneral->getCharVPTotal($this->session->userdata('wow_sess_id')); ?></li>
              </ul>
            </div>
            <?php endif; ?>
          </div>
        </nav>
      </div>
    </div>

    <?= $template['body']; ?>

    <section class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <div class="uk-text-center">
          <a target="_blank" href="<?= $this->config->item('social_facebook'); ?>" class="uk-icon-button uk-margin-small-right"><i class="fab fa-facebook-f"></i></a>
          <a target="_blank" href="<?= $this->config->item('social_twitter'); ?>" class="uk-icon-button uk-margin-small-right"><i class="fab fa-twitter"></i></a>
          <a target="_blank" href="<?= $this->config->item('social_youtube'); ?>" class="uk-icon-button"><i class="fab fa-youtube"></i></a>
        </div>
        <p class="uk-text-center uk-margin-small">Copyright <i class="far fa-copyright"></i> <?= date('Y'); ?> <span class="uk-text-bold"><?= $this->config->item('website_name'); ?></span>. <?= $this->lang->line('footer_rights'); ?></p>
        <p class="uk-text-small uk-margin-small uk-text-center">World of Warcraft® and Blizzard Entertainment® are all trademarks or registered trademarks of Blizzard Entertainment in the United States and/or other countries. These terms and all related materials, logos, and images are copyright © Blizzard Entertainment. This site is in no way associated with or endorsed by Blizzard Entertainment®.</p>
        <p class="uk-h6 uk-text-bold uk-text-uppercase uk-margin-small uk-text-center">Proudly powered by <a target="_blank" href="https://wow-cms.com">BlizzCMS</a></p>
      </div>
    </section>
  </body>
</html>
