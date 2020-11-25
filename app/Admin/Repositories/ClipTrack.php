<?php

namespace App\Admin\Repositories;

use App\Models\ClipTrack as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ClipTrack extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
