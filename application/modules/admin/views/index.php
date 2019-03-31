      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <div class="uk-grid uk-grid-collapse uk-grid-match uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m" data-uk-grid>
            <div>
              <div class="uk-card uk-card-secondary">
                <div class="uk-card-body uk-text-center">
                  <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><?= $this->lang->line('count_accounts_created'); ?></h5>
                  <hr class="uk-hr uk-margin-small-top uk-margin-remove-bottom">
                  <h1 class="uk-h1 uk-margin-small"><span class="uk-margin-small-right"><i class="fas fa-user-friends"></i></span><span class="counter uk-text-success" data-count="<?= $this->admin_model->getAccCreated(); ?>">0</span></h1>
                  <p class="uk-text-small uk-margin-remove"><?= $this->lang->line('total_accounts_registered'); ?></p>
                </div>
              </div>
            </div>
            <div>
              <div class="uk-card uk-card-secondary">
                <div class="uk-card-body uk-text-center">
                  <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><?= $this->lang->line('count_accounts_banned'); ?></h5>
                  <hr class="uk-hr uk-margin-small-top uk-margin-remove-bottom">
                  <h1 class="uk-h1 uk-margin-small"><span class="uk-margin-small-right"><i class="fas fa-user-slash"></i></span><span class="counter uk-text-danger" data-count="<?= $this->admin_model->getBanCount(); ?>">0</span></h1>
                  <p class="uk-text-small uk-margin-remove"><?= $this->lang->line('total_accounts_banned'); ?></p>
                </div>
              </div>
            </div>
            <div>
              <div class="uk-card uk-card-secondary">
                <div class="uk-card-body uk-text-center">
                  <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove">News Created</h5>
                  <hr class="uk-hr uk-margin-small-top uk-margin-remove-bottom">
                  <h1 class="uk-h1 uk-margin-small"><span class="uk-margin-small-right"><i class="fas fa-newspaper"></i></span><span class="counter uk-text-warning" data-count="<?= $this->admin_model->getNewsCreated(); ?>">0</span></h1>
                  <p class="uk-text-small uk-margin-remove">Total news writed</p>
                </div>
              </div>
            </div>
            <div>
              <div class="uk-card uk-card-secondary">
                <div class="uk-card-body uk-text-center">
                  <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove">Changelogs Created</h5>
                  <hr class="uk-hr uk-margin-small-top uk-margin-remove-bottom">
                  <h1 class="uk-h1 uk-margin-small"><span class="uk-margin-small-right"><i class="fas fa-scroll"></i></span><span class="counter uk-text-primary" data-count="<?= $this->admin_model->getChangelogsCreated(); ?>">0</span></h1>
                  <p class="uk-text-small uk-margin-remove">Total changelogs writed</p>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-1 uk-child-width-1-2@s" data-uk-grid>
            <?php foreach ($this->m_data->getRealms()->result() as $charsMultiRealm):
              $multiRealm = $this->m_data->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
            ?>
            <div>
              <div class="uk-card uk-card-default">
                <div class="uk-card-header">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-auto">
                      <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-server"></i></span>Realm - <?= $this->m_general->getRealmName($charsMultiRealm->realmID); ?></h4>
                    </div>
                    <div class="uk-width-expand uk-text-right">
                      <a href="<?= base_url('admin/realms'); ?>" class="uk-icon-button" uk-tooltip="<?= $this->lang->line('admin_nav_manage_realms'); ?>"><i class="fas fa-cog"></i></a>
                    </div>
                  </div>
                </div>
                <div class="uk-card-body">
                  <div class="uk-grid uk-grid-small uk-grid-divider uk-text-center" data-uk-grid>
                    <div class="uk-width-1-2">
                      <h5 class="uk-h5 uk-text-primary uk-text-bold uk-text-uppercase uk-margin-remove">Alliance Players</h5>
                      <h1 class="uk-h1 uk-margin-remove"><span class="counter" data-count="<?= $this->m_characters->getCharactersOnlineAlliance($multiRealm); ?>">0</span></h1>
                      <p class="uk-text-small uk-margin-remove">Alliances playing on realm</p>
                    </div>
                    <div class="uk-width-1-2">
                      <h5 class="uk-h5 uk-text-danger uk-text-bold uk-text-uppercase uk-margin-remove">Horde Players</h5>
                      <h1 class="uk-h1 uk-margin-remove"><span class="counter" data-count="<?= $this->m_characters->getCharactersOnlineHorde($multiRealm); ?>">0</span></h1>
                      <p class="uk-text-small uk-margin-remove">Hordes playing on realm</p>
                    </div>
                  </div>
                  <hr class="uk-divider-icon uk-margin-small">
                  <h6 class="uk-h6 uk-text-uppercase uk-margin-remove uk-text-center"><i class="fas fa-user-friends"></i> <span class="counter uk-text-bold uk-text-warning" data-count="<?= $this->m_characters->getAllCharactersOnline($multiRealm); ?>">0</span> Players playing on realm</h6>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
