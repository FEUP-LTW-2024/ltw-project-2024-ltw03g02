<?php function drawEditBtn() { ?>
    <button class="icon-btn edit-btn" ><img src="../../images/icon_btn/edit_solid.svg" /></button>
<?php } ?>

<?php function drawDeleteBtn() { ?>
    <button class="icon-btn delete-btn" ><img src="../../images/icon_btn/trash_solid.svg" /></button>
<?php } ?>

<?php function drawPlusBtn() { ?>
        <button class="icon-btn plus-btn" ><img src="../../images/icon_btn/plus_solid.svg" /></button>
<?php } ?>

<?php function drawEditBtnWithId($userId) { ?>
    <button id="edit-btn-<?= $userId ?>"  class="icon-btn edit-btn"><img src="../../images/icon_btn/edit_solid.svg" /></button>
<?php } ?>

<?php function drawDeleteBtnWithId($id) { ?>
    <button id="delete-btn-<?= $id ?>" class="icon-btn delete-btn"><img src="/images/icon_btn/trash_solid.svg" /></button>
<?php } ?>