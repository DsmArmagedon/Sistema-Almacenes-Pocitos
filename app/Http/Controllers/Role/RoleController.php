<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Cache;
use App\Repositories\PermissionRepository;

class RoleController extends Controller
{
    protected $roleR;
    protected $permissionR;

    public function __construct(RoleRepository $roleR, PermissionRepository $permissionR)
    {
        $this->roleR = $roleR;
        $this->permissionR = $permissionR;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = $this->roleR->getListRole($request);
        if($request->ajax())
        {
            $view = view('roles.table-roles', compact('roles'))->render();
            return response()->json($view);
        }
        return view('roles.index')->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissionR->getListPermission();
        return view('roles.create')->with('permissions',$permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {
            $role = $this->roleR->fillModel($request);
            DB::beginTransaction();
            $role->save();
            $role->permissions()->sync($request->permissions);
            DB::commit();
            if($request->ajax())
            {
                return response()->json(['message' => 'ROL creado correctamente!']);
            }
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            DB::rollback();
            throw new CustomException('Error al crear el ROL', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roleR->getShowRole($id);
        return response()->json($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleR->getShowRole($id,'id');
        $permissions = $this->permissionR->getListPermission();
        return view('roles.edit')->with('role',$role)->with('permissions', $permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            $role = $this->roleR->fillModel($request, $id);
            DB::beginTransaction();
            $role->save();
            $role->permissions()->sync($request->permissions);
            DB::commit();
            Cache::put('role.'.$role->id,$role->permissions);
            return response()->json(['message' => 'ROL actualizado correctamente!']);

        } catch (\Exception $e) {
            DB::rollback();
            throw new CustomException('Error al actualizar el ROL', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role = $this->roleR->findOrFail($id);
            DB::beginTransaction();
            $role->permissions()->detach();
            $role->delete();
            DB::commit();
            Cache::forget('role.'.$role->id);
            return response()->json(['message' => 'ROL eliminado correctamente!']);
        } catch (\Exception $e) {
            DB::rollback();
            throw new CustomException('Error al eliminar el ROL', 400);
        }
    }
}
