<?php if ($this->session->flashdata('success')): ?>
<div class="uk-alert-success uk-margin-small" uk-alert>
  <a class="uk-alert-close" uk-close></a>
  <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><i class="fa-solid fa-circle-check"></i> <?= lang('success') ?></h5>
  <p class="uk-text-small uk-margin-remove"><?= $this->session->flashdata('success') ?></p>
</div>
<?php elseif ($this->session->flashdata('info')): ?>
<div class="uk-alert-primary uk-margin-small" uk-alert>
  <a class="uk-alert-close" uk-close></a>
  <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><i class="fa-solid fa-circle-info"></i> <?= lang('information') ?></h5>
  <p class="uk-text-small uk-margin-remove"><?= $this->session->flashdata('info') ?></p>
</div>
<?php elseif ($this->session->flashdata('warning')): ?>
<div class="uk-alert-warning uk-margin-small" uk-alert>
  <a class="uk-alert-close" uk-close></a>
  <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><i class="fa-solid fa-circle-exclamation"></i> <?= lang('warning') ?></h5>
  <p class="uk-text-small uk-margin-remove"><?= $this->session->flashdata('warning') ?></p>
</div>
<?php elseif ($this->session->flashdata('error')): ?>
<div class="uk-alert-danger uk-margin-small" uk-alert>
  <a class="uk-alert-close" uk-close></a>
  <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><i class="fa-solid fa-circle-xmark"></i> <?= lang('error') ?></h5>
  <p class="uk-text-small uk-margin-remove"><?= $this->session->flashdata('error') ?></p>
</div>
<?php elseif ($this->session->flashdata('error_list')): ?>
<div class="uk-alert-danger uk-margin-small" uk-alert>
  <a class="uk-alert-close" uk-close></a>
  <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><i class="fa-solid fa-circle-xmark"></i> <?= lang('error') ?></h5>
  <ul class="uk-list uk-list-hyphen uk-margin-remove">
    <?= $this->session->flashdata('error_list') ?>
  </ul>
</div>
<?php endif ?>
