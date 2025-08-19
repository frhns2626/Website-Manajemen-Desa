<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::where('penduduk_id', Auth::user()->penduduk->id)->paginate(5);

        return view('pages.complaint.index', compact(
            'complaints',
        ));
    }

    public function create()
    {
        return view('pages.complaint.create');
    }

    public function store(Request $request) 
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3', 'max:2000'],
            'photo_proof' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $complaint = new Complaint();
        $complaint->penduduk_id = Auth::user()->penduduk->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')){
            $filePath = $request->file('photo_proof')->store('public/uploads');
            $complaint->photo_proof = $filePath;
        }

        $complaint->save();

        return redirect('/complaint')->with('success', 'Berhasil membuat aduan');
    }


    public function edit($id)
    {
        $complaint = Complaint::findOrFail($id);

        return view('pages.complaint.edit', compact('complaint'));
    }

      public function update(Request $request, $id) 
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3', 'max:2000'],
            'photo_proof' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->penduduk_id = Auth::user()->penduduk->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')){
            if (isset($complaint->photo_proof)){
                Storage::delete($complaint->photo_proof);
            }
            $filePath = $request->file('photo_proof')->store('public/uploads');
            $complaint->photo_proof = $filePath;
        }

        $complaint->save();

        return redirect('/complaint')->with('success', 'Berhasil mengubah aduan');
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();

        return redirect('/complaint')->with('success', 'Berhasil menghapus aduan');
    }
}
