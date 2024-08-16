<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\carsModel;
use App\Models\brandsModel;
use App\Models\modelsModel;
use App\Models\generationsModel;
use App\Models\sub_modelsModel;
use App\Models\Province;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CarsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Debugging information
        $this->command->info('Starting the CarsTableSeeder...');

        // Define the color options
        $colors = [
            'white', 'green', 'cream', 'pink', 'black', 'red', 'gray', 
            'blue', 'brown', 'silver', 'gold', 'skyblue', 'purple', 
            'orange', 'yellow'
        ];

        // Define the gas options
        $gasOptions = [
            'รถน้ำมัน / hybrid', 'รถไฟฟ้า EV 100%', 'รถติดแก๊ส'
        ];

        // Define the feature image options
        // $featureOptions = [
        //     'uploads/exterior/66/exterior-66-1-66a88f0124736.webp',
        //     'uploads/exterior/68/exterior-68-1-66a895a49f8ff.webp',
        //     'uploads/exterior/70/exterior-70-1-66aaf5477ee03.webp',
        //     'uploads/exterior/67/exterior-67-1-66a88f6483499.webp',
        //     'uploads/exterior/69/exterior-69-1-66aaf5b33ce2e.webp',
        //     'uploads/exterior/71/exterior-71-1-66a897418ad9f.webp',
        //     'uploads/exterior/72/exterior-72-1-66a897e89e70e.webp',
        //     'uploads/exterior/74/exterior-74-1-66aafd6e386ba.webp',
        //     'uploads/exterior/75/exterior-75-1-66b1897bc72b1.webp'
        // ];
        $featureOptions = [
            'uploads/exterior/44/exterior-44-1-66aaf4aa01db3.webp',
            'uploads/exterior/46/exterior-46-1-66aaf489d4037.webp',
            'uploads/exterior/47/exterior-47-1-66aaf4699108b.webp',
            'uploads/exterior/48/exterior-48-1-66aaf44847a70.webp',
            'uploads/exterior/49/exterior-49-1-66aaf42cad23d.webp',
            'uploads/exterior/50/exterior-50-1-66aaf4107fac1.webp',
            'uploads/exterior/51/exterior-51-1-66aaf3f46030a.webp',
            'uploads/exterior/52/exterior-52-1-66aaf3cc7d3d7.webp',
        ];

        // Get the current year
        $currentYear = Carbon::now()->year;

        for ($i = 0; $i < 300; $i++) {
            // Log the current record being seeded
            $this->command->info('Seeding record: ' . ($i + 1));

            // Create or fetch a random brand from the first 20 brand IDs
            $brand = brandsModel::whereIn('id', range(1, 12))->inRandomOrder()->first();

            // Create or fetch a random model for the brand
            $model = modelsModel::where('brand_id', $brand->id)->inRandomOrder()->first();

            // Create or fetch a random generation for the model
            $generation = generationsModel::where('models_id', $model->id)->inRandomOrder()->first();

            // Check if generation is found
            if (!$generation) {
                $this->command->info('No generation found for model_id: ' . $model->id);
                continue; // Skip this iteration if no generation found
            }

            // Create or fetch a random sub_model for the generation
            $sub_model = sub_modelsModel::where('generations_id', $generation->id)->inRandomOrder()->first();

            // Check if sub_model is found
            if (!$sub_model) {
                $this->command->info('No sub_model found for generation_id: ' . $generation->id);
                continue; // Skip this iteration if no sub_model found
            }

            // Fetch a random province name in Thai
            $province = Province::inRandomOrder()->first()->name_th;

            // Set status with 5% 'created' and 95% 'approved'
            $status = $faker->boolean(5) ? 'created' : 'approved';

            // Set customer_id with 85% '22' and 20% other
            $customer_id = $faker->boolean(85) ? 22 : $faker->numberBetween(1, 50);

            // Set type with 95% 'dealer' and 5% 'home'
            $type = $faker->boolean(95) ? 'dealer' : 'home';

            // Set the modelyear as a random year between 2010 and the current year
            $modelyear = $faker->numberBetween(2018, $currentYear);

            // Choose a random color from the specified options
            $color = $faker->randomElement($colors);

            // Set price between 300000 and 20000000
            $price = $faker->numberBetween(300000, 20000000);

            // Get the ev type from the model
            $ev = $model->evtype;

            // Choose a random gas type from the specified options
            $gas = $faker->randomElement($gasOptions);

            // Choose a random feature image from the specified options
            $feature = $faker->randomElement($featureOptions);

            // Generate random timestamps for adddate, approvedate, and expiredate
            $adddate = Carbon::createFromTimestamp($faker->dateTimeThisDecade->getTimestamp());
            $approvedate = $adddate->copy()->addDay();
            $expiredate = $adddate->copy()->addMonths(3);

            // Set licenseplate based on type
            $licenseplate = $type === 'dealer' ? null : 'uploads/registration/67/registration-67-1-66a88f64ac33f.webp';

            // Set a random category array with 1 to 5 elements
            $category = json_encode($faker->randomElements([1, 2, 3, 4, 5], $faker->numberBetween(1, 5)));

            // Generate the slug using the model's generateUniqueSlug function
            $car = new carsModel([
                'status' => $status,
                'title' => $faker->sentence,
                'feature' => $feature,
                'brand_id' => $brand->id,
                'model_id' => $model->id,
                'generations_id' => $generation->id,
                'sub_models_id' => $sub_model->id,
                'modelyear' => $modelyear,
                'yearregis' => $faker->year,
                'vehicle_code' => $faker->bothify('??###'),
                'gear' => $faker->randomElement(['auto', 'manual']),
                'color' => $color,
                'price' => $price,
                'old_price' => $faker->numberBetween(500000, 20000000),
                'province' => $province,
                'gas' => $gas,
                'ev' => $ev,
                'user_id' => null, // user_id empty
                'customer_id' => $customer_id,
                'mileage' => $faker->numberBetween(10000, 100000),
                'mappicture' => $faker->imageUrl(),
                'location' => $faker->address,
                'clickcount' => $faker->numberBetween(1, 100),
                'viewcount' => $faker->numberBetween(1, 100),
                'seecount' => $faker->numberBetween(1, 100),
                'adddate' => $adddate->timestamp,
                'approvedate' => $approvedate->timestamp,
                'expiredate' => $expiredate->timestamp,
                'stock' => null, // stock null
                'type' => $type,
                'promotion_id' => null, // promotion_id null
                'payment' => null, // payment null
                'detail' => $faker->paragraph,
                'reserve' => null, // reserve null
                'licenseplate' => $licenseplate,
                'warranty_1' => $faker->boolean,
                'warranty_2' => $faker->boolean,
                'warranty_3' => $faker->boolean,
                'warranty_2_input' => $faker->word,
                'category' => $category,
                'tag' => $faker->word,
                'meta_title' => $faker->sentence,
                'meta_description' => $faker->paragraph,
                'meta_keyword' => $faker->words(3, true),
                'mydeals' => null, // mydeals null
                'slug' => null, // Slug will be generated later
            ]);

            // Generate the slug after the car is created
            $car->slug = $car->generateUniqueSlug($car->id);
            $car->save();
        }

        // Log after finishing the seeding process
        $this->command->info('Finished seeding CarsTableSeeder.');
    }
}
