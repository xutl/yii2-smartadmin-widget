<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var \yii\web\View $this */
/* @var <?= ltrim($generator->modelClass, '\\') ?> $model */
/* @var ActiveForm $form */
?>
<?= "<?php " ?>$form = ActiveForm::begin(['layout'=>'horizontal', 'enableAjaxValidation' => true, 'enableClientValidation' => false,]); ?>
<fieldset>
<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>
</fieldset>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= "<?= " ?>Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>

<?= "<?php " ?>ActiveForm::end(); ?>

