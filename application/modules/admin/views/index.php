    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-card uk-card-secondary uk-card-body uk-margin-small">
          <div class="uk-grid uk-grid-collapse uk-grid-divider uk-grid-match uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m" data-uk-grid>
            <div>
              <div class="uk-text-center">
                <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><?= $this->lang->line('count_accounts_created'); ?></h5>
                <h1 class="uk-h1 uk-margin-small"><span class="blizzcms-count uk-text-primary" data-from="0" data-to="<?= $this->admin_model->getAccCreated(); ?>" data-speed="2000" data-refresh-interval="50"></span><span class="uk-margin-small-left"><i class="fas fa-user-friends"></i></span></h1>
                <p class="uk-text-small uk-margin-remove"><?= $this->lang->line('total_accounts_registered'); ?></p>
              </div>
            </div>
            <div>
              <div class="uk-text-center">
                <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><?= $this->lang->line('count_accounts_banned'); ?></h5>
                <h1 class="uk-h1 uk-margin-small"><span class="blizzcms-count uk-text-primary" data-from="0" data-to="<?= $this->admin_model->getBanCount(); ?>" data-speed="2000" data-refresh-interval="50"></span><span class="uk-margin-small-left"><i class="fas fa-user-slash"></i></span></h1>
                <p class="uk-text-small uk-margin-remove"><?= $this->lang->line('total_accounts_banned'); ?></p>
              </div>
            </div>
            <div>
              <div class="uk-text-center">
                <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><?= $this->lang->line('count_news_created'); ?></h5>
                <h1 class="uk-h1 uk-margin-small"><span class="blizzcms-count uk-text-primary" data-from="0" data-to="<?= $this->admin_model->getNewsCreated(); ?>" data-speed="2000" data-refresh-interval="50"></span><span class="uk-margin-small-left"><i class="fas fa-newspaper"></i></span></h1>
                <p class="uk-text-small uk-margin-remove"><?= $this->lang->line('total_news_writed'); ?></p>
              </div>
            </div>
            <div>
              <div class="uk-text-center">
                <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><?= $this->lang->line('count_changelogs_created'); ?></h5>
                <h1 class="uk-h1 uk-margin-small"><span class="blizzcms-count uk-text-primary" data-from="0" data-to="<?= $this->admin_model->getChangelogsCreated(); ?>" data-speed="2000" data-refresh-interval="50"></span><span class="uk-margin-small-left"><i class="fas fa-scroll"></i></span></h1>
                <p class="uk-text-small uk-margin-remove"><?= $this->lang->line('total_changelogs_writed'); ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-1 uk-child-width-1-2@s" data-uk-grid>
          <?php foreach ($this->wowrealm->getRealms()->result() as $charsMultiRealm):
            $multiRealm = $this->wowrealm->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
          ?>
          <div>
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-auto">
                    <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-server"></i></span>Realm - <?= $this->wowrealm->getRealmName($charsMultiRealm->realmID); ?></h4>
                  </div>
                  <div class="uk-width-expand uk-text-right">
                    <a href="<?= base_url('admin/realms'); ?>" class="uk-icon-button" uk-tooltip="<?= $this->lang->line('admin_nav_realms'); ?>"><i class="fas fa-cog"></i></a>
                  </div>
                </div>
              </div>
              <div class="uk-card-body">
                <div class="uk-grid uk-grid-small uk-grid-divider uk-text-center" data-uk-grid>
                  <div class="uk-width-1-2">
                    <h5 class="uk-h5 uk-text-primary uk-text-bold uk-text-uppercase uk-margin-remove"><?= $this->lang->line('info_alliance_players'); ?></h5>
                    <h1 class="uk-h1 uk-margin-remove"><span class="blizzcms-count" data-from="0" data-to="<?= $this->wowrealm->getCharactersOnlineAlliance($multiRealm); ?>" data-speed="2000" data-refresh-interval="50"></span></h1>
                    <p class="uk-text-small uk-margin-remove"><?= $this->lang->line('info_alliance_playing'); ?></p>
                  </div>
                  <div class="uk-width-1-2">
                    <h5 class="uk-h5 uk-text-danger uk-text-bold uk-text-uppercase uk-margin-remove"><?= $this->lang->line('info_horde_players'); ?></h5>
                    <h1 class="uk-h1 uk-margin-remove"><span class="blizzcms-count" data-from="0" data-to="<?= $this->wowrealm->getCharactersOnlineHorde($multiRealm); ?>" data-speed="2000" data-refresh-interval="50"></span></h1>
                    <p class="uk-text-small uk-margin-remove"><?= $this->lang->line('info_horde_playing'); ?></p>
                  </div>
                </div>
                <hr class="uk-divider-icon uk-margin-small">
                <h6 class="uk-h6 uk-text-uppercase uk-margin-remove uk-text-center"><i class="fas fa-user-friends"></i> <span class="blizzcms-count uk-text-bold uk-text-warning" data-from="0" data-to="<?= $this->wowrealm->getAllCharactersOnline($multiRealm); ?>" data-speed="2000" data-refresh-interval="50"></span> <?= $this->lang->line('info_players_playing'); ?></h6>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
