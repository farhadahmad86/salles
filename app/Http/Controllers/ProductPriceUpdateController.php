<?php

namespace App\Http\Controllers;

use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductPriceUpdateController extends Controller
{
    public function product_price_update(Request $request)
    {
        $auth = Auth::user();
        // dd(1);
        $user = Auth::user()->id;
        $userID = DB::table('users')->where('supervisor', $user)->orWhere('id', $user)
        ->where('users_company_id', $auth->users_company_id)
        ->get()
        ->pluck('id');
        $ar = json_decode($request->array);
        $product_category = !isset($request->product_category) && empty($request->product_category) ? (!empty($ar) ? $ar[0]->{'value'} : '') : $request->product_category;
        $product = !isset($request->product) && empty($request->product) ? (!empty($ar) && isset($ar[1]) ? $ar[1]->{'value'} : '') : $request->product;
        $product_group = !isset($request->product_group) && empty($request->product_group) ? (!empty($ar) && isset($ar[2]) ? $ar[2]->{'value'} : '') : $request->product_group;
        $created_by = !isset($request->created_by) && empty($request->created_by) ? (!empty($ar) && isset($ar[3]) ? $ar[3]->{'value'} : '') : $request->created_by;
        // $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) && isset($ar[3]) ? $ar[3]->{'value'} : '') : $request->from_date;
        // $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) && isset($ar[4]) ? $ar[4]->{'value'} : '') : $request->to_date;
        // $search = !isset($request->search) && empty($request->search) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->search;
        $datas = null;
        // if (!empty($product_group)) {
        // dd(1);
        $query = DB::table('product_price')->where('product_price_company_id', $auth->users_company_id);
        $query->join('product', 'product.id', '=', 'product_price.product_price_product_id');
        $query->join('users', 'users.id', '=', 'product_price.product_price_user_id');
        $query->join('product_group', 'product_group.product_group_id', '=', 'product.pro_group_id');
        $query->join('category', 'category.cat_id', '=', 'product.cat_id');
        $query->select('product.*', 'product_price.*', 'users.name', 'product_group.product_group_name', 'category.cat_category');
        $query->orderByDesc('product_price.product_price_created_at');
        $pagination_number = empty($ar) ? 2000 : 30;

        if (!empty($product_group) || !empty($product_category) || !empty($product) || !empty($created_by)) {
            // Add conditions based on the provided parameters
            if (!empty($product_group)) {
                $query->where('product.pro_group_id', '=', $product_group);
            }
            if (!empty($product_category)) {
                $query->where('product.cat_id', '=', $product_category);
            }
            if (!empty($product)) {
                $query->where('product.id', '=', $product);
            }
            if (!empty($created_by)) {
                $query->where('product.user_id', '=', $created_by);
            }
            $datas = $query->paginate($pagination_number);
        }
        if (Auth::user()->role == 'Supervisor') {
            $query->whereIn('product_price_user_id', $userID);
        }
        if (Auth::user()->role == 'Supervisor') {
            $query->where('product_price_user_id', $user);
        }
        // dd($datas);
        // if(!empty($product_group)) {
        //     $query->where('product_group.product_group_id', '=', $product_group);
        // }
        // if(!empty($product_category)) {
        //     $query->where('product.cat_id', '=', $product_category);
        // }
        // if(!empty($product)) {
        //     // $query->where('product_price.product_price_product_id', '=', $product);
        // }
        // if(!empty($product_group)) {
        //     $query->where('product_group.product_group_id', '=', $product_group);
        // }
        // if(!empty($product)) {
        //     // $query->where('product_price.product_price_product_id', '=', $product);
        // }

        // $datas = $query->get();

        // dd($datas);
        // }

        // if (!empty($product_category)) {
        //     $query = DB::table('product_price');
        //     $query->join('product', 'product.id', '=', 'product_price.product_price_product_id');
        //     $query->join('users', 'users.id', '=', 'product_price.product_price_user_id');
        //     $query->join('product_group', 'product_group.product_group_id', '=', 'product.pro_group_id');
        //     $query->join('category', 'category.cat_id', '=', 'product.cat_id');
        //     $query->select('product.*', 'product_price.*', 'users.name', 'product_group.product_group_name', 'category.cat_category');

        //     $query->where('product.cat_id', '=', $product_category);
        //     $query->orderByDesc('product_price.product_price_created_at');
        //     $pagination_number = empty($ar) ? 30 : 100000000;
        //     if (Auth::user()->role == 'Supervisor') {
        //         $query->whereIn('product_price_user_id', $userID);
        //     }
        //     if (Auth::user()->role == 'Supervisor') {
        //         $query->where('product_price_user_id', $user);
        //     }
        //     $datas = $query->paginate($pagination_number);
        // }

        // if (!empty($product)) {
        //     $query = DB::table('product_price');
        //     $query->join('product', 'product.id', '=', 'product_price.product_price_product_id');
        //     $query->join('users', 'users.id', '=', 'product_price.product_price_user_id');
        //     $query->join('product_group', 'product_group.product_group_id', '=', 'product.pro_group_id');
        //     $query->join('category', 'category.cat_id', '=', 'product.cat_id');
        //     $query->select('product.*', 'product_price.*', 'users.name', 'product_group.product_group_name', 'category.cat_category');

        //     $query->where('product_price.product_price_product_id', '=', $product);
        //     $query->orderByDesc('product_price.product_price_created_at');
        //     $pagination_number = empty($ar) ? 30 : 100000000;
        //     if (Auth::user()->role == 'Supervisor') {
        //         $query->whereIn('product_price_user_id', $userID);
        //     }
        //     if (Auth::user()->role == 'Supervisor') {
        //         $query->where('product_price_user_id', $user);
        //     }
        //     $datas = $query->paginate($pagination_number);
        // }

        // if (!empty($created_by)) {
        //     $query = DB::table('product_price');
        //     $query->join('product', 'product.id', '=', 'product_price.product_price_product_id');
        //     $query->join('users', 'users.id', '=', 'product_price.product_price_user_id');
        //     //        $query->join('unit', 'unit.unit_id', '=', 'product_price.product_price_unit');
        //     $query->join('product_group', 'product_group.product_group_id', '=', 'product.pro_group_id');
        //     $query->join('category', 'category.cat_id', '=', 'product.cat_id');
        //     $query->select('product.*', 'product_price.*', 'users.name', 'product_group.product_group_name', 'category.cat_category');

        //     $query->where('product_price.product_price_user_id', '=', $created_by);
        //     $query->orderByDesc('product_price.product_price_created_at');
        //     $pagination_number = empty($ar) ? 30 : 100000000;
        //     if (Auth::user()->role == 'Supervisor') {
        //         $query->whereIn('product_price_user_id', $userID);
        //     }
        //     if (Auth::user()->role == 'Supervisor') {
        //         $query->where('product_price_user_id', $user);
        //     }
        //     $datas = $query->paginate($pagination_number);
        // }

        // if (!empty($from_date)) {
        //     $query->where('product_price.product_price_created_at', '>=', date($from_date));
        // }
        // if (!empty($to_date)) {
        //     $query->where('product_price.product_price_created_at', '<=', date($to_date));
        // }
        // if (!empty($search)) {
        //     $query->where(function ($query) use ($search) {
        //         $query->orWhere('product.product_name', 'like', '%' . $search . '%');
        //         $query->orWhere('product_price.product_price_sale', 'like', '%' . $search . '%');
        //         $query->orWhere('product_price.product_price_unit', 'like', '%' . $search . '%');
        //         $query->orWhere('product_price.product_price_purchase', 'like', '%' . $search . '%');
        //         $query->orWhere('product_price.product_price_created_at', 'like', '%' . $search . '%');
        //         $query->orWhere('name', 'like', '%' . $search . '%');
        //     });
        // }
        $reminder = DB::table('company')
            ->where('user_id', Auth::user()->id)
            ->where('company_company_id', $auth->users_company_id)
            ->select('user_id')
            ->get();
        $all_created_by = DB::table('users')
            ->whereIn('id', DB::table('product_price')->pluck('product_price_user_id')->all())
            ->where('users_company_id', $auth->users_company_id)
            ->get();
        $all_product_group = DB::table('product_group')
            ->whereIn('product_group_id', DB::table('product_group')->pluck('product_group_id')->all())
            ->where('product_group_company_id', $auth->users_company_id)
            ->get();
        $all_product = DB::table('product')
            ->whereIn('id', DB::table('product')->pluck('id')->all())
            ->where('product_company_id', $auth->users_company_id)
            ->get();
        $all_product_category = DB::table('category')
            ->whereIn('cat_id', DB::table('product')->pluck('cat_id')->all())
            ->where('category_company_id', $auth->users_company_id)
            ->get();
        // dd($datas);
        if ($datas == null || empty($datas->items())) {
            // $datas is either null or empty
            $count_row = 0;
            // dd(1);
        } else {
            // $datas is not null and not empty
            $count_row = 1;
            // dd($datas, $count_row);
        }
        //            PRINT
        // $prnt_page_dir = 'print.pages.p_productPrice';
        // $pge_title = 'Product Price List';
        // $srch_fltr = [];
        // array_push($srch_fltr, $created_by, $from_date, $to_date);
        // $type = '';
        // if (isset($request->array) && !empty($request->array)) {
        //     $type = isset($request->str) ? $request->str : '';
        //     $footer = view('print._partials.pdf_footer')->render();
        //     $header = view('print._partials.pdf_header', compact('pge_title', 'srch_fltr'))->render();
        //     $options = [
        //         'footer-html' => $footer,
        //         'header-html' => $header,
        //     ];
        //     $pdf = PDF::loadView($prnt_page_dir, compact('datas', 'count_row', 'reminder', 'type', 'pge_title'));
        //     $pdf->setOptions($options);
        //     if ($type === 'pdf') {
        //         return $pdf->stream($pge_title . '_x.pdf');
        //     } elseif ($type === 'download_pdf') {
        //         return $pdf->download($pge_title . '_x.pdf');
        //     } elseif ($type === 'download_excel') {
        //         return Excel::download(new ExcelFileCusExport($datas, $srch_fltr, $type, $prnt_page_dir, $pge_title, $count_row), $pge_title . '_x.xlsx');
        //     }
        // } else {
        return view('productPrice.productPriceUpdate', compact('datas', 'count_row', 'all_product_group', 'all_product_category', 'product_category', 'all_product', 'product', 'all_created_by', 'created_by', 'product_group'));
        // }
    }
    public function update_product_price(Request $request)
    {
        $auth = Auth::user();
        // dd($request->all());
        $ids = $request->input('id');
        $purchasePrices = $request->input('purchase_price');
        $salePrices = $request->input('sale_price');

        foreach ($ids as $index => $id) {
            $storeProductPrice = ProductPrice::find($id);
            $storeProductPrice->product_price_purchase = $purchasePrices[$index];
            $storeProductPrice->product_price_sale = $salePrices[$index];
            $storeProductPrice->product_price_updated_at = now(); // Use Carbon::now() if not using Laravel 8+
            // ... other updates if needed ...

            $storeProductPrice->save();
        }

        return redirect('/product_price_update')->with('success', 'Successfully Updated');
    }
}
