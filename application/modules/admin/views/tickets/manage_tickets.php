<section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
      <div class="uk-width-expand uk-heading-line">
        <h3 class="uk-h3"><i class="fas fa-scroll"></i> <?= $this->lang->line('admin_nav_manage_tickets') ?></h3>
      </div>
    </div>
    <div class="uk-grid uk-grid-small" data-uk-grid>
      <div class="uk-width-1-4@s">
        <div class="uk-card uk-card-secondary">
          <ul class="uk-nav uk-nav-default">
            <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) >= config_item('admin_access_level')): ?>
            <li class="uk-active"><a href="<?= base_url('admin/tickets'); ?>"><i class="fas fa-arrow-circle-left"></i></a></li>
            <?php endif; ?>
            <?php foreach($realmsList as $link): ?>
            <li><a href="<?= base_url('admin/tickets/realm/'.$link->realmID); ?>"><i class="fas fa-server"></i> <?= $this->wowrealm->getRealmName($link->realmID); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="uk-width-3-4@s">
        <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-1 uk-child-width-1-2@s" data-uk-grid>
          <?php foreach ($this->wowrealm->getRealms()->result() as $charsMultiRealm):
            $multiRealm = $this->wowrealm->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
          ?>
          <div>
            <a class="uk-link-heading" href="<?= base_url('admin/tickets/realm/'.$charsMultiRealm->id); ?>">
              <div class="uk-card uk-card-default">
                <div class="uk-card-header">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-auto">
                      <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-server"></i></span>Realm - <?= $this->wowrealm->getRealmName($charsMultiRealm->realmID); ?></h4>
                    </div>
                  </div>
                </div>
                <div class="uk-card-body">
                  <div class="uk-grid uk-grid-small uk-text-center" data-uk-grid>
                    <div class="uk-width-1-1">
                      <h5 class="uk-h5 uk-text-primary uk-text-bold uk-text-uppercase uk-margin-remove">New Ticket's</h5>
                      <h1 class="uk-h1 uk-margin-remove"><i class="fas fa-scroll"></i> <span class="blizzcms-count" data-from="0" data-to="<?= $this->admin_model->countTickets($multiRealm); ?>" data-speed="2000" data-refresh-interval="50"></span></h1>
                      </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>