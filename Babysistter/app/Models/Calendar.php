<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'id',
        'title',
        'start',
        'end',
        'start_recur',
        'end_recur',
        'start_time',
        'end_time',
        'user_id',
        'status',
        'color',
        'editable',
        'selectable',
        'parent_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'calendars';

//    public function user(): BelongsTo
//    {
//        return $this->belongsTo(User::class);
//    }
}
