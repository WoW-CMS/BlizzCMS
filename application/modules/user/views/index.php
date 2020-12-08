    <section class="uk-section uk-section-xsmall uk-padding-remove uk-height-small header-section">

    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <li class="uk-active"><a href="<?= base_url('user'); ?>"><i class="fas fa-user-circle"></i> <?= lang('tab_account'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=lang('navbar_donate_panel'); ?></a></li>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=lang('navbar_vote_panel'); ?></a></li>
              <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=lang('tab_store'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=lang('tab_bugtracker'); ?></a></li>
              <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=lang('tab_changelogs'); ?></a></li>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small">
                  <div class="uk-width-expand@m">
                    <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-info-circle"></i> <?= lang('panel_account_details'); ?></h5>
                  </div>
                  <div class="uk-width-auto@m">
                    <a href="<?= base_url('user/settings'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-user-edit"></i> <?= lang('button_account_settings'); ?></a>
                  </div>
                </div>
              </div>
              <div class="uk-card-body">
                <div class="uk-overflow-auto uk-margin-small">
                  <table class="uk-table uk-table-small">
                    <tbody>
                      <tr>
                        <td class="uk-width-small"><span class="uk-h5 uk-text-bold"><?= lang('placeholder_nickname'); ?></span></td>
                        <td class="uk-table-expand"><?= $this->session->userdata('nickname'); ?></td>
                      </tr>
                      <tr>
                        <td class="uk-width-small"><span class="uk-h5 uk-text-bold"><?= lang('placeholder_username'); ?></span></td>
                        <td class="uk-table-expand"><?= $this->session->userdata('username'); ?></td>
                      </tr>
                      <tr>
                        <td class="uk-width-small"><span class="uk-h5 uk-text-bold"><?= lang('placeholder_email'); ?></span></td>
                        <td class="uk-table-expand"><?= $this->session->userdata('email'); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-users"></i> <?= lang('panel_chars_list'); ?></h5>
              </div>
              <div class="uk-card-body">
                <div class="uk-grid uk-child-width-1-1 uk-margin-small" data-uk-grid>
                  <?php foreach ($this->realm->getRealms()->result() as $charsMultiRealm):
                    $multiRealm = $this->realm->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
                  ?>
                  <div>
                    <h5 class="uk-h5 uk-text-bold"><i class="fas fa-server"></i> <?= $this->realm->getRealmName($charsMultiRealm->realmID); ?></h5>
                    <div class="uk-overflow-auto uk-width-1-1 uk-margin-small">
                      <table class="uk-table uk-table-divider uk-table-small">
                        <thead>
                          <tr>
                            <th class="uk-table-expand"><i class="fas fa-user"></i> <?= lang('table_header_name'); ?></th>
                            <th class="uk-table-expand"><i class="fas fa-info-circle"></i> <?= lang('table_header_race'); ?>/<?= lang('table_header_class'); ?></th>
                            <th class="uk-width-small"><i class="fas fa-level-up-alt"></i> <?= lang('table_header_level'); ?></th>
                            <th class="uk-table-expand"><i class="fas fa-clock"></i> <?= lang('table_header_time_played'); ?></th>
                            <th class="uk-table-expand"><i class="fas fa-coins"></i> <?= lang('table_header_money'); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($this->realm->getGeneralCharactersSpecifyAcc($multiRealm , $this->session->userdata('id'))->result() as $chars): ?>
                          <tr>
                            <td><?= $chars->name ?></td>
                            <td>
                              <img class="uk-border-circle" src="<?= base_url('assets/images/races/'.race_icon($chars->race)); ?>" width="20" height="20" title="<?= race_name($chars->race); ?>" alt="">
                              <img class="uk-border-circle" src="<?= base_url('assets/images/class/'.class_icon($chars->class)); ?>" width="20" height="20" title="<?= class_name($chars->class); ?>" alt="">
                            </td>
                            <td><?= $chars->level ?></td>
                            <td><?= time_converter($chars->totaltime); ?></td>
                            <td><?= money_converter($chars->money); ?></td>
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
