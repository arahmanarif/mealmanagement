<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Meal;
use App\Models\Details;
use App\Models\Deposite;
use App\Models\Count_meals;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MealController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Count_meals::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<div class="dropdown table-dropdown" id="accordion">';
                    $html .= '<a href=" ' . route('meal.edit', $row->id) . '" id="EditMeal" class="action-btn p-2"><i class="fa-solid fa-pen-to-square text-success"></i></a>';
                    $html .= '</div>';
                    return $html;
                })
                ->editColumn('total', function ($row) {
                    return $row->breakfast + $row->lunch + $row->dinner;
                })
                ->setRowData([
                    'total' => function ($row) {
                        return 'row' . $row->id;
                    },
                ])
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $meal = new Count_meals();
        $meal->name = $request->name;
        $meal->breakfast = $request->breakfast;
        $meal->lunch = $request->lunch;
        $meal->dinner = $request->dinner;
        $meal->date = $request->date;
        $meal->save();
        return response()->json('Meal added successfully!');
    }

    public function edit($id){
        $members = Meal::all();
        $newmember = Count_meals::where('id', $id)->first();
        return view('partials.ajax_view.edit_meal', compact('members', 'newmember'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required'
        ]);
        $meal = Count_meals::find($id);
        $meal->name = $request->name;
        $meal->breakfast = $request->breakfast;
        $meal->lunch = $request->lunch;
        $meal->dinner = $request->dinner;
        $meal->date = $request->date;
        $meal->save();
        return response()->json('Meal updated successfully!');
    }

    public function detailsIndex(Request $request){
        if ($request->ajax()) {
            $data = Deposite::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<div class="dropdown table-dropdown" id="accordion">';
                    $html .= '<a href="" id="edit" class="action-btn p-3" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>';
                    $html .= '</div>';
                    return $html;
                })
                // ->editColumn('total', function ($row) {
                //     return $row->breakfast + $row->lunch + $row->dinner;
                // })
                // ->setRowData([
                //     'total' => function ($row) {
                //         return 'row-' . $row->id;
                //     },
                // ])
                ->editColumn('name', function ($row) {
                    // Log::info($row->relatioToMeal);
                    return $row->relatioToMeal->name ?? 'N/A';
                })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
    }



}
