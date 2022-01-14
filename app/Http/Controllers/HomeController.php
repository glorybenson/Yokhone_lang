<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        function save_file($file, $path)
        {
            $name = $path . date('dMY') . time() . '.' . $file->getClientOriginalExtension();
            $fileDestination = $path;
            $file->move($fileDestination, $name);
            return $name;
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['title'] = "Users";
        $data['sn'] = 1;
        $data['users'] = User::whereKeyNot(Auth::user()->id)->with('created_user:id,first_name,last_name')->paginate(10);
        return view('users.index', $data);
    }

    public function edit_user(Request $request, $id)
    {
        try {
            if ($_POST) {
                $rules = array(
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'role' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
                );

                $fieldNames = array(
                    'vendor_id' => "Vendor Name",
                    'subject' => "Message Subject",
                    'content' => "Message Content"
                );

                $validator = Validator::make($request->all(), $rules);
                // $validator->setAttributeNames($fieldNames);

                if ($validator->fails()) {
                    Session::flash('warning', 'All fields are required');
                    return back()->withErrors($validator)->withInput();
                }

                $user = User::find($request->id);
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->role = $request->role;
                $user->save();

                Session::flash('success', "User updated successfully");
                return redirect()->route('home');
            }
            $data['mode'] = "edit";
            $data['roles'] = Role::all();
            $data['user'] = User::where('id', $id)->with('user_role')->first();
            $data['title'] = "Edit User";
            return view('users.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function create_user(Request $request)
    {
        try {
            //code...
            $data['mode'] = "create";
            if ($_POST) {
                $rules = array(
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'role' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', 'All fields are required');
                    return back()->withErrors($validator)->withInput();
                }

                User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'role' => $request->role,
                    'created_by' => Auth::user()->id,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                Session::flash('success', "User created successfully");
                return redirect()->route('home');
            }

            $data['roles'] = Role::all();
            $data['title'] = "Create User";
            return view('users.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function delete_user($id)
    {
        try {
            //code...
            $user = User::find($id);
            $user->delete();
            Session::flash('success', 'User Deleted successfully');
            return redirect()->route('home');
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }
    public function employees()
    {
        $data['title'] = "Employees";
        $data['sn'] = 1;
        $data['employees'] = Employee::paginate(10);
        // $data['employees'] = Employee::with('created_user:id,first_name,last_name')->paginate(10);
        return view('employees.index', $data);
    }

    public function view_employee($id)
    {
        $data['employee'] = $employee = Employee::find($id);
        if (!isset($employee)) {
            Session::flash('warning', 'Employee not found');
            return redirect()->route('employees');
        }
        $data['mode'] = $employee->first_name . " " . $employee->last_name . " Data";
        // $data['employees'] = Employee::with('created_user:id,first_name,last_name')->paginate(10);
        return view('employees.view', $data);
    }
    public function salary_employee($id)
    {
        $data['sn'] = 1;
        $data['employee'] = $employee = Employee::find($id);
        if (!isset($employee)) {
            Session::flash('warning', 'Employee not found');
            return redirect()->route('employees');
        }
        $data['salaries'] = Salary::where('employee_id', $employee->id)->get();
        $data['title'] = $employee->first_name . " " . $employee->last_name . " Data";
        // $data['employees'] = Employee::with('created_user:id,first_name,last_name')->paginate(10);
        return view('employees.salary', $data);
    }

    public function add_salary(Request $request)
    {
        try {
            //code...            
            $rules = array(
                'salary_amount' => ['required', 'string', 'max:255'],
                'salary_start_date' => ['required', 'string', 'max:255'],
                'current_salary' => ['required', 'string', 'max:255'],
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                Session::flash('warning', 'All fields are required');
                if (isset($request->id)) {
                    # code...                    
                    return back()->withErrors($validator);
                }
                return back()->withErrors($validator)->withInput();
            }
            if ($request->id) {
                Salary::where(['employee_id' => $request->employee_id, 'id' => $request->id])->update([
                    'employee_id' => $request->employee_id,
                    'amount' => $request->salary_amount,
                    'start_date' => $request->salary_start_date,
                    'current_salary' => $request->current_salary,
                ]);
                Session::flash('success', "Salary Record Updated successfully");
                return back();
            }

            Salary::create([
                'employee_id' => $request->employee_id,
                'amount' => $request->salary_amount,
                'start_date' => $request->salary_start_date,
                'current_salary' => $request->current_salary,
            ]);

            Session::flash('success', "Salary added successfully");
            return back();
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function edit_employee(Request $request, $id)
    {
        try {
            $data['mode'] = "edit";
            $data['employee'] = $employee = Employee::find($id);
            if (!isset($employee)) {
                Session::flash('warning', 'Employee not found');
                return redirect()->route('employees');
            }
            if ($_POST) {
                $rules = array(
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:employees,email,' . $employee->id],
                    'employee_id' => ['required', 'string', 'max:255'],
                    'hiring_date' => ['required', 'string', 'max:255'],
                    // 'end_date' => ['required', 'string', 'max:255'],
                    'CIN' => ['required', 'string', 'max:255'],
                    'CIN_proof' => ['exclude_if:CIN_proof,null', 'mimetypes:application/pdf', 'max:15000'],
                    'cell_1' => ['required', 'string', 'max:255'],
                    // 'cell_2' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string'],
                    'contact_full_name' => ['required', 'string', 'max:255'],
                    'contact_1_cell' => ['required', 'string', 'max:255'],
                    'contact_1_cell2' => ['required', 'string', 'max:255'],
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', 'All fields are required');
                    return back()->withErrors($validator)->withInput();
                }

                if ($request->hasFile('CIN_proof')) {
                    $CIN_proof = save_file($request->file('CIN_proof'), "CIN_PROOF");
                }


                Employee::where('id', $request->id)->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'employee_id' => $request->employee_id,
                    'hiring_date' => $request->hiring_date,
                    'end_date' => $request->end_date,
                    'CIN' => $request->CIN,
                    'CIN_proof' => $CIN_proof ?? $employee->CIN_proof,
                    'cell_1' => $request->cell_1,
                    'cell_2' => $request->cell_2,
                    'address' => $request->address,
                    'contact_full_name' => $request->contact_full_name,
                    'contact_1_cell' => $request->contact_1_cell,
                    'contact_1_cell2' => $request->contact_1_cell2
                ]);

                Session::flash('success', "Employee data updated successfully");
                return redirect()->route('employees');
            }
            $data['title'] = "Edit Employee";
            return view('employees.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function create_employee(Request $request)
    {
        try {
            //code...
            $data['mode'] = "create";
            if ($_POST) {
                $rules = array(
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:employees'],
                    'employee_id' => ['required', 'string', 'max:255'],
                    'hiring_date' => ['required', 'string', 'max:255'],
                    // 'end_date' => ['required', 'string', 'max:255'],
                    'CIN' => ['required', 'string', 'max:255'],
                    'CIN_proof' => ['required', 'mimetypes:application/pdf', 'max:15000'],
                    'cell_1' => ['required', 'string', 'max:255'],
                    // 'cell_2' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string'],
                    'contact_full_name' => ['required', 'string', 'max:255'],
                    'contact_1_cell' => ['required', 'string', 'max:255'],
                    'contact_1_cell2' => ['required', 'string', 'max:255'],
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', 'All fields are required');
                    return back()->withErrors($validator)->withInput();
                }


                if ($request->hasFile('CIN_proof')) {
                    $CIN_proof = save_file($request->file('CIN_proof'), "CIN_PROOF");
                }

                Employee::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'employee_id' => $request->employee_id,
                    'hiring_date' => $request->hiring_date,
                    'end_date' => $request->end_date,
                    'CIN' => $request->CIN,
                    'CIN_proof' => $CIN_proof ?? "",
                    'cell_1' => $request->cell_1,
                    'cell_2' => $request->cell_2,
                    'address' => $request->address,
                    'contact_full_name' => $request->contact_full_name,
                    'contact_1_cell' => $request->contact_1_cell,
                    'contact_1_cell2' => $request->contact_1_cell2
                ]);

                Session::flash('success', "Employee created successfully");
                return redirect()->route('employees');
            }

            $data['title'] = "Create User";
            return view('employees.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', "An error occur try again");
            return back();
        }
    }
}
