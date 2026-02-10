<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Profiles retrieved successfully',
            'data' => $profiles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Create profile',
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $profile = Profile::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Profile created successfully',
            'data' => $profile
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        $profile = Profile::findOrFail($profile->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Profile retrieved successfully',
            'data' => $profile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Edit profile',
                'data' => $profile
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $profile->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'data' => $profile
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Profile deleted successfully'
        ]);
    }
}
