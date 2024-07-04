<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Review extends Model
{
    use HasFactory;


    protected $fillable = ['review', 'rating'];
    public function book(){
        return $this->belongsTo(Book::class);
    }
    protected static function booted()
    {
        static::updated(function(Review $review) {
            Log::info('Review updated: ' . $review->id);
            cache()->forget('book:' . $review->book_id);
        });
    
        static::deleted(function(Review $review) {
            Log::info('Review deleted: ' . $review->id);
            cache()->forget('book:' . $review->book_id);
        });
        static::created(fn(Review $review) => cache()->forget('book:' . $review->book_id));
    }
}
