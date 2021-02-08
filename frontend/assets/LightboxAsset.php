<?php
namespace frontend\assets;

use Yii;
use yii\web\AssetBundle;

class LightboxAsset extends AssetBundle{
	public $basePath='@webroot';
	public $baseUrl='@web';
	public $css=[
		'lightbox/css/lightbox.css'
	];
	public $js=[
		'lightbox/js/lightbox.js'
	];
	public $depends=[
		'yii\web\JqueryAsset',
	];
}
?>