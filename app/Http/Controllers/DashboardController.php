<?php

namespace App\Http\Controllers;

use App\Models\ExcelUpload;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Symfony\Component\Translation\t;

class DashboardController extends Controller
{
    private $success = false;
    private $message = '';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * This is used to import excel data
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $title = 'upload a new excel file';
        if ($request->hasFile('file')) {
            $fileSize = $request->file('file')->getSize() / 1024;
            $fileSize = $fileSize / 1024;
            $profileImage = uploadImage($request, 'images/file');
            $data['file'] = $profileImage;
            $data['file_size'] = !empty($fileSize) ? round($fileSize, 2).'mbs' : '';
            $data['original_name'] = $request->file->getClientOriginalName();
            $data['user_id'] = loginId();
            ExcelUpload::insert($data);
            $this->success = true;
            $this->message = 'File Uploaded Successfully';
        }
        $arr = [];
        $arr['title'] = loginUserName().' '.$title;
        $arr['status'] = $this->success == true ? 'Successful' : 'Unsuccessful';
        $arr['created_at'] = now();
        $arr['updated_at'] = now();
        activity($arr);

        return response()->json(['success' => $this->success, 'message' => $this->message]);
    }

    /**
     *
     *  This is used to get files data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFiles(Request $request)
    {
        $data = [];
        $pager = '';
        $page = $request->input('page');
        $perPage = $request->input('per_page');
        $file = ExcelUpload::get()->toArray();
        if (!isAdmin()) {
            $file = ExcelUpload::where('user_id', loginId())->get()->toArray();
        }
        if (!empty($file)) {
            foreach ($file as $key => $row) {
                $file[$key]['created_at'] = viewDateFormat($row['created_at']);
            }
            $data = makePagination($file, $perPage, $page);
            $pager = paginationView($data, count($file));
        }

        return response()->json(['data' => $data, 'pager' => $pager]);
    }
}
