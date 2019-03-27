<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
	protected $fillable = ['update_code', 'cron_date', 'executed', 'page_id'];

        protected $dates = [
	      'published_at',
	      'created_at', 
	      'cron_date'
	    ];


	public function page(){

      return $this->belongsTo(Page::class);
      
    }
}
