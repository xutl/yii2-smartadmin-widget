<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yuncms\admin\widgets\Jarvis;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Update '.Inflector::camel2words(StringHelper::basename($generator->modelClass)))?> . ': ' . $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString('Manage ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-update">
            <?= "<?php " ?>Jarvis::begin([
                'editbutton' => false,
                'deletebutton' => false,
                'header' => Html::encode($this->title),
                'bodyToolbarActions' => [
                    [
                        'label' => <?= $generator->generateString('Manage ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>,
                        'url' => ['/<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/index'],
                    ],
                    [
                        'label' => <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>,
                        'url' => ['/<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/create'],
                    ],
                ]
            ]); ?>

            <?= "<?= " ?>$this->render('_form', [
                'model' => $model,
            ]) ?>
            <?= "<?php " ?>Jarvis::end(); ?>
        </article>
    </div>
</section>