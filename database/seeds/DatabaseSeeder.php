<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Persona;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // 
     
        $personas = factory(App\Persona::class, 50)->create();

        $personas->each(function(App\Persona $persona) use ($persona)
        {
        	 factory(App\User::class)
        	 ->times(1)
        	 ->create([
        	 	'persona_id'=>$persona->id,
        	 	]);

        	 $persona->usuario()->sync();
        
        });
    }
}
