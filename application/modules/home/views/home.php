    <section class="uk-section uk-padding-remove slider-section">
      <?php if($this->m_modules->getSlideshowStatus()): ?>
      <?php if($this->home_model->getSlides()->num_rows()): ?>
      <div class="uk-position-relative uk-visible-toggle" uk-slideshow="animation: fade;autoplay: true;autoplay-interval: 6000;min-height: 150;max-height: 300;">
        <ul class="uk-slideshow-items">
          <?php foreach ($slides as $slides): ?>
            <li>
              <img src="{slide_url}<?= $slides->image; ?>" alt="<?= $slides->title ?>" uk-cover>
              <div class="uk-container uk-position-relative uk-margin-large-top">
                <h2 class="uk-h2 uk-position-medium uk-text-left"><?= $slides->title ?></h2>
              </div>
            </li>
          <?php endforeach ?>
        </ul>
        <div class="uk-position-bottom-center uk-position-small">
          <ul class="uk-slideshow-nav uk-dotnav"></ul>
        </div>
      </div>
      <?php endif ?>
      <?php endif ?>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium uk-margin-small" data-uk-grid>
          <div class="uk-width-2-3@s">
            <?php if ($this->m_modules->getNewsStatus()): ?>
            <h4 class="uk-h4 uk-text-bold uk-text-uppercase"><i class="fas fa-newspaper fa-sm"></i> {home_latest_news}</h4>
            <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-1" data-uk-grid>
              <?php foreach ($threeNews as $newstree): ?>
              <div>
                <a href="<?= base_url('news/'.$newstree->id) ;?>" title="{button_read_more}">
                  <div class="uk-card uk-card-default news-card uk-card-hover uk-grid-collapse uk-margin" uk-grid>
                    <div class="uk-width-1-3@s uk-card-media-left uk-cover-container">
                      <img src="{news_url}<?= $newstree->image ?>" alt="<?= $newstree->title ?>" uk-cover>
                      <canvas width="500" height="250"></canvas>
                    </div>
                    <div class="uk-width-2-3@s uk-card-body">
                      <h5 class="uk-h5 uk-text-uppercase uk-text-bold uk-margin-small"><?= $newstree->title ?></h5>
                      <p class="uk-text-small uk-margin-small"><?= substr(ucfirst(strtolower(strip_tags($newstree->description))), 0, 160).' ...'; ?></p>
                    </div>
                  </div>
                </a>
              </div>
              <?php endforeach ?>
            </div>
            <?php endif ?>
          </div>
          <div class="uk-width-1-3@s">
            <?php if($this->m_modules->getRealmStatus()): ?>
            <h4 class="uk-h4 uk-text-bold uk-text-uppercase"><i class="fas fa-server fa-sm"></i> {home_server_status}</h4>
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-margin-small" data-uk-grid>
              <?php foreach ($realmsList as $charsMultiRealm): 
                $multiRealm = $this->m_data->getRealmConnectionData($charsMultiRealm->id);
              ?>
              <div>
                <div class="uk-card uk-card-default uk-card-body card-status">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-expand">
                      <h5 class="uk-h5 uk-text-bold uk-margin-small"><i class="fas fa-server"></i> Realm <?= $this->m_general->getRealmName($charsMultiRealm->realmID); ?></h5>
                    </div>
                    <div class="uk-width-auto">
                      <?php if ($this->m_data->realm_status($charsMultiRealm->realmID, $this->m_general->realmGetHostname($charsMultiRealm->realmID))): ?>
                        <div class="status-dot online" uk-tooltip="<?= $this->lang->line('online'); ?>"><span><span></span></span></div>
                      <?php else: ?>
                        <div class="status-dot offline" uk-tooltip="<?= $this->lang->line('offline'); ?>"><span><span></span></span></div>
                      <?php endif ?>
                    </div>
                  </div>
                  <?php if ($this->m_data->realm_status($charsMultiRealm->realmID, $this->m_general->realmGetHostname($charsMultiRealm->realmID))): ?>
                  <div class="uk-grid uk-grid-collapse uk-margin-small" data-uk-grid>
                    <div class="uk-width-1-2">
                      <div class="uk-tile alliance-bar uk-text-center" uk-tooltip="<?= $this->lang->line('faction_alliance'); ?>">
                        <i class="fas fa-users"></i>
                        <?= $this->m_characters->getCharactersOnlineAlliance($multiRealm); ?>
                      </div>
                    </div>
                    <div class="uk-width-1-2">
                      <div class="uk-tile horde-bar uk-text-center" uk-tooltip="<?= $this->lang->line('faction_horde'); ?>">
                        <i class="fas fa-users"></i>
                        <?= $this->m_characters->getCharactersOnlineHorde($multiRealm); ?>
                      </div>
                    </div>
                  </div>
                  <?php else: ?>
                  <p class="uk-text-small uk-margin-small"><i class="fas fa-exclamation-circle"></i> <?= $this->lang->line('realm_notification'); ?> <span class="uk-text-danger uk-text-bold uk-text-uppercase"><?= $this->lang->line('offline'); ?></span></p>
                  <?php endif ?>
                </div>
              </div>
              <?php endforeach ?>
            </div>
            <h5 class="uk-h5 uk-text-center uk-margin dotted-divider">
              <?php if ($this->m_general->getExpansionAction() == 1): ?>
              <i class="fas fa-gamepad"></i> Set Realmlist {conf_realmlist}
              <?php else: ?>
              <i class="fas fa-gamepad"></i> Set Portal "{conf_realmlist}"
              <?php endif ?>
            </h5>
            <?php endif ?>
            <?php if ($this->m_modules->getDiscordStatus() == '1' && $this->config->item('discordType') == '1'): ?>
            <h4 class="uk-h4 uk-text-bold uk-text-uppercase"><i class="fab fa-discord fa-sm"></i> <?= $this->lang->line('home_discord'); ?></h4>
            <div class="uk-text-center uk-margin-small">
              <a class="discord-widget" href="https://discord.gg/<?= $this->config->item('discord_inv'); ?>" title="Join us on Discord">
                <img src="https://discordapp.com/api/guilds/{discord_id}/embed.png?style=banner3">
              </a>
            </div>
            <?php endif ?>
            <?php if ($this->m_modules->getDiscordStatus() == '1' && $this->config->item('discordType') == '2'): ?>
            <h4 class="uk-h4 uk-text-bold uk-text-uppercase"><i class="fab fa-discord fa-sm"></i> <?= $this->lang->line('home_discord'); ?></h4>
            <div class="uk-text-center uk-margin-small">
              <iframe src="{conf_discordwidget}{discord_id}&theme={conf_discordtheme}" width="{discord_width_class}" height="{discord_height_class}" {discord_extras}></iframe>
            </div>
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>
