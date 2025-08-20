<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\User;
use App\Notifications\ComplaintStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    public function index()
    {
        $pendudukId = Auth::user()->penduduk->id ?? null;

        $complaints = Complaint::when(Auth::user()->role_id == \App\Models\Role::ROLE_USER, function ($query) use ($pendudukId) {
            $query->where('penduduk_id', $pendudukId);
        })->paginate(5);

        return view('pages.complaint.index', compact(
            'complaints',
        ));
    }

    public function create()
    {
        $penduduk = Auth::user()->penduduk;
        if (!$penduduk) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk manapun');
        }
        return view('pages.complaint.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'content' => ['required', 'min:3', 'max:2000'],
            'photo_proof' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $penduduk = Auth::user()->penduduk;
        if (!$penduduk) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk manapun');
        }

        $complaint = new Complaint();
        $complaint->penduduk_id = $penduduk->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')) {
            $filePath = $request->file('photo_proof')->store('public/uploads');
            $complaint->photo_proof = $filePath;
        }

        $complaint->save();

        return redirect('/complaint')->with('success', 'Berhasil membuat aduan');
    }


    public function edit($id)
    {
        $penduduk = Auth::user()->penduduk;
        if (!$penduduk) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk manapun');
        }

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

        $penduduk = Auth::user()->penduduk;
        if (!$penduduk) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk manapun');
        }

        $complaint = Complaint::findOrFail($id);

        if ($complaint->status != 'new') {
            return redirect('/complaint')->with('error', "Gagal mengubah aduan, status aduan anda saat ini adalah $complaint->status_label");
        }

        $complaint->penduduk_id = $penduduk->id;
        $complaint->title = $request->input('title');
        $complaint->content = $request->input('content');

        if ($request->hasFile('photo_proof')) {
            if (isset($complaint->photo_proof)) {
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
        $penduduk = Auth::user()->penduduk;
        if (!$penduduk) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk manapun');
        }

        $complaint = Complaint::findOrFail($id);

        if ($complaint->status != 'new') {
            return redirect('/complaint')->with('error', "Gagal hapus aduan, status aduan anda saat ini adalah $complaint->status_label");
        }

        $complaint->delete();

        return redirect('/complaint')->with('success', 'Berhasil menghapus aduan');
    }


    public function update_status(Request $request, $id)
    {
        $request->validate([
            'status' => ['required', Rule::in('new', 'processing', 'completed')],
        ]);

        $penduduk = Auth::user()->penduduk;
        if (Auth::user()->role_id == \App\Models\Role::ROLE_USER && !$penduduk) {
            return redirect('/complaint')->with('error', 'Akun anda belum terhubung dengan data penduduk manapun');
        }

        $complaint = Complaint::findOrFail($id);
        $oldStatus = $complaint->status_label;
        
        
        $complaint->status = $request->input('status');
        $complaint->save();

        $newStatus = $complaint->status_label;

        User::where('id', $complaint->penduduk->user_id)
            ->firstOrFail()
            ->notify(new ComplaintStatusChanged($complaint, $oldStatus, $newStatus));

        return redirect('/complaint')->with('success', 'Berhasil mengubah status');
    }
}
