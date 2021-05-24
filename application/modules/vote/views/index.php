    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('vote_panel') ?></h4>
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
                <h5 class="uk-h5 uk-text-bold"><i class="far fa-list-alt"></i> <?= lang('menu') ?></h5>
              </div>
              <ul class="uk-nav-default aside-nav uk-nav-parent-icon" uk-nav>
                <li><a href="<?= site_url('user') ?>"><i class="fas fa-user-circle"></i> <?= lang('my_account') ?></a></li>
                <li><a href="<?= site_url('user/settings') ?>"><i class="fas fa-tools"></i> <?= lang('account_settings') ?></a></li>
                <li><a href="<?= site_url('donate') ?>"><i class="fas fa-hand-holding-usd"></i> <?= lang('donate_panel') ?></a></li>
                <li class="uk-active"><a href="<?= site_url('vote') ?>"><i class="fas fa-vote-yea"></i> <?= lang('vote_panel') ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@m">
            <?= $template['partials']['alerts'] ?>
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-4@s uk-child-width-1-4@m" data-uk-grid>
              <?php foreach ($topsites as $topsite): ?>
              <div>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-header">
                    <h5 class="uk-h5 uk-text-bold"><?= $topsite->name ?></h5>
                  </div>
                  <div class="uk-card-body">
                    <div class="uk-flex uk-flex-center">
                      <img src="<?= $topsite->image ?>" alt="Image">
                    </div>
                    <p class="uk-text-small uk-text-center uk-margin-small"><?= $topsite->points ?> <?= lang('vote_points') ?></p>
                    <?php if (now() >= strtotime($this->vote_model->get_expiration($topsite->id))): ?>
                    <a href="<?= site_url('vote/site/'.$topsite->id) ?>" class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-vote-yea"></i> <?= lang('vote') ?></a>
                    <?php else: ?>
                    <h5 class="uk-h5 uk-text-uppercase uk-text-bold uk-text-center uk-margin-remove-bottom uk-margin-small-top"><?= lang('next_vote') ?></h5>
                    <div class="uk-grid-collapse uk-child-width-auto uk-flex-center uk-margin-small-bottom" uk-grid uk-countdown="date: <?= date('c', strtotime($this->vote_model->get_expiration($topsite->id))) ?>">
                      <div>
                        <div class="uk-countdown-number uk-countdown-days"></div>
                      </div>
                      <div class="uk-countdown-separator">:</div>
                      <div>
                        <div class="uk-countdown-number uk-countdown-hours"></div>
                      </div>
                      <div class="uk-countdown-separator">:</div>
                      <div>
                        <div class="uk-countdown-number uk-countdown-minutes"></div>
                      </div>
                      <div class="uk-countdown-separator">:</div>
                      <div>
                        <div class="uk-countdown-number uk-countdown-seconds"></div>
                      </div>
                    </div>
                    <?php endif ?>
                  </div>
                </div>
              </div>
              <?php endforeach ?>
            </div>
            <?= $links ?>
          </div>
        </div>
      </div>
    </section>
