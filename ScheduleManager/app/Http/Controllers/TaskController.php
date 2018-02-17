<?php
/**
 * Created by PhpStorm.
 * User: motoyoshiyuta
 * Date: 2018/02/17
 * Time: 17:19
 */

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get()
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();
        return view('tasks', [
            'tasks' => $tasks
        ]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function create(Request $request)
    {
        // Validation::makeが無いので一旦コメントアウト
        // バリデーション
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|max:255',
//        ]);
//
//        if ($validator->fails()){
//            return redirect('/')
//                ->withInput()
//                ->withErrors($validator);
//        }

        // task追加処理
        $task = new Task();
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    }

    /**
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function delete(Task $task)
    {
        $task->delete();

        return redirect('/');
    }
}