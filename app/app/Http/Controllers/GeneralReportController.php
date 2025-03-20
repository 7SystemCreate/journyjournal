<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Report;
use App\Http\Requests\CreateReport;

use Illuminate\Support\Facades\Auth;

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
        /*
        $report->report_reason = $request->report_reason;
        $report->post_id = $request->post_id;

        $report->save();
        */
        $columns = ['report_reason', 'post_id'];
        foreach($columns as $column) {
            $report->$column = $request->$column;
        }

        Auth::user()->report()->save($report);

        $post = Post::find($request->post_id);
        $post->report_flg += 1; // 通報回数を増やす
        $post->save(); // 変更を保存

        return view('report_comp');
    }

}
