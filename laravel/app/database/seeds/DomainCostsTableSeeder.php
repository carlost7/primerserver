<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class DomainCostsTableSeeder extends Seeder {

      public function run()
      {
            $faker = Faker::create();

            DomainCost::create([
                "domain" => 'com', 
                "cost" => 122, 
                "concept" => "Costo dominio .com", 
                "currency" => "MXN"
            ]);
            
            DomainCost::create([
                "domain" => 'com.mx', 
                "cost" => 150, 
                "concept" => "Costo dominio .com.mx", 
                "currency" => "MXN"
            ]);
            
            DomainCost::create([
                "domain" => 'net', 
                "cost" => 150, 
                "concept" => "Costo dominio .net", 
                "currency" => "MXN"
            ]);
      }

}
