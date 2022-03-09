<table class="table table-head-fixed table-hover">
    <thead>
        <tr>
            <?php 
            /**
             * Render table headers
             */
            foreach($tableHead as $key => $label): // Render Table's header
                echo "<th style=\"width: {$columnWidths[$key]}%\">". $label??'' . '</th>';
            endforeach; 
            ?>
            <th style="width:10%"></th>
        </tr> <!-- / tr -->
    </thead> <!-- / thead -->
    <tbody>
        <?php 
        /**
         * Render table data
         */
        for($i = 0, $len = count($tableData); $i < $len; ++$i):  
            echo "<tr data-id=\"{$tableData[$i][$rowId]}\">";
                // render colunms
                foreach($tableHead as $key => $label):
                    if ($key != $rowId):
                        echo "<td style=\"width: {$columnWidths[$key]}%!impo\"><span>" .nl2br($tableData[$i][$key]). '</span></td>';
                    endif;
                endforeach;

                // render buttons
        ?>
                <td style="width:10%">
                    <button class="btn btn-sm btn-primary"
                            onclick="adminTable.edit(<?= $tableData[$i][$rowId]??'null' ?>)"> Edit </button>
                    <button class="btn btn-sm btn-danger" 
                            onclick="adminTable.delete(<?= $tableData[$i][$rowId]??'null' ?>)"> Delete </button>
                </td>
        <?php 
            echo '</tr>';
        endfor; 
        ?>
    </tbody> <!-- / tbody -->
</table>


