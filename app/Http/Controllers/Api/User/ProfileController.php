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

    /**
     * @OA\Get(
     *     path="/user",
     *     tags={"Profile"},
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *         @OA\Schema(ref="#/definitions/Profile"),
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function show(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        return new ProfileResource($request->user());

        //return $this->serializer->profile($user);
    }

    /**
     * @OA\Put(
     *     path="/user",
     *     tags={"Profile"},
     *     @OA\Parameter(name="body", in="body", required=true, @OA\Schema(ref="#/definitions/ProfileEditRequest")),
     *     @OA\Response(
     *         response=200,
     *         description="Success response",
     *     ),
     *     security={{"Bearer": {}, "OAuth2": {}}}
     * )
     */
    public function update(ProfileEditRequest $request)
    {
        $this->service->edit($request->user()->id, $request);

        /** @var User $user */
        $user = User::findOrFail($request->user()->id);

        return new ProfileResource($user);

        //return $this->serializer->profile($user);
    }
}
