<?php

namespace App\Http\Controllers\Api\V1\Permission;

use App\helpers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralCollection;
use App\Http\Resources\PermissionRsource;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class RoleController extends Controller
{
    use helpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
       
        return $this->apiResponse(['data' => $roles], 200);
    }
    public function getRoleForUser(Request $request)
    {
        $role = User::where('id',$request->id)->with('roles')->get();
        if(count($role)!=0){
            return $this->apiResponse(['data' => $role], 200);
        }else{
            return $this->apiResponse(['message' => 'not found'], 404);
        }
       
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:254',
        ]);
       
        $roles = Role::create(['name' => $request->name]);

        return $this->apiResponse(['data' => $roles], 200);
    }
  
   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:254',
            'id' => 'required|exists:roles,id',
        ]);

        $roles = Role::where('id',$request->id)->update([
            'name' => $request->name,
        ]);
        $roles = Role::where('id', $request->id)->get();

        return $this->apiResponse(['data' => $roles], 200);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $roles = Role::where('id', $id)->delete();
        if($roles){
            return $this->apiResponse(['message' => 'The User Has Been Deleted'], 200);
        }else{
            return $this->apiResponse(['message' => 'not found'], 200);
        }
    }
}
