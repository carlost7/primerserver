<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call('PlansTableSeeder');
        $this->call('ServersTableSeeder');
        $this->call('HostingCostsTableSeeder');
        $this->call('DomainCostsTableSeeder');                
    }

}
