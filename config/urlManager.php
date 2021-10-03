<?php

return [
    'class' => \yii\web\UrlManager::class,
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
        '<hash>' => 'link/view',
    ],
];