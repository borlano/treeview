<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Worker;
use App\Post;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchPhrase = $request->search['value'];
        $orderColumn = $request->columns[$request->order[0]['column']]['name'];
        $orderDirection = $request->order[0]['dir'];

        //Generate api answer
        $answer['draw'] = $request->draw;

        // Get workers list with pagination, ordering and searching
        $answer['data'] = Worker::with('post')->
            when($searchPhrase, function($query) use($searchPhrase) {
                return $query->where('name', 'like', '%'.$searchPhrase.'%');
            })->
            orderBy($orderColumn, $orderDirection)->
            limit($request->length)->
            offset($request->start)->
            get();

        // Count total records
        $answer['recordsTotal'] = Worker::count();

        // Count records involved in query
        $answer['recordsFiltered'] = Worker::when($searchPhrase, function($query) use($searchPhrase) {
                return $query->where('name', 'like', '%'.$searchPhrase.'%');
            })->count();

        return response()->json($answer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get posts list for select
        $data['posts'] = Post::all();

        // Get possible bosses for select
        $data['bosses'] = Worker::where('post_id', 1)->get();

        return view('admin.worker_create', $data);
    }

    /**
     * Get possible bosses for given worker by ajax.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getBosses(Request $request)
    {
        if ($request->ajax()) {
            // Get possible bosses for given worker for select
            $data['bosses'] = Worker::where('post_id', $request->post_id - 1)->get();

            // Generate view with list of received bosses
            $view['html'] = view('admin.options', $data)->render();

            // Return generated view
            return response()->json($view);
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate received data
        $this->validate($request, [
            'name' => 'required|string',
            'pid' => 'required|integer',
            'post_id' => 'required|integer',
            'salary' => 'required|numeric|min:100|max:1000000',
        ]);

        // Prepare data to store in the database
        $data = $request->except('_token, avatar');

        if($request->hasFile('avatar')) {

            // Generate filename
            $data['avatar'] = (Worker::orderBy('id', 'DESC')->first()->id + 1).'.'.$request->file('avatar')->getClientOriginalExtension();

            Storage::disk('local')->
                putFileAs(
                    '/public/avatars',
                    $request->file('avatar'),
                    $data['avatar'],
                    'public'
                );
        }

        // Store new worker
        $worker = new Worker();
        $worker->fill($data);

        if($worker->save()) {
            return redirect()->route('listWorkers')->with('success', 'Новый пользователь добавлен');
        } else {
            return redirect()->route('listWorkers')->with('error', 'Ошибка добавления пользователя');
        }
    }

    /**
     * Display the specified resource by ajax.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {

            // Get data of given worker
            $data['worker'] = Worker::with('post')->
                where('workers.id', $request->id)->
                first();

            // Generate view with info about given worker
            $view['html'] = view('admin.worker_info', $data)->render();

            // Return generated view
            return response()->json($view);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get worker by given id or fail if he doesn't exist
        $data['worker'] = Worker::findOrFail($id);

        // Get posts list for select
        $data['posts'] = Post::all();

        // Get possible bosses for select
        $data['bosses'] = Worker::where('post_id', $data['worker']->post_id - 1)->get();

        return view('admin.worker_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate received data
        $this->validate($request, [
            'name' => 'required|string',
            'pid' => 'required|integer',
            'post_id' => 'required|integer',
            'salary' => 'required|numeric|min:100|max:1000000',
        ]);

        // Check selected worker
        if ($worker = Worker::find((int)$id)) {

            // Prepare data to store in the database
            $data = $request->except('_token, avatar');

            if($request->hasFile('avatar')) {

                // Generate filename
                $data['avatar'] = $worker->id.'.'.explode('.', $request->file('avatar')->getClientOriginalName())[1];

                Storage::disk('local')->
                    putFileAs(
                        '/public/avatars',
                        $request->file('avatar'),
                        $data['avatar'],
                        'public'
                    );
            }

            // Store new data
            $worker->fill($data);

            if($worker->save()) {
                return redirect()->route('listWorkers')->with('success', 'Новая информация сохранена');
            } else {
                return redirect()->route('listWorkers')->with('error', 'Ошибка изменения пользователя');
            }

        } else {

            // If doesn't exist return with error
            return redirect()->route('listWorkers')->with('error', 'Запись не существует');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get selected worker
        $worker = Worker::find($id);

        if ($worker) {

            // If this worker exist to redirect all his colleagues to his boss
            Worker::where('pid', $worker->id)->update(['pid' => $worker->pid]);

            // Delete selected worker
            $worker->delete();

            // Return to workers list with message
            return redirect()->back()->with('success', 'Запись удалена');
        } else {

            // If doesn't exist return with error
            return redirect()->back()->with('error', 'Запись не существует');
        }
    }
}