<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'created_user_id'
    ];

    /**
	* The attributes excluded from the model's JSON form.
	*
	* @var array
	*/
	protected $hidden = ['created_at', 'updated_at'];
}
