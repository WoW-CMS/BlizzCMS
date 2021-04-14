    <div id="editTopic" uk-modal="bg-close: false">
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title uk-text-uppercase"><i class="fas fa-pencil-alt"></i> <?= $this->lang->line('button_edit_topic'); ?></h2>
        </div>
        <form action="" method="post" accept-charset="utf-8">
          <div class="uk-modal-body">
            <div class="uk-margin uk-light">
              <label class="uk-form-label"><?= $this->lang->line('placeholder_title'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen fa-lg"></i></span>
                  <input class="uk-input" name="edit_title" value="<?= $this->forum_model->getTopicTitle($idlink); ?>" type="text" placeholder="<?= $this->forum_model->getTopicTitle($idlink); ?>" required>
                </div>
              </div>
            </div>
            <div class="uk-margin uk-light">
              <label class="uk-form-label"><?= $this->lang->line('placeholder_description'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-width-1-1">
                  <textarea class="uk-textarea tinyeditor" name="edit_description" rows="10" cols="80"><?= $this->forum_model->getTopicDescription($idlink); ?></textarea>
                </div>
              </div>
            </div>
            <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) >= config_item('admin_access_level')): ?>
            <div class="uk-margin">
              <div class="uk-form-controls">
                <div class="uk-grid uk-grid-small uk-child-width-auto uk-flex uk-flex-center" data-uk-grid>
                  <label><input class="uk-checkbox" type="checkbox" name="topic_pinned" <?php if($this->forum_model->getTopicPinned($idlink) == '1') echo 'checked'; ?>> <?= $this->lang->line('placeholder_highl'); ?></label>
                  <label><input class="uk-checkbox" type="checkbox" name="topic_locked" <?php if($this->forum_model->getTopicLocked($idlink) == '1') echo 'checked'; ?>> <?= $this->lang->line('placeholder_lock'); ?></label>
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
