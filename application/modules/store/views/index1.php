    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if($this->m_modules->getUCPStatus() == '1'): ?>
              <li><a href="<?= base_url('panel') ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('tab_account'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->m_modules->getDonationStatus() == '1'): ?>
              <li><a href="<?= base_url('donate') ?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('navbar_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getVoteStatus() == '1'): ?>
              <li><a href="<?= base_url('vote') ?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('navbar_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getStoreStatus() == '1'): ?>
              <li class="uk-active"><a href="<?= base_url('store') ?>"><i class="fas fa-store"></i> <?=$this->lang->line('tab_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->m_modules->getBugtrackerStatus() == '1'): ?>
              <li><a href="<?= base_url('bugtracker') ?>"><i class="fas fa-bug"></i> <?=$this->lang->line('tab_bugtracker'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getChangelogsStatus() == '1'): ?>
              <li><a href="<?= base_url('changelogs') ?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('tab_changelogs'); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <?php if(isset($_GET['complete'])): ?>
            <div class="uk-alert-success" uk-alert>
              <a class="uk-alert-close" uk-close></a>
              <p><i class="far fa-check-circle"></i> <?=$this->lang->line('alert_successful_purchase');?></p>
            </div>
            <?php endif; ?>
            <div class="uk-margin-remove-top uk-margin-small-bottom">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-expand">
                  <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?=$this->lang->line('tab_store'); ?></h4>
                </div>
                <div class="uk-width-auto">
                  <form method="post" action="">
                    <div class="uk-form-controls uk-light">
                      <select class="uk-select" id="selectCategory">
                        <option value="0"><?= $this->lang->line('store_select_categories'); ?></option>
                        <option value="0"><?= $this->lang->line('store_all_categories'); ?></option>
                        <?php foreach($this->store_model->getGroups()->result() as $ggroups): ?>
                        <option value="<?= $ggroups->id ?>"><?= $ggroups->name ?></option>
                        <?php endforeach; ?>
                      </select>
                      <script>
                        $('#selectCategory').change(function() {
                          var url = $(this).val(); // get selected value
                          if (url) { // require a URL
                            window.location = "<?= base_url('store/'); ?>"+url; // redirect
                          }
                          return false;
                        });
                      </script>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-1 uk-child-width-1-3@s uk-child-width-1-4@m" data-uk-grid>
              <?php foreach($this->store_model->getShopGeneral($idlink)->result() as $itemsG): ?>
              <div>
                <div class="uk-inline-clip uk-transition-toggle wow-store-margin" tabindex="0">
                  <img src="<?= base_url('includes/images/store/'.$itemsG->image); ?>" class="uk-border-rounded uk-transition-scale-up uk-transition-opaque" alt="<?= $itemsG->image ?>">
                  <div class="uk-overlay uk-position-bottom-center">
                    <p class="uk-text-center uk-text-break uk-light uk-text-break"><a rel="item=<?= $itemsG->itemid ?>" class="uk-button uk-button-text"><?= $itemsG->name ?></a></p>
                    <div class="uk-text-center uk-margin-small">
                      <?php if(!is_null($itemsG->price_dp) && !empty($itemsG->price_dp) && $itemsG->price_dp != '0'): ?>
                      <a href="<?= base_url('cart/'.$itemsG->id.'?tp=dp'); ?>" class="url-flex-points"><span uk-tooltip="title:<?=$this->lang->line('panel_dp'); ?>;pos: bottom"><i class="dp-icon"></i></span> <?= $itemsG->price_dp ?></a>
                      <?php endif; ?>
                      <?php if(!is_null($itemsG->price_vp) && !empty($itemsG->price_vp) && $itemsG->price_vp != '0'): ?>
                      <a href="<?= base_url('cart/'.$itemsG->id.'?tp=vp'); ?>" class="url-flex-points"><span uk-tooltip="title:<?=$this->lang->line('panel_vp'); ?>;pos: bottom"><i class="vp-icon"></i></span> <?= $itemsG->price_vp ?></a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
