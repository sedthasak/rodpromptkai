<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;



use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Input;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image;

use App\DataTables\newsModelDataTable;
use App\Models\newsModel;
use App\Models\User;

class NewsController extends Controller
{
    public function BN_news_add(Request $request)
    {
        return view('backend/news-add', [ 
            'default_pagename' => 'เพิ่มข่าวใหม่',
        ]);
    }
    public function BN_news_add_action(Request $request)
    {
        // Validate the request
        $request->validate([
            'slug' => ['required', 'regex:/[a-zA-Z]/'], // Ensure slug contains at least one English alphabet letter
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'feature' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ], [
            'slug.regex' => 'The slug must contain at least one English alphabet letter.',
        ]);
    
        $news = new newsModel;
        $news->user_id = $request->user_id;
        $news->title = $request->title;
        $news->excerpt = $request->excerpt;
        $news->content = $request->content;
    
        // Set the meta fields
        $news->meta_title = $request->meta_title;
        $news->meta_keyword = $request->meta_keyword;
        $news->meta_description = $request->meta_description;
    
        // Generate or set the slug
        if ($request->filled('slug')) {
            $news->slug = $news->generateUniqueSlugFromRequest($request->slug);
        } else {
            $news->slug = $news->generateUniqueSlug();
        }
    
        // Process and save the featured image
        if ($request->hasFile('feature')) {
            $uploadedFile = $request->file('feature');
            $destinationPath = public_path('/uploads/news-feature');
            $filename = $uploadedFile->getClientOriginalName();
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
            // Generate unique filename
            $newFileName = 'feature-' . time() . '-' . uniqid() . '.' . $ext;
    
            // Move the uploaded file to the destination path
            $uploadedFile->move($destinationPath, $newFileName);
    
            // Check if the file is JPEG or PNG to convert to WebP
            if (in_array($ext, ['jpeg', 'jpg', 'png'])) {
                // Convert to WebP format using Intervention Image
                $webpFileName = 'feature-' . time() . '-' . uniqid() . '.webp';
                $webpPath = $destinationPath . '/' . $webpFileName;
    
                // Open original image using Intervention Image
                $image = Image::make($destinationPath . '/' . $newFileName);
    
                // Save image as WebP
                $image->encode('webp')->save($webpPath);
    
                // Optionally delete the original uploaded image
                // unlink($destinationPath . '/' . $newFileName);
    
                // Store the WebP file path in the database
                $news->feature = 'uploads/news-feature/' . $webpFileName;
            } else {
                // Fallback to storing the original image path if not JPEG or PNG
                $news->feature = 'uploads/news-feature/' . $newFileName;
            }
        }
    
        $news->save();
    
        return redirect(route('BN_news'))->with('success', 'สร้างสำเร็จ !!!');
    }
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|mimes:jpeg,jpg,png,gif|max:2048', // Adjust file types and size as needed
        ]);
    
        if ($request->file('upload')->isValid()) {
            $file = $request->file('upload');
            $filename = time() . '-' . uniqid() . '.webp'; // Use WebP format
            $path = public_path('/uploads/ckeditor/');
            
            // Create the folder if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
    
            // Use Intervention Image to resize and convert image to WebP
            $image = Image::make($file);
            $image->encode('webp', 90)->save($path . $filename);
    
            // Return the image URL
            return response()->json([
                'uploaded' => true,
                'url' => asset('uploads/ckeditor/' . $filename),
            ]);
        }
    
        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'File upload failed.',
            ],
        ]);
    }
    
    

    public function BN_news_edit(Request $request, $id)
    {
        $mynews = newsModel::find($id);
        return view('backend/news-edit', [ 
            'default_pagename' => 'แก้ไขข่าว',
            'mynews' => $mynews,
        ]);
    }
    public function BN_news_edit_action(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'feature' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);
    
        // Find the news item by ID
        $news = newsModel::find($request->news_id);
    
        // Handle the feature image upload
        if ($request->hasFile('feature')) {
            // Delete the old feature image if it exists
            if (isset($news->feature)) {
                $oldPath = public_path($news->feature);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
    
            // Upload the new feature image
            $file = $request->file('feature');
            $destinationPath = public_path('/uploads/news-feature');
            $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
    
            // Check if the file is JPEG or PNG to convert to WebP
            if (in_array($file->getClientOriginalExtension(), ['jpeg', 'jpg', 'png'])) {
                // Convert to WebP format using Intervention Image
                $webpFileName = time() . '-' . uniqid() . '.webp';
                $webpPath = $destinationPath . '/' . $webpFileName;
    
                // Open original image using Intervention Image
                $image = Image::make($destinationPath . '/' . $filename);
    
                // Save image as WebP
                $image->encode('webp')->save($webpPath);
    
                // Optionally delete the original uploaded image
                // unlink($destinationPath . '/' . $filename);
    
                // Store the WebP file path in the database
                $news->feature = 'uploads/news-feature/' . $webpFileName;
            } else {
                // Fallback to storing the original image path if not JPEG or PNG
                $news->feature = 'uploads/news-feature/' . $filename;
            }
        }
    
        // Update the news fields
        $news->user_id = $request->user_id;
        $news->title = $request->title;
        $news->excerpt = $request->excerpt;
        $news->content = $request->content;
    
        // Update meta fields
        $news->meta_title = $request->meta_title;
        $news->meta_keyword = $request->meta_keyword;
        $news->meta_description = $request->meta_description;
    
        // Save the updated news item
        $news->update();
    
        return redirect()->back()->with('success', 'แก้ไขสำเร็จ !!!');
    }
    
    
    
    










    
    

    







    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'feature' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Handle the image upload
        if ($request->hasFile('feature')) {
            $fileName = time().'.'.$request->feature->extension();  
            $request->feature->move(public_path('uploads'), $fileName);
        }

        // Save the news post
        $news = new newsModel();
        $news->title = $request->input('title');
        $news->feature = $fileName;
        $news->excerpt = $request->input('excerpt');
        $news->content = $request->input('content');
        $news->user_id = $request->input('user_id');
        $news->save();

        return redirect()->route('BN_news')->with('success', 'News created successfully');
    }

    public function BN_news(Request $request)
    {
        // $news = newsModel::query()
        // ->orderBy('id', 'desc')
        // ->paginate(12);

        $query = newsModel::query()
            ->orderBy('id', 'desc');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('excerpt', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('content', 'LIKE', '%' . $keyword . '%');
            });
        }

        $resultPerPage = 12;
        $query = $query->paginate($resultPerPage);

        return view('backend/news', [ 
            'default_pagename' => 'ข่าวรถยนต์',
            'query' => $query,
        ]);
    }
    public function BN_news_delete($id)
    {
        $news = newsModel::findOrFail($id);
        
        // Optionally, delete the associated image
        if ($news->feature && file_exists(public_path($news->feature))) {
            unlink(public_path($news->feature));
        }

        $news->delete();

        return redirect()->route('BN_news')->with('success', 'News item deleted successfully.');
    }




    public function index(newsModelDataTable $dataTable)
    {
        return $dataTable->render('backend.news');
        // return Datatables::of(Customer::query())->make(true);
        // $data["data"] = "hello world";
        // return response(json_encode($data));
    }
    
    

















    public function BN_newsFetch()
    {
        $query = newsModel::all()->sort();
        $output = '';
        if($query->count() > 0){
            ?>
                <div class="grid gap-6 mt-5 p-5 box">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="">
                                <tr class="">
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">#</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">ชื่อ</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">คำอธิบาย</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">รูปภาพ</td>
                                    <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">*</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach($query as $key => $res){
                                $count++;
                                ?>
                                <tr class="">
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $count ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->name ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><?php echo $res->description ?></td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap">
                                        <img width="150" src="<?php echo url($res->feature) ?>" />
                                    </td>
                                    <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"><a href="<?php echo route('BN_categories_edit', ['id' => $res->id]); ?>">แก้ไข</a></td>
                                </tr>
                                <?php
                                }
                                ?>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
        }else{
            echo "Not Found!!!";
        }
    }
    

    
    public function BN_news_store(Request $request, newsModelDataTable $dataTable): RedirectResponse
    {
        $validated = $request->validate([
            'title'     => 'required',
            'feature'   => 'required',
            'excerpt'   => 'required',
            'content'   => 'required',
        ]);
        // return dd($request);

        $filepath = null;
        if($request->hasFile('feature')){
            $file = $request->file('feature');
            $destinationPath = public_path('/uploads');
            $filename = $file->getClientOriginalName();

            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $newfilenam = time() . '.' .$ext;
            $file->move($destinationPath, $newfilenam);
            $filepath = 'uploads/'.$newfilenam;
        }

        $news_store = [
            "title"     => $request->title,
            "feature"   => $filepath,
            "excerpt"   => $request->excerpt,
            "content"   => $request->content
        ];
        newsModel::create($news_store);

        return redirect($this->index($dataTable));
    }
    public function BN_news_ajaxlist(Request $request) {
        $data = [];
        return redirect(json_encode($data));
    }
}
