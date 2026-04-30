<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
class CustomerController extends Controller {
    public function index() {
        Gate::authorize('viewAny',Customer::class);
        $query = $this->query();
        $customers = request('perPage')
            ? $query->paginate(request('perPage'))
            : $query->get();
        return CustomerResource::collection($customers);
    }
    public function store(StoreCustomerRequest $request) {
        Gate::authorize('create',Customer::class);
        $data = $request->validated();
        $customer = Customer::create($data);
        return CustomerResource::make($customer);
    }
    public function show(Customer $customer) {
        Gate::authorize('view',$customer);
        return CustomerResource::make($customer);
    }
    public function update(UpdateCustomerRequest $request, Customer $customer) {
        Gate::authorize('update',$customer);
        $data = $request->validated();
        $customer->update($data);
        return CustomerResource::make($customer);
    }
    public function destroy(Customer $customer) {
        Gate::authorize('delete',$customer);
        $customer->delete();
        return response()->noContent();
    }
    public function restore(Customer $customer){
        Gate::authorize('restore',$customer);
        $customer->restore();
        return CustomerResource::make($customer);
    }
    public function forceDelete(Customer $customer){
        Gate::authorize('forceDelete',$customer);
        $customer->forceDelete();
        return response()->noContent();
    }
    private function query():Builder{
        $query = Customer::query();
        if(request('filters')){
            foreach (request('filters') as $column => $conditions) {
                foreach ($conditions as $operator => $value) {
                    match ($operator) {
                        'like' => $query->where($column,'like',"%$value%"),
                        '!=','=','<','<=','>','>=' => $query->where($column,$operator,$value),
                    };
                }
            }
        }
        if(request('select'))
            $query->select(explode(',',request('select')));
        if(request('sort')){
            foreach (explode(',',request('sort')) as $column) {
                $direction = str_starts_with($column,'-') ? 'desc' : 'asc';
                $column = ltrim($column,'-');
                $query->orderBy($column,$direction);
            }
        }
        if(request('include'))
            $query->with(explode(',',request('include')));
        return $query;
    }
}