<?php

namespace app\repositories;

use app\models\Link;

class LinkRepository
{
    public function get(string $hash): ?Link
    {
        return Link::findOne(['hash' => $hash]);
    }

    public function save(Link $link): void
    {
        if (!$link->save(false)) {
            throw new \DomainException('Link not saved');
        }
    }
}