<?php

/**
 * Render template
 */
// table toolbar
$this->start('toolbar') ?>

    <div class="row">
        <?= $this->Flash->render('error') ?>
    </div>

    <div id="searchForm" class="" style="flex:1">

        <?php $formUrl = $this->Url->build(['prefix' => 'Admin', 'controller' => 'User', 'action' => 'index'], ['fullBase' => true]); ?>
        <?= $this->Form->create(null, ['method' => 'GET', 'url' => $formUrl]) ?>
        <div class="row align-items-center">
            <div class="row col">
                <div class="col">
                    <?php $email = array_key_exists('email', $query) ? $query['email'] : ''; ?>
                    <label for="Email">Email</label>
                    <input type="text" name="email" class="form-control form-control-sm" value="<?= $email ?>">
                </div>
            </div>
            <div class="row col">
                <div class="col">
                    <?php $name = array_key_exists('name', $query) ? $query['name'] : ''; ?>
                    <label>Full name</label>
                    <input type="text" name="name" class="form-control form-control-sm" value="<?= $name ?>">
                </div>
            </div>
            <div class="row col">
                <div class="col">
                    <label for="">User flag</label>
                    <div class="d-flex">
                        <?php foreach ($userFlags as $value => $name) : ?>
                            <div class="form-check ml-2">
                                <?php
                                $isCheck = array_key_exists('user_flg', $query) && in_array($value, $query['user_flg'])
                                    ? 'checked'
                                    : '';
                                ?>
                                <input class="form-check-input" type="checkbox" name="user_flg[]" <?= $isCheck ?> value="<?= $value ?>">
                                <label class="form-check-label"><?= $name ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="row col">
                <div class="col">
                    <?php $phone = array_key_exists('phone', $query) ? $query['phone'] : ''; ?>
                    <label for="">Phone</label>
                    <input type="text" name="phone" class="form-control form-control-sm" value="<?= $phone ?>" data-label="Phone">
                </div>
            </div>
            <div class="row col">
                <div class="col">
                    <?= $this->Form->submit(__('Search'), ['class' => 'btn btn-primary']); ?>
                </div>
            </div>
        </div>


        <?= $this->Form->end() ?>
    </div>
    <div class="ms-auto px-3" style="border-left: 1px solid #e5e5e5;">
        <?php
        $exportCSVUrl = $this->Url::build(
            ['prefix' => 'Admin', 'controller' => 'User', 'action' => 'exportCSV', '?' => $this->request->getQuery()],
            ['fullBase' => true]
        );
        ?>
        <a id="exportCSV" href="<?= $exportCSVUrl ?>" class="float-right btn btn-success">Export CSV</a>
    </div>
<?php
$this->end(); // End tool bar

// load admin index template
echo $this->element('admin/adminIndex/index');

/**
 * Load view CSS
 */
$this->start('css');
// admin index scripts
echo $this->Html->css('admin/adminIndex/table');
$this->end();

/**
 * Load view scripts
 */
$this->start('scripts');
// admin index scripts
echo $this->Html->script('admin/adminIndex/table');
echo $this->Html->script('admin/user/index');

// Execute
$csrf = $this->request->getAttribute('csrfToken');
$deleteUrl = $this->Url::build(['prefix' => 'Admin', 'controller' => 'User', 'action' => 'delete', 'id' => 0], ['fullBase' => true]);
$editUrl = $this->Url::build(['prefix' => 'Admin', 'controller' => 'User', 'action' => 'edit', 'id' => 0], ['fullBase' => true]);
?>

<script>
    const CSRF_TOKEN = '<?= $csrf ?>';
    $(function() {
        // init adminTable helper
        adminTable.init({
            deleteUrl: '<?= $deleteUrl ?>',
            editUrl: '<?= $editUrl ?>',
        });
    });
</script>
<?php $this->end(); ?>