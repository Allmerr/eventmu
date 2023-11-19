<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NicknameService;

class SettingController extends Controller
{
    public function index()
    {
        return view('studio.setting.index', [
            'user' => auth()->user(),
        ]);
    }

    public function updateProfilePicture(Request $request){
        $validatedData = $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = auth()->user();

        $validatedData['profile_picture'] = $request->file('profile_picture')->store('profile_picture');

        $user->profile->profile_picture = $validatedData['profile_picture'];
        $user->profile->save();

        return redirect()->back()->with('success', 'Profile picture changed successfully.');
    }

    public function updateProfile(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:20',
            'nickname' => 'required|string|max:20',
            'caption' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'pronouns' => 'nullable|in:Do not specify,he/him,she/her,they/them',
            'url' => 'nullable|url|max:255',
            'social_accounts' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        $user->name = $validatedData['name'];
        $user->nickname = $validatedData['nickname'];

        $user->profile->update([
            'caption' => $validatedData['caption'],
            'bio' => $validatedData['bio'],
            'pronouns' => $validatedData['pronouns'],
            'url' => $validatedData['url'],
            'location' => $validatedData['location'],
            'social_accounts' => $validatedData['social_accounts'],
        ]);


        $nicknameService = new NicknameService();

        if($nicknameService->isUnique($validatedData['nickname'])){
            $user->nickname = $validatedData['nickname'];
        }

        // dd($validatedData, $user);
        $user->save();

        return redirect()->back()->with('success', 'Profile changed successfully.');
    }

    public function isNicknameUnique($nickname){
        $nicknameService = new NicknameService();

        if($nicknameService->isUnique($nickname) || $nickname === auth()->user()->nickname){
            return response()->json([
                'is_unique' => true,
            ]);
        }

        return response()->json([
            'is_unique' => false,
        ]);
    }
}
