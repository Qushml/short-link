<?php


namespace app\api\modules\v1\controllers;


use app\api\modules\v1\forms\LinkCreateForm;
use app\api\modules\v1\service\LinkService;
use app\repositories\LinkRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class LinkController extends Controller
{
    protected LinkRepository $repository;

    public function __construct($id, $module, LinkRepository $repository, $config = [])
    {
        $this->repository = $repository;
        parent::__construct($id, $module, $config);
    }

    public function verbs()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create' => 'POST',
                    'view' => 'GET',
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        \Yii::$app->response->format = \Yii::$app->response::FORMAT_JSON;

        $form = new LinkCreateForm();

        if (!$form->load(\Yii::$app->request->post())) {
            return ['status' => 'error', 'message' => 'Invalid load data'];
        }

        if (!$form->validate()) {
            return ['status' => 'error', 'message' => 'Invalid load url'];
        }

        try {
            $service = new LinkService($this->repository);
            $link = $service->createLinkByForm($form);
        } catch (\Throwable $e) {
            return [
                'status' => 'error',
                'message' => 'Internal server error'
            ];
        }

        return ['status' => 'success', 'short_url' => \Yii::$app->frontendUrlManager->createAbsoluteUrl(['link/view', 'hash' => $link->hash])];
    }

    public function actionView(string $hash)
    {
        \Yii::$app->response->format = \Yii::$app->response::FORMAT_JSON;

        try {
            if ($linkModel = $this->repository->get($hash)) {
                return [
                    'status' => 'ok',
                    'url' => $linkModel->url,
                    'click_count' => $linkModel->click_count,
                    'short_url' => \Yii::$app->frontendUrlManager->createAbsoluteUrl(['link/view', 'hash' => $linkModel->hash]),
                ];
            }

            return ['status' => 'error', 'message' => 'Link not found'];
        } catch (\Throwable $e) {
            return ['status' => 'error', 'message' => 'Internal server error'];
        }
    }
}