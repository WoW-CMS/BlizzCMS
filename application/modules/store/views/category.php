    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('store') ?></h4>
          </div>
          <div class="uk-width-auto"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="far fa-list-alt"></i> <?= lang('categories') ?></h5>
              </div>
              <ul class="uk-nav-default aside-nav uk-nav-parent-icon" uk-nav>
                <li><a href="<?= site_url('store') ?>"><i class="fas fa-star"></i> <?= lang('top_items') ?></a></li>
                <?php foreach ($this->store_model->get_all_categories() as $cat): ?>
                <?php if ($cat->type === TYPE_DEFAULT): ?>
                <li><a href="<?= site_url('store/category/'.$cat->slug) ?>"><?= $cat->name ?></a></li>
                <?php else: ?>
                <li class="uk-parent">
                  <a href="#"><?= $cat->name ?></a>
                  <ul class="uk-nav-sub uk-nav-parent-icon" uk-nav>
                    <?php foreach ($this->store_model->get_all_categories($cat->id) as $sub): ?>
                    <li><a href="<?= site_url('store/category/'.$sub->slug) ?>"><?= $sub->name ?></a></li>
                    <?php endforeach ?>
                  </ul>
                </li>
                <?php endif ?>
                <?php endforeach ?>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@m">
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m" data-uk-grid>
              <?php foreach($items as $item): ?>
              <div>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-header">
                  </div>
                  <div class="uk-card-body uk-text-break">
                    <h5 class="uk-margin-remove"><?= html_escape($item->name) ?></h5>
                    <p class="uk-text-small uk-margin-remove"><?= html_escape($item->description) ?></p>
                    <?php if ($item->price_type === TYPE_DP): ?>
                    <i class="dp-icon" uk-tooltip="title: <?= lang('donor_points') ?>"></i><?= $item->dp ?>
                    <?php elseif ($item->price_type === TYPE_VP): ?>
                    <i class="vp-icon" uk-tooltip="title: <?= lang('vote_points') ?>"></i><?= $item->vp ?>
                    <?php elseif ($item->price_type === TYPE_AND): ?>
                    <i class="dp-icon" uk-tooltip="title: <?= lang('donor_points') ?>"></i><?= $item->dp ?> <span class="uk-badge">&amp;</span> <i class="vp-icon" uk-tooltip="title: <?= lang('vote_points') ?>"></i><?= $item->vp ?>
                    <?php endif ?>
                    <a href="<?= site_url('store/item/'.$item->id) ?>" class="uk-button uk-button-default uk-button-small uk-width-1-1 uk-margin-small-top"><i class="fas fa-cart-plus"></i> <?= lang('view_item') ?></a>
                  </div>
                </div>
              </div>
              <?php endforeach ?>
            </div>
          </div>
        </div>
      </div>
    </section>