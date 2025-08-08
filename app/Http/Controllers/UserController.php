<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function account_request_view()
    {
        $users = User::where('status', 'submitted')->get();
        return view('pages.permintaan-akun.index', [
            'users' => $users,
        ]);
    }
    public function account_approval(Request $request, $userId)
    {
        $for = $request->input('for');

        $user = User::findOrFail($userId);
        $user->status = $for == 'approve' ? 'approved' : 'rejected';
        $user->save();

        return back()->with('success', $for == 'approve' ? 'Berhasil Menyetujui Akun' : 'Berhasil Menolak Akun');
    }
}
