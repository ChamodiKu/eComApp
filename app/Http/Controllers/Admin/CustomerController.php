<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Admin\CustomerInterface;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    private CustomerInterface $customerInterface;

    public function __construct(CustomerInterface $customerInterface)
    {
        $this->customerInterface = $customerInterface;
    }

    /**
     * View all customers data
     */
    public function index($request)
    {
        try {
            if (Auth::user()->can('customer-view')) {
                $customers = $this->customerInterface->index($request);

                $customers = Customer::getAllCustomersForFilter($request);

                return view ('admin.customer.all_customers', compact('customers'));
            } else {
                return view('admin.errors.403_forbidden');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            if (Auth::user()->can('customer-delete')) {
                DB::beginTransaction();

                $customer = $this->customerInterface->destroy($id);
                Customer::destroy($id);
                DB::commit();

                return response()->json(['status' => 200, 'message' => 'Customer deleted successfully !']);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Status change of the specified resource.
     */
    public function changeStatus(Request $request, $id)
    {
        try {
            if (Auth::user()->can('customer-status')) {
                DB::beginTransaction();

                $customer = $this->customerInterface->changeStatus($request,$id);
                $customer = Customer::find($id);

                $customer->is_active = $request->is_active;
                $customer->save();
                DB::commit();

                return response()->json(['status' => 200, 'message' => 'Customer status changed successfully !']);
            } else {
                return response()->json(['status' => 500, 'message' => 'You don\'t have permissions to preview this page. Kindly contact your Administrator.']);
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => $exception->getMessage()]);
        }
    }
}
