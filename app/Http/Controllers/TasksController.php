<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;
use App\Models\Item;

class TasksController extends Controller
{
    /**
     * Get the template for creating lists.
     */
    public function complete(Request $req){
        $input = $req->all();
        $res = [
            'listCompleted' => true,
            'listId' => null
        ];

        $task = Item::find($input['taskId']);
        $task->completed = empty($input['completed']) ? false : true;
        $task->save();

        $list = $task->todo_list;
        foreach ($list->items as $item) {
            if (!$item->completed) {
                $res['listCompleted'] = false;
            }
        }

        if ($res['listCompleted']) {
            $list->completed = true;
            $list->save();
            $res['listCompleted'] = true;
            $res['listId'] = $list->id;
        }

        return json_encode($res);
    }
}
