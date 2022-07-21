<?php
define('staffImagePath', 'staff/profile');


use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * This function returns unique image name
 *
 * @param $extension
 * @return string
 */
function createImageUniqueName($extension)
{
    $uniqueId = time() . uniqid(rand());
    $imageName = $uniqueId . '.' . $extension;

    return $imageName;
}

/**
 * This is used to get current date time
 *
 * @return string
 */
function currentDateTime()
{
    $time = \Carbon\Carbon::now();

    return $time->toDateTimeString();
}

/**
 * This is used to get current date time
 *
 * @return string
 */
function currentDate()
{
    return date_format(new \DateTime(), 'd-m-Y');
}

/**
 * make_complete_pagination_block
 * @param $obj
 * @param string $type | three possible values 1)short (for short paragraph) 2)long (for long paragraph) 3) null (for no paragraph) .
 * @return  complete pagination block
 */
function paginationView($data, $total)
{
    $info = get_pager_info_paragraph($data, 'long', true, $total);

    return view('partials._pager', compact('data', 'info'))->render();
}

/**
 * Used to paginate weekly overview data
 *
 * @param $items
 * @param int $perPage
 * @param null $page
 * @param array $options
 * @return LengthAwarePaginator
 */
function makePagination($items, $perPage, $page = null, $options = [])
{
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    $items = $items instanceof Collection ? $items : Collection::make($items);

    return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
}

/**
 * get_pager_info_paragraph | it will a paginator object provided by laravel paginate method and will return a paragraph line item with the info about total records and showing records range according to the current page.
 * @param array $obj | paginator object provided by laravel paginate method
 * @param string $type | three possible values 1)short (for short paragraph) 2)long (for long paragraph) 3) null (for no paragraph) .
 * @return returns string | returns a string (paragraph line with star end and total records according to the current page.)
 *
 */
function get_pager_info_paragraph($obj, $type = null, $is_simple, $totalRecord)
{
    $info = "";
    $end = $obj->currentPage() * $obj->perPage();
    $start = $end - ($obj->perPage() - 1);
    $current_page = $obj->currentPage();
    $total = $totalRecord;
    if (!empty($is_simple)) {
        $last_page = ($total - 1) * $obj->perPage();
    } else {
        $last_page = $obj->lastPage();
    }
    if ($start < 1) {
        $start = 1;
    }
    if ($end > $total) {
        $end = $total;
    }
    $type = 'long';
    if ($type) {
        if ($total > 0) {
            if ($type == 'long') {
                $info = "<div class='pager-info'><p>$start from $end to $total results.</p><div class='clr'></div></div>";
            } else {
                $info = "<div class='pager-info'><p>Side $current_page of $last_page </p><div class='clr'></div></div>";
            }
        }
    }

    return $info;
}

/**
 * This is used to upload any file
 *
 * @param $request
 * @param $path
 * @return string
 */
function uploadImage($request, $path)
{
    $fileName = '';
    if ($request->hasFile('file')) {
        $fileName = $request->file->hashName();
        $image = $request->file('file');
        $destinationPath = public_path($path);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $image->move($destinationPath, $fileName);
    }

    return $fileName;
}

/**
 * This function returns login user id
 *
 * @return mixed
 */
function loginId()
{
    $id = 0;
    if (\Auth::check())
        $id = \Auth::user()->id;

    return $id;
}

/**
 * This is used to check user is admin or not
 *
 * @param string $user
 * @return bool
 */
function isAdmin()
{
    $isAdmin = false;
    if (\Auth::check() && \Auth::user()->user_type == 0) {
        $isAdmin = true;
    }

    return $isAdmin;
}

function isCompany()
{
    $isCompany = false;
    if (\Auth::check() && \Auth::user()->user_type == 1) {
        $isCompany = true;
    }

    return $isCompany;
}

function isCompanyUser()
{
    $isCompanyUser = false;
    if (\Auth::check() && \Auth::user()->user_type == 2) {
        $isCompanyUser = true;
    }

    return $isCompanyUser;
}

function isUserPermit()
{
    $isUserPermit = false;
    if (\Auth::check() && \Auth::user()->is_permission == 1) {
        $isUserPermit = true;
    }

    return $isUserPermit;
}

/**
 * This function returns login user name
 *
 * @return mixed
 */
function loginUserName()
{
    $name = '';
    if (\Auth::check()) {
        $name = \Auth::user()->name;
    }

    return $name;
}

/**
 * This function returns login user image
 *
 * @return mixed
 */
function loginUserImage()
{
    $image = '';
    if (\Auth::check()) {
        $url = asset('images/profile');
        $profileImage = \Auth::user()->image;
        if (!empty($profileImage)) {
            $image = $url . '/' . $profileImage;
        }
    }

    return $image;
}

/**
 * This function returns login user email
 *
 * @return mixed
 */
function loginUserEmail()
{
    $name = '';
    if (\Auth::check())
        $name = \Auth::user()->email;

    return $name;
}

/**
 * This function returns login user phone
 *
 * @return mixed
 */
function loginUserPhone()
{
    $name = '';
    if (\Auth::check())
        $name = \Auth::user()->phone;

    return $name;
}

