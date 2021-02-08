<?php
namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;

class JqueryUiAsset extends AssetBundle{
	public $basePath='@webroot';
	public $baseUrl='@web';
	public $css=[
		'jquery-ui/jquery-ui.css'
	];
	public $js=[
		'jquery-ui/jquery-ui.js',
		'jquery-ui/dpesp.js'
	];
	public $depends=[
		'yii\web\JqueryAsset'
	];
}
?>