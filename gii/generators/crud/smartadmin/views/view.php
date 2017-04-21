<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;
use yuncms\admin\widgets\Jarvis;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString('Manage ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
            <?= "<?php " ?>Jarvis::begin([
                'noPadding' => true,
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
                    [
                        'label' => <?= $generator->generateString('Update ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>,
                        'url' => ['/<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/update', 'id' => $model->id],
                        'options' => ['class' => 'btn btn-primary btn-sm']
                    ],
                    [
                        'label' => <?= $generator->generateString('Delete ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>,
                        'url' => ['/<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/delete', 'id' => $model->id],
                        'options' => [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]
                    ],
                ]
            ]); ?>
            <?= "<?= " ?>DetailView::widget([
                'model' => $model,
                'attributes' => [
        <?php
        if (($tableSchema = $generator->getTableSchema()) === false) {
            foreach ($generator->getColumnNames() as $name) {
                echo "              '" . $name . "',\n";
            }
        } else {
            foreach ($generator->getTableSchema()->columns as $column) {
                $format = $generator->generateColumnFormat($column);
                echo "                    '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            }
        }
        ?>
                ],
            ]) ?>
            <?= "<?php " ?>Jarvis::end(); ?>
        </article>
    </div>
</section>