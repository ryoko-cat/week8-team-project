<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalList extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'rentalLists';

    public function member() {
        return $this -> belongsTo(Member::class);
    }
    protected $fillable = [
        'item_id','lending_date', 'member_id'
    ];
}