<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CvBilgileri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CvController extends Controller
{
    protected function ensureAdmin()
    {
        if (!Auth::check() || Auth::user()->getAttribute('role') !== 'admin') {
            abort(403);
        }
    }

    public function index()
    {
        $this->ensureAdmin();
        $cvs = CvBilgileri::latest()->paginate(20);
        return view('admin.cvs.index', compact('cvs'));
    }

    public function edit(CvBilgileri $cv)
    {
        $this->ensureAdmin();
        return view('admin.cvs.edit', compact('cv'));
    }

    public function update(Request $request, CvBilgileri $cv)
    {
        $this->ensureAdmin();
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'required|string|max:50',
            'birth_date' => 'required|date',
            'education'  => 'required|string',
            'experience' => 'required|string',
            'skills'     => 'nullable|string',
            'about'      => 'required|string',
            'profile_pic'=> 'nullable|image|max:2048',
        ]);

        $cv->update($data);

        if ($request->hasFile('profile_pic')) {
            // Optional: clear old media
            $cv->clearMediaCollection('profile_pics');
            $cv->addMedia($request->file('profile_pic'))->toMediaCollection('profile_pics');
        }

        return redirect()->route('admin.cvs.index')->with('success','CV updated successfully');
    }

    public function destroy(CvBilgileri $cv)
    {
        $this->ensureAdmin();
        $cv->delete();
        return back()->with('success','CV deleted');
    }
}



