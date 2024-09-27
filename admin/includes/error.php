<div class="mb-4">
    <?php if ($_SESSION["error"] != "") { ?>
        <div class="bg-washed-red pa3 mv3">
            <strong>Error :</strong> <?php echo htmlentities($_SESSION["error"]); ?>
            <?php $_SESSION["error"] = ""; ?>
        </div>
    <?php } ?>
    <?php if ($_SESSION["msg"] != "") { ?>
        <div class="bg-washed-green pa3 mv3">
            <strong>Success :</strong> <?php echo htmlentities($_SESSION["msg"]); ?>
            <?php $_SESSION["msg"] = ""; ?>
        </div>
    <?php } ?>
    <?php if ($_SESSION["delmsg"] != "") { ?>
        <div class="bg-light-yellow pa3 mv3">
            <strong>Success :</strong> <?php echo htmlentities($_SESSION["delmsg"]); ?>
            <?php $_SESSION["delmsg"] = ""; ?>
        </div>
    <?php } ?>
</div>