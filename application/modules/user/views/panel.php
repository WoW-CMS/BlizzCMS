    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if($this->wowmodule->getStatusModule('User Panel')): ?>
              <li class="uk-active"><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('tab_account'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getStatusModule('Donation') == '1'): ?>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('navbar_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStatusModule('Vote') == '1'): ?>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('navbar_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStatusModule('Store') == '1'): ?>
              <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=$this->lang->line('tab_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getStatusModule('Bugtracker') == '1'): ?>
              <li><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=$this->lang->line('tab_bugtracker'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStatusModule('Changelogs') == '1'): ?>
              <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('tab_changelogs'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStatusModule('Download') == '1'): ?>
              <li><a href="<?= base_url('download'); ?>"><i class="fas fa-download"></i> <?=$this->lang->line('tab_download'); ?></a></li>
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
                        <td class="uk-table-expand"><?= $this->wowauth->getUsernameID($this->session->userdata('wow_sess_id')); ?></td>
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
                    <h5 class="uk-h5 uk-text-bold"><i class="fas fa-server"></i> <?= $this->wowrealm->getRealmName($charsMultiRealm->realmID); ?></h5>
                    <div class="uk-overflow-auto uk-width-1-1 uk-margin-small">
                      <table class="uk-table uk-table-divider uk-table-small">
                        <thead>
                          <tr>
                            <th class="uk-table-expand"><i class="fas fa-user"></i> <?= $this->lang->line('table_header_name'); ?></th>
                            <th class="uk-table-expand"><i class="fas fa-info-circle"></i> <?= $this->lang->line('table_header_race'); ?>/<?= $this->lang->line('table_header_class'); ?></th>
                            <th class="uk-width-small"><i class="fas fa-level-up-alt"></i> <?= $this->lang->line('table_header_level'); ?></th>
                            <th class="uk-table-expand"><i class="fas fa-clock"></i> <?= $this->lang->line('table_header_time_played'); ?></th>
                            <th class="uk-table-expand"><i class="fas fa-coins"></i> <?= $this->lang->line('table_header_money'); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($this->wowrealm->getGeneralCharactersSpecifyAcc($multiRealm , $this->session->userdata('wow_sess_id'))->result() as $chars): ?>
                          <tr>
                            <td><?= $chars->name ?></td>
                            <td>
                              <?php if($chars->race or $chars->class > 0) { ?>
                              <img class="uk-border-rounded" src="<?= base_url('assets/images/races/'.$this->wowgeneral->getRaceIcon($chars->race)); ?>" width="20" height="20" title="<?= $this->lang->line($this->wowgeneral->getRaceName($chars->race)); ?>" alt="">
                              <img class="uk-border-rounded" src="<?= base_url('assets/images/class/'.$this->wowgeneral->getClassIcon($chars->class)); ?>" width="20" height="20" title="<?= $this->wowgeneral->getClassName($chars->class); ?>" alt="">
                              <?php } ?>
                            </td>
                            <td><?= $chars->level ?></td>
                            <td><?= $this->wowgeneral->timeConversor($chars->totaltime); ?></td>
                            <td><?= $this->wowgeneral->moneyConversor($chars->money)['gold']; ?>g <?= $this->wowgeneral->moneyConversor($chars->money)['silver']; ?>s <?= $this->wowgeneral->moneyConversor($chars->money)['copper']; ?>c</td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
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
