<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class CreatePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create permissions with command';

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
     * @return int
     */
    public function handle()
    {
        $name = $this->ask(
            'What should be name of the permission ?'
        );

        $validator = Validator::make(
            [
                'name' => $name,
            ],
            [
                'name' => ['required', 'unique:permissions,name', 'alpha_dash']
            ]
        );

        if ($validator->fails()) {
            $this->info('Permission not created. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        Permission::create([
            'name' => $name
        ]);

        $this->info('New Permission created successfully.');
        return 0;
    }
}
