<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $dates = [
      'published_at',
      'created_at',
      'updated_at', 
      'cron_update'
    ];

    protected $fillable = ['id','page_name', 'user_ftp', 'pass_ftp', 'current_code', 'link_file', 'active'];


  public function codes()
  {
    return $this->hasMany(Code::class);
  }
}
