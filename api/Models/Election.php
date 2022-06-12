<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/22/2022
 * File: Election.php
 * Description: create Election class that model with election table
 */

namespace UsDataAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    //The table associated with this model
    protected $table = 'election';

    //The primary key of the table
    protected $primaryKey = 'election_id';

    //The PK is non-numeric
    public $incrementing = false;

    //If the PF is not an integer, set its type
    protected $keyType = 'char';

    //If the created_at and updated_at columns are not used
    public $timestamps = false;

    //Retrieve all election parties
    public static function getElections()
    {
        return self::all();
    }

    //Retrieve an election party by their id
    public static function getElectionById($id)
    {
        return self::findOrFail($id);
    }


    public function states() {
        return $this->hasMany(State::class, 'election');
    }

    //View all states by election
    public static function getStatesByElection(int $id) {
        $states = self::findOrFail($id)->states;
        $states->load('election')->load('election');
        return $states;
    }
}
