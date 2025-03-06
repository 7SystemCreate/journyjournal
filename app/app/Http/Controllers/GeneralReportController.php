<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Report;
use App\Http\Requests\CreateReport;

class GeneralReportController extends Controller
{
    public function postReport(Post $post) {

        return view('report', [
            'post' => $post,
        ]);
    }

    public function reportConf(CreateReport $request, Post $post){

        $postId = $request->input('post_id');
        $post = Post::find($postId);

        $report = new Report;

        $report->report_reason = $request->report_reason;
        
        return view('report_conf', [
            'post' => $post,
            'report' => $report,
        ]);
    }

    public function reportComp(Request $request){

        $report = new Report;

        $report->report_reason = $request->report_reason;
        $report->post_id = $request->post_id;

        $report->save();

        return view('report_comp');
    }

}
