<?php

namespace App\Http\Controllers;

use App\Models\CvBilgileri;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function store(Request $request)
    {
        // Validasyon
        $request->validate([
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email',
            'phone'      => 'required',
            'birth_date' => 'required|date',
            'education'  => 'required|string',
            'experience' => 'required|string',
            'skills'     => 'nullable|string',
            'about'      => 'required|string',
            'profile_pic' => 'required|image|max:2048',
        ]);

        // Model kullanarak kaydet
        $cv = CvBilgileri::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'birth_date' => $request->birth_date,
            'education'  => $request->education,
            'experience' => $request->experience,
            'skills'     => $request->skills,
            'about'      => $request->about,
        ]);

        // Fotoğraf ekleme
        if($request->hasFile('profile_pic')){
            $cv->addMedia($request->file('profile_pic'))
                ->toMediaCollection('profile_pics');
        }



        return redirect()->route('cv.show', ['id' => $cv->id])->with('success', '✅ Save Successful! CV ID: '.$cv->id);
    }

    public function show($id)
    {
        $cv = CvBilgileri::findOrFail($id);
        return view('cv-show', compact('cv'));
    }
}
