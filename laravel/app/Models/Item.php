<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'items';

    public function category() {
        return $this -> belongsTo(Category::class);

	}
    public function period() {
        return $this -> belongsTo(Period::class);
    }

    protected $fillable = [
        'title','description', 'category_id','period_id'
    ];
}
