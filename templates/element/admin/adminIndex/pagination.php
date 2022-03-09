<?php 
    use Cake\Collection\Collection;
    
    $showingTo = $pagination['page'] * $pagination['perPage'];
    if ($showingTo > $pagination['total']) {
        $showingTo = $pagination['total'];
    }
    $showingFrom = 1 + ($pagination['page'] - 1) * $pagination['perPage'];
    if ($showingFrom > $pagination['total']) {
        $showingFrom = 1;
    }
    
    $totalPage = round($pagination['total']/$pagination['perPage']);
    $paginationOffset = $pagination['paginationOffset'];  // number of paginate button on page
    $currentOffset = ceil($pagination['page']/$paginationOffset) - 1;
    $start = $currentOffset * $paginationOffset + 1;
    $end = $currentOffset * $paginationOffset + $paginationOffset;

    $routeParamsArr = [
        'prefix' => 'Admin', 
        'controller' => 'User', 
        'action' => 'index',
        '?' => $this->request->getQuery()
    ];
?>

<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
            Showing <?= $showingFrom ?> to <?= $showingTo ?> of <?= $pagination['total'] ?> entries
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers">
            <ul class="pagination m-0 float-right">

                <li class="paginate_button page-item"> 
                    <?php $routeParamsArr['?']['page'] = 1; ?>
                    <a href="<?= $this->Url::build($routeParamsArr, ['fullBase' => true ]) ?>" class="page-link">First</a>
                </li>

                <?php if ($pagination['page'] - 1 > 0): ?>
                    <li class="paginate_button page-item previous"> 
                    <?php $routeParamsArr['?']['page'] = $pagination['page'] - 1; ?>
                    <a href="<?= $this->Url::build($routeParamsArr, ['fullBase' => true ]) ?>" class="page-link"> < </a>
                <?php else: ?>
                    <button class="page-link" disabled="true"> < </button>
                <?php endif;?>

                <?php for ($i = $start; $i <= $end && $i <= $totalPage; ++$i): ?>
                    <li class="paginate_button page-item ">
                        <?php 
                            $routeParamsArr['?']['page'] = $i;
                            $isActive = $i == $pagination['page'] ? 'bg-primary' : ''; 
                        ?>
                        <a href="<?= $this->Url::build($routeParamsArr, ['fullBase' => true ]) ?>" class="page-link <?= $isActive ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <?php if ($pagination['page'] + 1 <= $totalPage): ?>
                    <li class="paginate_button page-item"> 
                    <?php $routeParamsArr['?']['page'] = $pagination['page'] + 1 ?>
                    <a href="<?= $this->Url::build($routeParamsArr, ['fullBase' => true ]) ?>" class="page-link">></a>
                <?php else: ?>
                    <button class="page-link" disabled="true"> > </button>
                <?php endif;?>

                <li class="paginate_button page-item"> 
                    <?php $routeParamsArr['?']['page'] = $totalPage; ?>
                    <a href="<?= $this->Url::build($routeParamsArr, ['fullBase' => true ]) ?>" class="page-link">Last</a>
                </li>
            </ul>
        </div>
    </div>
</div>