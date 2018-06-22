<?php

use app\widget\mui\MuiHeader;
use app\widget\mui\MuiAccordion;
use app\widget\mui\MuiAccordionItem;
use app\widget\mui\MuiButton;
use app\widget\mui\MuiGrid;
use app\widget\mui\MuiGridNine;

use yii\helpers\Url;

?>
<?= MuiHeader::widget(['title' => '个人中心页面']) ?>

<div class="mui-content">
    <?= MuiGridNine::widget(array(
        'items' => [
            array('icon' => 'mui-icon mui-icon-home', 'label' => '首页', 'href' => '#'),
            array('icon' => 'mui-icon mui-icon-chat', 'label' => '留言', 'href' => '#'),
            array('icon' => 'mui-icon mui-icon-navigate', 'label' => '导航', 'href' => '#'),
        ],
    )) ?>
    <?php MuiAccordion::begin(); ?>
        <?php MuiAccordionItem::begin(); ?>
                <h3>文章标题</h3>
                <div>
                    <p>为了识别用户，每个用户针对每个公众号会产生一个安全的OpenID，
                        如果需要在多公众号、移动应用之间做用户共通，则需前往微信开放平台，
                        将这些公众号和应用绑定到一个开放平台账号下，绑定后，一个用户虽然对多个公众号和应用有多个不同的OpenID，但他对所有这些同一开放平台账号下的公众号和应用，只有一个UnionID，可以在用户管理-获取用户基本信息（UnionID机制）文档了解详情</p>
                    <p>
                        微信公众平台开发是指为微信公众号进行业务开发，
                        为移动应用、PC端网站、公众号第三方平台（为各行各业公众号运营者提供服务）的开发，
                        请前往微信开放平台接入。
                    </p>
                    <p>
                            微信公众平台开发是指为微信公众号进行业务开发，
                            为移动应用、PC端网站、公众号第三方平台（为各行各业公众号运营者提供服务）的开发，
                            请前往微信开放平台接入。
                    </p>
                </div>
        <?php MuiAccordionItem::end(); ?>
    <?php MuiAccordion::end(); ?>
</div>
