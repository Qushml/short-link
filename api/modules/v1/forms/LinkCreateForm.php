<?php

namespace app\api\modules\v1\forms;


class LinkCreateForm extends \yii\base\Model
{
    public string $url = '';

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'url'],
        ];
    }
}