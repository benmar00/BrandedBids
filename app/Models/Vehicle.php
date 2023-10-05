<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Cviebrock\EloquentSluggable\{Sluggable, SluggableScopeHelpers};
use Auth, DB;


class Vehicle extends Model
{
    use Sluggable, SluggableScopeHelpers;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vehicles';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array  x
     */
    protected $fillable = ['make_id', 'name', 'mileage', 'vin', 'title_status', 'location', 'engine', 'drivetrain', 'transmission', 'body_style_id', 'exterior_color', 'interior_color', 'seller_id', 'seller_type', 'description', 'image', 'model', 'status', 'images', 'expire', 'starting_bid', 'short_desc', 'video', 'year', 'views', 'crash', 'party', 'website', 'flaws', 'title_hand', 'zip', 'sale', 'located', 'reserve', 'referal', 'modify','lisence','dealer','data','equipment','history','serv_history', 'issues', 'conditions', 'videos','docphoto','review','city','inspection','features','schedule','accept'];

    protected $guarded = ['seller_id'];

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function bodyStyle()
    {
        return $this->belongsTo(BodyStyle::class);
    }

    public function scopeActive($query)
    {
        return $query->whereStatus(true);
    }

    public function qas()
    {
        return $this->hasMany(SellerQA::class);
    }

    public function flags()
    {
        return $this->hasMany(Flagged::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();;
    }
    public function highBid()
    {

        return $this->hasOne(Bid::class)
            ->select(DB::raw('MAX(bid) as highest_bid'))
            ->groupBy('vehicle_id');
    }
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function takeImages($num)
    {
        $array = [];
        if ($this->images) {
            foreach (json_decode($this->images) as $key => $value) {
                array_push($array, $value);
                if ($key == $num - 1) {
                    break;
                }
            }
        }
        return $array;
    }
    public function make()
    {
        return $this->belongsTo(Make::class);
    }
    protected function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    protected function getImages($value)
    {
        return json_decode($value, true);
    }
    protected function setImages($value)
    {
        return json_encode($value);
    }


    protected static function new()
    {
        return static::latest()->active()->take(4)->get();
    }
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }
}
