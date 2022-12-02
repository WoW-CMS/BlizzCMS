<section class="uk-section uk-padding-remove bc-slider-section">
  <div class="uk-position-relative uk-visible-toggle" uk-slideshow="animation: fade; autoplay: true; autoplay-interval: 10000; pause-on-hover: true; min-height: 125; max-height: 250">
    <ul class="uk-slideshow-items">
      <?php foreach ($this->slide_model->find_all() as $slide): ?>
      <?php if ($slide->type === SLIDE_IMAGE): ?>
      <li>
        <img src="<?= $template['uploads'].$slide->path ?>" alt="<?= $slide->title ?>" uk-cover>
        <div class="uk-container uk-position-relative uk-margin-large-top">
          <h2 class="uk-h2 uk-position-medium uk-text-left uk-margin-remove"><?= $slide->title ?></h2>
          <p class="uk-position-medium uk-text-left uk-margin-remove"><?= $slide->description ?></p>
        </div>
      </li>
      <?php elseif ($slide->type === SLIDE_VIDEO): ?>
      <li>
        <video src="<?= $template['uploads'].$slide->path ?>" autoplay loop playslinline uk-cover></video>
        <div class="uk-container uk-position-relative uk-margin-large-top">
          <h2 class="uk-h2 uk-position-medium uk-text-left uk-margin-remove"><?= $slide->title ?></h2>
          <p class="uk-position-medium uk-text-left uk-margin-remove"><?= $slide->description ?></p>
        </div>
      </li>
      <?php elseif ($slide->type === SLIDE_IFRAME): ?>
      <li>
        <iframe src="<?= $slide->path ?>" allowfullscreen uk-video="autoplay: false" uk-cover></iframe>
      </li>
      <?php endif ?>
      <?php endforeach ?>
    </ul>
    <div class="uk-position-bottom-center uk-position-small">
      <ul class="uk-slideshow-nav uk-dotnav"></ul>
    </div>
  </div>
</section>
<section class="uk-section uk-section-xsmall bc-default-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-margin" uk-grid>
      <div class="uk-width-3-5@s uk-width-2-3@m">
        <h3 class="uk-h4 uk-text-bold uk-margin-small"><?= lang('latest_news') ?></h3>
        <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
          <?php foreach ($articles as $article): ?>
          <div>
            <div class="uk-card uk-card-default uk-card-hover uk-grid-collapse" uk-grid>
              <div class="uk-width-1-3@s uk-card-media-left uk-cover-container">
                <img src="<?= $template['uploads'].$article->image ?>" alt="<?= $article->title ?>" uk-cover>
                <canvas width="500" height="250"></canvas>
              </div>
              <div class="uk-width-2-3@s">
                <div class="uk-card-body">
                  <h4 class="uk-h4 uk-text-bold uk-margin-remove">
                    <a class="uk-link-reset" href="<?= site_url('news/'.$article->id.'/'.$article->slug) ?>"><?= word_limiter($article->title, 12) ?></a>
                  </h4>
                  <p class="uk-text-meta uk-margin-remove-top uk-margin-small-bottom">
                    <i class="fa-regular fa-clock"></i> <time datetime="<?= format_date($article->created_at, 'c') ?>"><?= format_date($article->created_at, 'M j, Y, h:i A') ?></time>
                  </p>
                  <p class="uk-text-small uk-margin-small"><?= html_escape($article->summary) ?></p>
                  <div class="uk-grid-small uk-flex uk-flex-middle uk-margin-top" uk-grid>
                    <div class="uk-width-expand uk-text-meta">
                      <span class="uk-margin-small-right" uk-tooltip="<?= lang('comments') ?>"><i class="fa-solid fa-comment"></i> <?= $article->comments ?></span> <span uk-tooltip="<?= lang('views') ?>"><i class="fa-solid fa-eye"></i> <?= $article->views ?></span> 
                    </div>
                    <div class="uk-width-auto">
                      <a href="<?= site_url('news/'.$article->id.'/'.$article->slug) ?>" class="uk-button uk-button-default uk-button-small"><?= lang('read_more') ?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
      <div class="uk-width-2-5@s uk-width-1-3@m">
        <?php if (isset($realms) && ! empty($realms)): ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-bold uk-margin-remove"><i class="fa-solid fa-server"></i> <?= lang('realm_status') ?></h5>
          </div>
          <div class="uk-card-body">
            <?php foreach ($realms as $realm): ?>
            <div class="uk-grid-small" uk-grid>
              <div class="uk-width-expand">
                <h5 class="uk-h5 uk-text-bold uk-margin-small"><?= $realm->realm_name ?></h5>
              </div>
              <div class="uk-width-auto">
                <?php if ($this->realm_model->is_online($realm->id)): ?>
                <div class="bc-status-dot"></div>
                <?php else: ?>
                <div class="bc-status-dot is-offline"></div>
                <?php endif ?>
              </div>
            </div>
            <div class="bc-stacked-bars">
              <div class="bc-progressbar bc-alliance-bar" style="width: <?= $this->realm_model->percentage_online($realm->id, 'alliance') ?>%"></div>
              <div class="bc-progressbar bc-horde-bar" style="width: <?= $this->realm_model->percentage_online($realm->id, 'horde') ?>%"></div>
            </div>
            <?php endforeach ?>
            <?php if (! empty(config_item('app_realmlist'))): ?>
            <div class="bc-realmlist">
              <i class="fa-solid fa-gamepad"></i> <?= config_item('app_realmlist') ?>
            </div>
            <?php endif ?>
          </div>
        </div>
        <?php endif ?>
        <div class="uk-card uk-card-default uk-margin">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-bold uk-margin-remove"><i class="fa-solid fa-share-nodes"></i> <?= lang('social_networks') ?></h5>
          </div>
          <div class="uk-card-body">
            <div class="uk-flex uk-margin">
              <a href="https://facebook.com/<?= config_item('social_facebook') ?>" class="uk-icon-button"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="https://twitter.com/<?= config_item('social_twitter') ?>" class="uk-icon-button uk-margin-small-left"><i class="fa-brands fa-twitter"></i></a>
              <a href="https://www.youtube.com/c/<?= config_item('social_youtube') ?>" class="uk-icon-button uk-margin-small-left"><i class="fa-brands fa-youtube"></i></a>
            </div>
          </div>
        </div>
        <?php if (! empty(config_item('social_discord'))): ?>
        <div class="uk-card uk-card-default uk-margin">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-bold uk-margin-remove"><i class="fa-brands fa-discord"></i> <?= lang('discord') ?></h5>
          </div>
          <div class="uk-card-body">
            <iframe src="https://discordapp.com/widget?id=<?= config_item('social_discord') ?>&theme=dark" width="347" height="400" allowtransparency="true" frameborder="0"></iframe>
          </div>
        </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</section>
