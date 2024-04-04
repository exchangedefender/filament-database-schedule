<?php

namespace HusamTariq\FilamentDatabaseSchedule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Carbon;

class ScheduleHistory extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    protected $fillable = [
        'command',
        'params',
        'output',
        'options',
    ];

    protected $casts = [
        'params' => 'array',
        'options' => 'array',
        'completed_at' => 'datetime'
    ];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = Config::get('filament-database-schedule.table.schedule_histories', 'schedule_histories');
    }

    public function command()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    public function markCompleted(?Carbon $at = null)
    {
        $this->forceFill([
            'completed_at' => $at ?? now(),
        ])->save();
    }
}
