<?php

namespace App\Http\Controllers;

use App\Models\pesanan;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware('akses');
    }


    public function index(Request $request)
    {

        $role = $request->role;
        $produk = produk::get();
        // dd($produk);

        return view('page.produk', compact('produk', 'role'));

    }

    public function store(Request $request)
    {
        $ids = $request->id_produk;
        $names = $request->nama;
        $prices = $request->harga;
        $units = $request->satuan;
    
        foreach ($ids as $key => $id) {
           
            if (!empty($names[$key]) && !empty($prices[$key]) && !empty($units[$key])) {
                $prod = Produk::find($id);
    
                if (!$prod) {
                    $prod = new Produk();
                }
    
                $prod->nama = $names[$key];
                $prod->harga = $prices[$key];
                $prod->satuan = $units[$key];
    
                $prod->save();
            }
        }
    
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
    

    public function produk_create(Request $request){
        $role = $request->role;
        return view('page.produk_create', compact('role'));
    }
    public function store_produk(Request $request)
    {
        try {
            $role = $request->role;
            $names = $request->nama;
            $prices = $request->harga;
            $units = $request->satuan;
        
            // Validasi jika ada data yang kosong
            foreach ($names as $key => $name) {
                if (empty($name) || empty($prices[$key]) || empty($units[$key])) {
                    return redirect()->back()->withInput()->withErrors('Semua kolom harus diisi');
                }
            }
        
            // Simpan data
            foreach ($names as $key => $name) {
                $prod = new Produk();
                $prod->nama = $name;
                $prod->harga = $prices[$key];
                $prod->satuan = $units[$key];
                $prod->save();
            }
        
            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors('Gagal menyimpan data: ' . $e->getMessage());
        }
    }
    
    
   

    public function produkcheck(Request $request)
    {

        $role = $request->role;
        $produk = produk::get();
        // dd($produk);

        return view('page.produkcheck', compact('produk', 'role'));
    }

    public function pesan(Request $request)
    {

        $id_produk = $request->id_produk;
        $harga = $request->harga;
        $quantity = $request->quantity;
        $total = $request->total;

        // foreach($id_produk as $key => $produk){
        //     $pesan = new pesanan();
        //     $pesan->id_produk = $produk;
        //     $pesan->harga = $harga[$key];
        //     $pesan->quantity = $quantity[$key];

        //     if ($quantity[$key] > 0) {
        //         $pesan->total = $total[$key];
        //         $pesan->save();
        //     }       
        // }

        // penggunaan for
        $count = count($id_produk);
        for ($i = 0; $i < $count; $i++) {
            $pesan = new pesanan();
            $pesan->id_produk = $id_produk[$i];
            $pesan->harga = $harga[$i];
            $pesan->quantity = $quantity[$i];

            if ($quantity[$i] > 0) {
                $pesan->total = $total[$i];
                $pesan->save();
            }
        }
        return redirect()->back()->with('success', 'berhasil dipesan');

    }

    public function produkdata(Request $request)
    {
        $role = $request->role;
        $produk = produk::all();
        return view('page.produk_data', compact('produk', 'role'));

    }

    public function produkcart(Request $request, $id)
    {
        $product = produk::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "nama" => $product->nama,
                "quantity" => 1,
                "satuan" => $product->satuan,
                "harga" => $product->harga
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }


    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function keranjang(Request $request)
    {

        $role = $request->role;
        return view('page.cart', compact('role'));
    }


    public function checkout(Request $request)
{
    $role = $request->role;
    $cart = session()->get('cart');

    if (empty($cart)) {
        // return redirect()->back()->with('error', 'Data anda tidak ada');
        return redirect()->route($role . '.produk.data')->with('error', 'Data anda tidak ada');

    }

    $o = Pesanan::select(DB::raw('MAX(RIGHT(kode_pesanan, 4)) as kode'))->first();
    $nama = "ichsan";
    $kd = "";

    if ($o && $o->kode) {
        $tmp = ((int) $o->kode + 1);
        $kd = date('d-m-Y') . '-' . sprintf("%04s", $tmp);
    } else {
        $kd = date('d-m-Y') . '-0001';
    }

    $data = [];
    $pesanan = Pesanan::where('kode_pesanan', $nama)->first();

    if ($pesanan) {
        session()->forget('cart');
        return redirect()->route($role . '.produk.data');
    } else {
        foreach ($cart as $item) {
            $data['id_produk'] = $item['id'];
            $data['harga'] = $item['harga'];
            $data['quantity'] = $item['quantity'];
            $data['total'] = $item['harga'] * $item['quantity'];
            $data['kode_pesanan'] = $kd;
            $data['username'] = $nama;

            Pesanan::create($data);
        }
        session()->forget('cart');
        return redirect()->route($role . '.produk.data');
    }
}


}


