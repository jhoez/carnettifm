<?php 
use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$this->beginPage();?>
<!DOCTYPE html>
<html>
<head>
	<title><?=Html::encode($this->title);?></title>
	<?php $this->head();?>
</head>
<body>
	<?php $this->beginBody();?>
	<div class="wrap">
		<div class="container">
			<?=$content;?>
		</div>
	</div>
	<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage();?>