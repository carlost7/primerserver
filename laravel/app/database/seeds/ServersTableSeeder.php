<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ServersTableSeeder extends Seeder {

    public function run()
    {

        Server::create([
            "domain"     => "psbasic.com",
            "nameserver" => "psbasic",
            "ip"         => "rs4.websithostserver.net",
            "plan_id"    => "1",
        ]);
        Server::create([
            "domain"     => "psbasic.com",
            "nameserver" => "psbasic",
            "ip"         => "rs4.websithostserver.net",
            "plan_id"    => "2",
        ]);
    }

}
