<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Laptop;
use App\Models\LaptopImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\GoogleDriveService;
use Google\Service\Dataform\DeleteFile;

class LaptopController extends Controller
{
    public function index()
    {
        $laptops = Laptop::paginate(12);
        if (Auth::id()) {
            $userType = Auth()->user()->user_type;
            if ($userType == 'admin') {
                return view('admin.laptops.laptop', compact('laptops'));
            }
        }
        return view('laptop', compact('laptops'));
    }
    public function search(Request $request)
    {   
        $keyword = $request->input('keyword');
        $laptops = Laptop::where('name', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->orWhere('price', 'like', "%$keyword%")
            ->paginate(12);

        $userType = Auth()->user()->user_type;
        if ($userType == 'admin') {
            return view('admin.laptops.laptop', compact('laptops'));
        }
        else {
            return redirect()->back();
        }
        
    }
    public function delete($id)
    {
        $laptop = Laptop::findOrFail($id);
        $laptop->delete();
        return redirect()->route('admin_laptop.index')->with('success', 'Laptop has been deleted successfully.');
    }

    public function showFormUpdate($id)
    {
        $laptop = Laptop::findOrFail($id);
        $brands = Brand::all();
        return view('admin.laptops.cru_laptops', compact('laptop', 'brands'));
    }

    public function showFormCreate()
    {
        $brands = Brand::all();
        return view('admin.laptops.cru_laptops', compact('brands'));
    }

    public function upload_images()
    {
    }
    public function create_or_update(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:350',
            'price' => 'required|numeric',
            'thumbnail' => $id ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'brightness' => 'nullable|integer',
            'ram' => 'nullable|integer',
            'rom' => 'nullable|integer',
            'processor' => 'nullable|string|max:100',
            'graphics_card' => 'nullable|string|max:100',
            'brand_id' => 'required|exists:brands,id',
            'screen' => 'nullable|string|max:255',
            'wireless' => 'nullable|string|max:255',
            'system' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'weight' => 'nullable|string',
            'battery' => 'nullable|string|max:255',
            'keyboard' => 'nullable|string|max:255',
            'bluetooth' => 'nullable|string|max:255',
            'webcam' => 'nullable|string|max:255',
            'lan' => 'nullable|string|max:255',
        ]);
        
        // Xử lý tải lên hình ảnh thumbnail nếu có
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = $image->storeAs('uploads', $fileName); 

            // Tạo một instance của service GoogleDriveService
            $googleDriveService = new GoogleDriveService();

            // Upload hình ảnh lên Google Drive
            $fileId = $googleDriveService->uploadImage(storage_path('app/' . $filePath));

            if ($id) {
                $oldLaptop = Laptop::findOrFail($id);
                $googleDriveService->deleteFile($oldLaptop->avatar_url);
                // Xóa hình ảnh cũ trong thư mục lưu trữ

            }
            unlink(storage_path('app/' . $filePath));
            // Cập nhật avatar_url mới cho laptop
            $avatarUrl = $fileId;
            $thumbnail = $fileName;
        } else {
            // Sử dụng avatar_url cũ nếu không có ảnh mới
            $avatarUrl = $id ? Laptop::findOrFail($id)->avatar_url : null;
            $thumbnail = null;
        }

        if ($id) {
            $laptop = Laptop::findOrFail($id);
        } else {
            $laptop = new Laptop;
        }

        $laptop->name = $validatedData['name'];
        $laptop->price = $validatedData['price'];
        $laptop->description = $validatedData['description'];
        $laptop->brightness = $validatedData['brightness'];
        $laptop->ram = $validatedData['ram'];
        $laptop->rom = $validatedData['rom'];
        $laptop->processor = $validatedData['processor'];
        $laptop->graphics_card = $validatedData['graphics_card'];
        $laptop->brand_id = $validatedData['brand_id'];
        $laptop->avatar_url = $avatarUrl;
        $laptop->screen = $validatedData['screen'];
        $laptop->wireless = $validatedData['wireless'];
        $laptop->system = $validatedData['system'];
        $laptop->color = $validatedData['color'];
        $laptop->weight = $validatedData['weight'];
        $laptop->battery = $validatedData['battery'];
        $laptop->keyboard = $validatedData['keyboard'];
        $laptop->bluetooth = $validatedData['bluetooth'];
        $laptop->webcam = $validatedData['webcam'];
        $laptop->lan = $validatedData['lan'];

        $laptop->save();
        if ($id) {
            return redirect()->route('admin_laptop.show_update', [
                'id' => $id,
                'success', "update success"
            ]);
        } else {
            return redirect()->route('admin_laptop.show_update', ['id' => $laptop->id]);
        }
    }

    public function update_slide_images(Request $request, $id)
    {
        // Kiểm tra nếu có các file slide_images được gửi đi từ form
        if ($request->hasFile('slide_images')) {
            // Xóa các ảnh cũ trước nếu có
            $googleDriveService = new GoogleDriveService();
            $laptop_images = LaptopImages::where('laptop_id', $id)->get();
            if ($laptop_images->isNotEmpty()) {
                foreach ($laptop_images as $image) {
                    $googleDriveService->deleteFile($image->image_url);
                    $image->delete();
                }
            }

            // Validate dữ liệu đầu vào
            $validatedData = $request->validate([
                'slide_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Xử lý tải lên và lưu trữ các ảnh mới
            foreach ($request->file('slide_images') as $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $filePath = $image->storeAs('uploads', $fileName);

                // Upload hình ảnh lên Google Drive và lấy fileId
                $fileId = $googleDriveService->uploadImage(storage_path('app/' . $filePath));

                LaptopImages::create([
                    'laptop_id' => $id,
                    'url' => $fileId,
                ]);

               
                unlink(storage_path('app/' . $filePath));
            }
        }

        return redirect()->route('admin_laptop.show_update', ['id' => $id])->with('success', 'Slide images updated successfully');
    }

    public function delete_image($id){
        $laptop_image = LaptopImages::findOrFail($id);
        $googleDriveService = new GoogleDriveService();
        $googleDriveService->deleteFile($laptop_image->image_url);
        $laptop_image->delete();
        return redirect()->back()->with('success','delete successfully'
    );
    }

    public function getById($id){
        $laptop = Laptop::findOrFail($id);
        $similar_laptops = Laptop::where('brand_id', $laptop->brand_id)
                                ->orWhere('ram',$laptop->ram)
                                ->orWhere('rom',$laptop->rom)
                                ->where('id', '!=', $id)
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();
        
        return view('laptop_details', compact('laptop', 'similar_laptops'));
    }
    

    public function UserSearch(Request $request){
        $keyword = $request->input('keyword');
        $query = Laptop::query();

        if($keyword){
            $query 
            ->where('laptops.name','like',"%$keyword%")
            ->orWhere('laptops.description','like',"%$keyword%");
        }

        if($request->has('sortBy')){
            $sortBy = $request->input('sortBy');
            $query->orderBy('laptops.'.$sortBy,'ASC');
        }

        if($request->has('orderBy')){
            $orderBy = $request->input('orderBy');
            $query->orderBy('laptops.price',$orderBy);
        }
        if($request->has('priceFrom')){
            $priceFrom = $request->input('priceFrom');
            $query->where('laptops.price','>=',$priceFrom);
        }
        if($request->has('priceTo')){
            $priceTo = $request->input('priceTo');
            $query->where('laptops.price','<=',$priceTo);
        }

        $laptops = $query->paginate(12);
        
        return view('laptop',compact('laptops'));
    }
}
