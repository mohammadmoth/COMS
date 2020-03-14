<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:AdminUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add first user Admin ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Adding user admin in database ');
        $this->info('username : admin@admin.com ');
        $this->info('password : 123456 ');
 
        $user = new \App\User ();
        $user->name = "admin";
        $user->email = "admin@admin.com";
        $user->ip = "";
        $user->rules = "admin" ;

        $user->password= \Illuminate\Support\Facades\Hash::make("123456") ;
        try {
        if (  $user->save())
        $this->info('Thank You https://github.com/MohammadMOTH/COMS');
        else
        $this->error('You have added before , https://github.com/MohammadMOTH/COMS');
        } catch (\Throwable $th) {
            //throw $th;
            $this->error('You have added before , https://github.com/MohammadMOTH/COMS');
        }
        //
    }
}
