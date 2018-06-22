<form method="post">
    <input type="text" name="url" placeholder="www.baidu.com"></input>
    <button>提交</button>
</form>
<?php if (isset($err)): ?>
    <?php print_r($err->getMessage()); ?>
<?php endif; ?>
<?php if (isset($body)): ?>
    <?= $body ?>
<?php endif; ?>
