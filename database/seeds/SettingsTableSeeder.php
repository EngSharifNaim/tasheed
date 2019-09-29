<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
	        	['key' => 'site_activet','value' => 'yes'],
	        	['key' => 'close_msg','value' => ''],
	        	['key' => 'site_title','value' => 'أسم الموقع'],
	        	['key' => 'site_url','value' => 'http://localhost'],
	        	['key' => 'site_path','value' => 'http://localhost'],
	        	['key' => 'site_meta','value' => ''],
	        	['key' => 'site_kayword','value' => ''],
	        	['key' => 'site_email','value' => 'emial@site.com'],
	        	['key' => 'site_mobile','value' => ''],
	        	['key' => 'site_phone','value' => ''],
	        	['key' => 'facebook_url','value' => ''],
	        	['key' => 'twitter_url','value' => ''],
	        	['key' => 'google_plus','value' => ''],
	        	['key' => 'instagram','value' => ''],
	        	['key' => 'site_skype','value' => '']
        	];


        DB::table('settings')->insert($data); 
    }
}
