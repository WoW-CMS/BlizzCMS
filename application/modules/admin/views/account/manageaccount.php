<?php
if (isset($_POST['action_ban'])):
  $reason = $_POST['action_reason'];
  $this->admin_model->insertBanAcc($idlink, $reason);
endif;

if (isset($_POST['button_unban'])):
  $this->admin_model->inserUnBanAcc($idlink);
endif;

if (isset($_POST['button_RemoveRankACCWeb'])):
  $this->admin_model->removeRankAcc($idlink);
endif;

if (isset($_POST['button_AddRankACCWeb'])):
  $gmlevel = $_POST['gmlevel'];
  $this->admin_model->insertRankAcc($idlink, $gmlevel);
endif;
?>
      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <div class="uk-card uk-card-default uk-margin-small">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span data-uk-icon="icon: user"></span> <?= $this->lang->line('panel_admin_user_manage'); ?> - <?= $this->m_data->getUsernameID($idlink) ?></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-3@m" data-uk-grid>
                <?php if($this->admin_model->getBanSpecify($idlink)->num_rows()): ?>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-card-header uk-card-primary uk-text-center uk-text-uppercase">
                      <i class="fas fa-check-circle"></i> <?= $this->lang->line('panel_admin_unban_account'); ?>
                    </div>
                    <div class="uk-card-body">
                      <form action="" method="post">
                        <div class="uk-margin-small">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="button_unban" type="submit"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_unban'); ?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php else: ?>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-card-header uk-card-secondary uk-text-center uk-text-uppercase">
                      <i class="fas fa-ban"></i> <?= $this->lang->line('panel_admin_ban_account'); ?>
                    </div>
                    <div class="uk-card-body">
                      <form action="" method="post" accept-charset="utf-8">
                        <div class="uk-margin-small">
                          <div class="uk-form-controls">
                            <div class="uk-inline uk-width-1-1">
                              <input class="uk-input" name="action_reason" type="text" placeholder="<?= $this->lang->line('panel_admin_reason'); ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin-small">
                          <button class="uk-button uk-button-danger uk-width-1-1" name="action_ban" type="submit"><i class="fas fa-ban"></i> <?= $this->lang->line('button_ban'); ?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-card-header uk-card-primary uk-text-center uk-text-uppercase"><i class="fas fa-gamepad"></i> <?= $this->lang->line('panel_admin_rank_account'); ?></div>
                    <div class="uk-card-body">
                      <form action="" method="post">
                        <?php if($this->m_data->getGmSpecify($idlink)->num_rows()): ?>
                        <div class="uk-margin-small">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="button_RemoveRankACCWeb" type="submit"><i class="fas fa-user-times"></i> <?= $this->lang->line('button_re_grant_account'); ?></button>
                        </div>
                        <?php else: ?>
                        <div class="uk-margin-small">
                          <div class="uk-form-controls">
                            <div class="uk-inline uk-width-1-1">
                              <input class="uk-input" name="gmlevel" type="number" min="1" placeholder="<?= $this->lang->line('panel_admin_gmlevel'); ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin-small">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="button_AddRankACCWeb" type="submit"><i class="fas fa-user-plus"></i> <?= $this->lang->line('button_grant_account'); ?></button>
                        </div>
                        <?php endif; ?>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-card uk-card-default uk-margin-small">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span data-uk-icon="icon: user"></span> <?= $this->lang->line('panel_admin_general_info'); ?></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <div class="uk-overflow-auto uk-margin-small">
                <table class="uk-table uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-width-medium"><?= $this->lang->line('form_username'); ?></th>
                      <th class="uk-width-medium"><?= $this->lang->line('form_email'); ?></th>
                      <th class="uk-width-small"><?= $this->lang->line('panel_member'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($this->m_general->getUserInfoGeneral($idlink)->result() as $ginfo): ?>
                    <tr>
                      <td><?= $ginfo->username ?></td>
                      <td><?= $ginfo->email ?></td>
                      <td><?= date('Y-m-d', $ginfo->date); ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="uk-card uk-card-default uk-margin-small">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span data-uk-icon="icon: user"></span> <?= $this->lang->line('panel_admin_donate_history'); ?></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <div class="uk-overflow-auto uk-margin-small">
                <table class="uk-table uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-width-small">Payment ID</th>
                      <th class="uk-width-medium">Hash</th>
                      <th class="uk-width-small">Total</th>
                      <th class="uk-width-small">Complete</th>
                      <th class="uk-width-small">Create Time</th>
                      <th class="uk-width-small">Points</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($this->admin_model->getUserHistoryDonate($idlink)->result() as $donateInfo): ?>
                    <tr>
                      <td><?= $donateInfo->payment_id ?></td>
                      <td><?= $donateInfo->hash ?></td>
                      <td><?= $donateInfo->total ?></td>
                      <td><?= $this->admin_model->getDonateStatus($donateInfo->complete); ?></td>
                      <td><?= $donateInfo->create_time ?></td>
                      <td><?= $donateInfo->points ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="uk-card uk-card-default uk-margin-small">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span data-uk-icon="icon: user"></span> <?= $this->lang->line('panel_chars_list'); ?></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <ul uk-accordion>
                <?php foreach ($this->m_data->getRealms()->result() as $charsMultiRealm):
                  $multiRealm = $this->m_data->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
                ?>
                <li>
                  <a href="#" class="uk-accordion-title"><span data-uk-icon="icon: server"></span> Realm - <?= $this->m_general->getRealmName($charsMultiRealm->realmID); ?></a>
                  <div class="uk-accordion-content">
                    <div class="uk-overflow-auto uk-margin-small">
                      <table class="uk-table uk-table-divider uk-table-small">
                        <thead>
                          <tr>
                            <th class="uk-width-small">Guid</th>
                            <th class="uk-width-medium"><?= $this->lang->line('column_name'); ?></th>
                            <th class="uk-width-small"><?= $this->lang->line('column_race'); ?></th>
                            <th class="uk-width-small"><?= $this->lang->line('column_class'); ?></th>
                            <th class="uk-width-small"><?= $this->lang->line('column_level'); ?></th>
                            <th class="uk-width-small"><?= $this->lang->line('column_money'); ?></th>
                            <th class="uk-width-small"><?= $this->lang->line('column_total_kills'); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($this->m_characters->getGeneralCharactersSpecifyAcc($multiRealm, $idlink)->result() as $chars): ?>
                          <tr>
                            <td class="uk-table-link"><a href="<?= base_url('admin/managecharacter/'.$chars->guid.'/'.$charsMultiRealm->id); ?>" class="uk-link-reset"><?= $chars->guid ?></a></td>
                            <td class="uk-table-link"><a href="<?= base_url('admin/managecharacter/'.$chars->guid.'/'.$charsMultiRealm->id); ?>" class="uk-link-reset"><?= $chars->name ?></a></td>
                            <td><?= $this->m_general->getRaceName($chars->race); ?></td>
                            <td><?= $this->m_general->getNameClass($chars->class); ?></td>
                            <td><?= $chars->level ?></td>
                            <td><?= $chars->money ?></td>
                            <td><?= $chars->totalKills ?></td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="uk-card uk-card-default uk-margin-small">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span data-uk-icon="icon: list"></span> <?= $this->lang->line('panel_admin_annotations'); ?></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <ul class="uk-list uk-list-bullet">
                <?php foreach($this->admin_model->getAnnotationsSpecify($idlink)->result() as $annotations): ?>
                <li><?= $annotations->annotation ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </section>
