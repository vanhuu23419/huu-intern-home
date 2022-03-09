
<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
            <?=
            $this->Paginator->counter('Showing {{start}} to {{end}} of {{count}} entries');
            ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers">
            <ul class="pagination m-0 float-right">
                <li class="paginate_button page-item">
                    <a href="<?= $this->Paginator->generateUrl(['page' => 1], 'Users', [], ['fullBase' => true] ) ?>" class="page-link"> First </a>
                </li> <!--/ First paginate button -->
                <?php
                    /**
                     * Render paginate buttons with Cake\View\Helper\PaginatorHelper
                     */
                    if ($this->Paginator->hasPrev()) {
                        echo $this->Paginator->prev(); 
                    }

                    echo $this->Paginator->numbers(['modulus' => 3]);

                    if ($this->Paginator->hasNext()) {
                        echo $this->Paginator->next(); 
                    }
                ?>
                <li class="paginate_button page-item">
                    <a href="<?= $this->Paginator->generateUrl([
                        'page' => $this->Paginator->total()], 
                        'Users', 
                        [], 
                        ['fullBase' => true] 
                    ) ?>" class="page-link"> Last </a>
                </li> <!--/ Last paginate button -->
            </ul>
        </div>
    </div>
</div>