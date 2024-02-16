<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class validateCreateTaskData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->get('task_data'), [
            'title' => 'required|unique:tasks|max:100',
            'description' => 'required|max:255',
            'priority' => 'required|numeric|between:1,100',
            'due_at' => 'required|date|after:today',
        ]);
        if($validator->fails()){
            return redirect('/');
        }
        return $next($request);
    }
}
