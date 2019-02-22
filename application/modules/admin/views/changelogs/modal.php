      <div id="newChangelog" uk-modal="bg-close: false">
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h3 class="uk-modal-title uk-text-uppercase"><i class="fas fa-history"></i> <?= $this->lang->line('form_create_changelog'); ?></h3>
          </div>
          <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
            <div class="uk-modal-body">
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_changelog_title'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" name="chang_title" required type="text" placeholder="<?= $this->lang->line('form_changelog_title'); ?>">
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_description'); ?></label>
                <div class="uk-form-controls">
                  <textarea class="uk-textarea tinyeditor" name="chang_description" rows="10" cols="80"></textarea>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_upload_file'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <div uk-form-custom="target: true">
                      <input type="file" required name="chang_imageup">
                      <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" disabled>
                      <button class="uk-button uk-button-primary" type="button" tabindex="-1"><i class="fas fa-file-upload"></i> Select</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-modal-footer uk-text-right actions">
              <button class="uk-button uk-button-danger uk-modal-close" type="button"><?= $this->lang->line('button_cancel'); ?></button>
              <button class="uk-button uk-button-primary" type="submit" name="button_createChangelog"><?= $this->lang->line('button_create'); ?></button>
            </div>
          </form>
        </div>
      </div>
