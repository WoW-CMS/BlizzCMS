    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if($this->wowmodule->getUCPStatus() == '1'): ?>
              <li class="uk-active"><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('tab_account'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getDonationStatus() == '1'): ?>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('navbar_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getVoteStatus() == '1'): ?>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('navbar_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStoreStatus() == '1'): ?>
              <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=$this->lang->line('tab_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getBugtrackerStatus() == '1'): ?>
              <li><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=$this->lang->line('tab_bugtracker'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getChangelogsStatus() == '1'): ?>
              <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('tab_changelogs'); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= $this->lang->line('tab_account'); ?></h4>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small">
                  <div class="uk-width-expand@m">
                    <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-info-circle"></i> <?= $this->lang->line('panel_account_details'); ?></h5>
                  </div>
                  <div class="uk-width-auto@m">
                    <a href="<?= base_url('settings'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-user-edit"></i> <?= $this->lang->line('button_account_settings'); ?></a>
                  </div>
                </div>
              </div>
              <div class="uk-card-body">
                <div class="uk-overflow-auto uk-margin-small">
                  <table class="uk-table uk-table-small">
                    <tbody>
                      <tr>
                        <td class="uk-width-small"><span class="uk-h5 uk-text-bold"><?= $this->lang->line('placeholder_username'); ?></span></td>
                        <td class="uk-table-expand">
                          <?= $this->wowauth->getUsernameID($this->session->userdata('wow_sess_id')); ?>
                          <?php if($this->user_model->getExistInfo() == 0): ?>
                          <?= form_open('', 'id="syncAccount" class="uk-display-inline" onsubmit="SyncAccount(event)"'); ?>
                          <button class="uk-button uk-button-small uk-button-default uk-margin-small-left"><i class="fas fa-sync" value="<?= $this->session->userdata('wow_sess_id'); ?>" id="button_sync" type="submit"></i></button>
                          <?= form_close(); ?>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <tr>
                        <td class="uk-width-small"><span class="uk-h5 uk-text-bold"><?= $this->lang->line('placeholder_email'); ?></span></td>
                        <td class="uk-table-expand"><?= $this->wowauth->getEmailID($this->session->userdata('wow_sess_id')); ?></td>
                      </tr>
                      <tr>
                        <td class="uk-width-small"><span class="uk-h5 uk-text-bold"><?= $this->lang->line('panel_last_ip'); ?></span></td>
                        <td class="uk-table-expand"><?= $this->user_model->getLastIp($this->session->userdata('wow_sess_id')); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-users"></i> <?= $this->lang->line('panel_chars_list'); ?></h5>
              </div>
              <div class="uk-card-body">
                <div class="uk-grid uk-child-width-1-1 uk-margin-small" data-uk-grid>
                  <?php foreach ($this->wowrealm->getRealms()->result() as $charsMultiRealm):
                    $multiRealm = $this->wowrealm->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
                  ?>
                  <div>
                    <h4 class="uk-h4 uk-text-bold"><i class="fas fa-server"></i> <?= $this->wowrealm->getRealmName($charsMultiRealm->realmID); ?></h4>
                    <div class="uk-grid uk-grid-small uk-child-width-auto" data-uk-grid>
                      <?php foreach($this->wowrealm->getGeneralCharactersSpecifyAcc($multiRealm , $this->session->userdata('wow_sess_id'))->result() as $chars): ?>
                      <div>
                        <img class="uk-border-circle" src="<?= base_url('assets/images/class/'.$this->wowgeneral->getClassIcon($chars->class)); ?>" title="<?= $chars->name ?> (Lvl <?= $chars->level ?>)" width="50" height="50" uk-tooltip>
                      </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php if($this->user_model->getExistInfo() == 0): ?>
    <script>
      function SyncAccount(e) {
        e.preventDefault();

        var value = $('#button_sync').attr('value');
        $.ajax({
          url:"<?= base_url($lang.'/panel/sync'); ?>",
          method:"POST",
          data:{value},
          dataType:"text",
          beforeSend: function(){
            $.amaran({
              'theme': 'awesome info',
              'content': {
                title: '<?= $this->lang->line('notification_title_info'); ?>',
                message: '<?= $this->lang->line('notification_checking'); ?>',
                info: '',
                icon: 'fas fa-sign-in-alt'
              },
              'delay': 5000,
              'position': 'top right',
              'inEffect': 'slideRight',
              'outEffect': 'slideRight'
            });
          },
          success:function(response){
            if(!response)
              alert(response);

            if (response == 'idErr') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: 'id',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              return false;
            }

            if (response == 'accErr') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: 'acc',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              return false;
            }

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_sync_account'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= base_url('panel'); ?>");
          }
        });
      }
    </script>
    <?php endif; ?>
