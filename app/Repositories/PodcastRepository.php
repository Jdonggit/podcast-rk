<?php

namespace App\Repositories;

use Yish\Generators\Foundation\Repository\Repository;
use App\Models\Podcast;

class PodcastRepository extends Repository
{
    protected $model;

    public function __construct(Podcast $podcast)
    {
        $this->model = $podcast;
    }

    public function insert($data)
    {
        $this->model->insert($data);
    }
}
