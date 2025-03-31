<?php
if (isset($data['descendantId']) && $data['descendantId'])
{
    $descendantId = $data['descendantId'];

    $archeTunings = [];
    if (isset($data['archeTuning']) && is_array($data['archeTuning']))
    {
        foreach ($data['archeTuning']['arche_tuning'][0]['arche_tuning_board'][0]['node'] as $row)
        {
            $archeTunings[] = $row['position_row'] . '_' . $row['position_column'];
        }
    }
    ?>
<div class="card mb-3">
    <?php
    $row = nexon_first_descendant_meta_descendant_id($descendantId);
    $rowArcheTuningBoardGroup = nexon_first_descendant_meta_arche_tuning_board_group_descendant_group_id($row['descendant_group_id']);
    $rowArcheTuningBoardId = nexon_first_descendant_meta_arche_tuning_board_id($rowArcheTuningBoardGroup['arche_tuning_board_id']);

    $nodes = [];
    foreach ($rowArcheTuningBoardId['node'] as $node)
    {
        $nodes[$node['position_row'] . '_' . $node['position_column']] = $node['node_id'];
    }
    ?>

    <div class="table-responsive">
        <table class="table table-vcenter card-table">
            <tbody>
            <?php
            for ($r = 0; $r < $rowArcheTuningBoardId['row_size']; $r++)
            {
                ?>
                <tr>
                    <?php
                    for ($c = 0; $c < $rowArcheTuningBoardId['column_size']; $c++)
                    {
                        $key = $r . '_' . $c;
                        ?>
                        <td>
                            <?php
                            if (isset($nodes[$key]))
                            {
                                $opacity = in_array($key, $archeTunings) ? '100' : '10';
                                $rowNode = nexon_first_descendant_meta_arche_tuning_node_id($nodes[$key]);
                                ?>
                                <img
                                    alt="<?php echo $rowNode['node_name']; ?>"
                                    src="<?php echo $rowNode['node_image_url']; ?>"
                                    title="<?php echo $rowNode['node_name']; ?>"
                                    data-bs-toggle="modal" data-bs-target="#modal-<?php echo $r . '-' . $c; ?>"
                                    style="opacity: <?php echo $opacity; ?>%;"
                                >

                                <div
                                    class="modal modal-blur fade"
                                    id="modal-<?php echo $r . '-' . $c; ?>"
                                    tabindex="-1" aria-hidden="true" style="display: none;"
                                >
                                    <div class="modal-dialog modal-1 modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><?php echo $rowNode['node_name']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="datagrid-item mb-3">
                                                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.node_type'); ?></div>
                                                    <div class="datagrid-content"><?php echo $rowNode['node_type']; ?></div>
                                                </div>

                                                <div class="datagrid-item mb-3">
                                                    <div class="datagrid-title">Tier</div>
                                                    <div class="datagrid-content"><?php echo nexon_first_descendant_meta_tier_id($rowNode['tier_id']); ?></div>
                                                </div>

                                                <div class="datagrid-item mb-3">
                                                    <div class="datagrid-title"><?php echo lang('NexonFirstDescendant.required_tuning_point'); ?></div>
                                                    <div class="datagrid-content"><?php echo $rowNode['required_tuning_point']; ?></div>
                                                </div>

                                                <?php
                                                foreach ($rowNode['node_effect'] as $rowNodeEffect)
                                                {
                                                    ?>
                                                    <div class="datagrid-item mb-3">
                                                        <div class="datagrid-title"><?php echo nexon_first_descendant_meta_stat_id($rowNodeEffect['stat_id']); ?></div>
                                                        <div class="datagrid-content">
                                                            <?php
                                                            echo number_format_float($rowNodeEffect['stat_value']);
                                                            ?>
                                                            <small>(<?php echo $rowNodeEffect['operator_type']; ?>)</small>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
    <?php
}
?>
