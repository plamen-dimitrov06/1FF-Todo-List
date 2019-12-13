<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;
use App\Models\Item;

class ListsController extends Controller
{
    /**
     * Get the template for creating lists.
     */
    public function create(){
        return view('list.create');
    }

    /**
     * Get the template for creating lists.
     */
    public function edit($id){
        return view('list.edit', ['list' => TodoList::findOrFail($id)]);
    }

    /**
     * Create the list with it's items.
     *
     * @param Illuminate\Http\Request $req
     */
    public function save(Request $req) {
        $input = $req->all();

        $list = TodoList::create(['title' => $input['title']]);
        $task = Item::create([
            'title'         => $input['taskTitle'],
            'todo_list_id'  => $list->id,
            'deadline'      => date("Y-m-d H:i:s", strtotime($input['deadline'])),
        ]);

        return redirect()->route('index', ['message' => 'List created successfully!']);
    }

    /**
     * Update the list with the new data.
     *
     * @param Illuminate\Http\Request $req
     * @param $id
     */
    public function update(Request $req, $id) {
        $input = $req->all();
        $list = TodoList::find($id);

        if ($list->title != $input['title']) {
            $list->title = $input['title'];
            $list->save();
        }

        foreach ($list->items as $item) {
            $item->title = $input['taskTitle'][$item->id];
            $item->deadline = $input['deadline'][$item->id];
            $item->active = empty($input['active'][$item->id]) ? false : true;

            $item->save();
        }

        if (!empty($input['newTitle'])) {
            for ($i=0; $i < count($input['newTitle']); $i++) {
                Item::create([
                    'title'         => $input['newTitle'][$i],
                    'todo_list_id'  => $list->id,
                    'deadline'      => date("Y-m-d H:i:s", strtotime($input['newDeadline'][$i])),
                    'active'        => empty($input['newActive'][$i]) ? false : true,
                ]);
            }
        }

        return redirect()->route('list.edit', ['id' => $list->id]);
    }

    /**
     * Delete a list.
     */
    public function delete(Request $req){
        $input = $req->all();
        $list = TodoList::find($input['id']);

        foreach ($list->items as $item) {
            $item->delete();
        }

        $list->delete();

        return redirect()->route('index', ['lists' => TodoList::all()]);
    }
}
