    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <li><a href="<?= base_url('user'); ?>"><i class="fas fa-user-circle"></i> <?= lang('tab_account'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=lang('navbar_donate_panel'); ?></a></li>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=lang('navbar_vote_panel'); ?></a></li>
              <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=lang('tab_store'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=lang('tab_bugtracker'); ?></a></li>
              <li class="uk-active"><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=lang('tab_changelogs'); ?></a></li>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('tab_changelogs'); ?></h4>
            <?php if (isset($changelogs) && ! empty($changelogs)): ?>
            <div class="uk-grid uk-grid-small uk-child-width-1-1" data-uk-grid>
              <?php foreach ($changelogs as $changelog): ?>
              <div>
                <div class="uk-card uk-card-default uk-margin-small">
                  <div class="uk-card-header">
                    <div class="uk-grid uk-grid-small" data-uk-grid>
                      <div class="uk-width-expand@s">
                        <h5 class="uk-h5 uk-text-bold"><i class="fas fa-file-alt"></i> <?= $changelog->title; ?></h5>
                      </div>
                      <div class="uk-width-auto@s">
                        <p class="uk-text-small"><i class="far fa-clock"></i> <?= date('F j, Y, h:i a', $changelog->date); ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="uk-card-body">
                    <?= $changelog->description; ?>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
            <?= $links; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
