    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('store'); ?></h4>
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
                <h5 class="uk-h5 uk-text-bold"><i class="far fa-list-alt"></i> <?= lang('categories'); ?></h5>
              </div>
              <ul class="uk-nav-default aside-nav uk-nav-parent-icon" uk-nav>
                <li><a href="<?= site_url('store'); ?>"><i class="fas fa-star"></i> <?= lang('top_items'); ?></a></li>
                <?php foreach ($this->store_model->get_all_categories() as $cat): ?>
                <?php if ($cat->type === TYPE_DEFAULT): ?>
                <li><a href="<?= site_url('store/category/'.$cat->slug); ?>"><?= $cat->name; ?></a></li>
                <?php else: ?>
                <li class="uk-parent">
                  <a href="#"><?= $cat->name; ?></a>
                  <ul class="uk-nav-sub uk-nav-parent-icon" uk-nav>
                    <?php foreach ($this->store_model->get_all_categories($cat->id) as $sub): ?>
                    <li><a href="<?= site_url('store/category/'.$sub->slug) ?>"><?= $sub->name; ?></a></li>
                    <?php endforeach; ?>
                  </ul>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@m">
            <?= $template['partials']['alerts']; ?>
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-width-1-3@m">
              
              </div>
              <div class="uk-width-2-3@m">
                <h4 class="uk-h4 uk-text-bold uk-text-break uk-margin-remove"><?= html_escape($item->name) ?></h4>
                <hr class="uk-hr uk-margin-small">
                <div class="uk-margin-small-top uk-margin-bottom uk-text-break">
                  <?= html_escape($item->description) ?>
                </div>
                <p class="uk-text-small uk-text-bold uk-margin-small"><?= lang('price') ?>:</p>
                <?php if ($item->price_type === TYPE_DP): ?>
                <i class="dp-icon" uk-tooltip="title: <?= lang('donor_points'); ?>"></i><?= $item->dp; ?>
                <?php elseif ($item->price_type === TYPE_VP): ?>
                <i class="vp-icon" uk-tooltip="title: <?= lang('vote_points'); ?>"></i><?= $item->vp; ?>
                <?php elseif ($item->price_type === TYPE_AND): ?>
                <i class="dp-icon" uk-tooltip="title: <?= lang('donor_points'); ?>"></i><?= $item->dp; ?> <span class="uk-badge">&amp;</span> <i class="vp-icon" uk-tooltip="title: <?= lang('vote_points'); ?>"></i><?= $item->vp; ?>
                <?php endif; ?>
                <?= form_open(current_url()) ?>
                <p class="uk-text-small uk-text-bold uk-margin-top uk-margin-small-bottom"><?= lang('character') ?>:</p>
                <div class="uk-margin-remove-top uk-margin-small-bottom uk-light">
                  <select class="uk-select uk-width-medium uk-display-block" name="guid">
                    <option value="" hidden selected><?= lang('select_character') ?></option>
                    <?php foreach ($characters as $character): ?>
                    <option value="<?= $character->guid ?>"><?= $character->name ?></option>
                    <?php endforeach ?>
                  </select>
                  <?= form_error('guid', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <p class="uk-text-small uk-text-bold uk-margin-small"><?= lang('quantity') ?>:</p>
                <div class="uk-grid uk-grid-small uk-margin-remove-top uk-margin-small-bottom" data-uk-grid>
                  <div class="uk-width-auto@s uk-light">
                    <input class="uk-input uk-width-small" type="number" name="qty" min="1" value="1">
                    <?= form_error('qty', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-width-auto@s">
                    <button class="uk-button uk-button-default uk-text-uppercase uk-margin-small" type="submit" id="button_purchase"><i class="fas fa-cart-plus"></i> <?= lang('add_cart'); ?></button>
                  </div>
                </div>
              <?= form_close() ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>