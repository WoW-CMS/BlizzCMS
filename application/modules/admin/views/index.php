    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('dashboard') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><span><?= lang('dashboard') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-3-4@s"></div>
          <div class="uk-width-1-4@s">
            <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-1" data-uk-grid>
              <div>
                <div class="uk-card uk-card-secondary uk-card-body">
                  <div class="uk-text-center">
                    <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><?= lang('count_accounts_created') ?></h5>
                    <h1 class="uk-h1 uk-margin-small">
                      <span class="purecounter" data-purecounter-start="0" data-purecounter-end="1000">0</span>
                      <span class="uk-margin-small-left"><i class="fas fa-user-friends"></i></span>
                    </h1>
                    <p class="uk-text-small uk-margin-remove"><?= lang('total_accounts_registered') ?></p>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-card uk-card-secondary uk-card-body">
                  <div class="uk-text-center">
                    <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><?= lang('count_accounts_banned') ?></h5>
                    <h1 class="uk-h1 uk-margin-small">
                      <span class="purecounter" data-purecounter-start="0" data-purecounter-end="1000">0</span>
                      <span class="uk-margin-small-left"><i class="fas fa-user-slash"></i></span>
                    </h1>
                    <p class="uk-text-small uk-margin-remove"><?= lang('total_accounts_banned') ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
