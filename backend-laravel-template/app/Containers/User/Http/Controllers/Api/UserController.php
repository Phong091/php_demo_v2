<?php

namespace App\Containers\User\Http\Controllers\Api;

use App\Containers\User\Http\Requests\StoreUserRequest;
use App\Containers\User\Http\Requests\UpdateUserRequest;
use App\Containers\User\Http\Resources\UserDetailResource;
use App\Containers\User\Http\Resources\UserListResource;
use App\Containers\User\Services\UserService;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * NDX-Todo: Transforms the data
 */
class UserController extends BaseController
{
    private $userService;

    public function __construct(
        UserService $userService,
    ) {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? 25;
        $data = $this->userService->paginate($perPage);

        return $this->responseSuccess([
            'data' => UserListResource::collection($data->items()),
            'pagination' => $this->parsePagination($data),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->userService->create($request->validated());

        return $this->responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->userService->getById($id);

        return $this->responseSuccess(new UserDetailResource($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $this->userService->updateById($id, $request->validated());

        return $this->responseSuccess($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->userService->deleteById($id);

        return $this->responseSuccess($data);
    }
}
