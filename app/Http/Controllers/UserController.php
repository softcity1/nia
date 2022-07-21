<?php

namespace App\Http\Controllers;

use App\Mail\AccessResponseMail;
use App\Mail\GetAccessMail;
use App\Mail\NewUserEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private $success = false;
    private $message = '';

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function settings(Request $request)
    {
        $title = 'update account setting';
        if ($request->method() == 'POST') {
            $data = $request->all();
            unset($data['_token']);
            $user = User::find(loginId());
            if (!empty($user)) {
                $profileImage = $user->image;
                if ($request->hasFile('file')) {
                    if (isset($user->image) && !empty($user->image)) {
                        $Path = public_path('images/profile') . $user->image;
                        if (file_exists($Path)) {
                            unlink($Path);
                        }
                    }
                    $profileImage = uploadImage($request, 'images/profile');
                }
                $data['image'] = $profileImage;
                $data['password'] = (!empty($data['password']) ? Hash::make($data['password']) : $user->password);
                $data['date_of_birth'] = !empty($data['date_of_birth']) ? databaseDateTimeFromat($data['date_of_birth']) : null;
                $user->update($data);
                $this->success = true;
                $this->message = 'Profile updated successfully';
            }
            $arr = [];
            $arr['title'] = loginUserName() . ' ' . $title;
            $arr['status'] = $this->success == true ? 'Successful' : 'Unsuccessful';
            $arr['created_at'] = now();
            $arr['updated_at'] = now();
            activity($arr);

            return response()->json(['success' => $this->success, 'message' => $this->message]);
        }
        return view('setting.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * This is used to update login user profile
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $isAllow = 0;
        $isUser = false;
        $user = $email = '';
        $data['user_type'] = 2;
        $title = 'create a new user';
        unset($data['_token']);
        if (!empty($data['id'])) {
            $isUser = true;
            $user = User::find($data['id']);
        } else {
            $email = User::where('email', $data['email'])->first();
        }
        if (isCompany() == true) {
            $isAllow = User::where('created_by', loginId())->count();
        }
        if ($isAllow == 3) {
            $this->message = 'You can not create more than 3 users.';
        } else {
            if (empty($email)) {
                $isUser = true;
            } else {
                $this->message = 'User already exist';
            }
            if ($isUser == true) {
                $data['user_type'] = 2;
                if (isAdmin() == true) {
                    $data['user_type'] = 1;
                }
                $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
                $data['created_by'] = loginId();
                $data['company_logo'] = uploadImage($request, 'images/company');
                $data['created_at'] = currentDateTime();
                $data['updated_at'] = currentDateTime();
                unset($data['file']);
                if (!empty($data['id'])) {
                    unset($data['id']);
                    $user->update($data);
                    $this->message = 'User Updated successfully';
                    $title = 'updated a user';
                } else {
                    unset($data['id']);
                    $password = $data['name'] . '_123';
                    $data['password'] = Hash::make($password);
                    User::insert($data);
                    Mail::to($data['email'])->send(new NewUserEmail($data, $password));
                    $this->message = 'User Created successfully';
                }
                $this->success = true;
            }
            $arr = [];
            $arr['title'] = loginUserName() . ' ' . $title . ' ' . $data['first_name'] . ' ' . $data['last_name'];
            $arr['status'] = $this->success == true ? 'Successful' : 'Unsuccessful';
            $arr['created_at'] = now();
            $arr['updated_at'] = now();
            activity($arr);
        }

        return response()->json(['success' => $this->success, 'message' => $this->message]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.create', compact('user', 'id'));
    }

    /**
     * Destroy a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $title = 'delete user';
        $name = '';
        if ($id) {
            $user = User::find($id);
            $name = $user->name;
            $user->delete();
            $this->message = 'User Deleted successfully';
            $this->success = true;

        }
        $arr = [];
        $arr['title'] = loginUserName() . ' ' . $title . ' ' . $name;
        $arr['status'] = $this->success == true ? 'Successful' : 'Unsuccessful';
        $arr['created_at'] = now();
        $arr['updated_at'] = now();
        activity($arr);

        return response()->json(['success' => $this->success, 'message' => $this->message]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getUsers(Request $request)
    {
        $data = $usersArr = [];
        $pager = '';
        $page = $request->input('page');
        $perPage = $request->input('per_page');
        $users = User::select('id', 'name', 'company_name', 'phone', 'email', 'created_at')
            ->orderBy('created_at', 'desc')
            ->where('id', '!=', loginId());
        if (isCompany()) {
            $users->where('created_by', loginId());
        }
        if (!empty($users)) {
            $usersArr = $users->get()->toArray();
            foreach ($usersArr as $key => $row) {
                $usersArr[$key]['created_at'] = viewDateFormat($row['created_at']);
            }
            $data = makePagination($usersArr, $perPage, $page);
            $pager = paginationView($data, count($usersArr));
        }

        return response()->json(['data' => $data, 'pager' => $pager]);
    }

    /**
     * This is used to get permission for update of company user profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPermission()
    {
        $user = User::find(loginId());
        if (!empty($user)) {
            $createdBy = User::find($user->created_by);
            if (!empty($createdBy)) {
                Mail::to($createdBy->email)->send(new GetAccessMail($user, $createdBy));
                $this->success = true;
                $this->message = 'Request submitted successfully. Please wait for response from admin. Thanks';
            }
        }

        return response()->json(['success' => $this->success, 'message' => $this->message]);
    }

    /**
     * This is used to grant or reject permission for company user to update profile
     *
     * @param $requestedId
     * @param $granterId
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function grantPermission(Request $request, $requestedId = 0, $granterId = 0)
    {
        if ($request->method() == 'POST') {
            $requestedUser = User::find($request->input('requested_id'));
            $isAccept = $request->input('is_accept');
            if (!empty($requestedUser)) {
                $this->message = 'Request Rejected Successfully';
                $requestedUser->update(['is_permission' => 0]);
                if (!empty($isAccept)) {
                    $requestedUser->update(['is_permission' => 1]);
                    $this->message = 'Request Granted Successfully';
                }
                $this->success = true;
                Mail::to($requestedUser->email)->send(new AccessResponseMail($isAccept));
            }

            return response()->json(['success' => $this->success, 'message' => $this->message]);
        }

        return view('setting.grant-access', compact('requestedId', 'granterId'));
    }
}
