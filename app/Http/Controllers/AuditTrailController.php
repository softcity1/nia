<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('audit-trail.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showData(Request $request)
    {
        //        $adSpace = $adSpace->get()->toArray();
//        $data = makePagination($adSpace, $perPage, $page);
//        $pager = paginationView($data, count($adSpace));
        return view('audit-trail.index');
    }

    /**
     * get a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAuditTrail(Request $request)
    {
        $data = [];
        $pager = '';
        $page = $request->input('page');
        $perPage = $request->input('per_page');
        $auditTrail = Activity::select('id', 'title', 'status',
            'created_at')
            ->orderBy('created_at', 'desc')
            ->where('is_suspend', 0)
            ->where('id', '<>', loginId());
        if (isAdmin()) {
            $auditTrail = Activity::select('id', 'title', 'status',
                'created_at');
        }
        if (!empty($auditTrail)) {
            $auditTrail = $auditTrail->get()->toArray();
            foreach ($auditTrail as $key => $row) {
                $auditTrail[$key]['created_at'] = viewDateFormat($row['created_at']);
            }
            $data = makePagination($auditTrail, $perPage, $page);
            $pager = paginationView($data, count($auditTrail));
        }

        return response()->json(['data' => $data, 'pager' => $pager]);
    }
}
