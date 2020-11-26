    <section class="uk-section uk-padding-remove slider-section">
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
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium uk-margin-small" data-uk-grid>
          <div class="uk-width-2-3@s">
            <h4 class="uk-h4 uk-text-bold"><i class="fas fa-newspaper fa-sm"></i> <?= lang('home_latest_news'); ?></h4>
            <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-1" data-uk-grid>
              <?php foreach ($NewsList as $news): ?>
              <div>
                <a href="<?= base_url('news/'.$news->id) ;?>" title="<?= lang('button_read_more'); ?>">
                  <div class="uk-card uk-card-default news-card uk-card-hover uk-grid-collapse uk-margin" uk-grid>
                    <div class="uk-width-1-3@s uk-card-media-left uk-cover-container">
                      <img src="<?= base_url('assets/images/news/'.$news->image); ?>" alt="<?= $news->title ?>" uk-cover>
                      <canvas width="500" height="250"></canvas>
                    </div>
                    <div class="uk-width-2-3@s uk-card-body">
                      <h5 class="uk-h5 uk-text-bold uk-margin-small"><?= $news->title ?></h5>
                      <p class="uk-text-small uk-margin-small"><?= mb_substr(ucfirst(strtolower(strip_tags($news->description))), 0, 160, "UTF-8").' ...'; ?></p>
                      <p class="uk-text-small uk-margin-remove uk-text-right"><i class="far fa-comment-alt"></i> <?= $this->news_model->getCommentCount($news->id); ?> <?= lang('news_comments'); ?></p>
                    </div>
                  </div>
                </a>
              </div>
              <?php endforeach ?>
            </div>
          </div>
          <div class="uk-width-1-3@s">
            <h4 class="uk-h4 uk-text-bold"><i class="fas fa-server fa-sm"></i> <?= lang('home_server_status'); ?></h4>
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-margin-small" data-uk-grid>
              <?php foreach ($realmsList as $charsMultiRealm): 
                $multiRealm = $this->realm->getRealmConnectionData($charsMultiRealm->id);
              ?>
              <div>
                <div class="uk-card uk-card-default uk-card-body card-status">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-expand">
                      <h5 class="uk-h5 uk-text-bold uk-margin-small"><a href="<?= base_url('online'); ?>" class="uk-link-reset"><i class="fas fa-server"></i> <?= lang('table_header_realm'); ?> <?= $this->realm->getRealmName($charsMultiRealm->realmID); ?></a></h5>
                    </div>
                    <div class="uk-width-auto">
                      <?php if ($this->realm->RealmStatus($charsMultiRealm->realmID, $this->realm->realmGetHostname($charsMultiRealm->realmID))): ?>
                        <div class="status-dot online" uk-tooltip="<?= lang('online'); ?>"><span><span></span></span></div>
                      <?php else: ?>
                        <div class="status-dot offline" uk-tooltip="<?= lang('offline'); ?>"><span><span></span></span></div>
                      <?php endif ?>
                    </div>
                  </div>
                  <?php if ($this->realm->RealmStatus($charsMultiRealm->realmID, $this->realm->realmGetHostname($charsMultiRealm->realmID))): ?>
                  <div class="uk-grid uk-grid-collapse uk-margin-small" data-uk-grid>
                    <div class="uk-width-1-2">
                      <div class="uk-tile alliance-bar uk-text-center" uk-tooltip="<?= lang('faction_alliance'); ?>">
                        <i class="fas fa-users"></i>
                        <?= $this->realm->getCharactersOnlineAlliance($multiRealm); ?>
                      </div>
                    </div>
                    <div class="uk-width-1-2">
                      <div class="uk-tile horde-bar uk-text-center" uk-tooltip="<?= lang('faction_horde'); ?>">
                        <i class="fas fa-users"></i>
                        <?= $this->realm->getCharactersOnlineHorde($multiRealm); ?>
                      </div>
                    </div>
                  </div>
                  <?php else: ?>
                  <p class="uk-text-small uk-margin-small"><i class="fas fa-exclamation-circle"></i> <?= lang('home_realm_info'); ?> <span class="uk-text-danger uk-text-bold uk-text-uppercase"><?= lang('offline'); ?></span></p>
                  <?php endif ?>
                </div>
              </div>
              <?php endforeach ?>
            </div>
            <h5 class="uk-h5 uk-text-center uk-margin dotted-divider">
              <i class="fas fa-gamepad"></i> <?= config_item('realmlist'); ?>
            </h5>
            <h4 class="uk-h4 uk-text-bold"><i class="fab fa-discord fa-sm"></i> <?= lang('home_discord'); ?></h4>
            <div class="uk-text-center uk-margin-small">
              <iframe src="https://discordapp.com/widget?id=<?= config_item('discord_invitation') ?>&theme=dark" width="300" height="300" allowtransparency="true" frameborder="0"></iframe>
            </div>
          </div>
        </div>
      </div>
    </section>
