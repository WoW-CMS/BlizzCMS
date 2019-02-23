    <div id="newTopic" uk-modal="bg-close: false">
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title uk-text-uppercase"><i class="fas fa-pencil-alt"></i> <?= $this->lang->line('button_new_topic'); ?></h2>
        </div>
        <form action="<?= base_url('forum/newTopic/'.$idlink); ?>" method="post" accept-charset="utf-8" autocomplete="off">
          <div class="uk-modal-body">
            <div class="uk-margin uk-light">
              <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_title'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen fa-lg"></i></span>
                  <input class="uk-input" name="topic_title" type="text" placeholder="<?= $this->lang->line('form_title'); ?>" required>
                </div>
              </div>
            </div>
            <div class="uk-margin uk-light">
              <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_description'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-width-1-1">
                  <textarea class="uk-textarea tinyeditor" name="topic_description" rows="10" cols="80"></textarea>
                </div>
              </div>
            </div>
            <?php if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel'))): ?>
            <div class="uk-margin uk-light">
              <div class="uk-form-controls">
                <div class="uk-width-1-1 uk-text-center">
                  <label><input id="hightl" class="uk-checkbox" type="checkbox" name="check_highl" value="1"> <?= $this->lang->line('form_highl'); ?></label>
                  <span style="display:inline-block; width: 14px;"></span>
                  <label><input id="llock" class="uk-checkbox" type="checkbox" name="check_lock" value="1"> <?= $this->lang->line('form_lock'); ?></label>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </div>
          <div class="uk-modal-footer uk-text-right actions">
            <button class="uk-button uk-button-danger uk-modal-close" type="button"><i class="fas fa-times-circle"></i> <?= $this->lang->line('button_cancel'); ?></button>
            <button class="uk-button uk-button-default" type="submit" name="button_createTopic"><i class="fas fa-plus-circle"></i> <?= $this->lang->line('button_create'); ?></button>
          </div>
        </form>
      </div>
    </div>

    <div id="editTopic" uk-modal="bg-close: false">
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title uk-text-uppercase"><i class="fas fa-pencil-alt"></i> <?= $this->lang->line('button_edit_topic'); ?></h2>
        </div>
        <form action="" method="post" accept-charset="utf-8">
          <div class="uk-modal-body">
            <div class="uk-margin uk-light">
              <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_title'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen fa-lg"></i></span>
                  <input class="uk-input" name="edittopic_title" value="<?= $this->forum_model->getTopicTitle($idlink); ?>" type="text" placeholder="<?= $this->forum_model->getTopicTitle($idlink); ?>" required>
                </div>
              </div>
            </div>
            <div class="uk-margin uk-light">
              <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_description'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-width-1-1">
                  <textarea class="uk-textarea tinyeditor" name="edittopic_description" rows="10" cols="80"><?= $this->forum_model->getTopicDescription($idlink); ?></textarea>
                </div>
              </div>
            </div>
            <?php if($this->m_permissions->getIsAdmin($this->session->userdata('fx_sess_gmlevel'))): ?>
            <div class="uk-margin uk-light">
              <div class="uk-form-controls">
                <div class="uk-width-1-1 uk-text-center">
                  <label><input id="hightl" class="uk-checkbox" type="checkbox" name="check_highl" value="1"> <?= $this->lang->line('form_highl'); ?></label>
                  <span style="display:inline-block; width: 14px;"></span>
                  <label><input id="llock" class="uk-checkbox" type="checkbox" name="check_lock" value="1"> <?= $this->lang->line('form_lock'); ?></label>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </div>
          <div class="uk-modal-footer uk-text-right actions">
            <button class="uk-button uk-button-danger uk-modal-close" type="button"><i class="fas fa-times-circle"></i> <?= $this->lang->line('button_cancel'); ?></button>
            <button class="uk-button uk-button-default" type="submit" name="button_editTopic"><i class="fas fa-save"></i> <?= $this->lang->line('button_save'); ?></button>
          </div>
        </form>
      </div>
    </div>
