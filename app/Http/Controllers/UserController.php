<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function account_request_view()
    {
        $users = User::where('status', 'submitted')->get();
        $penduduks = Penduduk::where('user_id', null)->get();
        return view('pages.permintaan-akun.index', [
            'users' => $users,
            'penduduks' => $penduduks,
        ]);
    }
    public function account_approval(Request $request, $userId)
    {
        $request->validate([
            'for' => ['required', Rule::in(['approve', 'reject', 'activate', 'deactivate'])],
            'penduduk_id' => ['nullable', 'exists:penduduks,id']
        ]);

        $for = $request->input('for');

        $user = User::findOrFail($userId);
        $user->status = ($for == 'approve' || $for == 'activate') ? 'approved' : 'rejected';
        $user->save();

        $pendudukId = $request->input('penduduk_id');

        if ($request->has('penduduk_id') && isset($pendudukId)) {
            Penduduk::where('id', $pendudukId)->update([
                'user_id' => $user->id,
            ]);
        }

        // if (in_array($for, ['activate', 'deactivate'])) {
        //     return back()->with('success', $for == 'activate' ? 'Berhasil Aktifkan Akun' : 'Berhasil Menonaktifkan Akun');
        // }
        if ($for == 'activate') {
            return back()->with('success', 'Berhasil Aktifkan Akun');
        } else if ($for =='deactivate') {
            return back()->with('success', 'Berhasil Menonaktifkan Akun');
        }

        return back()->with('success', $for == 'approve' ? 'Berhasil Menyetujui Akun' : 'Berhasil Menolak Akun');
    }

    public function account_list_view()
    {
        $users = User::where('role_id', 2)->where('status', '!=', 'submitted')->get();

        return view('pages.daftar-akun.index', [
            'users' => $users,
        ]);
    }

    public function profile_view()
    {
        return view('pages.profile.index');
    }

    public function update_profile(Request $request, $userId)
    {
        $request->validate([
            'name' => 'required|min:3',
        ]);

        $user = User::findOrFail($userId);
        $user->name = $request->input('name');
        $user->save();

        return back()->with('success', 'Berhasil Mengubah Data');
    }

    public function changePassword_view()
    {
        return view('pages.profile.changePassword');
    }
    public function changePassword(Request $request, $userId)
    {
        $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
        ]);

        $user = User::findOrFail($userId);

        $currentpasswordIsValid = Hash::check($request->input('old_password'), $user->password);

        if ($currentpasswordIsValid) {
            $user->password = $request->input('new_password');
            $user->save();

            return back()->with('success', 'Berhasil Mengubah Password');
        }
        return back()->with('error', 'Gagal mengubah password, password lama tidak valid');
    }
}
