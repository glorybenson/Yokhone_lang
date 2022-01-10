<?php

namespace App\Http\Controllers;

use App\Models\Role;
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
        $data['employees'] = User::whereKeyNot(Auth::user()->id)->with('created_user:id,first_name,last_name')->paginate(10);
        return view('employees.index', $data);
    }

    public function edit_employee(Request $request, $id)
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

                // User::create([
                //     'first_name' => $request->first_name,
                //     'last_name' => $request->last_name,
                //     'role' => $request->role,
                //     'created_by' => Auth::user()->id,
                //     'email' => $request->email,
                //     'password' => Hash::make($request->password)
                // ]);

                dd($request->all());
                Session::flash('success', "Employee created successfully");
                return redirect()->route('employees');
            }

            $data['roles'] = Role::all();
            $data['title'] = "Create User";
            return view('employees.create', $data);
        } catch (\Throwable $th) {
            Session::flash('error', $th->getMessage());
            return back();
        }
    }
}
