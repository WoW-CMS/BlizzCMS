      <?php if ($this->session->flashdata('success')): ?>
      <div class="uk-alert-success uk-margin-small" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success'); ?></p>
      </div>
      <?php elseif ($this->session->flashdata('info')): ?>
      <div class="uk-alert-primary uk-margin-small" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><i class="fas fa-info-circle"></i> <?= $this->session->flashdata('info'); ?></p>
      </div>
      <?php elseif ($this->session->flashdata('warning')): ?>
      <div class="uk-alert-warning uk-margin-small" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('warning'); ?></p>
      </div>
      <?php elseif ($this->session->flashdata('error')): ?>
      <div class="uk-alert-danger uk-margin-small" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <p><i class="fas fa-times-circle"></i> <?= $this->session->flashdata('error'); ?></p>
      </div>
      <?php elseif ($this->session->flashdata('upload')): ?>
      <div class="uk-alert-danger uk-margin-small" uk-alert>
        <a class="uk-alert-close" uk-close></a>
        <ul class="uk-list uk-margin-remove">
          <?= $this->session->flashdata('upload'); ?>
        </ul>
      </div>
      <?php endif; ?>