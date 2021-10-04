<?php

return [
    'class' => \yii\web\UrlManager::class,
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
        '/' => 'site/index',
        '/<_a:contact|about|login|error>' => 'site/<_a>',
        '<hash>' => 'link/view',
    ],
];