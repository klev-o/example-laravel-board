<?php

namespace App\Console\Commands\User;

use App\UseCases\Command\UserService;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new admin';

    private $service;

    /**
     * Create a new command instance.
     * CreateAdmin constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('What is your name?');
        $email = $this->ask('What is your email?');
        $pass = $this->secret('What is your password?');

        try {
            $this->service->createAdmin($name, $email, $pass);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return false;
        }

        $this->info('Admin is successfully created!');
    }
}
