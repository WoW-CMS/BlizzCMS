    <section class="uk-section uk-padding-remove slider-section">
      <?php if($this->wowmodule->getStatusModule('Slideshow')): ?>
      <?php if($this->home_model->getSlides()->num_rows()): ?>
      <div class="uk-position-relative uk-visible-toggle" uk-slideshow="animation: fade;autoplay: true;autoplay-interval: 6000;min-height: 150;max-height: 300;">
        <ul class="uk-slideshow-items">
          <?php foreach ($slides as $slides): ?>
          <?php if ($slides->type == 1): ?>
          <li>
            <img src="<?= $template['location'].'assets/images/slides/'.$slides->route; ?>" alt="<?= $slides->title ?>" uk-cover>
            <div class="uk-container uk-position-relative uk-margin-large-top">
              <h2 class="uk-h2 uk-position-medium uk-text-left uk-margin-remove"><?= $slides->title ?></h2>
              <p class="uk-position-medium uk-text-left uk-margin-remove"><?= $slides->description ?></p>
            </div>
          </li>
          <?php elseif ($slides->type == 2): ?>
          <li>
            <video src="<?= $template['location'].'assets/images/slides/'.$slides->route; ?>" autoplay loop playslinline uk-cover></video>
            <div class="uk-container uk-position-relative uk-margin-large-top">
              <h2 class="uk-h2 uk-position-medium uk-text-left uk-margin-remove"><?= $slides->title ?></h2>
              <p class="uk-position-medium uk-text-left uk-margin-remove"><?= $slides->description ?></p>
            </div>
          </li>
          <?php elseif ($slides->type == 3): ?>
          <li>
            <iframe src="<?= $slides->route; ?>" frameborder="0" allowfullscreen uk-video="autoplay: false" data-uk-cover="automute: false"></iframe>
          </li>
          <?php endif; ?>
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
			<?php if ($this->wowmodule->getStatusModule('News')): ?>
            <h4 class="uk-h4 uk-text-bold"><i class="fas fa-newspaper fa-sm"></i> <?= $this->lang->line('home_latest_news'); ?></h4>
            <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-1" data-uk-grid>
              <?php foreach ($NewsList as $news): ?>
              <div>
                <a href="<?= base_url('news/'.$news->id) ;?>" title="<?= $this->lang->line('button_read_more'); ?>">
                  <div class="uk-card uk-card-default news-card uk-card-hover uk-grid-collapse uk-margin" uk-grid>
                    <div class="uk-width-1-3@s uk-card-media-left uk-cover-container">
                      <img src="<?= base_url('assets/images/news/'.$news->image); ?>" alt="<?= $news->title ?>" uk-cover>
                      <canvas width="500" height="250"></canvas>
                    </div>
                    <div class="uk-width-2-3@s uk-card-body">
                      <h5 class="uk-h5 uk-text-bold uk-margin-small"><?= $news->title ?></h5>
                      <p class="uk-text-small uk-margin-small"><?= mb_substr(ucfirst(strtolower(strip_tags($news->description))), 0, 160, "UTF-8").' ...'; ?></p>
                      <p class="uk-text-small uk-margin-remove uk-text-right"><i class="far fa-comment-alt"></i> <?= $this->news_model->getCommentCount($news->id); ?> <?= $this->lang->line('news_comments'); ?></p>
                    </div>
                  </div>
                </a>
              </div>
              <?php endforeach ?>
            </div>
            <?php endif ?>
          </div>
          <div class="uk-width-1-3@s">
            <?php if($this->wowmodule->getStatusModule('Realm Status')): ?>
			<h4 class="uk-h4 uk-text-bold"><i class="fas fa-server fa-sm"></i> <?= $this->lang->line('home_server_status'); ?></h4>
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-margin-small" data-uk-grid>
              <?php foreach ($realmsList as $charsMultiRealm): 
                $multiRealm = $this->wowrealm->getRealmConnectionData($charsMultiRealm->id);
              ?>
              <div>
                <div class="uk-card uk-card-default uk-card-body card-status">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-expand">
                      <h5 class="uk-h5 uk-text-bold uk-margin-small"><a href="<?= base_url('online'); ?>" class="uk-link-reset"><i class="fas fa-server"></i> <?= $this->lang->line('table_header_realm'); ?> <?= $this->wowrealm->getRealmName($charsMultiRealm->realmID); ?></a></h5>
                    </div>
                    <div class="uk-width-auto">
                      <?php if ($this->wowrealm->RealmStatus($charsMultiRealm->realmID)): ?>
                        <div class="status-dot online" uk-tooltip="<?= $this->lang->line('online'); ?>"><span><span></span></span></div>
                      <?php else: ?>
                        <div class="status-dot offline" uk-tooltip="<?= $this->lang->line('offline'); ?>"><span><span></span></span></div>
                      <?php endif ?>
                    </div>
                  </div>
                  <?php if ($this->wowrealm->RealmStatus($charsMultiRealm->realmID)): ?>
                  <div class="uk-grid uk-grid-collapse uk-margin-small" data-uk-grid>
                    <div class="uk-width-1-2">
                      <div class="uk-tile alliance-bar uk-text-center" uk-tooltip="<?= $this->lang->line('faction_alliance'); ?>">
                        <i class="fas fa-users"></i>
                        <?= $this->wowrealm->getCharactersOnlineAlliance($multiRealm); ?>
                      </div>
                    </div>
                    <div class="uk-width-1-2">
                      <div class="uk-tile horde-bar uk-text-center" uk-tooltip="<?= $this->lang->line('faction_horde'); ?>">
                        <i class="fas fa-users"></i>
                        <?= $this->wowrealm->getCharactersOnlineHorde($multiRealm); ?>
                      </div>
                    </div>
                  </div>
                  <?php else: ?>
                  <p class="uk-text-small uk-margin-small"><i class="fas fa-exclamation-circle"></i> <?= $this->lang->line('home_realm_info'); ?> <span class="uk-text-danger uk-text-bold uk-text-uppercase"><?= $this->lang->line('offline'); ?></span></p>
                  <?php endif ?>
                </div>
              </div>
              <?php endforeach ?>
            </div>
            <h5 class="uk-h5 uk-text-center uk-margin dotted-divider">
              <?php if ($this->wowgeneral->getExpansionAction() == 1): ?>
              <i class="fas fa-gamepad"></i> Set Realmlist <?= $this->config->item('realmlist'); ?>
              <?php else: ?>
              <i class="fas fa-gamepad"></i> Set Portal "<?= $this->config->item('realmlist'); ?>"
              <?php endif ?>
            </h5>
            <?php endif ?>
            <?php if ($this->wowmodule->getStatusModule('Discord') == '1' && $this->config->item('discord_type') == '1'): ?>
            <h4 class="uk-h4 uk-text-bold"><i class="fab fa-discord fa-sm"></i> <?= $this->lang->line('home_discord'); ?></h4>
            <div class="uk-text-center uk-margin-small">
              <a target="_blank" class="discord-widget" href="https://discord.gg/<?= $this->config->item('discord_invitation'); ?>" title="Join us on Discord">
                <img src="https://discord.com/api/guilds/<?= $discord_id ?>/widget.png?style=<?= $this->config->item('discord_style'); ?>">
              </a>
            </div>
            <?php endif ?>
            <?php if ($this->wowmodule->getStatusModule('Discord') == '1' && $this->config->item('discord_type') == '2'): ?>
            <h4 class="uk-h4 uk-text-bold"><i class="fab fa-discord fa-sm"></i> <?= $this->lang->line('home_discord'); ?></h4>
            <div class="uk-text-center uk-margin-small">
              <iframe src="https://discordapp.com/widget?id=<?= $discord_id ?>&theme=dark" width="300" height="300" allowtransparency="true" frameborder="0"></iframe>
            </div>
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>
