<!-- SysMsg -->
<?php if ($del): ?>
    <?php
    deleteSpruch($del);
    ?>
    <h4 class="well hideInTime"><?php echo $msg; ?></h4>
<?php endif; ?>

<?php if ($del2): ?>
    <?php
    deleteTermin($del2);
    ?>
    <h4 class="well hideInTime"><?php echo $msg2; ?></h4>
<?php endif; ?>

<?php if ($del3): ?>
    <?php
    deletePflanze($del3);
    ?>
    <h4 class="well hideInTime"><?php echo $msg3; ?></h4>
<?php endif; ?>

<?php if ($del4): ?>
    <?php
    deleteWartung($del4);
    ?>
    <h4 class="well hideInTime"><?php echo $msg4; ?></h4>
<?php endif; ?>

<?php if ($add): ?>
    <?php
    insertSpruch($add);
    ?>
    <h4 class="well hideInTime"><?php echo $msg_add; ?></h4>
<?php endif; ?>

<?php if ($add2): ?>
    <?php
    insertTermin($add2, 1, $add2_2, $add2_3);
    ?>
    <h4 class="well hideInTime"><?php echo $msg_add2; ?></h4>
<?php endif; ?>


<?php if ($p1 && $p2 != ""): ?>
    <?php
    insertPflanze($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8);
    ?>
    <h4 class="well hideInTime"><?php echo $msg_add3; ?></h4>
<?php endif; ?>