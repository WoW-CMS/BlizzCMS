<?php
if (isset($_POST['button_changeLevel'])):
  $level = $_POST['newLevel'];
  $this->admin_model->insertChangeLevelChar($idlink, $level, $multiRealm, $idrealm);
endif;

if (isset($_POST['button_renamechar'])):
  $newname = $_POST['newName'];
  $this->admin_model->insertCharRename($idlink, $newname, $multiRealm, $idrealm);
endif;

if (isset($_POST['button_unban'])):
  $this->admin_model->insertUnbanChar($idlink, $multiRealm, $idrealm);
endif;

if (isset($_POST['button_banchar'])):
  $reason = $_POST['banchar_reason'];
  $this->admin_model->insertBanChar($idlink, $reason, $multiRealm, $idrealm);
endif;

if (isset($_POST['button_customize'])):
  $this->admin_model->insertCustomizeChar($idlink, $multiRealm, $idrealm);
endif;

if (isset($_POST['button_changerace'])):
  $this->admin_model->insertChangeRaceChar($idlink, $multiRealm, $idrealm);
endif;

if (isset($_POST['button_changefaction'])):
  $this->admin_model->insertChangeFactionChar($idlink, $multiRealm, $idrealm);
endif; ?>

      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <?php if(isset($_GET['char'])) { ?>
          <div class="uk-alert-danger uk-margin-small" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p><i class="fas fa-info-circle"></i> <?= $this->lang->line('status_is_online'); ?></p>
          </div>
          <?php } ?>
          <?php if(isset($_GET['name'])) { ?>
          <div class="uk-alert-danger uk-margin-small" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p><i class="fas fa-info-circle"></i> <?= $this->lang->line('status_name_exist'); ?></p>
          </div>
          <?php } ?>
          <div class="uk-card uk-card-default uk-margin-small">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-user"></i></span><?= $this->lang->line('panel_admin_char_manage'); ?> - <span class="uk-text-bold"><?= $this->m_characters->getNameCharacterSpecifyGuid($multiRealm, $idlink); ?></span></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-3@m" data-uk-grid>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                      <h5 class="uk-h5 uk-text-uppercase uk-text-center"><i class="fas fa-cog"></i> <?= $this->lang->line('panel_admin_change_level'); ?></h5>
                    </div>
                    <div class="uk-card-body">
                      <form action="" method="post" accept-charset="utf-8">
                        <div class="uk-margin-small">
                          <div class="uk-form-controls">
                            <div class="uk-inline uk-width-1-1">
                              <input class="uk-input" name="newLevel" type="number" min="1" max="<?= $this->m_general->getMaxLevel(); ?>" placeholder="<?= $this->lang->line('column_level'); ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin-small">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="button_changeLevel" type="submit"><i class="fas fa-sync"></i> <?= $this->lang->line('button_change_level'); ?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                      <h5 class="uk-h5 uk-text-uppercase uk-text-center"><i class="fas fa-cog"></i> <?= $this->lang->line('panel_admin_rename'); ?></h5>
                    </div>
                    <div class="uk-card-body">
                      <form action="" method="post" accept-charset="utf-8">
                        <div class="uk-margin-small">
                          <div class="uk-form-controls">
                            <div class="uk-inline uk-width-1-1">
                              <input class="uk-input" name="newName" type="text" placeholder="<?= $this->lang->line('panel_admin_rename'); ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin-small">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="button_renamechar" type="submit"><i class="fas fa-edit"></i> <?= $this->lang->line('panel_admin_rename'); ?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php if($this->m_characters->getCharBanSpecifyGuid($idlink, $multiRealm)->num_rows()): ?>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                      <h5 class="uk-h5 uk-text-uppercase uk-text-center"><i class="fas fa-cog"></i> <?= $this->lang->line('panel_admin_unban_char'); ?></h5>
                    </div>
                    <div class="uk-card-body">
                      <form action="" method="post">
                        <div class="uk-margin-small">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="button_unban" type="submit"><i class="fas fa-check-circle"></i><?= $this->lang->line('button_unban'); ?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php else: ?>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                      <h5 class="uk-h5 uk-text-uppercase uk-text-center"><i class="fas fa-cog"></i> <?= $this->lang->line('panel_admin_ban_char'); ?></h5>
                    </div>
                    <div class="uk-card-body">
                      <form action="" method="post" accept-charset="utf-8">
                        <div class="uk-margin-small">
                          <div class="uk-form-controls">
                            <div class="uk-inline uk-width-1-1">
                              <input class="uk-input" name="banchar_reason" type="text" placeholder="<?= $this->lang->line('panel_admin_reason'); ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin-small">
                          <button class="uk-button uk-button-danger uk-width-1-1" name="button_banchar" type="submit"><i class="fas fa-ban"></i> <?= $this->lang->line('button_ban'); ?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                      <h5 class="uk-h5 uk-text-uppercase uk-text-center"><i class="fas fa-cog"></i> <?= $this->lang->line('panel_admin_customize'); ?></h5>
                    </div>
                    <div class="uk-card-body">
                      <form action="" method="post">
                        <div class="uk-margin-small">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="button_customize" type="submit"><i class="fas fa-sync"></i> <?= $this->lang->line('panel_admin_customize'); ?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                      <h5 class="uk-h5 uk-text-uppercase uk-text-center"><i class="fas fa-cog"></i> <?= $this->lang->line('panel_admin_change_race'); ?></h5>
                    </div>
                    <div class="uk-card-body">
                      <form action="" method="post">
                        <div class="uk-margin-small">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="button_changerace" type="submit"><i class="fas fa-sync"></i> <?= $this->lang->line('panel_admin_change_race'); ?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                      <h5 class="uk-h5 uk-text-uppercase uk-text-center"><i class="fas fa-cog"></i> <?= $this->lang->line('panel_admin_change_faction'); ?></h5>
                    </div>
                    <div class="uk-card-body">
                      <form action="" method="post">
                        <div class="uk-margin-small">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="button_changefaction" type="submit"><i class="fas fa-sync"></i> <?= $this->lang->line('panel_admin_change_faction'); ?></button>
                        </div>
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
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-list-alt"></i></span><?= $this->lang->line('panel_admin_annotations'); ?></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <ul class="uk-list uk-list-bullet">
                <?php foreach($this->admin_model->getAnnotationsSpecifyChar($idlink, $idrealm)->result() as $charlistannotation): ?>
                <li><?= $charlistannotation->annotation ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </section>
