<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);

        $categories = [
            ['name' => 'Kaos', 'slug' => 'kaos'],
            ['name' => 'Kemeja', 'slug' => 'kemeja'],
            ['name' => 'Celana', 'slug' => 'celana'],
            ['name' => 'Jaket', 'slug' => 'jaket'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $products = [
            ['category' => 'kaos', 'name' => 'Kaos Polos Cotton Combed 30s', 'price' => 89000, 'stock' => 50, 'is_featured' => true, 'description' => 'Kaos polos premium 100% cotton combed 30s. Nyaman dipakai sehari-hari. Tersedia dalam berbagai ukuran.'],
            ['category' => 'kaos', 'name' => 'Kaos Graphic Streetwear', 'price' => 129000, 'stock' => 30, 'is_featured' => true, 'description' => 'Kaos dengan desain graphic menarik. Bahan premium, jahitan rapi.'],
            ['category' => 'kaos', 'name' => 'Kaos Polo Premium', 'price' => 159000, 'stock' => 25, 'is_featured' => false, 'description' => 'Kaos polo dengan bahan lacoste premium. Cocok untuk gaya kasual dan semi-formal.'],
            ['category' => 'kemeja', 'name' => 'Kemeja Flannel Kotak', 'price' => 199000, 'stock' => 20, 'is_featured' => true, 'description' => 'Kemeja flannel dengan motif kotak-kotak klasik. Bahan tebal dan hangat.'],
            ['category' => 'kemeja', 'name' => 'Kemeja Linen Casual', 'price' => 229000, 'stock' => 15, 'is_featured' => true, 'description' => 'Kemeja bahan linen yang adem dan nyaman. Cocok untuk cuaca tropis.'],
            ['category' => 'kemeja', 'name' => 'Kemeja Denim Oversized', 'price' => 249000, 'stock' => 18, 'is_featured' => false, 'description' => 'Kemeja denim gaya oversize. Trendi dan fashionable.'],
            ['category' => 'celana', 'name' => 'Chino Pants Slim Fit', 'price' => 179000, 'stock' => 35, 'is_featured' => true, 'description' => 'Celana chino slim fit. Bahan nyaman, cocok untuk gaya kasual dan formal.'],
            ['category' => 'celana', 'name' => 'Celana Jogger Sporty', 'price' => 149000, 'stock' => 40, 'is_featured' => false, 'description' => 'Celana jogger dengan elastic waist. Nyaman untuk olahraga dan santai.'],
            ['category' => 'celana', 'name' => 'Celana Jeans Stretch', 'price' => 219000, 'stock' => 25, 'is_featured' => true, 'description' => 'Celana jeans dengan bahan stretch. Pas di tubuh dan fleksibel.'],
            ['category' => 'jaket', 'name' => 'Hoodie Zipper Premium', 'price' => 299000, 'stock' => 20, 'is_featured' => true, 'description' => 'Hoodie zipper dengan bahan fleece tebal. Hangat dan stylish.'],
            ['category' => 'jaket', 'name' => 'Jaket Bomber Satin', 'price' => 349000, 'stock' => 12, 'is_featured' => false, 'description' => 'Jaket bomber bahan satin. Tampil gagah dan maskulin.'],
            ['category' => 'jaket', 'name' => 'Denim Jacket Classic', 'price' => 329000, 'stock' => 15, 'is_featured' => true, 'description' => 'Jaket denim klasik. timeless fashion yang tidak lekang waktu.'],
            ['category' => 'aksesoris', 'name' => 'Topi Baseball Cap', 'price' => 79000, 'stock' => 50, 'is_featured' => false, 'description' => 'Topi baseball cap dengan desain simpel. Cocok untuk pelengkap gaya.'],
            ['category' => 'aksesoris', 'name' => 'Tas Ransel Vintage', 'price' => 189000, 'stock' => 20, 'is_featured' => true, 'description' => 'Tas ransel gaya vintage. Muat banyak, cocok untuk daily use.'],
            ['category' => 'aksesoris', 'name' => 'Jam Tangan Minimalis', 'price' => 259000, 'stock' => 10, 'is_featured' => true, 'description' => 'Jam tangan desain minimalis. Elegan dan presisi.'],
        ];

        foreach ($products as $product) {
            $category = Category::where('slug', $product['category'])->first();
            Product::create([
                'category_id' => $category->id,
                'name' => $product['name'],
                'slug' => \Illuminate\Support\Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'is_featured' => $product['is_featured'],
            ]);
        }
    }
}
