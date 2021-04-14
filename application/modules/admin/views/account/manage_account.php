    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-user-cog"></i> <?= $this->lang->line('placeholder_manage_account'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/accounts'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-margin-small">
          <div class="uk-card-header">
            <h5 class="uk-h5"><i class="fas fa-info-circle"></i> <?= $this->lang->line('placeholder_update_information'); ?></h5>
          </div>
          <div class="uk-card-body">
            <div class="uk-grid uk-grid-medium" data-uk-grid>
              <div class="uk-width-1-4@s">
                <div class="uk-flex uk-flex-center uk-margin-small">
                  <img class="uk-border-rounded" src="<?= base_url('assets/images/profiles/'.$this->wowauth->getNameAvatar($this->wowauth->getImageProfile($idlink))); ?>" height="170" alt="Avatar">
                </div>
                <div class="uk-text-center uk-margin-small">
                  <?php foreach ($this->wowgeneral->getUserInfoGeneral($idlink)->result() as $info): ?>
                  <h3 class="uk-h3 uk-text-bold uk-margin-remove"><i class="fas fa-user"></i> <?= $info->username ?></h3>
                  <p class="uk-margin-remove"><i class="fas fa-envelope"></i> <?= $info->email ?></p>
                  <?php endforeach; ?>
                </div>
              </div>
              <div class="uk-width-3-4@s">
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small"><span><i class="fas fa-coins"></i> <?= $this->lang->line('placeholder_account_points'); ?></span></h5>
                <?= form_open('', 'id="updateaccountForm" onsubmit="UpdateAccountForm(event)"'); ?>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('panel_dp'); ?></label>
                      <div class="uk-form-controls">
                        <input class="uk-input" type="number" id="account_dp" min="0" value="<?= $this->wowgeneral->getCharDPTotal($idlink); ?>" placeholder="<?= $this->lang->line('panel_dp'); ?>" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('panel_vp'); ?></label>
                      <div class="uk-form-controls">
                        <input class="uk-input" type="number" id="account_vp" min="0" value="<?= $this->wowgeneral->getCharVPTotal($idlink); ?>" placeholder="<?= $this->lang->line('panel_vp'); ?>" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-grid uk-grid-small uk-margin-small-top uk-margin-bottom" data-uk-grid>
                  <div class="uk-width-1-2@s">
                    <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_upaccount"><i class="fas fa-sync"></i> <?= $this->lang->line('button_update'); ?></button>
                  </div>
                </div>
                <?= form_close(); ?>
                <?php if($this->admin_model->getBanSpecify($idlink)->num_rows()): ?>
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small"><span><i class="far fa-check-circle"></i> <?= $this->lang->line('placeholder_account_unban'); ?></span></h5>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-inline uk-width-1-3@s">
                      <button class="uk-button uk-button-primary uk-width-1-1" type="submit" value="<?= $idlink ?>" id="button_unban" onclick="RemoveBan(event, this.value)"><i class="far fa-check-circle"></i> <?= $this->lang->line('button_unban'); ?></button>
                    </div>
                  </div>
                </div>
                <?php else: ?>
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small"><span><i class="fas fa-ban"></i> <?= $this->lang->line('placeholder_account_ban'); ?></span></h5>
                <?= form_open('', 'id="banaccountForm" onsubmit="BanAccountForm(event)"'); ?>
                <div class="uk-margin-small">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_reason'); ?></label>
                  <div class="uk-inline uk-width-1-1">
                    <div class="uk-form-controls">
                      <textarea class="uk-textarea" type="textarea" id="ban_reason" placeholder="<?= $this->lang->line('placeholder_reason'); ?>" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="uk-grid uk-grid-small uk-margin-small-top uk-margin-bottom" data-uk-grid>
                  <div class="uk-width-1-2@s">
                    <button class="uk-button uk-button-danger uk-width-1-1" type="submit" id="button_ban"><i class="fas fa-ban"></i> <?= $this->lang->line('button_ban'); ?></button>
                  </div>
                </div>
                <?= form_close(); ?>
                <?php endif; ?>
                <?php if($this->wowauth->getRank($idlink) <= '1'): ?>
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small"><span><i class="fas fa-user-minus"></i> <?= $this->lang->line('placeholder_account_remove_rank'); ?></span></h5>
                <div class="uk-grid uk-grid-small uk-margin-small-top uk-margin-remove-bottom" data-uk-grid>
                  <div class="uk-width-1-2@s">
                    <button class="uk-button uk-button-primary uk-width-1-1" type="submit" value="<?= $idlink ?>" id="button_delrank" onclick="RemoveRank(event, this.value)"><i class="fas fa-user-minus"></i> <?= $this->lang->line('button_remove'); ?></button>
                  </div>
                </div>
                <?php else: ?>
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small"><span><i class="fas fa-user-plus"></i> <?= $this->lang->line('placeholder_account_grant_rank'); ?></span></h5>
                <?= form_open('', 'id="grantrankForm" onsubmit="GrantRankForm(event)"'); ?>
                <div class="uk-margin-small">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_gmlevel'); ?></label>
                  <div class="uk-inline uk-width-1-1">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="number" id="account_gmrank" min="0" placeholder="<?= $this->lang->line('placeholder_gmlevel'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-grid uk-grid-small uk-margin-small-top uk-margin-remove-bottom" data-uk-grid>
                  <div class="uk-width-1-2@s">
                    <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_addrank"><i class="fas fa-user-plus"></i> <?= $this->lang->line('button_grant'); ?></button>
                  </div>
                </div>
                <?= form_close(); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="uk-grid uk-grid-small uk-margin" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-users-cog"></i> <?= $this->lang->line('panel_chars_list'); ?></h3>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-4@s">
            <div class="uk-card uk-card-secondary">
              <ul class="uk-nav uk-nav-default" uk-switcher="connect: #acc-characters">
                <?php foreach($this->wowrealm->getRealms()->result() as $realm): ?>
                <li><a href="javascript:void(0)"><i class="fas fa-server"></i> <?= $this->wowrealm->getRealmName($realm->realmID); ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-secondary character-list uk-card-body">
              <div class="uk-overflow-auto">
                <ul id="acc-characters" class="uk-switcher">
                  <?php foreach ($this->wowrealm->getRealms()->result() as $charsMultiRealm):
                    $multiRealm = $this->wowrealm->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
                  ?>
                  <li>
                    <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                      <thead>
                        <tr>
                          <th class="uk-table-shrink"><?= $this->lang->line('table_header_guid'); ?></th>
                          <th class="uk-width-small"><?= $this->lang->line('table_header_name'); ?></th>
                          <th class="uk-table-shrink"><?= $this->lang->line('table_header_race'); ?></th>
                          <th class="uk-table-shrink"><?= $this->lang->line('table_header_class'); ?></th>
                          <th class="uk-table-shrink"><?= $this->lang->line('table_header_level'); ?></th>
                          <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_money'); ?></th>
                          <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_total_kills'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($this->wowrealm->getGeneralCharactersSpecifyAcc($multiRealm, $idlink)->result() as $chars): ?>
                        <tr>
                          <td><?= $chars->guid ?></td>
                          <td><?= $chars->name ?></td>
                          <td><img class="uk-border-rounded" src="<?= base_url('assets/images/races/'.$this->wowgeneral->getRaceIcon($chars->race)); ?>" width="24" height="24" title="<?=$this->wowgeneral->getRaceName($chars->race);?>" alt="Race"></td>
                          <td><img class="uk-border-rounded" src="<?= base_url('assets/images/class/'.$this->wowgeneral->getClassIcon($chars->class)); ?>" width="24" height="24" title="<?=$this->wowgeneral->getClassName($chars->class);?>" alt="Class"></td>
                          <td><?= $chars->level ?></td>
                          <td class="uk-text-center"><?= $chars->money ?></td>
                          <td class="uk-text-center"><?= $chars->totalKills ?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      function UpdateAccountForm(e) {
        e.preventDefault();

        var id = "<?= $idlink ?>";
        var dp = $('#account_dp').val();
        var vp = $('#account_vp').val();
        if(dp == '' || vp == ''){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_dp_vp_empty'); ?>',
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
        $.ajax({
          url:"<?= base_url($lang.'/admin/account/update'); ?>",
          method:"POST",
          data:{id, dp, vp},
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

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_account_updated'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#updateaccountForm')[0].reset();
            window.location.replace("<?= base_url('admin/account/manage/'.$idlink); ?>");
          }
        });
      }
      function BanAccountForm(e) {
        e.preventDefault();

        var id = "<?= $idlink ?>";
        var reason = $('#ban_reason').val();
        if(reason == ''){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_reason_empty'); ?>',
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
        $.ajax({
          url:"<?= base_url($lang.'/admin/account/ban'); ?>",
          method:"POST",
          data:{id, reason},
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

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_account_banned'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#banaccountForm')[0].reset();
            window.location.replace("<?= base_url('admin/account/manage/'.$idlink); ?>");
          }
        });
      }
      function RemoveBan(e, value) {
        e.preventDefault();

        $.ajax({
          url:"<?= base_url($lang.'/admin/account/unban'); ?>",
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

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_account_ban_remove'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= base_url('admin/account/manage/'.$idlink); ?>");
          }
        });
      }
      function GrantRankForm(e) {
        e.preventDefault();

        var id = "<?= $idlink ?>";
        var rank = $('#account_gmrank').val();
        if(rank == ''){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_rank_empty'); ?>',
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
        $.ajax({
          url:"<?= base_url($lang.'/admin/account/grantrank'); ?>",
          method:"POST",
          data:{id, rank},
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

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_rank_granted'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#grantrankForm')[0].reset();
            window.location.replace("<?= base_url('admin/account/manage/'.$idlink); ?>");
          }
        });
      }
      function RemoveRank(e, value) {
        e.preventDefault();

        $.ajax({
          url:"<?= base_url($lang.'/admin/account/delrank'); ?>",
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

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_rank_removed'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= base_url('admin/account/manage/'.$idlink); ?>");
          }
        });
      }
    </script>
