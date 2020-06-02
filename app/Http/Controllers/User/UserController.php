<?php

namespace App\Http\Controllers\User;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\CompanyPositionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    protected $userR;
    protected $roleR;
    protected $companyPositionR;

    public function __construct(UserRepository $userR, RoleRepository $roleR, CompanyPositionRepository $companyPositionR) {
        $this->userR = $userR;
        $this->roleR = $roleR;
        $this->companyPositionR = $companyPositionR;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $users = $this->userR->getListUser($request, 'first_name,last_name,email,status');
        $roles = $this->roleR->getListRoleBasic(1);
        $companyPositions = $this->companyPositionR->getListCompPositionBasic(1);
        if ($request->ajax()) {
            $view = view('users.table-users', compact('users'))->render();
            return response()->json($view);
        }
        return view('users.index')
                        ->with('users', $users)->with('roles', $roles)
                        ->with('companyPositions', $companyPositions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request) {
        try {
            $user = $this->userR->fillModel($request);
            $user->save();
            if ($request->ajax()) {
                return response()->json(['message' => 'USUARIO creado correctamente!']);
            }
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            throw new CustomException('Error al crear el USUARIO', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = $this->userR->getShowUser($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = $this->userR->getShowUser($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id) {
        try {
            $user = $this->userR->fillModel($request, $id);
            $user->save();
            if ($request->ajax()) {
                return response()->json(['message' => 'USUARIO actualizado correctamente!']);
            }
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            throw new CustomException('Error al actualizar el USUARIO', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $user = $this->userR->findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'USUARIO eliminado correctamente!']);
        } catch (\Exception $e) {
            throw new CustomException('Error al eliminar el USUARIO', 400);
        }
    }

    public function changePassword(ChangePasswordRequest $request) {
        if (Hash::check($request->oldPassword, auth()->user()->password)) {
            try {
                $user = auth()->user();
                $user->password = $request->password;
                $user->save();
                return response()->json('Se actualizo la CONTRASEÑA correctamente.');
            } catch (\Exception $e) {
                throw new CustomException('Error al cambiar la contraseña', 400);
            }
        } else {
            throw new CustomException('Credenciales Inválidas', 401);
        }
    }

    public function changePasswordView() {
        return view('users.change-password');
    }
    
    public function profile() {
        $user = $this->userR->getShowUser(auth()->id());
        $permissions = $user->role->permissions;
        return view('users.profile')->with('user',$user)->with('permissions',$permissions);
    }
}
