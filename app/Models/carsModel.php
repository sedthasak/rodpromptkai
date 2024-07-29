<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use voku\helper\ASCII;

use App\Models\brandsModel;
use App\Models\modelsModel;
use App\Models\generationsModel;
use App\Models\sub_modelsModel;
use App\Models\User;
use App\Models\Customer;
use App\Models\MyDeal;
use App\Models\contacts_backModel;
use App\Models\provincesModel;

class carsModel extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'status',
        'title',
        'feature',
        'brand_id',
        'model_id',
        'generations_id',
        'sub_models_id',
        'modelyear',
        'yearregis',
        'vehicle_code',
        'gear',
        'color',
        'price',
        'old_price',
        'province',
        'gas',
        'ev',
        'user_id',
        'customer_id',
        'mileage',
        'mappicture',
        'location',
        'clickcount',
        'viewcount',
        'seecount',
        'adddate',
        'approvedate',
        'expiredate',
        'stock',
        'type',
        'promotion_id',
        'payment',
        'detail',
        'reserve',
        'licenseplate',
        'warranty_1',
        'warranty_2',
        'warranty_3',
        'warranty_2_input',
        'category',
        'tag',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'mydeals',
        'slug',
    ];

    public function brand()
    {
        return $this->belongsTo(brandsModel::class, 'brand_id');
    }

    public function model()
    {
        return $this->belongsTo(modelsModel::class, 'model_id');
    }

    public function generation()
    {
        return $this->belongsTo(generationsModel::class, 'generations_id');
    }

    public function subModel()
    {
        return $this->belongsTo(sub_modelsModel::class, 'sub_models_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function myDeal()
    {
        return $this->hasOne(MyDeal::class, 'cars_id');
    }

    public function contacts()
    {
        return $this->hasMany(contacts_backModel::class, 'cars_id');
    }

    public function generateUniqueSlug($id)
    {
        // Get the related brand, model, and submodel names
        $brandName = $this->brand ? $this->brand->title : '';
        $modelName = $this->model ? $this->model->model : '';
        $subModelName = $this->subModel ? $this->subModel->sub_models : '';

        // Fetch the English name of the province
        $provinceModel = provincesModel::where('name_th', $this->province)->first();
        $province = $provinceModel ? $provinceModel->name_en : $this->province;

        // Create the slug base using modelyear, brand, model, submodel, province, title, customer ID, and id
        $baseSlug = trim("{$this->modelyear} {$brandName} {$modelName} {$subModelName} {$province} {$this->title} {$this->customer_id} {$id}");

        // Generate the slug from the base text
        $generatedSlug = Str::slug($baseSlug, '-');

        // Ensure uniqueness
        $originalSlug = $generatedSlug;
        $count = 1;

        while (self::where('slug', $generatedSlug)->exists()) {
            $generatedSlug = $originalSlug . '-' . $count++;
        }

        return $generatedSlug;
    }
}
