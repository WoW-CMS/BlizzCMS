    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('bugtracker') ?></h4>
          </div>
          <div class="uk-width-auto">
            <?php if ($this->cms->isLogged()): ?>
            <a href="<?= site_url('bugtracker/create') ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-pencil-alt"></i> <?= lang('create_report') ?></a>
            <?php endif ?>
          </div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-3-4@m">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-search"></i> <?= lang('searcher') ?></h5>
              </div>
              <div class="uk-card-body">
                <?= form_open(site_url('bugtracker'), ['method' => 'get']) ?>
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-inline uk-width-expand@s uk-width-2-5@m">
                      <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="search" value="<?= $search ?>" placeholder="<?= lang('search') ?>">
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-3@s uk-width-2-5@m">
                      <div class="uk-form-controls">
                        <select class="uk-select" name="category">
                          <option value="" hidden selected><?= lang('select_category') ?></option>
                          <?php foreach ($categories as $cat): ?>
                          <option value="<?= $cat->id ?>" <?php if ($cat->id == $category) echo 'selected' ?>><?= $cat->name ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-auto@s uk-width-1-5@m">
                      <button class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-search"></i> <?= lang('search') ?></button>
                    </div>
                  </div>
                <?= form_close() ?>
              </div>
            </div>
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-list-alt"></i> <?= lang('reports_list') ?></h5>
              </div>
              <div class="uk-card-body uk-padding-remove">
                <div class="uk-overflow-auto">
                  <table class="uk-table uk-table-hover uk-table-small uk-table-divider">
                    <thead>
                      <tr>
                        <th><?= lang('id') ?></th>
                        <th class="uk-table-expand"><?= lang('title') ?></th>
                        <th class="uk-width-small"><?= lang('category') ?></th>
                        <th class="uk-width-small"><?= lang('priority') ?></th>
                        <th class="uk-width-small"><?= lang('status') ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($reports as $report): ?>
                      <tr>
                        <td class="uk-table-link">
                          <a href="<?= site_url('bugtracker/report/'.$report->id) ?>" class="uk-link-reset">
                            <?= $report->id ?>
                          </a>
                        </td>
                        <td class="uk-table-link">
                          <a href="<?= site_url('bugtracker/report/'.$report->id) ?>" class="uk-link-reset">
                            <?= html_escape($report->title) ?>
                          </a>
                        </td>
                        <td><?= $this->bugtracker_categories->name($report->category_id) ?></td>
                        <td><?= $report->priority ?></td>
                        <td><?= $report->status ?></td>
                      </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php if (isset($reports) && ! empty($reports)): ?>
            <?= $links ?>
            <?php endif ?>
          </div>
          <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-comments"></i> <?= lang('latest_comments') ?></h5>
              </div>
              <div class="uk-card-body">
                <ul class="uk-list uk-list-divider uk-text-small">
                  <?php foreach ($latest as $comment): ?>
                  <li>
                    <a href="<?= site_url('bugtracker/report/'.$comment->report_id) ?>"><?= character_limiter(strip_tags($comment->commentary), 60) ?></a>
                    <p class="uk-text-meta uk-margin-remove">By <?= $this->cms->user($comment->user_id, 'nickname') ?></p>
                  </li>
                  <?php endforeach ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
