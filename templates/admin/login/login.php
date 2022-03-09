<?php
// Set Layout for this page
$this->layout = 'admin/login';
?>

<div class="container-fluid pt-5 mt-5">
  <div class="row">

    <div class="col-md-12">

      <div id="loginForm" class="card card-primary">

        <div class="px-3 pt-3">
          <?= $this->Flash->render() ?>
        </div>

        <?= $this->Form->create() ?>

          <div class="card-body">
            <div class="form-group">
              <?= $this->Form->control('email', ['type' => 'text', 'data-label' => "Email", 'class' => 'form-control']) ?>
            </div>
            <div class="form-group">
              <?= $this->Form->control('password', ['data-label' => "Password", 'class' => 'form-control']) ?>
            </div>
          </div>

          <div class="card-footer">
            <?= $this->Form->submit(__('Login'), ['class' => 'btn btn-primary']); ?>
          </div>

        <?= $this->Form->end() ?>
      </div>

    </div>

    <div class="col-md-6">
    </div>

  </div>

</div>


<?php $this->start('scripts');

echo $this->Html->script('common/validation');
echo $this->Html->script('admin/login');

$this->end(); ?>