    <div id="createReport" uk-modal="bg-close: false">
      <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
          <h2 class="uk-modal-title uk-text-uppercase"><i class="fas fa-bug"></i> <?= $this->lang->line('placeholder_create_bug_report'); ?></h2>
        </div>
        <form action="<?= base_url('bugtracker/create'); ?>" method="post" accept-charset="utf-8" autocomplete="off">
          <div class="uk-modal-body">
            <div class="uk-margin uk-light">
              <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_title'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen fa-lg"></i></span>
                  <input class="uk-input" name="bug_title" type="text" placeholder="<?= $this->lang->line('placeholder_title'); ?>" required>
                </div>
              </div>
            </div>
            <div class="uk-margin uk-light">
              <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_type'); ?></label>
              <div class="uk-form-controls">
                <select class="uk-select" name="bug_type">
                  <?php foreach($this->bugtracker_model->getTypes()->result() as $types): ?>
                  <option value="<?= $types->id; ?>"><?= $types->title ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="uk-margin uk-light">
              <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_description'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-width-1-1">
                  <textarea class="uk-textarea tinyeditor" name="bug_description" rows="10" cols="80"></textarea>
                </div>
              </div>
            </div>
            <div class="uk-margin uk-light">
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-paperclip fa-lg"></i></span>
                  <input class="uk-input" name="bug_url" type="url" placeholder="URL">
                </div>
              </div>
            </div>
          </div>
          <div class="uk-modal-footer uk-text-right actions">
            <button class="uk-button uk-button-danger uk-modal-close" type="button"><i class="far fa-times-circle"></i> <?= $this->lang->line('button_cancel'); ?></button>
            <button class="uk-button uk-button-default" type="submit" name="button_createIssue"><i class="fas fa-plus-circle"></i> <?= $this->lang->line('button_create'); ?></button>
          </div>
        </form>
      </div>
    </div>
