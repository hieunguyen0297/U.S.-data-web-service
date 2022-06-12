<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/22/2022
 * File: State.php
 * Description: create State class
 */

namespace UsDataAPI\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //The table associated with this model
    protected $table = 'us_state';

    //The primary key of the table
    protected $primaryKey = 'state_id';

    //The PK is non-numeric
    public $incrementing = false;

    //If the PF is not an integer, set its type
    protected $keyType = 'char';

    //If the created_at and updated_at columns are not used
    public $timestamps = false;

    //Retrieve all states
    public static function getStates()
    {
        $states = self::with(['region', 'election'])->get();
        return $states;
    }

    //Retrieve one state
    public static function getStateById($id)
    {
        $state = self::findOrFail($id);
        $state->load('region')->load('election');
        return $state;
    }


    // Define the one to one (inverse) relationship  between Region and State
    public function region()
    {
        return $this->belongsTo(Region::class, 'region');
    }

    // Define the one to one (inverse) relationship  between Election and State
    public function election()
    {
        return $this->belongsTo(Election::class, 'election');
    }


    //relationship between states and cities
    public function cities() {
        return $this->hasMany(City::class, 'state');
    }

    //View all cities of a state
    public static function getCitiesByState(int $id) {
        $cities = self::findOrFail($id)->cities;
        $cities->load('rating')->load('state');
        return $cities;
    }


    //Search for states
    public static function searchStates($term) {
        if(is_numeric($term)) {
            $query = self::where('state_population', '>=', $term)->orWhere('state_id', '=', $term);

        } else {
            $query = self::Where('state_code', 'like', "%$term%")
                ->orWhere('state_name', 'like', "%$term%")
                ->orWhere('state_capital', 'like', "%$term%");
        }
        return $query->get()->load('region')->load('election');
    }


    //Create a new state
    public static function createState($request) {
        //Retrieve parameters from request body
        $params = $request->getParsedBody();
        //Create a new State instance
        $state = new State();
        //Set the state's attributes
        foreach($params as $field => $value) {
            $state->$field = $value;
        }
        //Insert the state into the database
        $state->save();
        return $state->load('region')->load('election');
    }


    //Update a state
    public static function updateState($request) {
        //Retrieve parameters from request body
        $params = $request->getParsedBody();
        //Retrieve id from the request url
        $id = $request->getAttribute('id');
        $state = self::findOrFail($id);
        if(!$state) {
            return false;
        }
        //update attributes of the state
        foreach($params as $field => $value) {
            $state->$field = $value;
        }
        //save the state into the database
        $state->save();
        return $state->load('region')->load('election');
    }

    //Delete a state
    public static function deleteState($request) {
        //Retrieve id from the request
        $id = $request->getAttribute('id');
        $state = self::findOrFail($id);
        return($state ? $state->delete() : $state);
    }


}