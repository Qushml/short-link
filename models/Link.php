<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Link
 * @package app\models
 *
 * @property $id int
 * @property $url string
 * @property $hash string
 * @property $click_count int
 */
class Link extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%link}}';
    }

    public static function create(string $url, string $hash): static
    {
        $model = new static;
        $model->url = $url;
        $model->hash = $hash;

        return $model;
    }

    public function incrementClickCount(): void
    {
        $this->click_count++;
    }
}