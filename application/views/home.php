    <section class="uk-section uk-padding-remove slider-section">
      <div class="uk-position-relative uk-visible-toggle" uk-slideshow="animation: fade;autoplay: true;autoplay-interval: 6000;min-height: 150;max-height: 300;">
        <ul class="uk-slideshow-items">
          <?php foreach ($this->base->get_slides() as $slide): ?>
          <?php if ($slide->type == 1): ?>
          <li>
            <img src="<?= $template['uploads'].'slides/'.$slide->route; ?>" alt="<?= $slide->title ?>" uk-cover>
            <div class="uk-container uk-position-relative uk-margin-large-top">
              <h2 class="uk-h2 uk-position-medium uk-text-left uk-margin-remove"><?= $slide->title ?></h2>
              <p class="uk-position-medium uk-text-left uk-margin-remove"><?= $slide->description ?></p>
            </div>
          </li>
          <?php elseif ($slide->type == 2): ?>
          <li>
            <video src="<?= $template['uploads'].'slides/'.$slide->route; ?>" autoplay loop playslinline uk-cover></video>
            <div class="uk-container uk-position-relative uk-margin-large-top">
              <h2 class="uk-h2 uk-position-medium uk-text-left uk-margin-remove"><?= $slide->title ?></h2>
              <p class="uk-position-medium uk-text-left uk-margin-remove"><?= $slide->description ?></p>
            </div>
          </li>
          <?php elseif ($slide->type == 3): ?>
          <li>
            <iframe src="<?= $slide->route; ?>" frameborder="0" allowfullscreen uk-video="autoplay: false" data-uk-cover="automute: false"></iframe>
          </li>
          <?php endif; ?>
          <?php endforeach ?>
        </ul>
        <div class="uk-position-bottom-center uk-position-small">
          <ul class="uk-slideshow-nav uk-dotnav"></ul>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium uk-margin-small" data-uk-grid>
          <div class="uk-width-2-3@s">
            <h4 class="uk-h4"><?= lang('home_latest_news'); ?></h4>
            <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-1" data-uk-grid>
              <?php foreach ($articles as $article): ?>
              <div>
                <a href="<?= base_url('news/'.$article->id) ;?>" title="<?= lang('button_read_more'); ?>">
                  <div class="uk-card uk-card-default news-card uk-card-hover uk-grid-collapse uk-margin" uk-grid>
                    <div class="uk-width-1-3@s uk-card-media-left uk-cover-container">
                      <img src="<?= $template['uploads'].'news/'.$article->image; ?>" alt="<?= $article->title ?>" uk-cover>
                      <canvas width="500" height="250"></canvas>
                    </div>
                    <div class="uk-width-2-3@s uk-card-body">
                      <h5 class="uk-h5 uk-text-bold uk-margin-small"><?= $article->title ?></h5>
                      <p class="uk-text-small uk-margin-small"><?= mb_substr(ucfirst(strtolower(strip_tags($article->description))), 0, 160, "UTF-8").' ...'; ?></p>
                      <p class="uk-text-small uk-margin-remove uk-text-right"><i class="far fa-comment-alt"></i> <?= $this->base->count_news_comments($article->id); ?> <?= lang('news_comments'); ?></p>
                    </div>
                  </div>
                </a>
              </div>
              <?php endforeach ?>
            </div>
          </div>
          <div class="uk-width-1-3@s">
            <h4 class="uk-h4"><?= lang('home_server_status'); ?></h4>
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-margin-small" data-uk-grid>
              <?php foreach ($realms as $realm): ?>
              <div>
                <div class="uk-card uk-card-default uk-card-body card-status">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-expand">
                      <h5 class="uk-h5 uk-text-bold uk-margin-small"><a href="<?= base_url('online'); ?>" class="uk-link-reset"><i class="fas fa-server"></i> <?= lang('table_header_realm'); ?> <?= $realm->name; ?></a></h5>
                    </div>
                    <div class="uk-width-auto">
                      <?php if ($this->realm->is_online($realm->id)): ?>
                        <div class="status-dot online" uk-tooltip="<?= lang('online'); ?>"><span><span></span></span></div>
                      <?php else: ?>
                        <div class="status-dot offline" uk-tooltip="<?= lang('offline'); ?>"><span><span></span></span></div>
                      <?php endif ?>
                    </div>
                  </div>
                  <?php if ($this->realm->is_online($realm->id)): ?>
                  <div class="uk-grid uk-grid-collapse uk-margin-small" data-uk-grid>
                    <div class="uk-width-1-2">
                      <div class="uk-tile alliance-bar uk-text-center" uk-tooltip="<?= lang('faction_alliance'); ?>">
                        <i class="fas fa-users"></i>
                        <?= $this->realm->count_online($realm->id, 'alliance'); ?>
                      </div>
                    </div>
                    <div class="uk-width-1-2">
                      <div class="uk-tile horde-bar uk-text-center" uk-tooltip="<?= lang('faction_horde'); ?>">
                        <i class="fas fa-users"></i>
                        <?= $this->realm->count_online($realm->id, 'horde'); ?>
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
            <?php if (! empty(config_item('realmlist'))): ?>
            <h5 class="uk-h5 uk-text-center uk-margin dotted-divider">
              <i class="fas fa-gamepad"></i> <?= config_item('realmlist'); ?>
            </h5>
            <?php endif; ?>
            <h4 class="uk-h4"><?= lang('home_discord'); ?></h4>
            <div class="uk-margin">
              <a target="_blank" href="<?= config_item('facebook_url'); ?>" class="uk-icon-button"><i class="fab fa-facebook-f"></i></a>
              <a target="_blank" href="<?= config_item('twitter_url'); ?>" class="uk-icon-button uk-margin-small-left"><i class="fab fa-twitter"></i></a>
              <a target="_blank" href="<?= config_item('youtube_url'); ?>" class="uk-icon-button uk-margin-small-left"><i class="fab fa-youtube"></i></a>
            </div>
            <?php if (! empty(config_item('discord_server_id'))): ?>
            <h4 class="uk-h4"><?= lang('home_discord'); ?></h4>
            <div class="uk-text-center uk-margin-small">
              <iframe src="https://discordapp.com/widget?id=<?= config_item('discord_server_id'); ?>&theme=dark" width="300" height="300" allowtransparency="true" frameborder="0"></iframe>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
