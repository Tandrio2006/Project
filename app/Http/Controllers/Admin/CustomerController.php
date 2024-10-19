<?php

namespace App\Http\Controllers\Admin;
use App\Exports\AdminExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\CustomerExport;
use App\Models\Customer;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index()
    {

        return view('customer.indexcustomer');
    }
    public function getCustomerData(Request $request)
    {
        $data = Customer::select([
            'Username',
            'Email',
            'Wa',
            'Bank',
            'NamaRek',
            'NoRek',
            'id'
        ])
            ->orderBy('id', 'desc')
            ->limit(200)
            ->get();

        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<a class="btn btnUpdateCustomer btn-sm btn-secondary ml-1" data-id="' . $row->id . '"><i class="fas fa-edit"></i></a>' .
                    '<a class="btn btnDestroyCustomer btn-sm btn-danger ml-1" data-id="' . $row->id . '"><i class="fas fa-trash"></i></a>' ;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function addCustomer(Request $request)
    {
        $request->validate([
            'Username' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:tbl_customer,Email',
            'Wa' => 'required|string|max:15',
            'Bank' => 'nullable|string|max:255',
            'NamaRek' => 'nullable|string|max:255',
            'NoRek' => 'nullable|string|max:255',
        ]);

        try {
            $Customer = new Customer();
            $Customer->Username = $request->input('Username');
            $Customer->Email = $request->input('Email');
            $Customer->Wa = $request->input('Wa');
            $Customer->Bank = $request->Bank ?? null; 
            $Customer->NamaRek = $request->NamaRek ?? null;
            $Customer->NoRek = $request->NoRek ?? null;

            $Customer->save();

            return response()->json(['success' => 'Customer berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menambahkan customer']);
        }
    }

    public function updateCustomer(Request $request, $id)
    {
        $validated = $request->validate([
            'Username' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:tbl_customer,Email,' . $id,
            'Wa' => 'required|string|max:15',
           'Bank' => 'nullable|string|max:255',
            'NamaRek' => 'nullable|string|max:255',
            'NoRek' => 'nullable|string|max:255',
        ]);

        try {
            $Customer = Customer::findOrFail($id);
            $Customer->Username = $request->input('Username');
            $Customer->Email = $request->input('Email');
            $Customer->Wa = $request->input('Wa');
            $Customer->Bank = $request->Bank ?? null; 
            $Customer->NamaRek = $request->NamaRek ?? null;
            $Customer->NoRek = $request->NoRek ?? null;

            $Customer->update($validated);

            return response()->json(['success' => true, 'message' => 'Customer berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['error' => false, 'message' => 'Gagal memperbarui customer']);
        }
    }
    public function destroyCustomer($id)
    {
        try {
            $Customer = Customer::findOrFail($id);

            $Customer->delete();

            return response()->json(['status' => 'success', 'message' => 'Customer berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $Customer = Customer::findOrFail($id);
        return response()->json($Customer);
    }
    public function export()
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }
    public function getAdminData(Request $request)
    {
        $data = User::select([
            'name',
            'email',
            'id'
        ])
            ->orderBy('id', 'desc')
            ->limit(100)
            ->get();

        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '<a class="btn btnUpdateAdmin btn-sm btn-secondary" data-id="' . $row->id . '"><i class="fas fa-edit"></i></a>' .
                    '<a class="btn btnDestroyAdmin btn-sm btn-danger ml-1" data-id="' . $row->id . '"><i class="fas fa-trash"></i></a>' ;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function addAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        try {
            $Admin = new User();
            $Admin->name = $request->input('name');
            $Admin->email = $request->input('email');
            $Admin->password = bcrypt($request->input('password'));
            $Admin->save();

            return response()->json(['success' => 'Admin berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menambahkan customer']);
        }
    }

    public function updateAdmin(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:8',
        ]);

        try {
            $Admin = User::findOrFail($id);
            $Admin->name = $request->input('name');
            $Admin->email = $request->input('email');
            $Admin->password = bcrypt($request->input('password'));

            $Admin->update($validated);

            return response()->json(['success' => true, 'message' => 'Admin berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['error' => false, 'message' => 'Gagal memperbarui customer']);
        }
    }
    public function destroyAdmin($id)
    {
        try {
            $Admin = User::findOrFail($id);

            $Admin->delete();

            return response()->json(['status' => 'success', 'message' => 'Admin berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function shows($id)
    {
        $Admin = User::findOrFail($id);
        return response()->json($Admin);
    }
    public function exportAdmin()
    {
        return Excel::download(new AdminExport, 'admin.xlsx');
    }
}