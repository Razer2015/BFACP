<?php

namespace BFACP\Player;

use BFACP\Elegant;

/**
 * Class Session.
 */
class Session extends Elegant
{
    /**
     * Should model handle timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'tbl_sessions';

    /**
     * Table primary key.
     *
     * @var string
     */
    protected $primaryKey = 'StatsID';

    /**
     * Fields not allowed to be mass assigned.
     *
     * @var array
     */
    protected $guarded = ['*'];

    /**
     * Date fields to convert to carbon instances.
     *
     * @var array
     */
    protected $dates = ['StartTime', 'EndTime'];

    /**
     * Append custom attributes to output.
     *
     * @var array
     */
    protected $appends = ['session_start', 'session_end'];

    /**
     * Models to be loaded automatically.
     *
     * @var array
     */
    protected $with = [];

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function server()
    {
        return $this->belongsToMany(\BFACP\Battlefield\Server\Server::class, 'tbl_server_player', 'StatsID',
            'ServerID');
    }

    /**
     * @return mixed
     */
    public function getSessionStartAttribute()
    {
        return $this->StartTime->toIso8601String();
    }

    /**
     * @return mixed
     */
    public function getSessionEndAttribute()
    {
        return $this->EndTime->toIso8601String();
    }
}
