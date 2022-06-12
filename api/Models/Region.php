<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/22/2022
 * File: Region.php
 * Description: create Region class
 */

namespace UsDataAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //The table associated with this model
    protected $table = 'geographic_region';

    //The primary key of the table
    protected $primaryKey = 'region_id';

    //The PK is non-numeric
    public $incrementing = false;

    //If the PF is not an integer, set its type
    protected $keyType = 'char';

    //If the created_at and updated_at columns are not used
    public $timestamps = false;

   //Retrieve regions
    public static function getRegions()
    {
        $states = self::with('states')->get();
        return $states;
    }

    //Retrieve a region by id
    public static function getRegionById($id)
    {
        $region = self::findOrFail($id);
        $region->load('states');
        return $region;
    }


    public function states() {
        return $this->hasMany(State::class, 'region');
    }

    //View all states of a region
    public static function getStatesByRegion(int $id) {
        $states = self::findOrFail($id)->states;
        $states->load('election')->load('region');
        return $states;
    }

}