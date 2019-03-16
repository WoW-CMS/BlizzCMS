    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-small main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-archive"></i> <?= $this->lang->line('news_recent_list'); ?></h4>
        <?php if ($this->news_model->getNewsList()->num_rows()): ?>
        <div class="uk-grid uk-grid-small uk-child-width-1-1" data-uk-grid>
          <?php foreach($this->news_model->getNewsList()->result() as $list): ?>
          <div>
            <a href="<?= base_url('news/'.$list->id); ?>">
              <div class="uk-card uk-card-default news-card uk-card-hover card-article">
                <div class="uk-card-body">
                  <div class="uk-grid uk-grid-medium" data-uk-grid>
                    <div class="uk-width-2-5 uk-width-1-4@s">
                      <div class="image-card uk-margin-small" style="background-image: url(<?= base_url('includes/images/news/'.$list->image); ?>);"></div>
                    </div>
                    <div class="uk-width-3-5 uk-width-3-4@s">
                      <h4 class="uk-h4 uk-text-uppercase uk-margin-small uk-text-break"><?= $list->title ?></h4>
                      <p class="uk-text-small uk-margin-small uk-visible@s"><?= substr(ucfirst(strtolower(strip_tags($list->description))), 0, 260).' ...'; ?></p>
                      <p class="uk-text-small uk-margin-remove"><i class="far fa-calendar-alt"></i> <?= date('Y-m-d', $list->date); ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </section>
