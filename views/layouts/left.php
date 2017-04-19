<?php
/* @var $this \yii\web\View */
use yuncms\admin\widgets\SideBar;
use yuncms\admin\helpers\MenuHelper;
?>

<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it -->
					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                        <img src="<?= Yii::$app->user->identity->getAvatar('middle'); ?>" alt="me" class="online">
						<span>
							 <?= Yii::$app->user->identity->username; ?>
						</span>
                        <i class="fa fa-angle-down"></i>
                    </a>

				</span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive-->

    <?php
    SideBar::begin();
    echo SideBar::widget(['items' => MenuHelper::getAssignedMenu(Yii::$app->user->getId())]);
    SideBar::end();
    ?>

    <span class="minifyme" data-action="minifyMenu">
				<i class="fa fa-arrow-circle-left hit"></i>
			</span>

</aside>
