<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Modal;
use App\Models\ProductImage;
use App\Models\Range;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public function collection(Collection $rows)
    {
        $rate = Currency::first();

        foreach ($rows as $row) {
            $this->importRow($row, $rate);
        }
    }

    public function importRow($row, $rate)
    {
        $category = Category::firstOrCreate(['name' => $row['category']]);
        $brand = Brand::firstOrCreate(['name' => $row['brand']]);

        $productData = [
            'name' => $row['name'],
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'description' => $row['description'],
            'unit' => $row['unit'],
            'price' => $row['kyat_price'] ?? null,
            'yuan_price' => $row['price'] ?? null,
        ];

        $product = Product::create($productData);

        $this->attachModels($product, 'modals', explode(',', $row['model']));
        $this->attachModels($product, 'types', explode(',', $row['type']));
        $this->attachModels($product, 'ranges', explode(',', $row['range']));

        $this->createProductImage($product);
    }

    public function attachModels($product, $relation, $items)
    {
        foreach ($items as $item) {
            $model = $relation === 'modals'
                ? Modal::firstOrCreate(['name' => $item])
                : ($relation === 'types'
                    ? Type::firstOrCreate(['name' => $item])
                    : Range::firstOrCreate(['name' => $item]));

            // Check if the product doesn't already have the model attached
            if (!$product->{$relation}->contains('id', $model->id)) {
                $product->{$relation}()->attach($model->id);
            }
        }
    }

    public function createProductImage($product)
    {
        $productImage = new ProductImage([
            'path' => null,
            'product_id' => $product->id,
        ]);

        $productImage->save();
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 5000;
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
