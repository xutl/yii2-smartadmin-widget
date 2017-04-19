<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yuncms\admin\widgets\Alert;
use yuncms\admin\assets\LayoutAsset;
use yuncms\admin\widgets\MainBreadcrumbs;

$asset = LayoutAsset::register($this);

$this->registerJs('pageSetUp();');

$this->registerJs('var sound_path="' . $asset->baseUrl . '/sound/";', \yii\web\View::POS_HEAD);

$this->title = Yii::t('admin', 'Manage Center');
//Meta
$this->registerMetaTag(['charset' => Yii::$app->charset]);
//$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1']);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no']);
$this->registerMetaTag(['name' => 'description', 'content' => 'TintSoft']);
$this->registerMetaTag(['name' => 'author', 'content' => 'TintSoft Team']);

//FAVICONS
$this->registerLinkTag(['rel' => 'shortcut icon', 'href' => $asset->baseUrl . '/img/favicon/favicon.ico', 'type' => 'image/x-icon']);
$this->registerLinkTag(['rel' => 'icon', 'href' => $asset->baseUrl . '/img/favicon/favicon.ico', 'type' => 'image/x-icon']);

//指定Web剪辑参考网页图标: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'href' => $asset->baseUrl . '/img/splash/sptouch-icon-iphone.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '76x76', 'href' => $asset->baseUrl . '/img/splash/touch-icon-ipad.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '120x120', 'href' => $asset->baseUrl . '/img/splash/touch-icon-iphone-retina.png']);
$this->registerLinkTag(['rel' => 'apple-touch-icon', 'sizes' => '152x152', 'href' => $asset->baseUrl . '/img/splash/touch-icon-ipad-retina.png']);
//iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance
$this->registerMetaTag(['name' => 'apple-mobile-web-app-capable', 'content' => 'yes']);
$this->registerMetaTag(['name' => 'apple-mobile-web-app-status-bar-style', 'content' => 'black']);

//Startup image for web apps
$this->registerLinkTag(['rel' => 'apple-touch-startup-image', 'href' => $asset->baseUrl . '/img/splash/ipad-landscape.png', 'media' => 'screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)']);
$this->registerLinkTag(['rel' => 'apple-touch-startup-image', 'href' => $asset->baseUrl . '/img/splash/ipad-portrait.png', 'media' => 'screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)']);
$this->registerMetaTag(['rel' => 'apple-touch-startup-image', 'href' => $asset->baseUrl . '/img/splash/iphone.png', 'media' => 'screen and (max-device-width: 320px)']);
?>
<?php $this->beginPage() ?><!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= Html::tag('title', Html::encode($this->title)); ?>
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
    </head>

    <!--

    TABLE OF CONTENTS.

    Use search to find needed section.

    ===================================================================

    |  01. #CSS Links                |  all CSS links and file paths  |
    |  02. #FAVICONS                 |  Favicon links and file paths  |
    |  03. #GOOGLE FONT              |  Google font link              |
    |  04. #APP SCREEN / ICONS       |  app icons, screen backdrops   |
    |  05. #BODY                     |  body tag                      |
    |  06. #HEADER                   |  header tag                    |
    |  07. #PROJECTS                 |  project lists                 |
    |  08. #TOGGLE LAYOUT BUTTONS    |  layout buttons and actions    |
    |  09. #MOBILE                   |  mobile view dropdown          |
    |  10. #SEARCH                   |  search field                  |
    |  11. #NAVIGATION               |  left panel & navigation       |
    |  12. #RIGHT PANEL              |  right panel userlist          |
    |  13. #MAIN PANEL               |  main panel                    |
    |  14. #MAIN CONTENT             |  content holder                |
    |  15. #PAGE FOOTER              |  page footer                   |
    |  16. #SHORTCUT AREA            |  dropdown shortcuts area       |
    |  17. #PLUGINS                  |  all scripts and plugins       |

    ===================================================================

    -->

    <!-- #BODY -->
    <!-- Possible Classes

        * 'smart-style-{SKIN#}'
        * 'smart-rtl'         - Switch theme mode to RTL
        * 'menu-on-top'       - Switch to top navigation (no DOM change required)
        * 'no-menu'			  - Hides the menu completely
        * 'hidden-menu'       - Hides the main menu but still accessable by hovering over left edge
        * 'fixed-header'      - Fixes the header
        * 'fixed-navigation'  - Fixes the main menu
        * 'fixed-ribbon'      - Fixes breadcrumb
        * 'fixed-page-footer' - Fixes footer
        * 'container'         - boxed layout mode (non-responsive: will not work with fixed-navigation & fixed-ribbon)
    -->
    <body class="">
    <?php $this->beginBody() ?>
    <!-- HEADER -->
    <?= $this->render(
        'header.php', ['asset' => $asset]
    ) ?>
    <!-- END HEADER -->

    <!-- Left panel : Navigation area -->
    <?= $this->render(
        'left.php', ['asset' => $asset]
    ) ?>
    <!-- END NAVIGATION -->

    <!-- MAIN PANEL -->
    <div id="main" role="main">

        <!-- RIBBON -->
        <div id="ribbon">

				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets"
                          data-title="<?= Yii::t('admin', 'Refresh'); ?>"
                          rel="tooltip" data-placement="bottom"
                          data-original-title="<i class='text-warning fa fa-warning'></i> <?= Yii::t('admin', 'Warning! This will reset all your widget settings.'); ?>"
                          data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>

            <!-- breadcrumb -->
            <?= Breadcrumbs::widget([
                'tag' => 'ol',
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <!-- end breadcrumb -->

            <!-- You can also add more buttons to the
            ribbon for further usability

            Example below:

            <span class="ribbon-button-alignment pull-right">
                <a class="btn btn-ribbon hidden-xs" href="http://f.l68.net" target="_blank"><i class="fa-plus"></i> Home</a>

            <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i
                    class="fa-grid"></i> Change Grid</span>
            <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
            <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span
                    class="hidden-mobile">Search</span></span>
            </span> -->

        </div>
        <!-- END RIBBON -->

        <!-- MAIN CONTENT -->
        <div id="content">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i>
                        <?= MainBreadcrumbs::widget([
                            'breadcrumbs' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    </h1>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

                </div>
            </div>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
        <!-- END MAIN CONTENT -->

    </div>
    <!-- END MAIN PANEL -->

    <!-- PAGE FOOTER -->
    <?= $this->render(
        'footer.php', ['asset' => $asset]
    ) ?>
    <!-- END PAGE FOOTER -->

    <!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
    Note: These tiles are completely responsive,
    you can add as many as you like
    -->
    <div id="shortcut">
        <ul>
            <li>
                <a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i
                            class="fa fa-envelope fa-4x"></i> <span>Mail <span
                                class="label pull-right bg-color-darken">14</span></span> </span> </a>
            </li>
            <li>
                <a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span
                        class="iconbox"> <i
                            class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
            </li>
            <li>
                <a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i
                            class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
            </li>
            <li>
                <a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i
                            class="fa fa-book fa-4x"></i> <span>Invoice <span
                                class="label pull-right bg-color-darken">99</span></span> </span> </a>
            </li>
            <li>
                <a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i
                            class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
            </li>
            <li>
                <a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span
                        class="iconbox"> <i
                            class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
            </li>
        </ul>
    </div>
    <!-- END SHORTCUT AREA -->
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>