    <div class="uk-navbar-container uk-navbar-transparent">
      <div class="uk-container">
        <nav class="uk-navbar" uk-navbar>
          <div class="uk-navbar-left">
            <a href="<?= base_url(); ?>" class="uk-navbar-item uk-logo uk-margin-small-right"><?= $this->config->item('ProjectName'); ?></a>
          </div>
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
              <?php if (!$this->m_data->isLogged()): ?>
              <?php if($this->m_modules->getRegisterStatus() == '1'): ?>
              <li class="uk-visible@m"><a href="<?= base_url('register'); ?>"><i class="fas fa-user-plus"></i>&nbsp;<?= $this->lang->line('button_register'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getLoginStatus() == '1'): ?>
              <li class="uk-visible@m"><a href="<?= base_url('login'); ?>"><i class="fas fa-sign-in-alt"></i>&nbsp;<?= $this->lang->line('button_login'); ?></a></li>
              <?php endif; ?>
              <?php endif; ?>
              <li class="uk-visible@m">
                <?php if ($this->m_data->isLogged()): ?>
                  <a href="#">
                  <?php if($this->m_general->getUserInfoGeneral($this->session->userdata('fx_sess_id'))->num_rows()): ?>
                  <img class="uk-border-circle" src="<?= base_url('includes/images/profiles/'.$this->m_data->getNameAvatar($this->m_data->getImageProfile($this->session->userdata('fx_sess_id')))); ?>" width="30" height="30" alt="Avatar">
                  <?php else: ?>
                  <img class="uk-border-circle" src="<?= base_url('includes/images/profiles/default.png'); ?>" width="30" height="30" alt="Avatar">
                  <?php endif; ?>
                  <span class="uk-text-middle uk-text-bold">&nbsp;<?= $this->session->userdata('fx_sess_username'); ?> #<?= $this->session->userdata('fx_sess_tag'); ?>&nbsp;<i class="fas fa-caret-down"></i></span></a>
                <?php endif; ?>
                <div class="uk-navbar-dropdown" uk-dropdown="boundary: .uk-container">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <?php if ($this->m_data->isLogged()): ?>
                    <?php if($this->m_modules->getUCPStatus() == '1'): ?>
                    <li><a href="<?= base_url('panel'); ?>"><i class="far fa-user-circle"></i> <?= $this->lang->line('button_user_panel'); ?></a></li>
                    <?php endif; ?>
                    <?php if($this->m_modules->getACPStatus() == '1'): ?>
                    <?php if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel'))): ?>
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
              <?php foreach ($this->m_general->getMenu()->result() as $menulist): ?>
              <?php if($menulist->father == '1'): ?>
              <li class="uk-visible@m">
                <a href="#">
                  <i class="<?= $menulist->icon ?>"></i>&nbsp;<?= $menulist->name ?>&nbsp;<i class="fas fa-caret-down"></i>
                </a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <?php foreach ($this->m_general->getMenuSon($menulist->id)->result() as $menusonlist): ?>
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
                    <p class="uk-logo uk-text-center uk-margin-small"><?= $this->config->item('ProjectName'); ?></p>
                    <?php if ($this->m_data->isLogged()): ?>
                    <div class="uk-padding-small uk-padding-remove-vertical uk-margin-small uk-text-center">
                      <?php if($this->m_general->getUserInfoGeneral($this->session->userdata('fx_sess_id'))->num_rows()): ?>
                      <img class="uk-border-circle" src="<?= base_url('includes/images/profiles/'.$this->m_data->getNameAvatar($this->m_data->getImageProfile($this->session->userdata('fx_sess_id')))); ?>" width="36" height="36" alt="Avatar">
                      <?php else: ?>
                      <img class="uk-border-circle" src="<?= base_url('includes/images/profiles/default.png'); ?>" width="36" height="36" alt="Avatar">
                      <?php endif; ?>
                      <span class="uk-label"><?= $this->session->userdata('fx_sess_username'); ?> #<?= $this->session->userdata('fx_sess_tag'); ?></span>
                    </div>
                    <?php endif; ?>
                    <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                      <?php if (!$this->m_data->isLogged()): ?>
                      <?php if($this->m_modules->getRegisterStatus() == '1'): ?>
                      <li><a href="<?= base_url('register'); ?>"><i class="fas fa-user-plus"></i> <?= $this->lang->line('button_register'); ?></a></li>
                      <?php endif; ?>
                      <?php if($this->m_modules->getLoginStatus() == '1'): ?>
                      <li><a href="<?= base_url('login'); ?>"><i class="fas fa-sign-in-alt"></i> <?= $this->lang->line('button_login'); ?></a></li>
                      <?php endif; ?>
                      <?php endif; ?>
                      <?php if ($this->m_data->isLogged()): ?>
                      <?php if($this->m_modules->getUCPStatus() == '1'): ?>
                      <li><a href="<?= base_url('panel'); ?>"><i class="far fa-user-circle"></i> <?= $this->lang->line('button_user_panel'); ?></a></li>
                      <?php endif; ?>
                      <?php if($this->m_modules->getACPStatus() == '1'): ?>
                      <?php if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel'))): ?>
                      <li><a href="<?= base_url('admin'); ?>"><i class="fas fa-cog"></i> <?= $this->lang->line('button_admin_panel'); ?></a></li>
                      <?php endif; ?>
                      <?php endif; ?>
                      <li><a href="<?= base_url('logout'); ?>"><i class="fas fa-sign-out-alt"></i> <?= $this->lang->line('button_logout'); ?></a></li>
                      <?php endif; ?>
                      <?php foreach ($this->m_general->getMenu()->result() as $menulist): ?>
                      <?php if($menulist->father == '1'): ?>
                      <li class="uk-parent">
                        <a href="#">
                          <i class="<?= $menulist->icon ?>"></i>&nbsp;<?= $menulist->name ?>
                        </a>
                        <ul class="uk-nav-sub">
                          <?php foreach ($this->m_general->getMenuSon($menulist->id)->result() as $menusonlist): ?>
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
            <?php if ($this->m_data->isLogged()): ?>
            <div class="uk-navbar-item">
              <ul class="uk-subnav uk-subnav-divider subnav-points">
                <li><span uk-tooltip="title:<?=$this->lang->line('panel_dp'); ?>;pos: bottom"><i class="dp-icon"></i></span> <?= $this->m_general->getCharDPTotal($this->session->userdata('fx_sess_id')); ?></li>
                <li><span uk-tooltip="title:<?=$this->lang->line('panel_vp'); ?>;pos: bottom"><i class="vp-icon"></i></span> <?= $this->m_general->getCharVPTotal($this->session->userdata('fx_sess_id')); ?></li>
              </ul>
            </div>
            <?php endif; ?>
          </div>
        </nav>
      </div>
    </div>
