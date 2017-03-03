<?php

namespace UserBundle\Query;

class GetUserQuery
{
    private $id;

    public function byId(string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function withFields()
    {
        return $this;
    }

    public function execute(): array
    {
        return ['uid' => $this->id];
    }
}