<?php

namespace Modules\Admin\Http\Controllers\v1;

use Modules\Admin\Repositories\AdminRepository;
use Modules\Core\Enums\ResponseCode;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Role\Http\Requests\EditAdminRequest;
use Modules\Role\Http\Requests\LoginAdminRequest;
use Modules\Role\Http\Requests\StoreAdminRequest;
use Modules\Role\Repositories\AdminRoleRepository;
use Modules\Role\Traits\CheckPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends CoreController
{
    use CheckPermission;

    public function __construct(protected AdminRepository $repository, protected AdminRoleRepository $roleRepository){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // if (!$this->can("read-admin")) {
        //     return failedResponse("", ResponseCode::NOT_ACCESS);
        // };


        $list = $this->repository->index()->paginate(env("PAGINATE"));
        return successResponse($list);

    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditAdminRequest $request, string $id)
    {
        if ($request->has("password")) {
            $request->merge([
                'password' => Hash::make($request->password),
            ]);
        }


        if ($request->has("role_id")) {
            $this->roleRepository->updateItem([
                "admin_id" => $id,
                "role_id" => $request->role_id
            ], $id);
            $request->request->remove('role_id');
        }

        $admin = $this->repository->updateItem($request->validated(), $id);
        return successResponse($admin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}

    function loginAdmin(LoginAdminRequest $request)
    {
        $admin = $this->repository->findByField('username', $request->username);
        if (!$admin) {
            return failedResponse('failed.notExist', ResponseCode::NOT_FOUND_DATA);
        }
        if (!Hash::check($request->password, $admin->password)) {
            return failedResponse('failed.passwordMatch', ResponseCode::NOT_FOUND_DATA);
        }
        $token = $admin->createToken('authTokenAdmin')->plainTextToken;
        $admin['token'] = $token;

        return  successResponse($admin);
    }

    public function store(StoreAdminRequest $request)
    {
        $request->merge([
            'password' => Hash::make($request->password),
        ]);
        $admin = $this->repository->newItem([
            "username" => $request->username,
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
        ]);

        if ($request->has("role_id")) {
            $this->roleRepository->newItem([
                "admin_id" => $admin->id,
                "role_id" => $request->role_id
            ]);
        }

        return successResponse($admin);
    }
}
