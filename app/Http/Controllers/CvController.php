<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CvBilgileri;
use Illuminate\Http\Request;
use App\Mail\CvCreatedMail;
use Illuminate\Support\Facades\Mail;

class CvController extends Controller
{
    public function store(Request $request)
    {
        // Validasyon
        $request->validate([
            'about'       => 'required|string',
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

        // 2️⃣ Send mail
        try {
            Mail::to('emirkanergoz1@gmail.com')
            ->send(new CvCreatedMail($cv));
        } catch (\Exception $e) {
            \Log::error('CV mail could not be sent: '.$e->getMessage());
        }

        // 3️⃣ Redirect
        return redirect()->route('cv.show', ['id' => $cv->id])
            ->with('success', '✅ Save Successful! CV ID: '.$cv->id);
    }

    public function show($id)
    {
        $cv = CvBilgileri::findOrFail($id);
        return view('cv-show', compact('cv'));
    }

    public function downloadPdf($id)
    {
        $cv = CvBilgileri::findOrFail($id);
        $pdf = Pdf::loadView('cv.pdf', compact("cv"));
        return $pdf->download($cv->first_name . '_' . $cv->last_name . '.pdf');
    }
}
