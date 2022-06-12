<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/22/2022
 * File: Rating.php
 * Description: file contains rating class model
 */

namespace UsDataAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //The table associated with this model
    protected $table = 'rating';

    //The primary key of the table
    protected $primaryKey = 'rating_id';

    //The PK is non-numeric
    public $incrementing = false;

    //If the PF is not an integer, set its type
    protected $keyType = 'char';

    //If the created_at and updated_at columns are not used
    public $timestamps = false;


    //Retrieve all ratings
    public static function getRatings()
    {
        return self::all();
    }

    //Retrieve a rating by id
    public static function getRatingById($id)
    {
        return self::findOrFail($id);
    }

    //relationship between rating and cities
    public function cities() {
        return $this->hasMany(City::class, 'rating');
    }

    //View all cities by rating
    public static function getCitiesByRating(int $id) {
        $cities = self::findOrFail($id)->cities;
        $cities->load('rating');
        return $cities;
    }

}
