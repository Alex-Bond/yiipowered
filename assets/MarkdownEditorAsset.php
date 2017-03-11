<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * MarkdownEditorAsset groups assets for markdown editor
 */
class MarkdownEditorAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/markdown';
    public $js = [
        'editor.js',
    ];
    public $depends = [
        \yii\web\JqueryAsset::class,
        \app\assets\CodeMirrorAsset::class,
        \app\assets\CodeMirrorButtonsAsset::class,
    ];
}
