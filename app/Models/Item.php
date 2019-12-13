<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'completed' => false,
        'active'    => true,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'deadline',
        'todo_list_id',
    ];

    /**
     * Get the list to which this items belongst.
     */
    public function todo_list()
    {
        return $this->belongsTo('App\TodoList');
    }
}
