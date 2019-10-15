<?php
use App\Address;
use App\User;
use App\product;
use App\Image;
use App\Review;
use App\Category;
use App\Tag;
use App\Ticket;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //factory(Address ::class , 1000)->create();
        //factory( User ::class , 500)->create();
         factory(product ::class , 1000)->create();
      // factory(Image ::class , 3500)->create();
       //factory(Review ::class , 3500)->create();
      // factory( Category ::class , 12)->create();
      // factory( Tag ::class , 150)->create();
     //  factory( Ticket ::class , 150)->create();


    }
}
