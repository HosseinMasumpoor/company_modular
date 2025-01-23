<?php

namespace Modules\Role\Http\Controllers\v1;

use Modules\Core\Enums\ResponseCode;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Role\Http\Requests\PermissionRolesRequest;
use Modules\Role\Http\Requests\RoleRequest;
use Modules\Role\Http\Resources\PermissionRoleResource;
use Modules\Role\Models\Permission;
use Modules\Role\Models\Role;
use Modules\Role\Repositories\PermissionRoleRepository;
use Modules\Role\Repositories\RoleRepository;
use Modules\Role\Traits\CheckPermission;

class RoleController extends CoreController
{
    use CheckPermission;

    public function __construct(protected RoleRepository $repository, protected PermissionRoleRepository $permissionRoleRepository){

    }
    public function permissions()
    {
        if (!$this->can("read-permission")) {
            return failedResponse("", ResponseCode::NOT_ACCESS);
        }


        $list = Permission::all();
        return successResponse($list);
    }

    public function permissionRoles(PermissionRolesRequest $request)
    {
        if (!$this->can("edit-permission")) {
            return failedResponse("", ResponseCode::NOT_ACCESS);
        }

        $param = $request->validated();
        $roleId = $param['role_id'];
        $this->permissionRoleRepository->remove($roleId);
        foreach ($param['permissions'] as $permission) {
            $this->permissionRoleRepository->newItem([
                "role_id" => $roleId,
                "permission_id" => $permission['id'],
            ]);
        }
        return successResponse([]);
    }

    public function getPermissionRoles(Role $role)
    {
        if (!$this->can("read-permission")) {
            return failedResponse("", ResponseCode::NOT_ACCESS);
        }

        $list = $this->permissionRoleRepository->getByFields(["role_id" => $role->id]);

        return successResponse(PermissionRoleResource::collection($list));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!$this->can("read-role")) {
            return failedResponse("", ResponseCode::NOT_ACCESS);
        }


        $list = $this->repository->index()->paginate(config('core.paginate_number'));
        return successResponse($list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        if (!$this->can("add-role")) {
            return failedResponse("", ResponseCode::NOT_ACCESS);
        }
        $record = $this->repository->newItem($request->validated());
        return successResponse($record);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!$this->can("read-role")) {
            return failedResponse("", ResponseCode::NOT_ACCESS);
        }
        $record = $this->repository->findByField("id", $id);
        return successResponse($record);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        if (!$this->can("edit-role")) {
            return failedResponse("", ResponseCode::NOT_ACCESS);
        }
        $record = $this->repository->updateItem($request->validated(), $id);
        return successResponse($record);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->can("delete-role")) {
            return failedResponse("", ResponseCode::NOT_ACCESS);
        }
        $record = $this->repository->remove($id);
        return successResponse($record);
    }
}
