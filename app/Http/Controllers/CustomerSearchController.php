<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\CustomerSearchPost;
use App\MyServices\MyApplicationService;
use Illuminate\Http\Request;
use My_func;

class CustomerSearchController extends Controller
{
    protected $myApplicationService;
    private $validated;

    public function __construct()
    {
        $this->myApplicationService = app()->make(MyApplicationService::class);
   //???     $this->myApplicationService = app()->make('myapplicationservice');
    }

     /**
     * 顧客を検索して表示する
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        $id = $request->query('page');

        if (!empty($id)){
            
            //var_dump($name, $age_from, $age_to, $id);
            $wheres = $request->session()->get('wheres');
            $customers = Customer::where($wheres)->paginate(8);
            $search_criterias = $request->session()->get('search_criterias');

            $data = [
                'name' => $request->session()->get('name'),             // 氏名      
                'age_from' =>  $request->session()->get('age_from'),    //年齢下限
                'age_to' =>   $request->session()->get('age_to'),       //年齢上限
                'customers'=> $customers,
                'search_criterias' => $search_criterias,
            ];

            return view('customer_search', $data);

        }  else {

            My_func::session_clear($request);
      /*      $request->session()->forget('name');
            $request->session()->forget('age_from');
            $request->session()->forget('age_to');  
            $request->session()->forget('wheres');  
            $request->session()->forget('search_criterias');  */

            return view('customer_search');
        }
  
        
    }

    public function search(CustomerSearchPost $request, MyApplicationService $myApplicationService)
    {
 
        $validated = $request->validated();
        $wheres = [];
        $search_criterias = [];

        My_func::session_clear($request);
   /*     $request->session()->forget('name');
        $request->session()->forget('age_from');
        $request->session()->forget('age_to');  
        $request->session()->forget('wheres');  
        $request->session()->forget('search_criterias');  */

         // 氏名の指定は有るか
        if (!empty($validated['name'])) {
            $name =  $validated['name'];
            array_push($wheres, ['name', 'like', '%'.$name.'%']);
            $request->session()->put('name', $validated['name']);


          //???  array_push($wheres, ['name', '=', $validated['name']]);
            array_push($search_criterias, '氏名が' . $validated['name'] . 'に一致する');
            
        }
        // 年齢 from の指定は有るか
        if (!empty($validated['age_from'])) {
            $ages = $myApplicationService->getBirthdayRange(($validated['age_from']));
            array_push($wheres, ['birthdate', '<=', $ages['end']]);
            $request->session()->put('age_from', $validated['age_from']);
        }

        // 年齢 to の指定は有るか
        if (!empty($validated['age_to'])) {
            $ages = $myApplicationService->getBirthdayRange(($validated['age_to']));
            array_push($wheres, ['birthdate', '>=', $ages['end']]);
            $request->session()->put('age_to', $validated['age_to']);
        }

        $customers = Customer::where($wheres)->paginate(8);
        $request->session()->put('wheres', $wheres);
        $request->session()->put('search_criterias', $search_criterias);

        $data = [
            'name' => $request->session()->get('name'), //検索キーワード      
            'age_from' =>  $request->session()->get('age_from'), //検索キーワード
            'age_to' =>   $request->session()->get('age_to'), //検索キーワード
            'customers'=> $customers,
            'search_criterias' => $search_criterias,
        ];
        return view('customer_search', compact('customers', 'search_criterias', 'validated'), $data);

    }

    
}
