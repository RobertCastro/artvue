<?php

use Illuminate\Database\Seeder;

use App\Page;
use Carbon\Carbon;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        Page::truncate();

        $page = new Page;
        $page->page_name = "robertcastro.co";
        $page->user_ftp = "robert@robertcastro.co";
        $page->pass_ftp = "9_Gm7t4sWW*9";
        $page->current_code = '<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">';
        $page->link_file = "public_html/archivo/index.php";
        
        
        

        $page->save();
    }
}
