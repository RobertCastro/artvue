<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $guarded =[];
    protected $fillable = ['title', 'body', 'category_id', 'except', 'user_id', 'url'];

    protected $dates = [
      'published_at',
      'created_at',
      'updated_at'
    ];

    public function category(){
      return $this->belongsTo(Category::class);
    }

    public function tags(){
      return $this->belongsToMany(Tag::class);
    }

    public function photos()
    {
      return $this->hasMany(Photo::class);
    }

    public function owner()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query)
    {
      $query->whereNotNull('published_at')
              ->where('published_at', '<=', Carbon::now())
              ->latest('published_at');

    }

    public function isPublished()
    {
      return ! is_null($this->published_at) && $this->published_at < today();
    }



    public function scopeAllowed($query)
    {
      if( auth()->user()->can('view', $this) )
      {
        return $query;
      }
        return $query->where('user_id', auth()->id());
    }



    public function getRouteKeyName()
    {
      return 'url';
    }
}
