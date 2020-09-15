<?php

namespace App\Admin\Repositories;

use App\Models\HardwareCategory as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class HardwareCategory extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
