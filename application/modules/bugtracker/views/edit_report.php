    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('bugtracker'); ?></h4>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('bugtracker'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-arrow-circle-left"></i> <?= lang('back'); ?></a>
          </div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <?= $template['partials']['alerts']; ?>
        <div class="uk-card uk-card-default uk-margin-small">
          <div class="uk-card-header">
            <div class="uk-grid uk-grid-small uk-flex uk-flex-middle">
              <div class="uk-width-expand">
                <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-bug"></i> <?= lang('edit_report'); ?></h5>
              </div>
              <div class="uk-width-auto"></div>
            </div>
          </div>
          <div class="uk-card-body">
            <?= form_open(current_url()); ?>
            <div class="uk-margin uk-light">
              <label class="uk-form-label"><?= lang('title'); ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="title" value="<?= $report->title;; ?>" placeholder="<?= lang('title'); ?>">
              </div>
              <?= form_error('title', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
            </div>
            <div class="uk-margin uk-light">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('realm'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="realm">
                      <option value="" hidden selected><?= lang('select_realm'); ?></option>
                      <?php foreach ($realms as $realm): ?>
                      <option value="<?= $realm->id; ?>" <?php if ($realm->id == $report->realm_id) echo 'selected'; ?>><?= $realm->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <?= form_error('realm', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('category'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="category">
                      <option value="" hidden selected><?= lang('select_category'); ?></option>
                      <?php foreach ($this->bugtracker_model->get_categories() as $category): ?>
                      <option value="<?= $category->id; ?>" <?php if ($category->id == $report->category_id) echo 'selected'; ?>><?= $category->name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <?= form_error('category', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <?php if ($this->auth->is_moderator()): ?>
            <div class="uk-margin uk-light">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('priority'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="priority">
                      <option value="low" <?php if ('low' === $report->priority) echo 'selected'; ?>>Low</option>
                      <option value="normal" <?php if ('normal' === $report->priority) echo 'selected'; ?>>Normal</option>
                      <option value="medium" <?php if ('medium' === $report->priority) echo 'selected'; ?>>Medium</option>
                      <option value="high" <?php if ('high' === $report->priority) echo 'selected'; ?>>High</option>
                      <option value="critical" <?php if ('critical' === $report->priority) echo 'selected'; ?>>Critical</option>
                    </select>
                  </div>
                  <?= form_error('priority', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('status'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="status">
                      <option value="open" <?php if ('open' === $report->status) echo 'selected'; ?>>Open</option>
                      <option value="waiting information" <?php if ('waiting information' === $report->status) echo 'selected'; ?>>Waiting Information</option>
                      <option value="confirmed" <?php if ('confirmed' === $report->status) echo 'selected'; ?>>Confirmed</option>
                      <option value="in progress" <?php if ('in progress' === $report->status) echo 'selected'; ?>>In Progress</option>
                      <option value="invalid" <?php if ('invalid' === $report->status) echo 'selected'; ?>>Invalid</option>
                      <option value="fixed" <?php if ('fixed' === $report->status) echo 'selected'; ?>>Fixed</option>
                    </select>
                  </div>
                  <?= form_error('status', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <div class="uk-margin uk-light">
              <label class="uk-form-label"><?= lang('description'); ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea tinyeditor" name="description" rows="12"><?= $report->description; ?></textarea>
              </div>
              <?= form_error('description', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
            </div>
            <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-top" type="submit"><i class="fas fa-plus-circle"></i> <?= lang('create'); ?></button>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>