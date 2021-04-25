<?php

namespace App\Http\Controllers\Api\User;

use App\Entity\User\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\ProfileEditRequest;
use App\Http\Serializers\UserSerializer;
use App\Http\Resources\User\ProfileResource;
use App\UseCases\Profile\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $service;
    /**
     * @var UserSerializer
     */
    //private $serializer;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
        //$this->serializer = $serializer;
    }

    public function show(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        return new ProfileResource($request->user());

        //return $this->serializer->profile($user);
    }

    public function update(ProfileEditRequest $request)
    {
        $this->service->edit($request->user()->id, $request);

        /** @var User $user */
        $user = User::findOrFail($request->user()->id);

        return new ProfileResource($user);

        //return $this->serializer->profile($user);
    }
}
