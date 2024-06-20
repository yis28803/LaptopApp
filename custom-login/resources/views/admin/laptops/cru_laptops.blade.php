@extends('admin.admin')
@section('title', isset($laptop) ? 'Update Laptop' : 'Create laptop')
@section('content')
<div class="container mx-auto p-5">
    <h1 class="text-2xl font-bold mb-4">Complete the form below to {{ isset($laptop) ? 'update' : 'create' }} a laptop</h1>
    <form action="{{ isset($laptop) ? route('admin_laptop.update', $laptop->id) : route('admin_laptop.create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->name : '' }}">
        </div>
        <div class="mb-4">
            <label for="price" class="block font-semibold mb-1">Price</label>
            <input type="number" name="price" id="price" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->price : '' }}">
        </div>
        <div class="mb-4">
            <label for="avatar" class="block font-semibold mb-1">Thumbnail</label>
            @if(isset($laptop))
                <img src="{{ $laptop->avatar_url }}" alt="Thumbnail" class="w-40 h-auto mb-2">
                {{-- <img src="https://drive.google.com/thumbnail?id=0B6wwyazyzml-OGQ3VUo0Z2thdmc&sz=w1000" alt="Thumbnail" class="w-40 h-auto mb-2"> --}}
                
            @endif
            <input type="file" name="thumbnail" id="thumbnail" class="w-full border-gray-300 rounded-md px-3 py-2">
        </div>
        
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Description</label>
            <textarea name="description" id="description" rows="5" class="w-full border-gray-300 rounded-md px-3 py-2" required>{{ isset($laptop) ? $laptop->description : '' }}</textarea>
        </div>
        <div class="mb-4">
            <label for="brightness" class="block font-semibold mb-1">Brightness (nits)</label>
            <input type="number" name="brightness" id="brightness" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->brightness : '' }}">
        </div>
        <div class="mb-4">
            <label for="ram" class="block font-semibold mb-1">RAM (GB)</label>
            <input type="number" name="ram" id="ram" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->ram : '' }}">
        </div>
        <div class="mb-4">
            <label for="rom" class="block font-semibold mb-1">ROM (GB)</label>
            <input type="number" name="rom" id="rom" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->rom : '' }}">
        </div>
        <div class="mb-4">
            <label for="screen" class="block font-semibold mb-1">Screen size (inches)</label>
            <input type="text" name="screen" id="screen" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->screen : '' }}">
        </div>
        <div class="mb-4">
            <label for="wireless" class="block font-semibold mb-1">Wireless</label>
            <input type="text" name="wireless" id="wireless" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->wireless : '' }}">
        </div>
        <div class="mb-4">
            <label for="system" class="block font-semibold mb-1">Operating System</label>
            <input type="text" name="system" id="system" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->system : '' }}">
        </div>
        <div class="mb-4">
            <label for="color" class="block font-semibold mb-1">Color</label>
            <input type="text" name="color" id="color" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->color : '' }}">
        </div>
        <div class="mb-4">
            <label for="keyboard" class="block font-semibold mb-1">Keyboard</label>
            <input type="text" name="keyboard" id="keyboard" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->color : '' }}">
        </div>
        <div class="mb-4">
            <label for="battery" class="block font-semibold mb-1">Battery</label>
            <input type="text" name="battery" id="battery" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->battery : '' }}">
        </div>
        <div class="mb-4">
            <label for="bluetooth" class="block font-semibold mb-1">Bluetooth</label>
            <input type="text" name="bluetooth" id="bluetooth" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->bluetooth : '' }}">
        </div>
        <div class="mb-4">
            <label for="webcam" class="block font-semibold mb-1">Webcam</label>
            <input type="text" name="webcam" id="webcam" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->webcam : '' }}">
        </div>
        <div class="mb-4">
            <label for="lan" class="block font-semibold mb-1">LAN</label>
            <input type="text" name="lan" id="lan" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->lan : '' }}">
        </div>
        <div class="mb-4">
            <label for="weight" class="block font-semibold mb-1">Weight</label>
            <input type="text" name="weight" id="weight" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->weight : '' }}">
        </div>
        <div class="mb-4">
            <label for="processor" class="block font-semibold mb-1">Processor</label>
            <input type="text" name="processor" id="processor" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->processor : '' }}">
        </div>
        <div class="mb-4">
            <label for="graphics_card" class="block font-semibold mb-1">Graphics Card</label>
            <input type="text" name="graphics_card" id="graphics_card" class="w-full border-gray-300 rounded-md px-3 py-2" required value="{{ isset($laptop) ? $laptop->graphics_card : '' }}">
        </div>
        <div class="mb-4">
            <label for="brand_id" class="block font-semibold mb-1">Brand</label>
            <select name="brand_id" id="brand_id" class="w-full border-gray-300 rounded-md px-3 py-2">
                <option value="">-- Select Brand --</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" {{ isset($laptop) && $laptop->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-end">
            <x-primary-button>
                {{ isset($laptop) ? __('UPDATE') : __('CREATE') }}
            </x-primary-button>
           <x-warning-button class="ms-3">
            {{ __('RESET') }}
           </x-warning-button>
        </div>
    </form>
<hr class='text-gray-300 text-center font-weight-bold mt-5 mb-3'>
@if (isset($laptop))
    
      <!-- Hiển thị các hình ảnh cũ -->
      @if(isset($laptop->images) && count($laptop->images) > 0)
      <div>
          <h3 class="text-lg font-semibold mb-4">Slide Images:</h3>
          <div class="flex justify-between">
              @foreach($laptop->images as $image)
                  <div class="relative overflow-hidden group">
                      <img src="{{ $image->url }}" alt="" class="object-cover rounded-lg border border-gray-600 transition duration-300 transform group-hover:scale-105">
                     <form action="{{ route('admin_laptop.delete_slide_images',$image->id) }}" method="POST" >
                      
                      @csrf
                      @method('DELETE')
                      <x-icon-button class="">
                          {{ __('X') }}
                       </x-icon-button>
                       
                     </form>
                    
                  </div>
              @endforeach
          </div>
      </div>
      @endif
      
          
      
      <!-- Hiển thị form cho phép người dùng chọn và tải lên các hình ảnh mới -->
      <div>
      <h3>Upload New Slide Images:</h3>
      <form action="{{ route('admin_laptop.update_slide_images', $laptop->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="slide_images">Select Images:</label>
              <input type="file" class="form-control" name="slide_images[]" id="slide_images" multiple required>
          </div>
          <div class="flex justify-end">
              <x-primary-button>
                  {{ __('Uploads') }}
              </x-primary-button>
              <x-warning-button class="ms-3">
                  {{ __('RESET') }}
                 </x-warning-button>
          </div>
         
      </form>
      </div>
@endif
  


</div>



@endsection
