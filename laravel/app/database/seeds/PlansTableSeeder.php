<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PlansTableSeeder extends Seeder {

      public function run()
      {
            $plan = Plan::create([
                        "plan_name"       => "basic",
                        "num_emails"      => "100",
                        "num_databases"   => "1",
                        "num_ftps"        => "1",
                        "quota_emails"    => "10000",
                        "quota_databases" => "10000",
                        "quota_ftps"      => "10000",
            ]);


            HostingCost::create([
                "cost"     => 100,
                "currency" => "MEX",
                "concept"  => "Hosting basico",
                "active"   => true,
                "plan_id"  => $plan->id
            ]);

            $plan = Plan::create([
                        "plan_name"       => "free",
                        "num_emails"      => "100",
                        "num_databases"   => "1",
                        "num_ftps"        => "1",
                        "quota_emails"    => "10000",
                        "quota_databases" => "10000",
                        "quota_ftps"      => "10000",
            ]);

            HostingCost::create([
                "cost"     => 0,
                "currency" => "MEX",
                "concept"  => "HOsting free",
                "active"   => true,
                "plan_id"  => $plan->id
            ]);
      }

}
