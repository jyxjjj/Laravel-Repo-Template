<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @method static Builder|static newModelQuery()
 * @method static Builder|static newQuery()
 * @method static Builder|static query()
 */
class BaseModel extends Model
{
    const ?string CREATED_AT = null;
    const ?string UPDATED_AT = null;
    public $incrementing = false;
    public $timestamps = false;
    protected $connection = 'mariadb';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $perPage = 20;
    protected $guarded = [];
    protected $hidden = [];
    protected $dateFormat = 'Y-m-d H:i:s.v';

    public function freshTimestamp(): Carbon
    {
        return getRequestTime();
    }

    public function getDateFormat(): string
    {
        return 'Y-m-d H:i:s.v';
    }
}
