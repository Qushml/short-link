<?php

namespace app\controllers;

use app\repositories\LinkRepository;
use yii\web\NotFoundHttpException;

class LinkController extends \yii\web\Controller
{
    protected LinkRepository $repository;

    public function __construct($id, $module, LinkRepository $repository, $config = [])
    {
        $this->repository = $repository;
        parent::__construct($id, $module, $config);
    }

    public function actionView(string $hash)
    {
        if (!$model = $this->repository->get($hash)) {
            throw new NotFoundHttpException();
        }

        $model->incrementClickCount();
        $this->repository->save($model);

        return $this->redirect($model->url);
    }
}