<?php

namespace App;

use App\Category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Entry extends Model
{
    use Notifiable;

    public $table = 'entries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticketnumber', 'first_name', 'last_name', 'customer_number', 'email', 'category_id', 'text', 'status_id', 'link'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function statusoption()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /**protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /**protected $casts = [
        'email_verified_at' => 'datetime',
    ];*/
}
