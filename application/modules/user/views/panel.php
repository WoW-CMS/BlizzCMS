    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-small main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if($this->m_modules->getStatusUCP() == '1'): ?>
              <?php if($this->m_permissions->getMyPermissions('Permission_Panel')): ?>
              <li class="uk-active"><a href="<?= base_url('panel') ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('nav_account'); ?></a></li>
              <?php endif; ?>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->m_modules->getDonation() == '1'): ?>
              <li><a href="<?= base_url('donate') ?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('button_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getVote() == '1'): ?>
              <li><a href="<?= base_url('vote') ?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('button_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->m_modules->getStatusStore() == '1'): ?>
              <li><a href="<?= base_url('store') ?>"><i class="fas fa-store"></i> <?=$this->lang->line('nav_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->m_modules->getStatusLadBugtracker() == '1'): ?>
              <li><a href="<?= base_url('bugtracker') ?>"><i class="fas fa-bug"></i> <?=$this->lang->line('nav_bugtracker'); ?></a></li>
              <?php endif; ?>
              <li><a href="<?= base_url('changelogs') ?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('nav_changelogs'); ?></a></li>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <h3 class="uk-h3 uk-text-uppercase uk-text-bold"><?= $this->lang->line('nav_account'); ?></h3>
            <?php if(isset($_POST['button_changepass'])) {
              $oldpass = $_POST['oldpass'];
              $newpass = $_POST['newpass'];
              $reppass = $_POST['newpassr'];

              if (strlen($newpass) >= 5 && strlen($newpass) <= 16)
              {
                if ($reppass == $newpass)
                {
                  if ($this->m_general->getExpansionAction() == 1)
                  {
                    $compare = $this->m_data->Account($this->session->userdata('fx_sess_username'), $oldpass);

                    $newpassI = $this->m_data->Account($this->session->userdata('fx_sess_username'), $newpass);

                    if ($this->m_data->getPasswordAccountID($this->session->userdata('fx_sess_id')) == strtoupper($compare))
                    {
                      if ($newpassI == $this->m_data->getPasswordAccountID($this->session->userdata('fx_sess_id')))
                        echo '<div class="uk-alert-warning uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('password_same').'</p></div>';
                      else
                      {
                        $this->user_model->changePasswordI($this->session->userdata('fx_sess_id'), $newpassI);
                      }
                    }
                    else
                      echo '<div class="uk-alert-warning uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('opassword_not_match').'</p></div>';
                  }
                  else if ($this->m_general->getExpansionAction() == 2)
                  {
                    $compare = $this->m_data->Battlenet($this->session->userdata('fx_sess_email'), $oldpass);

                    $newpassI = $this->m_data->Account($this->session->userdata('fx_sess_username'), $newpass);

                    $newpassII = $this->m_data->Battlenet($this->session->userdata('fx_sess_email'), $newpass);

                    if ($this->m_data->getPasswordBnetID($this->session->userdata('fx_sess_id')) == strtoupper($compare))
                    {
                      if ($newpassII == $this->m_data->getPasswordBnetID($this->session->userdata('fx_sess_id')))
                        echo '<div class="uk-alert-warning uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('password_same').'</p></div>';
                      else
                      {
                        $this->user_model->changePasswordII($this->session->userdata('fx_sess_id'), $newpassI, $newpassII);
                      }
                    }
                    else
                      echo '<div class="uk-alert-warning uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('opassword_not_match').'</p></div>';
                  }
                  else
                    echo '<div class="uk-alert-danger uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('expansion_not_found').'</p></div>';
                }
                else
                  echo '<div class="uk-alert-warning uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('password_not_match').'</p></div>';
              }
              else
                echo '<div class="uk-alert-danger uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('password_lenght_error').'</p></div>';
            } ?>

            <?php if(isset($_POST['button_changeemail'])) {
              $password = $_POST['password'];
              $oldemail = $_POST['oldemail'];
              $newemail = $_POST['newemail'];

              if ($this->m_general->getExpansionAction() == 1)
              {
                $compare = $this->m_data->Account($this->session->userdata('fx_sess_username'), $password);

                if (strtoupper($this->session->userdata('fx_sess_email')) == strtoupper($oldemail))
                {
                  if ($this->m_data->getPasswordAccountID($this->session->userdata('fx_sess_id')) == strtoupper($compare))
                  {
                    $this->user_model->changeEmailI($this->session->userdata('fx_sess_id'), $newemail);
                  }
                  else
                    echo '<div class="uk-alert-warning uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p class="uk-text-center"><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('opassword_not_match').'</p></div>';
                }
                else
                  echo '<div class="uk-alert-warning uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p class="uk-text-center"><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('oemail_not_match').'</p></div>';
              }
              else if ($this->m_general->getExpansionAction() == 2)
              {
                $compare = $this->m_data->Battlenet($this->session->userdata('fx_sess_email'), $password);

                $newpasscompare = $this->m_data->Battlenet($newemail, $password);

                if ($this->user_model->getExistEmail(strtoupper($newemail)) > 0)
                  echo '<div class="uk-alert-warning uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p class="uk-text-center"><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('email_used').'</p></div>';
                else
                {
                  if (strtoupper($this->session->userdata('fx_sess_email')) == strtoupper($oldemail))
                  {
                    if ($this->m_data->getPasswordBnetID($this->session->userdata('fx_sess_id')) == strtoupper($compare))
                    {
                      $this->user_model->changeEmailII($this->session->userdata('fx_sess_id'), $newemail, $newpasscompare);
                    }
                    else
                      echo '<div class="uk-alert-warning uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p class="uk-text-center"><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('opassword_not_match').'</p></div>';
                  }
                  else
                    echo '<div class="uk-alert-warning uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p class="uk-text-center"><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('oemail_not_match').'</p></div>';
                }
              }
              else
                echo '<div class="uk-alert-danger uk-margin-small" uk-alert><a class="uk-alert-close" uk-close></a><p class="uk-text-center"><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('expansion_notfound').'</p></div>';
            } ?>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small">
                  <div class="uk-width-expand@m">
                    <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-info-circle"></i> Account Details</h4>
                  </div>
                  <div class="uk-width-auto@m">
                    <a class="uk-button uk-button-default uk-button-small" uk-toggle="target: #changePassword"><i class="fas fa-key"></i> <?= $this->lang->line('button_change_password'); ?></a>
                  </div>
                </div>
              </div>
              <div class="uk-card-body">
                <div class="uk-overflow-auto uk-margin-small">
                  <table class="uk-table uk-table-small">
                    <tbody>
                      <tr>
                        <td class="uk-width-small"><span class="uk-h5 uk-text-bold">Username</span></td>
                        <td class="uk-table-expand"><?= $this->m_data->getUsernameID($this->session->userdata('fx_sess_id')); ?></td>
                      </tr>
                      <tr>
                        <td class="uk-width-small"><span class="uk-h5 uk-text-bold">Email</span></td>
                        <td class="uk-table-expand"><?= $this->m_data->getEmailID($this->session->userdata('fx_sess_id')); ?></td>
                      </tr>
                      <tr>
                        <td class="uk-width-small"><span class="uk-h5 uk-text-bold">Last IP</span></td>
                        <td class="uk-table-expand"><?= $this->user_model->getLastIp($this->session->userdata('fx_sess_id')); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-users"></i> <?= $this->lang->line('panel_chars_list'); ?></h4>
              </div>
              <div class="uk-card-body">
                <div class="uk-grid uk-child-width-1-1 uk-margin-small" data-uk-grid>
                  <?php foreach ($this->m_data->getRealms()->result() as $charsMultiRealm):
                    $multiRealm = $this->m_data->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
                  ?>
                  <div>
                    <h4 class="uk-h4 uk-text-bold"><i class="fas fa-server"></i> <?= $this->m_general->getRealmName($charsMultiRealm->realmID); ?></h4>
                    <div class="uk-grid uk-grid-small uk-child-width-auto" data-uk-grid>
                      <?php foreach($this->m_characters->getGeneralCharactersSpecifyAcc($multiRealm , $this->session->userdata('fx_sess_id'))->result() as $chars): ?>
                      <div>
                        <img class="uk-border-circle" src="<?= base_url('includes/images/class/'.$this->m_general->getClassIcon($chars->class)); ?>" title="<?= $chars->name ?> (Lvl <?= $chars->level ?>)" width="50" height="50" uk-tooltip>
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
