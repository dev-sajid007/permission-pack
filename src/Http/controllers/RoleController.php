<?php

namespace DevSajid\Permission\Http\Controllers;

use App\Http\Controllers\Controller;
use DevSajid\Permission\Models\Role;
use DevSajid\Permission\Traits\GetRoutesName;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    use GetRoutesName;
    public function index()
    {
        $roles = Role::all();
        return view('permission::roles.index', compact('roles'));
    }


    public function create(){

        $modules = collect($this->getAllRouteNameAsArray());
        return view('permission::roles.create',compact('modules'));
    }


    public function store(Request $request){

        //return $request->all();
        $request->validate([
            'name' => 'required|unique:roles|max:50',
            'permissions' => 'required',
        ]);

        Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'permissions' => $request->permissions,
        ]);

        $this->super_admin_permission();

        //notification
        $notification = array(
            'message' =>'Role Created',
            'alert-type' =>'success'
        );
        return redirect()->route('app.roles.index')->with($notification);
    }

    /**
     * Supper Admin Permission
     * --------------------------------
     * This will get all permissions and update supper admin permissions.
    */

    public function super_admin_permission() {
        $super_admin = Role::where('slug', 'super-admin')->first();
        $super_admin->update([
            'permissions' => $this->modules_list(),
        ]);
    }

    public function modules_list() {
        $modules = collect($this->getAllRouteNameAsArray());
        $arr = [];
        foreach ($modules as $key => $module) {
            foreach ($module as $name) {
                array_push($arr, $key.'.'.$name);
            }
        }
        return $arr;
    }



    public function edit($id){

        $modules = collect($this->getAllRouteNameAsArray());
        $roles   = Role::all();
        $role    = Role::find($id);
        return view('permission::roles.create', compact('role', 'modules', 'roles'));
    }



    public function update(REQUEST $request,$id){

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'permissions' => $request->permissions,
        ]);

        // $role->permissions()->sync($request->input('permissions'));
        $this->super_admin_permission();
        // //notification
        $notification = array(
            'message' =>'Role Updated',
            'alert-type' =>'success'
        );
        return redirect()->route('app.roles.index')->with($notification);
    }


    public function delete($id){
   
        $role = Role::findOrFail($id);
        if ($role->deleteable == 1){
            $role->delete();
        }
        else{
            $notification = array(
                'message' =>'Cannot delete this role',
                'alert-type' =>'error'
            );
            return back()->with($notification);
        }
        //notification
        $notification = array(
            'message' =>'Role Delete Successfully ',
            'alert-type' =>'success'
        );
        return redirect()->route('app.roles.index')->with($notification);
    }



}
