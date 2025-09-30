<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\CreateUserRequest;
use App\Http\Requests\Admin\Users\updateUserRequest;
use App\Interfaces\Admin\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserInterface $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * View all users data
     */
    public function index($request)
    {
        try {
            if (Auth::user()->can('user-view')) {
                $users = $this->userInterface->index($request);

                $users = User::getAllUsersForFilter($request);

                return view ('admin.user.all_users', compact('users'));
            } else {
                return view('admin.errors.403_forbidden');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new user.
     */
    public function createUi()
    {
        if (Auth::user()->can('user-create')) {

            return view('admin.users.components.create_user');
        } else {
            return view('admin.errors.403_forbidden');
        }
    }

    /**
     * Store a newly created user in storage.
     */
    public function create(CreateUserRequest $request)
    {
        try {
            if (Auth::user()->can('user-create')) {
                DB::beginTransaction();

                $user = $this->userInterface->create($request);

                $user = new User();

                $user->fname = $request->fname;
                $user->lname = $request->lname;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->status = $request->status;
                
                $user->save();

                DB::commit();
                return response()->json(['status' => 200, 'message' => 'User created successfully !']);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {

            DB::rollBack();

            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateUi($id)
    {
        try {
            if (Auth::user()->can('user-edit')) {

                $user = $this->userInterface->updateUi($id);

                return response()->json(['status' => 200, 'message' => 'User updated successfully !', 'data' => $user]);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateUserRequest $request, $id)
    {
        try {
            if (Auth::user()->can('user-edit')) {

                DB::beginTransaction();

                //updating user
                $user = $this->userInterface->update($request, $id);

                $user = User::find($id);

                $user->fname = $request->fname;
                $user->lname = $request->lname;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->status = $request->status;
                
                $user->save();
                DB::commit();

                return response()->json(['status' => 200, 'message' => 'User updated successfully !']);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            if (Auth::user()->can('user-delete')) {
                DB::beginTransaction();

                $user = $this->userInterface->destroy($id);
                User::destroy($id);
                DB::commit();

                return response()->json(['status' => 200, 'message' => 'User deleted successfully !']);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Status change of the specified resource.
     */
    public function changeStatus(Request $request, $id)
    {
        try {
            if (Auth::user()->can('user-status')) {
                DB::beginTransaction();

                $user = $this->userInterface->changeStatus($request, $id);
                $user = User::find($id);

                $user->status = $request->status;
                $user->save();
                DB::commit();

                return response()->json(['status' => 200, 'message' => 'User status changed successfully !']);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }
}
