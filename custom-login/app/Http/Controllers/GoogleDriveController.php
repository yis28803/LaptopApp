<?php

namespace App\Http\Controllers;

use App\Services\GoogleDriveService;
use Illuminate\Http\Request;

class GoogleDriveController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = $image->storeAs('uploads', $fileName);
            $googleDriveService = new GoogleDriveService();
            $fileId = $googleDriveService->uploadImage(storage_path('app/' . $filePath));
            unlink(storage_path('app/' . $filePath));
            return redirect()->route('test.index')->with('success', 'Hình ảnh đã được upload thành công lên Google Drive với link: ' . $fileId);
        }

    
        return redirect()->route('test.index')->with('error', 'Vui lòng chọn một hình ảnh.');
    }
}
