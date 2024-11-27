<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Helper\ImageHelper;
use App\Helpers\Response\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\ProfileUpdateRequest;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private const PATH = 'admin.profile.partials.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = auth()->user();
            return view(self::PATH.'personal-information', compact('user'));
        } catch (\Exception $exception) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileUpdateRequest $request): JsonResponse
    {
        $attributes = collect($request->validated());
        try {
            $user = auth()->user();

            if ($attributes->get('profile')) {
                $profile_image = ImageHelper::updateImage($attributes->get('profile'), $user->profile);
                $attributes->put('profile', $profile_image['path']);
            }
            $user->update($attributes->toArray());
            return ResponseHelper::success('Başarılı bir şekilde Kişisel bilgiler güncellendi.');
        } catch (\Exception $exception) {
            return ResponseHelper::error('Bir hata oluştur.', [$exception->getMessage()]);
        }
    }

    public function changePassword()
    {
        try {
            $user = auth()->user();
            if (!$user) {
                abort(404);
            }
            return view(self::PATH.'change-password', compact('user'));
        } catch (\Exception $exception) {
            abort(404);
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $attributes = collect($request->validated());
        try {
            $user = auth()->user();
            if (!$user) {
                abort(404);
            }
            $user->password =  Hash::make($attributes->get('new_password'));
            $user->save();
            return ResponseHelper::success('Başarılı bir şekilde şifre değiştirme işleminiz gerçekleştirildi.');
        } catch (\Exception $exception) {
            return ResponseHelper::error('Bir hata oluştur.', [$exception->getMessage()]);
        }
    }
}
