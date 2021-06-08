    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('manage_account') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><a href="<?= site_url('admin/users') ?>"><?= lang('all_users') ?></a></li>
              <li><span><?= lang('manage_account') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/users') ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-grid uk-margin-small" data-uk-grid>
          <div class="uk-width-1-3@s">
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-flex uk-flex-center uk-margin-small">
                <img class="uk-border-circle uk-box-shadow-medium" src="<?= $template['uploads'].'avatars/'.$this->website->user_avatar($user->id) ?>" width="100" height="100" alt="Avatar">
              </div>
              <div class="uk-text-center uk-margin-small">
                <h4 class="uk-h4 uk-margin-remove"><?= $user->username ?></h4>
                <p class="uk-text-small uk-margin-remove"><?= lang('member_since') ?>: <?= date('j F Y', strtotime($user->joined_at)) ?></p>
              </div>
            </div>
          </div>
          <div class="uk-width-2-3@s">
            <?= $template['partials']['alerts'] ?>
            <div class="uk-card uk-card-default uk-card-body uk-padding-remove uk-margin-small">
              <ul class="uk-tab" uk-switcher="connect: #account-data;">
                <li><a href="#"><?= lang('account') ?></a></li>
                <li><a href="#"><?= lang('characters') ?></a></li>
              </ul>
            </div>
            <ul id="account-data" class="uk-switcher uk-margin">
              <li>
                <?= form_open(site_url('admin/users/update'), ['class' => 'uk-form-horizontal']) ?>
                <?= form_hidden('id', $user->id) ?>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-body">
                    <h5 class="uk-h5 uk-text-bold uk-margin-small"><?= lang('account_information') ?></h5>
                    <div class="uk-margin">
                      <label class="uk-form-label"><?= lang('username') ?></label>
                      <div class="uk-form-controls">
                        <input class="uk-input uk-disabled" type="text" value="<?= $user->username ?>" placeholder="<?= lang('username') ?>" disabled>
                      </div>
                    </div>
                    <div class="uk-margin">
                      <label class="uk-form-label"><?= lang('nickname') ?></label>
                      <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="nickname" value="<?= $user->nickname ?>" placeholder="<?= lang('nickname') ?>">
                      </div>
                      <?= form_error('nickname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                    </div>
                    <div class="uk-margin">
                      <label class="uk-form-label"><?= lang('donor_points') ?></label>
                      <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="dp" value="<?= $user->dp ?>" placeholder="<?= lang('donor_points') ?>">
                      </div>
                      <?= form_error('dp', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                    </div>
                    <div class="uk-margin">
                      <label class="uk-form-label"><?= lang('vote_points') ?></label>
                      <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="vp" value="<?= $user->vp ?>" placeholder="<?= lang('vote_points') ?>">
                      </div>
                      <?= form_error('vp', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                    </div>
                  </div>
                </div>
                <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-sync"></i> <?= lang('update') ?></button>
                <?= form_close() ?>
              </li>
              <li>
                <?php foreach ($this->realms->find_all() as $realm): ?>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-body uk-padding-remove uk-overflow-auto">
                    <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                      <thead>
                        <tr>
                          <th><?= lang('guid') ?></th>
                          <th class="uk-width-small"><?= lang('name') ?></th>
                          <th class="uk-width-small"><?= lang('race') ?></th>
                          <th class="uk-width-small"><?= lang('class') ?></th>
                          <th class="uk-width-small"><?= lang('level') ?></th>
                          <th class="uk-width-small"><?= lang('money') ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($this->characters->account_characters($realm->id, $user->id) as $chars): ?>
                        <tr>
                          <td><?= $chars->guid ?></td>
                          <td><?= $chars->name ?></td>
                          <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/race/'.$chars->race.'-'.$chars->gender.'.png' ?>" width="24" height="24" alt="<?= race_name($chars->race) ?>"></td>
                          <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.$chars->class.'.png' ?>" width="24" height="24" alt="<?= class_name($chars->class) ?>"></td>
                          <td><?= $chars->level ?></td>
                          <td class="uk-text-center"><?= $chars->money ?></td>
                        </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <?php endforeach ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>