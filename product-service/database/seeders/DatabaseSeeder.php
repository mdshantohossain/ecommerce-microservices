<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\OtherImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $categories = [
            'Electronics' => [
                0 => ['name' => 'Mobile Phones'],
                1 => ['name' => 'Laptops & Computers'],
                2 => ['name' => 'Headphones'],
                3 => ['name' => 'Smart Home Devices'],
            ],
            'Fashion & Apparel' => [
                0 => ['name' => 'Men’s Clothing'],
                1 => ['name' => 'Women’s Clothing'],
                2 => ['name' => 'Footwear'],
                3 => ['name' => 'Accessories (Watches, Bags, Jewelry)'],
            ],
            'Home & Kitchen' => [
                0 => ['name' => 'Furniture'],
                1 => ['name' => 'Appliances'],
                2 => ['name' => 'Cookware & Dining'],
                3 => ['name' => 'Bedding & Bath'],
            ],
            'Beauty & Personal Care' => [
                0 => ['name' => 'Skincare'],
                1 => ['name' => 'Makeup'],
                2 => ['name' => 'Hair Care'],
                3 => ['name' => 'Fragrances'],
            ],
            'Health & Wellness' => [
                0 => ['name' => 'Vitamins & Supplements'],
                1 => ['name' => 'Fitness Equipment'],
                2 => ['name' => 'Personal Care Devices'],
            ],
            'Toys & Games' => [
                0 => ['name' => 'Educational Toys'],
                1 => ['name' => 'Board Games'],
                2 => ['name' => 'Puzzles'],
                3 => ['name' => 'Outdoor Play Equipment'],
            ],
            'Sports & Outdoors' => [
                0 => ['name' => 'Sportswear'],
                1 => ['name' => 'Camping Gear'],
                2 => ['name' => 'Fitness Accessories'],
                3 => ['name' => 'Bicycles'],
            ],
            'Automotive' => [
                0 => ['name' => 'Car Accessories'],
                1 => ['name' => 'Tools & Equipment'],
                2 => ['name' => 'Tires & Wheels'],
            ],
            'Books & Stationery' => [
                0 => ['name' => 'Fiction & Non-Fiction'],
                1 => ['name' => 'Educational Books'],
                2 => ['name' => 'Office Supplies'],
                3 => ['name' => 'Art Supplies'],
            ],
            'Pet Supplies' => [
                0 => ['name' => 'Pet Food'],
                1 => ['name' => 'Toys & Accessories'],
                2 => ['name' => 'Grooming Products'],
            ],
        ];

        foreach ($categories as $categoryName => $subCategories) {
            $category = Category::create([
                'name' => $categoryName,
                'image' => 'https://picsum.photos/id/'. rand(200, 1000).'/200/300',
                'status' => 1,
                'slug' => Str::slug($categoryName),
            ]);

            foreach ($subCategories as $subCategory)
            {
                $subCategory = SubCategory::create([
                    'category_id' => $category->id,
                    'name' =>  $subCategory['name'],
                    'image' => 'https://picsum.photos/id/'. rand(200, 1000) .'/200/300',
                    'slug' =>  Str::slug($subCategory['name']),
                    'status' => 1
                ]);

                $productImageNo = 240;

                for ($i = 1; $i <= rand(20, 25); $i++) {
                    $product = Product::create([
                        'category_id' => $category->id,
                        'sub_category_id' => $subCategory->id,
                        'name' => $subCategory->name. ' Product'. $i,
                        'selling_price' => rand(100, 2000),
                        'regular_price' => rand(100, 2000),
                        'short_description' => 'this is short product description',
                        'long_description' => Str::random(600),
                        'main_image' => "https://picsum.photos/id/". $productImageNo ."/200/300",
                        'quantity' => rand(100, 1000),
                        'slug' => Str::random(50),
                        'status' => 1,
                    ]);

                    for($j = 1; $j < 5; $j++) {
                        OtherImage::create([
                            'product_id' => $product->id,
                            'image' => "https://picsum.photos/id/". $productImageNo++ ."/200/300",
                        ]);
                    };
                    $productImageNo++;
                }
            }
        }

        User::factory(1)->create();
    }
}
