<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Farm;
use App\Models\Role;
use App\Models\Salary;
use App\Models\Tree;
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
        $data['users'] = User::whereKeyNot(Auth::user()->id)->with('created_user:id,first_name,last_name')->orderBy('id', 'desc')->paginate(10);
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
        $data['employees'] = Employee::orderBy('id', 'desc')->paginate(10);
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
        $data['salaries'] = Salary::where('employee_id', $employee->id)->orderBy('id', 'desc')->get();
        $data['title'] = $employee->first_name . " " . $employee->last_name . " Data";
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

            $data['title'] = "Create New Employee";
            return view('employees.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', "An error occur try again");
            return back();
        }
    }


    public function farms()
    {
        $data['title'] = "Farms";
        $data['sn'] = 1;
        $data['farms'] = Farm::orderBy('id', 'desc')->paginate(10);
        return view('farms.index', $data);
    }

    public function create_farm(Request $request)
    {
        try {
            //code...
            $data['mode'] = "create";
            if ($_POST) {
                $rules = array(
                    'farm_name' => ['required', 'string', 'max:255', 'unique:farms'],
                    'farm_desc' => ['required', 'string', 'max:255'],
                    'acquisition_date' => ['required', 'string', 'max:255'],
                    'surface' => ['required', 'string', 'max:255'],
                    'amount' => ['required', 'string'],
                    'latitude' => ['required', 'string'],
                    'longitude' => ['required', 'string'],
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', 'All fields are required');
                    return back()->withErrors($validator)->withInput();
                }


                Farm::create([
                    'farm_name' => $request->farm_name,
                    'farm_desc' => $request->farm_desc,
                    'acquisition_date' => $request->acquisition_date,
                    'surface' => $request->surface,
                    'amount' => $request->amount,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude
                ]);

                Session::flash('success', "Farm created successfully");
                return redirect()->route('farms');
            }

            $data['title'] = "Create New Farm";
            return view('farms.create', $data);
        } catch (\Throwable $th) {
            // Session::flash('error', "An error occur try again");
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function edit_farm(Request $request, $id)
    {
        try {
            $data['mode'] = "edit";
            $data['farm'] = $farm = Farm::find($id);
            if (!isset($farm)) {
                Session::flash('warning', 'Farm not found');
                return redirect()->route('farms');
            }
            if ($_POST) {

                $rules = array(
                    'farm_name' => ['required', 'string', 'max:255', 'unique:farms,farm_name,' . $request->id],
                    'farm_desc' => ['required', 'string', 'max:255'],
                    'acquisition_date' => ['required', 'string', 'max:255'],
                    'surface' => ['required', 'string', 'max:255'],
                    'amount' => ['required', 'string'],
                    'latitude' => ['required', 'string'],
                    'longitude' => ['required', 'string'],
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', 'All fields are required');
                    return back()->withErrors($validator)->withInput();
                }


                Farm::where('id', $request->id)->update([
                    'farm_name' => $request->farm_name,
                    'farm_desc' => $request->farm_desc,
                    'acquisition_date' => $request->acquisition_date,
                    'surface' => $request->surface,
                    'amount' => $request->amount,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude
                ]);

                Session::flash('success', "Farm data updated successfully");
                return redirect()->route('farms');
            }
            $data['title'] = "Edit Farm";
            return view('farms.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function trees()
    {
        $data['title'] = "Trees";
        $data['sn'] = 1;
        $data['trees'] = Tree::with('farm:id,farm_name')->orderBy('id', 'desc')->paginate(10);
        return view('trees.index', $data);
    }

    public function create_tree(Request $request)
    {
        try {
            //code...
            $data['mode'] = "create";
            $data['farms'] = $f = Farm::orderBy('id', 'desc')->get();
            if ($_POST) {
                $rules = array(
                    'farm_id' => ['required', 'string', 'max:255'],
                    'desc' => ['required', 'string', 'max:255'],
                    'reason' => ['required', 'string', 'max:255'],
                    'quantity' => ['required', 'string', 'max:255'],
                    'date_planted' => ['required', 'string']
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', 'All fields are required');
                    return back()->withErrors($validator)->withInput();
                }


                Tree::create([
                    'farm_id' => $request->farm_id,
                    'desc' => $request->desc,
                    'reason' => $request->reason,
                    'quantity' => $request->quantity,
                    'date_planted' => $request->date_planted
                ]);

                Session::flash('success', "Tree created successfully");
                return redirect()->route('trees');
            }

            $data['title'] = "Create New Tree";
            return view('trees.create', $data);
        } catch (\Throwable $th) {
            // Session::flash('error', "An error occur try again");
            Session::flash('error', $th->getMessage());
            return back();
        }
    }

    public function edit_tree(Request $request, $id)
    {
        try {
            $data['mode'] = "edit";
            $data['tree'] = $tree = Tree::find($id);
            $data['farms'] = Farm::orderBy('id', 'desc')->get();
            if (!isset($tree)) {
                Session::flash('warning', 'Tree not found');
                return redirect()->route('trees');
            }
            if ($_POST) {

                $rules = array(
                    'farm_id' => ['required', 'string', 'max:255'],
                    'desc' => ['required', 'string', 'max:255'],
                    'reason' => ['required', 'string', 'max:255'],
                    'quantity' => ['required', 'string', 'max:255'],
                    'date_planted' => ['required', 'string']
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    Session::flash('warning', 'All fields are required');
                    return back()->withErrors($validator)->withInput();
                }


                Tree::where('id', $request->id)->update([
                    'farm_id' => $request->farm_id,
                    'desc' => $request->desc,
                    'reason' => $request->reason,
                    'quantity' => $request->quantity,
                    'date_planted' => $request->date_planted
                ]);

                Session::flash('success', "Tree data updated successfully");
                return redirect()->route('trees');
            }
            $data['title'] = "Edit Tree";
            return view('trees.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }
}
