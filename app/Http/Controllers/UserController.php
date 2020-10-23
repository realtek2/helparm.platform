<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('fund_id', '>', 0)->latest()->paginate(10);
        return view('admin.user.index', compact('users'))->with((request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $funds = Fund::all();

        return view('admin.user.create', compact('funds'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'fund_id' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        User::create($input);

        
        return redirect(route('admin.users.index'))->with('success', 'Пользователь создан.');
    }

    public function edit(User $user)
    {
        $funds = Fund::all();
        return view('admin.user.edit', compact('user', 'funds'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'fund_id' => 'required'
        ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::findOrFail($id);
        $user->update($input);

        return redirect(route('admin.users.index'))->with('success', 'Пользователь обновлён.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('admin.users.index'))->with('success', 'Пользователь удалён.');
    }
}
