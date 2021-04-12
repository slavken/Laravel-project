<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Scopes\Post\StatusScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function leaderboard(): object
    {
        return Post::with('user')
            ->withoutGlobalScope(StatusScope::class)
            ->where('created_at', '>=', Carbon::today())
            ->get()
            ->groupBy('user.name')
            ->sortDesc()
            ->slice(-3)
            ->keys();
    }

    public function updateEmail(Request $request, User $user): User
    {
        $user->email = $request->email;
        $user->email_verified_at = null;
        $user->save();

        return $user;
    }

    public function updateUsername(Request $request, User $user): User
    {
        $user->name = $request->name;
        $user->save();

        return $user;
    }

    public function updatePassword(Request $request, User $user): User
    {
        $user->password = Hash::make($request->new_password);
        $user->save();

        return $user;
    }

    public function confirmEmail(User $user): void
    {
        $user->email_verified_at = Carbon::now();
        $user->save();
    }
}
