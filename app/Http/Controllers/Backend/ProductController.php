<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Currency;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Modal;
use App\Models\Range;
use App\Models\Type;

class ProductController extends Controller
{
    public $productImageArray = [];
    /**
     * product listing view
     *
     * @return void
     */
    public function listing()
    {
        $product = Product::where('price', null)->paginate(100);
        // return $product;
        return view('backend.products.index');
    }

    /**
     * Product create
     *
     * @return void
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
        $models = Modal::all();
        $types = Type::all();
        $ranges = Range::all();
        return view('backend.products.create', compact('categories', 'brands','models', 'types', 'ranges'));
    }

     /**
     * Product Store
     *
     * @param Request $request
     * @return void
     */
    public function store(StoreProductRequest $request)
    {
        $rate = Currency::first();
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->kyat_price ?? ($request->price * $rate->kyats),
            'yuan_price' => $request->price,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'description' => $request->description,
            'instock' => $request->instock,
            'unit' => $request->unit,
        ]);

        $models = Modal::whereIn('id', $request->models)->get();
        $product->modals()->syncWithoutDetaching($models);

        $types = Type::whereIn('id', $request->types)->get();
        $product->types()->syncWithoutDetaching($types);

        $ranges = Range::whereIn('id', $request->ranges)->get();
        $product->ranges()->syncWithoutDetaching($ranges);

        if ($request->hasFile('images')) {
            $this->_createProductImages($product->id, $request->file('images'));
        }

        return redirect()->route('product')->with('created', 'Product Created Successfully');
    }


    /**
     * Product detail
     *
     */
    public function detail(Product $product){
        $product->with('brand','category','images')->first();
        $data = [
            'product'=>$product,
        ];

        return view('backend.products.detail')->with($data);
    }

    /**
   * Create Review Images
   */
  private function _createProductImages($productId, $files)
  {
      foreach ($files as $image) {
          $this->productImageArray[] = [
              'product_id'      => $productId,
              'path'           => $image->store('products'),
              'created_at'     => now(),
              'updated_at'     => now(),
          ];
      }

      ProductImage::insert($this->productImageArray);
  }

    /**
     * Product edit
     *
     * @param StoreProductRequest $request
     * @param [type] $id
     * @return void
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $brands = Brand::orderBy('id', 'desc')->get();
        $models = Modal::all();
        $types = Type::all();
        $ranges = Range::all();
        // $p = $product->with('modals','types','ranges')->get();
        // return $p;
        return view('backend.products.edit', compact('product', 'categories', 'brands','models','types','ranges'));
    }

    /**
     * Update Product
     *
     * @param [type] $id
     * @param StoreProductRequest $request
     * @return void
     */
    public function update(Product $product, UpdateProductRequest $request)
    {
        if (empty($request->old) && empty($request->images)) {
            return redirect()->back()->with('fail', 'Product Image is required');
        }
        $rate = Currency::first();
        DB::beginTransaction();
        try {
            $product->name = $request->name;
            // if($request->kyat_price){
            //     $product->price = $request->kyat_price;
            // }else{
            //     $product->price = $request->price * $rate->kyats;
            // }
            $product->price = $request->kyat_price;
            $product->yuan_price = $request->price;

            $product->category_id = $request->category_id ?? null;
            $product->brand_id = $request->brand_id ?? null;

            $product->english_colors = $request->english_colors ?? [];

            $product->description = $request->description;
            $product->instock = $request->instock;
            $product->unit = $request->unit;

            $models = Modal::whereIn('id', $request->models)->get();
            $product->modals()->syncWithoutDetaching($models);

            $types = Type::whereIn('id', $request->types)->get();
            $product->types()->syncWithoutDetaching($types);

            $ranges = Range::whereIn('id', $request->ranges)->get();
            $product->ranges()->syncWithoutDetaching($ranges);

            $product->update();

            // old image file delete
            if ($request->has('old')) {
                $files = $product->images()->whereNotIn('id', $request->old)->get();## oldimg where not in request old
                if (count($files) > 0) { ## delete oldimg where not in request old
                    foreach ($files as $file) {
                        $oldPath = $file->getRawOriginal('path') ?? '';
                        Storage::delete($oldPath);
                    }

                    $product->images()->whereNotIn('id', $request->old)->delete();
                }
            }

            if ($request->hasFile('images')) {
                $this->_createProductImages($product->id, $request->file('images'));
            }

            DB::commit();
            return redirect()->route('product')->with('updated', 'Product Updated Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

     /**
     * Product destroy
     *
     * @param [type] $id
     * @return void
     */
    public function destroy(Product $product)
    {
        // $product->update(['status'=> '0']);
        $product->delete();
        return 'success';
    }

    public function deleteAll()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return 'success';
    }

    public function serverSide()
    {
        $product = Product::with(['brand', 'category', 'image', 'modals', 'types', 'ranges'])
            ->active()
            ->orderBy('id', 'desc');
        return datatables($product)
            ->addColumn('image', function ($each) {
                $image = $each->image;
                return "<img src='{$image->path}' class='thumbnail_img'/>";
            })
            ->addColumn('category', function ($each) {
                return $each->category->name ?? '---';
            })
            ->addColumn('brand', function ($each) {
                return $each->brand->name ?? '---';
            })
            ->addColumn('modals', function ($each) {
                $modals = $each->modals->pluck('name')->toArray();
                return count($modals) > 0 ? implode(', ', $modals) : '---';
            })
            ->addColumn('types', function ($each) {
                $types = $each->types->pluck('name')->toArray();
                return count($types) > 0 ? implode(', ', $types) : '---';
            })
            ->addColumn('ranges', function ($each) {
                $ranges = $each->ranges->pluck('name')->toArray();
                return count($ranges) > 0 ? implode(', ', $ranges) : '---';
            })
            ->editColumn('price', function ($each) {
                $rate = Currency::first();
                if ($each->price) {
                    return number_format(floatval($each->price), 4, '.', '') . ' MMK';
                }
                return number_format(floatval($each->yuan_price*$rate->kyats), 4, '.', '') . ' MMK';

            })
            ->editColumn('yuan_price', function ($each) {
                $rate = Currency::first();
                if($each->yuan_price){
                    return number_format(floatval($each->yuan_price), 4, '.', '') . ' Yuan';
                }
                return number_format(floatval($each->price/$rate->kyats), 4, '.', '') . ' Yuan';

            })
            ->editColumn('instock', function ($each) {
                $instock = $each->instock == 1 ? 'instock' : 'out of stock';
                $class = $each->instock == 1 ? 'badge-soft-success' : 'badge-soft-danger';
                return "<div class='badge $class'>$instock</div>";
            })
            ->addColumn('action', function ($each) {
                $show_icon = "<a href='" . route('product.detail', $each->id) . "' class='detail_btn btn btn-sm btn-info'><i class='ri-eye-fill btn_icon_size'></i></a>";
                $edit_icon = "<a href='" . route('product.edit', $each->id) . "' class='btn btn-sm btn-success edit_btn'><i class='mdi mdi-square-edit-outline btn_icon_size'></i></a>";
                $delete_icon = "<a href='#' class='btn btn-sm btn-danger delete_btn' data-id='{$each->id}'><i class='mdi mdi-trash-can-outline btn_icon_size'></i></a>";
                return "<div class='action_icon d-flex gap-3'>$show_icon$edit_icon$delete_icon</div>";
            })
            ->rawColumns(['category', 'instock', 'brand', 'action', 'image'])
            ->toJson();
    }


    /**
     * Product images
     *
     * @return void
     */
    public function images(Product $product)
    {
        $oldImages = [];
        foreach ($product->images as $img) {
            $oldImages[] = [
            'id'  => $img->id,
            'src' => $img->path,
          ];
        }

        return response()->json($oldImages);
    }

    public function importView()
    {
        return view('backend.products.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new ProductImport, $request->file('file'));

        return to_route('product')->with('created', 'Product data imported Successfully');
    }
}
