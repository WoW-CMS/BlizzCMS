<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('news') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-2-3@s uk-width-3-4@m">
        <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
          <?php foreach ($articles as $item): ?>
          <div>
            <div class="uk-card uk-card-default uk-card-hover uk-grid-collapse" uk-grid>
              <div class="uk-width-1-3@s uk-card-media-left uk-cover-container">
                <img src="<?= $template['uploads'].$item->image ?>" alt="<?= $item->title ?>" uk-cover>
                <canvas width="500" height="250"></canvas>
              </div>
              <div class="uk-width-2-3@s">
                <div class="uk-card-body">
                  <h4 class="uk-h4 uk-text-bold uk-margin-remove">
                    <a class="uk-link-reset" href="<?= site_url('news/'.$item->id.'/'.$item->slug) ?>"><?= word_limiter($item->title, 12) ?></a>
                  </h4>
                  <p class="uk-text-meta uk-margin-remove-top uk-margin-small-bottom">
                    <i class="fa-regular fa-clock"></i> <time datetime="<?= format_date($item->created_at, 'c') ?>"><?= format_date($item->created_at, 'M j, Y, h:i A') ?></time>
                  </p>
                  <p class="uk-text-small uk-margin-small"><?= html_escape($item->summary) ?></p>
                  <div class="uk-grid-small uk-flex uk-flex-middle uk-margin-top" uk-grid>
                    <div class="uk-width-expand uk-text-meta">
                      <span class="uk-margin-small-right" uk-tooltip="<?= lang('comments') ?>"><i class="fa-solid fa-comment"></i> <?= $item->comments ?></span> <span uk-tooltip="<?= lang('views') ?>"><i class="fa-solid fa-eye"></i> <?= $item->views ?></span> 
                    </div>
                    <div class="uk-width-auto">
                      <a href="<?= site_url('news/'.$item->id.'/'.$item->slug) ?>" class="uk-button uk-button-default uk-button-small"><?= lang('read_more') ?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
        <?php if (isset($articles) && ! empty($articles)): ?>
        <?= $pagination ?>
        <?php endif ?>
      </div>
      <div class="uk-width-1-3@s uk-width-1-4@m"></div>
    </div>
  </div>
</section>
