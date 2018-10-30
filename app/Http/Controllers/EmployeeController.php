<?php

namespace App\Http\Controllers;

use App\Classes\EmployeeManager;
use App\Http\Requests\PermissionRequest;
use App\Model\City;
use App\Model\EmployeePermission;
use App\Model\Permission;
use App\Model\Role;
use App\Model\States;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * @var EmployeeManager
     */
    private $employeeManager;

    public function __construct(EmployeeManager $employeeManager)
    {
        $this->employeeManager = $employeeManager;
    }

    public function getAddEmployee()
    {
        $states = States::orderBy('name', 'ASC')->get();
        $cities = City::orderBy('name', 'ASC')->get();
        return view('admin.pages.employee.add_employee', compact('cities', 'states'));
    }

    public function postAddEmployee(Request $request)
    {
        if ($request->get('userId')) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'username' => 'required|unique:users,username',
                'email' => 'required',
                'password' => 'required',
                'mobile_number' => 'required|regex:/[0-9]{10}/|digits:10|unique:users,mobile_num',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'username' => 'required|unique:users,username',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'mobile_number' => 'required|regex:/[0-9]{10}/|digits:10|unique:users,mobile_num',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->get('userId')) {
            $user = User::find($request->get('userId'));
        } else {
            $user = new User();
        }
        $this->employeeManager->saveEmployeeDetails($user, $request);

        if (!$request->get('userId')) {
            $role = Role::where('name', 'employee')->first();
            $user->attachRole($role);
        }

        if ($request->get('userId')) {
            Session::flash('success', 'Employee updated successfully !');
            return redirect()->route('get:edit_employee', $user->slug);
        } else {
            Session::flash('success', 'Employee added successfully !');
            return redirect()->back();
        }
    }

    public function getManageEmployee()
    {
        $users = User::withRole('employee')->get();
        return view('admin.pages.employee.manage_employee', compact('users'));
    }

    public function getEditEmployee($slug)
    {
        $user = User::select('id', 'first_name', 'last_name', 'username', 'email', 'mobile_num', 'status', 'state', 'city', 'profile')->where('slug', $slug)->first();
        if (!$user) {
            Session::flash('error', 'Data not found');
            return redirect()->back();
        }
        return view('admin.pages.employee.add_employee', compact('user'));
    }

    public function getDeleteEmployee(Request $request)
    {
        $user = User::where('slug', $request->get('slug'))->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }
        $user->delete();
        Session::flash('success', 'Employee Deleted Successfully!');
        return response()->json([
            'success' => true,
            'message' => 'User Deleted Successfully'
        ]);
    }

    public function getAddPermission()
    {
        return view('admin.pages.permission.add_permission');
    }

    public function postAddPermission(PermissionRequest $request)
    {
        if($request->get('permissionId')){
            $permission = Permission::find($request->get('permissionId'));
        }else{
            $permission = new Permission();
        }
        $this->employeeManager->savePermoission($permission, $request);
        Session::flash('success', 'Permission added successfully!');
        return redirect()->route('get:edit_permission', $permission->slug);
    }

    public function getManagePermission()
    {
        $permissions = Permission::select('id', 'name', 'display_name', 'description', 'slug')->get();
        return view('admin.pages.permission.manage_permission', compact('permissions'));
    }

    public function getAssignPermission()
    {
        $permissions = Permission::select('id', 'name', 'display_name')->get();
        $users = User::select('users.id', 'users.username')->withRole('employee')->get();
        return view('admin.pages.permission.assign_permission', compact('permissions', 'users'));
    }

    public function postAssignPermission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee' => 'required',
            'permission' => 'required',
        ]);

        if ($validator->fails()) {
            redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($request->get('employee'));
        if(!$user){
            Session::flash('error', 'Employee not found..!');
            return redirect()->back();
        }
        foreach ($request->get('permission') as $item){
            $permission = Permission::find($item);
            if($permission){
                if(EmployeePermission::where('user_id', $user->id)->where('permission_id', $permission->id)->first()){
                    $employeePermission = EmployeePermission::where('user_id', $user->id)->where('permission_id', $permission->id)->first();
                }else{
                    $employeePermission = new EmployeePermission();
                }
                $employeePermission->user_id = $user->id;
                $employeePermission->permission_id = $item;
                $employeePermission->save();
            }
        }
        Session::flash('success', 'Permission add to employee successfully..!');
        return redirect()->back();
    }

    public function getManageAssignPermission()
    {
        $permissions = EmployeePermission::select('employee_permission.id', 'users.username', 'permissions.id', 'permissions.name')
            ->join('users', 'users.id', '=', 'employee_permission.user_id')
            ->join('permissions', 'permissions.id', '=', 'employee_permission.permission_id')
            ->get();
        return view('admin.pages.permission.manage_assign_permission', compact('permissions'));
    }
    
    public function getcheckEmployeePermission()
    {
        $permissions_check = EmployeePermission::select('employee_permission.*')
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('admin.layout.include.sidebar', compact('employee_permission'));
    }

    public function getDeleteAssignPermission(Request $request)
    {
        $permission = EmployeePermission::find($request->get('permissionId'));
        if(!$permission){
            return response()->json([
               'success' => false,
                'message' => 'Assign permission not found..!'
            ]);
        }
        $permission->delete();
        return response()->json([
           'success' => true,
           'message' => 'Assign permission delete successfully..!'
        ]);
    }

    public function getEditPermission($slug)
    {
        $permission = Permission::where('slug', $slug)->first();
        if (!$permission) {
            Session::flash('error', 'Data not found');
            return redirect()->back();
        }
        return view('admin.pages.permission.add_permission', compact('permission'));
    }

    public function getDeletePermission(Request $request)
    {
        $permission = Permission::where('slug', $request->get('slug'))->first();
        if (!$permission) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ]);
        }
        $permission->delete();
        Session::flash('success', 'Permission Deleted Successfully!');
        return response()->json([
            'success' => true,
            'message' => 'User Deleted Successfully'
        ]);
    }
}
