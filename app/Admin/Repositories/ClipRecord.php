<?php

namespace App\Admin\Repositories;

use App\Models\ClipRecord as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ClipRecord extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
