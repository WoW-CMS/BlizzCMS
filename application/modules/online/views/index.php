    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('online_players'); ?></h4>
          </div>
          <div class="uk-width-auto"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-server"></i>  <?= lang('realm'); ?></h5>
              </div>
              <ul class="uk-nav uk-nav-default aside-nav" uk-switcher="connect: #online-players;animation: uk-animation-fade">
                <?php foreach ($realms as $realm): ?>
                <li><a href="#"><?= $realm->name; ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@m">
            <ul id="online-players" class="uk-switcher">
              <?php foreach ($realms as $realm): ?>
              <li>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-body uk-padding-remove">
                    <div class="uk-overflow-auto">
                      <table class="uk-table uk-table-small uk-table-divider">
                        <thead>
                          <tr>
                            <th class="uk-table-expand"><?= lang('name'); ?></th>
                            <th class="uk-table-expand"><?= lang('level'); ?></th>
                            <th class="uk-table-expand"><?= lang('race'); ?></th>
                            <th class="uk-table-expand"><?= lang('class'); ?></th>
                            <th class="uk-table-expand"><?= lang('zone'); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($this->online_model->get_players($realm->id) as $online): ?>
                          <tr>
                            <td><?= $online->name; ?></td>
                            <td><?= $online->level; ?></td>
                            <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/race/'.$online->race.'-'.$online->gender.'.png'; ?>" width="20" height="20" alt="<?= race_name($online->race); ?>"></td>
                            <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.$online->class.'.png'; ?>" width="20" height="20" alt="<?= class_name($online->class); ?>"></td>
                            <td><?= zone_name($online->zone); ?></td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
