<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PlansTableSeeder extends Seeder
{

      public function run()
      {
            Plan::create([
                "plan_name" => "Básico",
                "num_emails" => "100",
                "num_databases" => "1",
                "num_ftps" => "1",
                "quota_emails" => "10000",
                "quota_databases" => "10000",
                "quota_ftps" => "10000",
            ]);
      }

}
