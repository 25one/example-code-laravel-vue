<?php

use Illuminate\Database\Seeder;
use App\Models\Room;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Room::create(
            [
                'name' => 'room 1',
                'title' => 'There is a big window in it. There is not much furniture in our living-room. We have no armchairs, no wall-unit in the living-room because they take too much space. And there are no drapes on the window, only net curtain and jalousie.',
                'price' => 49.99,
                'image' => 'room1.jpg',
            ]
        ); 
        Room::create(
            [
                'name' => 'room 2',
                'title' => 'There is a big window in it. There is not much furniture in our living-room. We have no armchairs, no wall-unit in the living-room because they take too much space. And there are no drapes on the window, only net curtain and jalousie.',
                'price' => 49.99,
                'image' => 'room2.jpg',
            ]
        );
        Room::create(
            [
                'name' => 'room 3',
                'title' => 'There is a big window in it. There is not much furniture in our living-room. We have no armchairs, no wall-unit in the living-room because they take too much space. And there are no drapes on the window, only net curtain and jalousie.',
                'price' => 49.99,
                'image' => 'room3.jpg',
            ]
        );
        Room::create(
            [
                'name' => 'room 4',
                'title' => 'There is a big window in it. There is not much furniture in our living-room. We have no armchairs, no wall-unit in the living-room because they take too much space. And there are no drapes on the window, only net curtain and jalousie.',
                'price' => 49.99,
                'image' => 'room4.jpg',
            ]
        );
        Room::create(
            [
                'name' => 'room 5',
                'title' => 'There is a big window in it. There is not much furniture in our living-room. We have no armchairs, no wall-unit in the living-room because they take too much space. And there are no drapes on the window, only net curtain and jalousie.',
                'price' => 49.99,
                'image' => 'room5.jpg',
            ]
        );                        
    }
}
