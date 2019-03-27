<?php

use Illuminate\Database\Seeder;
use App\Code;
use Carbon\Carbon;


class CodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Code::truncate();

        $code = new Code; 
        $code->cron_date = Carbon::now()->subDays(1);
        $code->executed = '0';
        $code->page_id = '1';

        
        

        $code->save();
    }
}
