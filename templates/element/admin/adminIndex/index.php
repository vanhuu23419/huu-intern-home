<div class="row">
    <div class="col">
        <div class="card">
            <div id="toolbar" class="card-header toolbar d-flex align-items-center">
                <?= $this->fetch('toolbar'); ?>
            </div>  <!-- /.toolbar -->            

            <div id="table" class="card-body p-0 table-responsive" style="height: 500px;">
                <?php 
                    if (count($tableData) > 0) {
                        echo $this->element('admin/adminIndex/table');
                    }
                    else {
                        echo $this->element('admin/adminIndex/table-empty');
                    }
                ?>
            </div> <!-- /.table -->

            <?php if (count($tableData) > 0): ?>
                <div id="pagination" class="card-footer clearfix">
                    <?= $this->element('admin/adminIndex/pagination') ?>
                </div>  <!-- /.pagination -->
            <?php endif;?>
        </div>
    </div>
</div>