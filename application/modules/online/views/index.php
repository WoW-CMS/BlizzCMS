    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-users"></i> <?=$this->lang->line('tab_online');?></h4>
        <ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .onlineplayers">
          <?php foreach ($realms as $realm): ?>
          <li><a href="#"><i class="fas fa-server"></i> <?= $this->wowrealm->getRealmName($realm->realmID); ?></a></li>
          <?php endforeach; ?>
        </ul>
        <ul class="uk-switcher onlineplayers uk-margin-small">
          <?php foreach ($realms as $charsMultiRealm):
            $multiRealm = $this->wowrealm->getRealmConnectionData($charsMultiRealm->id);
          ?>
          <li>
            <div class="uk-overflow-auto uk-margin-small">
              <table class="uk-table dark-table uk-table-divider uk-table-small">
                <thead>
                  <tr>
                    <th class="uk-table-expand"><i class="fas fa-user"></i> <?=$this->lang->line('table_header_name');?></th>
                    <th class="uk-table-expand uk-text-center"><i class="fas fa-info-circle"></i> <?=$this->lang->line('table_header_level');?></th>
                    <th class="uk-table-expand uk-text-center"><i class="fas fa-user-tag"></i> <?=$this->lang->line('table_header_race');?></th>
                    <th class="uk-table-expand uk-text-center"><i class="fas fa-user-tag"></i> <?=$this->lang->line('table_header_class');?></th>
                    <th class="uk-table-expand uk-text-center"><i class="fas fa-location-arrow"></i> <?=$this->lang->line('table_header_zone');?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($this->online_model->getOnlinePlayers($multiRealm)->result() as $online): ?>
                  <tr>
                    <td class="uk-text-capitalize"><?= $online->name ?></td>
                    <td class="uk-text-center"><?= $online->level ?></td>
                    <td class="uk-text-center"><img class="uk-border-rounded" src="<?= base_url('assets/images/races/'.$this->wowgeneral->getRaceIcon($online->race)); ?>" width="20" height="20" title="<?= $this->wowgeneral->getRaceName($online->race); ?>" alt="<?= $this->wowgeneral->getRaceName($online->race); ?>"></td>
                    <td class="uk-text-center"><img class="uk-border-rounded" src="<?= base_url('assets/images/class/'.$this->wowgeneral->getClassIcon($online->class)); ?>" width="20" height="20" title="<?= $this->wowgeneral->getClassName($online->class); ?>" alt="<?= $this->wowgeneral->getClassName($online->class); ?>"></td>
                    <td class="uk-text-center"><?= $this->wowgeneral->getSpecifyZone($online->zone); ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
