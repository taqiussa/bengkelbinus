<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use App\Models\Customer;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Role',
            'email' => 'admin@role.test',
            'password' => bcrypt('asdfasdf')
        ]);
        User::create(
        [
            'name' => 'user Role',
            'email' => 'user@role.test',
            'password' => bcrypt('asdfasdf')
        ]);

        Category::create([
            'category' => 'Barang',
        ]);
        Category::create([
            'category' => 'Jasa',
        ]);

        Item::create(
            [
            'category_id' => 1,
            'item' => 'Shock',
            'jumlah' => 10,
            'harga' => 150000,
            ]);
        Item::create(
            [
            'category_id' => 1,
            'item' => 'Lampu',
            'jumlah' => 10,
            'harga' => 10000,
            ]);
        Item::create(
            [
            'category_id' => 2,
            'item' => 'Service Ringan',
            'jumlah' => 1,
            'harga' => 25000,
            ]);
        Item::create(
            [
            'category_id' => 2,
            'item' => 'Service Sedang',
            'jumlah' => 1,
            'harga' => 55000,
            ]
        );
        Customer::create(
            [
            'nama' => 'Taqi',
            'nopol' => 'H 3825 ALD',
            'tipe' => 'Vario',
            'tahun' => '2010',
            'alamat' => 'Kendal',
            ]);
        Customer::create(
            [
            'nama' => 'Arga',
            'nopol' => 'H 3417 YD',
            'tipe' => 'Beat',
            'tahun' => '2014',
            'alamat' => 'Kendal',
            ],
        );
        Customer::create(
            [
            'nama' => 'Arif',
            'nopol' => 'H 1717 YD',
            'tipe' => 'Supra',
            'tahun' => '2014',
            'alamat' => 'Semarang',
            ],
        );
    }
}
