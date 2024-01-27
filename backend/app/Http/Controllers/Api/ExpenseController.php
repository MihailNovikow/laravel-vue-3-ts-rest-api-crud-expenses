<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Support\Facades\Redis;

class ExpenseController extends ApiController
{

    public function index()
    {
        $expenses = Expense::all();
        if($expenses) {
         return $this->respondSuccess($expenses);
        } else {
           return $this->respondNotFound();
        }

    }

    public function store(ExpenseRequest $request)
    {
        $expense['date'] = $request->date;
        $expense['sum'] = $request->sum;
        $expense['comment'] = $request->comment;
        $expense = Expense::create($request->validated());
        $expense = Redis::set('expense:'.$expense->id, $expense);
        return $this->respondSuccessCreate($expense);
    }

    public function show($id)
    { 
        $expense = Redis::get('expense:'.$id);
        if(!$expense) {
           $expense = Expense::find($id);  
        }
       
        if($expense) {
            return $this->respondSuccess($expense);
         }
         else {
           return $this->respondNotFound();
        }
    }

    public function update(ExpenseRequest $request, $id)
    {
        $expense = Redis::get('expense:'.$id);
        
        if(!$expense) {
           $expense = Expense::find($id);  
        }
        if($expense) {
           $expense->date = $request->date;
           $expense->sum = $request->sum;
           $expense->comment = $request->comment;
        Redis::del('expense:'.$id);
        $expense->save();
        Redis::set('expense:'.$id, $expense);
       return $this->respondSuccessUpdate($expense);
        }
       else {
           return $this->respondNotFound();
        }
    }

      public function destroy($id)
    {
        $expense = Expense::find($id);
        if($expense) {
        $expense->delete();
        Redis::del('expense:'.$id);
       return $this->respondSuccessDelete($expense);
        }
       else {
           return $this->respondNotFound();
        }
    }
     public function destroyAll()
    {
        $expenses = Expense::all();
        if($expenses) {
       Expense::whereNotNull('id')->delete();
       return $this->respondSuccess($expenses);
        }
       else {
           return $this->respondNotFound();
        }
    }
}
