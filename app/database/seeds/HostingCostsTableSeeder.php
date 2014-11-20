<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class HostingCostsTableSeeder extends Seeder {

      public function run()
      {
            $faker = Faker::create();


            HostingCost::create([
                "cost" => "100", 
                "currency" => "MXN", 
                "concept" => "Hosting", 
                "active" => true,
                "plan_id" => 1                
            ]);
      }

}
