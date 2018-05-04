<?php

use yii\helpers\BaseUrl;
use yii\helpers\Html;

?>
<div class="modules-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".<br>
        The action belongs to the controller "<?= get_class($this->context) ?>"<br>
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
<div class="container">

    <ul>
        <li><?= Html::a('widget挂件类生成空模板', BaseUrl::toRoute(['/generate/widget'])) ?></li>
        <li> <?= Html::a('采集指定的网页', BaseUrl::toRoute(['/generate/curl-get'])) ?></li>
        <li> <?= Html::a('正则匹配数据', BaseUrl::toRoute(['/generate/preg-html'])) ?></li>
    </ul>


</div>
