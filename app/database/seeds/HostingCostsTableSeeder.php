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
                "concept" => "Hosting Basico", 
                "active" => true,
                "plan_id" => 1                
            ]);
            HostingCost::create([
                "cost" => "150", 
                "currency" => "MXN", 
                "concept" => "Hosting Startup", 
                "active" => true,
                "plan_id" => 2                
            ]);
      }

}
