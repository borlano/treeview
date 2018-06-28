<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;

class IndexController extends Controller
{
    public function index()
    {
        $workers = Worker::with('post')->whereIn('post_id', [1,2])->get();

        $data = [];
        foreach ($workers as $key => $worker)
        {
            if($worker->pid == 0)
            {
                $data['workers']['first'][$worker->id] = $worker;
            }
            else
            {
                $data['workers']['second'][$worker->pid][$worker->id] = $worker;
            }
        }

        return view('tree', $data);
    }

    public function getBrunch(Request $request)
    {
        if ($request->ajax()) {
            // Get possible bosses for given worker for select
            $data['workers'] = Worker::where('pid', $request->id)->get();

            // Generate view with list of received bosses
            $view['html'] = (count($data['workers']) > 0) ? view('brunch', $data)->render() : '';

            // Pass id to the view
            $view['id'] = $request->id;

            // Return generated view
            return response()->json($view);
        } else {
            abort(404);
        }
    }
}