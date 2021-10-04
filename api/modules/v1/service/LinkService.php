<?php

namespace app\api\modules\v1\service;

use app\api\modules\v1\forms\LinkCreateForm;
use app\models\Link;
use app\repositories\LinkRepository;

class LinkService
{
    protected LinkRepository $repository;

    public function __construct(LinkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createLinkByForm(LinkCreateForm $form): Link
    {
        $link = Link::create($form->url, $this->generateUniqHash());
        $this->repository->save($link);
        return $link;
    }

    protected function generateUniqHash(): string
    {
        do {
            $hash = substr(md5(uniqid(mt_rand(), true)),0,8);
        } while ($this->repository->get($hash));
        return $hash;
    }
}