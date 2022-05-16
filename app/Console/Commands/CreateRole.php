<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create roles with command';

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
        $permissionOptions = Permission::all()->pluck('name')->toArray();
        if(!count($permissionOptions)){
            $this->info('Please create at least one permission before role creating.');
            return 0;
        }

        $permissionNames = $this->choice('Choose permissions of the role ?', $permissionOptions, null, null, true);
        $permissions = Permission::whereIn('name', $permissionNames)->get()->pluck('id')->toArray();
        $name = $this->ask(
            'What should be name of the role ?'
        );

        $validator = Validator::make(
            [
                'name' => $name,
                'permissions' => $permissionNames,
            ],
            [
                'name' => ['required', 'unique:roles,name', 'alpha_dash'],
                'permissions' => ['required', 'array']
            ]
        );

        if ($validator->fails()) {
            $this->info('Role not created. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        $role = Role::create([
            'name' => $name
        ]);
        if($role){
            $role->permissions()->sync($permissions);
        }

        $this->info('New Role created successfully.');
        return 0;
    }
}