/**
 * This function returns login user first name
 *
 * @return mixed
 */
function loginFirstName()
{
    $name = '';
    if (\Auth::check())
        $name = \Auth::user()->first_name;

    return $name;
}

/**
 * This function returns login user first name
 *
 * @return mixed
 */
function loginLastName()
{
    $name = '';
    if (\Auth::check())
        $name = \Auth::user()->last_name;

    return $name;
}

/**
 * This function returns login user first name
 *
 * @return mixed
 */
function loginUserDOB()
{
    $dob = '';
    if (\Auth::check())
        $dob = \Auth::user()->date_of_birth;

    return $dob;
}

/**
 * This function returns login user first name
 *
 * @return mixed
 */
function loginUserGender()
{
    $gender = '';
    if (\Auth::check())
        $gender = \Auth::user()->gender;

    return $gender;
}

function databaseDateFromat($date)
{
    return date_format(new \DateTime($date), 'Y-m-d');
}

function manipulateStr($input)
{
    return strrev(ucwords(strrev(ucwords(strtolower($input)))));
}

/**
 * This is used to changed date picker to date time
 *
 * @param $date
 * @return false|string
 */
function databaseDateTimeFromat($date)
{
    return date_format(new \DateTime($date), 'Y-m-d h:i');
}

/**
 * This is used to changed date picker to date time
 *
 * @param $date
 * @return false|string
 */
function scheduleDateTimeFormat($date)
{
    return date_format(new \DateTime($date), 'd/m/Y');
}

/**
 * This is used to format errors
 *
 * @param $data
 *     array:2 [
 * "email" => array:1 [
 * 0 => "The email has already been taken."
 * ]
 * "mobile_number" => array:1 [
 * 0 => "The mobile number has already been taken."
 * ]
 * ]
 * @return array
 *
 * array:2 [
 * 0 => "The email has already been taken."
 * 1 => "The mobile number has already been taken."
 * ]
 */
function formatErrors($data)
{
    $errors = [];
    if (!empty($data)) {
        foreach ($data as $row) {
            if ($row) {
                foreach ($row as $value) {
                    $errors[] = $value;
                }
            }
        }
    }

    return $errors;
}

/**
 * This is used to return random password
 *
 * @return string
 */
function randomPassword($length, $count, $characters)
{

// $length - the length of the generated password
// $count - number of passwords to be generated
// $characters - types of characters to be used in the password

// define variables used within the function
    $symbols = array();
    $passwords = array();
    $used_symbols = '';
    $pass = '';

// an array of different character types
    $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
    $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $symbols["numbers"] = '1234567890';
//    $symbols["special_symbols"] = '!?~@#-_+<>[]{}';

    $characters = explode(",", $characters); // get characters types to be used for the passsword
    foreach ($characters as $key => $value) {
        $used_symbols .= $symbols[$value]; // build a string with all characters
    }
    $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1
    $pass = '';
    for ($p = 0; $p < $count; $p++) {
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $symbols_length); // get a random character from the string with all characters
            $pass .= $used_symbols[$n]; // add the character to the password string
        }
        $passwords[] = $pass;
    }

    return $pass; // return the generated password
}

function generateRandomString($length = 5)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function arrayToObject($d)
{
    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return (object)array_map(__FUNCTION__, $d);
    } else {
        // Return object
        return $d;
    }
}

/**
 * This function is used to return dates by filter type
 *
 * @param $filterType
 * @return array
 */
function getTopFiltersDates($filterType, $topCalendarDate = '') {
    $dates = [];
    $firstDate = '';
    $secondDate = '';
    if ($filterType == 'this-month') {
        $firstDate = date('Y-m-01', strtotime(currentDate()));
        $secondDate = date('Y-m-t', strtotime(currentDate()));
    }
    if ($filterType == 'last-month') {
        $firstDate = date('Y-m-01', strtotime("-1 month"));
        $secondDate = date('Y-m-t', strtotime("-1 month"));
    }
    if ($filterType == 'this-year') {
        $firstDate = date('Y-01-01');
        $secondDate = date('Y-12-31');
    }
    if ($filterType == 'this-week') {
        $now = Carbon::now();
        $firstDate = $now->startOfWeek()->format('Y-m-d');
        $secondDate = $now->endOfWeek()->format('Y-m-d');
    }
    if ($filterType == 'last-week') {
        $firstDate  = Carbon::now()->subDays(7)->startOfWeek();
        $secondDate  = Carbon::now()->subDays(7)->endOfWeek();
    }
    if ($filterType == 'today') {
        $firstDate = currentDate();
    }
    if ($filterType == 'yesterday') {
        $firstDate = databaseDateFromat(Carbon::yesterday());
    }
    if ($filterType == 'by-calendar') {
        $firstDate = databaseDateFromat($topCalendarDate);
    }
    $dates['firstDate'] = databaseDateFromat($firstDate);
    $dates['secondDate'] = !empty($secondDate) ? databaseDateFromat($secondDate) : [];

    return $dates;
}

function viewDateFormat($date)
{
    return date_format(new \DateTime($date), 'd/m/Y');
}

function activity($arr)
{
    \App\Models\Activity::insert($arr);
}

function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    // $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}
