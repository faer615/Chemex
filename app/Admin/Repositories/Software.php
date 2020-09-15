<?php

namespace App\Admin\Repositories;

use App\Models\Software as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Software extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
