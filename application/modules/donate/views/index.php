<?php
if (isset($_POST['button_donate'])):
  $this->donate_model->getDonate($_POST['button_donate']);
endif; ?>

    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <li><a href="<?= site_url('user'); ?>"><i class="fas fa-user-circle"></i> <?= lang('my_account'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li class="uk-active"><a href="<?= site_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?= lang('donate_panel'); ?></a></li>
              <li><a href="<?= site_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?= lang('vote_panel'); ?></a></li>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <?= $template['partials']['alerts']; ?>
            <div class="uk-grid-small uk-grid-match uk-child-width-1-1 uk-child-width-1-3@s uk-flex-center" uk-grid>
              <?php foreach($this->donate_model->getDonations()->result() as $donateList): ?>
              <div>
                <div class="uk-transition-toggle" tabindex="0">
                  <div class="uk-card uk-card-body uk-card-donate uk-text-center uk-transition-scale-up uk-transition-opaque">
                    <i class="fab fa-paypal fa-3x"></i>
                    <h2 class="uk-margin-small uk-text-bold"><?= $donateList->name ?><br>
                      <sup><?= config_item('paypal_currency_symbol'); ?></sup><?= $donateList->price ?>
                    </h2>
                    <h5 class="uk-margin-small"><span uk-icon="icon: plus-circle"></span> <?= lang('donate_get'); ?> <span class="uk-text-bold"><?= $donateList->points ?></span> <?= lang('donor_points'); ?>
                    </h5>
                    <form action="" method="post" accept-charset="utf-8">
                      <div class="uk-margin">
                        <button class="uk-button uk-button-secondary" type="submit" value="<?= $donateList->id ?>" name="button_donate"><i class="fas fa-donate"></i> <?= lang('donate'); ?></button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
