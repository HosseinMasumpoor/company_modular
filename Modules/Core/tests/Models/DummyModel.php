<?php

namespace Modules\Core\Tests\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DummyModel extends Model
{
    use SoftDeletes;
}
