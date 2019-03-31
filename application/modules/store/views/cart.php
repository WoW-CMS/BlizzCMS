<?php
if (isset($_POST['buyNowGetItem'])):
  $charselect = $_POST['charSelects'];

  $method = $_GET['tp'];
  $price = $this->store_model->getPriceType($idlink, $_GET['tp']);
  $result_explode = explode('|', $charselect);

  $soapUser = $this->m_data->getRealm($result_explode[0])->row_array()['console_username'];
  $soapPass = $this->m_data->getRealm($result_explode[0])->row_array()['console_password'];
  $soapHost = $this->m_data->getRealm($result_explode[0])->row_array()['console_hostname'];
  $soapPort = $this->m_data->getRealm($result_explode[0])->row_array()['console_port'];
  $soap_uri = $this->m_data->getRealm($result_explode[0])->row_array()['emulator'];

  $this->store_model->insertHistory(
    $idlink, 
    $this->store_model->getItem($idlink), 
    $this->session->userdata('fx_sess_id'), 
    $result_explode[1], 
    $method,
    $price,
    $soapUser, 
    $soapPass, 
    $soapHost, 
    $soapPort, 
    $soap_uri,
    $result_explode[0]);
endif; ?>

    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if($this->m_modules->getUCPStatus() == '1'): ?>
              <li><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('tab_account'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->m_modules->getDonationStatus() == '1'): ?>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('navbar_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getVoteStatus() == '1'): ?>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('navbar_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getStoreStatus() == '1'): ?>
              <li class="uk-active"><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=$this->lang->line('tab_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->m_modules->getBugtrackerStatus() == '1'): ?>
              <li><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=$this->lang->line('tab_bugtracker'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getChangelogsStatus() == '1'): ?>
              <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('tab_changelogs'); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
             <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-shopping-bag"></i> <?= $this->lang->line('tab_cart'); ?></h4>
            <div class="uk-overflow-auto uk-width-1-1 uk-margin-small">
              <table class="uk-table uk-table-middle uk-table-divider">
                <thead>
                  <tr>
                    <th class="uk-table-expand"><i class="fas fa-info-circle"></i> <?=$this->lang->line('store_item_name');?></th>
                    <th class="uk-table-expand uk-text-center"><i class="fas fa-list-ul"></i> <?=$this->lang->line('store_select_character');?></th>
                    <th class="uk-table-expand uk-text-center"><i class="fas fa-shopping-bag"></i> <?=$this->lang->line('store_item_price');?></th>
                    <th class="uk-table-expand uk-text-center"><i class="fas fa-cart-plus"></i> Buyout</th>
                  </tr>
                </thead>
                <tbody>
                  <form action="" method="post" accept-charset="utf-8">
                    <tr>
                      <td><?= $this->store_model->getName($idlink); ?></td>
                      <td>
                        <div class="uk-form-controls uk-light">
                          <select class="uk-select uk-width-1-1" name="charSelects">
                            <?php foreach ($this->m_data->getRealms()->result() as $charsMultiRealm): 
                              $multiRealm = $this->m_data->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
                            ?>
                              <?php foreach($this->m_characters->getGeneralCharactersSpecifyAcc($multiRealm ,$this->session->userdata('fx_sess_id'))->result() as $listchar): ?>
                              <option value="<?= $charsMultiRealm->id ?>|<?= $listchar->guid ?>"><?= $listchar->name ?> - <?= $this->m_general->getRealmName($charsMultiRealm->realmID); ?></option>
                              <?php endforeach; ?>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </td>
                      <td class="uk-text-center">
                        <?php if($_GET['tp'] == "dp"): ?>
                        <a class="url-flex-points"><span uk-tooltip="title:<?=$this->lang->line('panel_dp'); ?>;pos: bottom"><i class="dp-icon"></i></span> <?= $this->store_model->getPriceType($idlink, $_GET['tp']); ?></a>
                        <?php else: ?>
                        <a class="url-flex-points"><span uk-tooltip="title:<?=$this->lang->line('panel_vp'); ?>;pos: bottom"><i class="vp-icon"></i></span> <?= $this->store_model->getPriceType($idlink, $_GET['tp']); ?></a>
                        <?php endif; ?>
                      </td>
                      <td class="uk-text-center">
                        <?php if ($_GET['tp'] == "dp")
                          $qqs = $this->m_general->getCharDPTotal($this->session->userdata('fx_sess_id'));
                        else
                          $qqs = $this->m_general->getCharVPTotal($this->session->userdata('fx_sess_id'));
                        ?>
                        <?php if ($qqs >= $this->store_model->getPriceType($idlink, $_GET['tp'])): ?>
                        <button type="submit" name="buyNowGetItem" class="uk-button uk-button-default uk-width-3-4 uk-button-small" title="<?= $this->lang->line('button_buy'); ?>"><i class="fas fa-shopping-cart"></i> <?= $this->lang->line('button_buy'); ?></button>
                        <?php else: ?>
                        <div class="uk-alert-warning" uk-alert><p><i class="fas fa-exclamation-triangle"></i> <?=$this->lang->line('alert_points_insufficient');?></p></div>
                        <?php endif; ?>
                      </td>
                    </tr>
                  </form>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
