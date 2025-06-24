<?php

namespace Database\Seeders;

use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\OtherImage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\Log;

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
           $category = Category::create(['name' => $categoryName]);

           foreach ($subCategories as $subCategory)
           {
              $subCategory = SubCategory::create([
                  'category_id' => $category->id,
                  'name' =>  $subCategory['name'],
              ]);

              $productImageNo = 240;

              for ($i = 1; $i <= rand(5, 10); $i++) {
                 $product = Product::create([
                      'category_id' => $category->id,
                      'sub_category_id' => $subCategory->id,
                      'name' => $subCategory->name. ' Product'. $i,
                      'selling_price' => rand(100, 2000),
                      'regular_price' => rand(100, 2000),
                      'short_description' => 'this is short product description',
                      'long_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt dolorem dolorum enim est eum minus quo repudiandae similique. Dolor dolores earum eum tempora vel. Accusamus animi dolorem excepturi iusto molestias natus nostrum porro quisquam. Commodi consectetur consequatur culpa delectus dolorem doloribus eligendi harum hic iste, iure laborum molestiae obcaecati odit provident repellat soluta, tenetur? Alias atque consectetur corporis culpa cupiditate dicta earum enim ex explicabo facilis fugiat, in magni maxime minus numquam omnis optio possimus quia quidem recusandae reiciendis repellendus sapiente similique soluta temporibus ut vitae! Culpa dignissimos doloremque error fugit illum laudantium numquam rem repudiandae totam velit, voluptatem voluptatibus?',
                      'main_image' => "https://picsum.photos/id/". $productImageNo ."/200/300",
                      'quantity' => rand(100, 1000)
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
