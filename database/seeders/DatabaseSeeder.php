<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ikan;
use App\Models\Pembayaran;
use App\Models\Pembelian;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // user
        User::factory()->count(30)->create();

        // categories
        $fishNames = ['Lele', 'Nila', 'Gurame', 'Mas', 'Patin', 'Kakap', 'Tuna', 'Sardine'];

        // Loop untuk memasukkan data produk
        foreach ($fishNames as $fishName) {
            Category::create([
                'nama' => $fishName,
                'gambar' => 'images/categories/1738406431.jpg', // Path gambar
                // Timestamps akan otomatis diisi jika kolom ada di migration
            ]);
        }

        // ikan
        $fishNames = ['Lele', 'Nila', 'Gurame', 'Mas', 'Patin', 'Kakap', 'Tuna', 'Sardine'];

        $categoryId = 1;
        foreach ($fishNames as $index => $fishName) {
            Ikan::create([
                'id_cate' => $categoryId,
                'nama' => $fishName,
                'deskripsi' => 'Ikan ' . $fishName . ' segar dan berkualitas tinggi.',
                'stock' => rand(10, 100), // Stok acak antara 10-100
                'min_pembelian' => rand(1, 5), // Minimal pembelian acak antara 1-5
                'harga' => 25000,
                'gambar' => 'images/categories/1738406431.jpg', // sesuaikan dengan gambar yang ada di images
            ]);

            $categoryId = ($categoryId % 10) + 1;
        }

        // pembelian
        $userIds = User::pluck('id')->toArray();
        $ikanIds = Ikan::pluck('id')->toArray();

        // Daftar alamat contoh di Indonesia
        $alamatContoh = [
            'Jl. Sudirman No. 123, Jakarta Pusat',
            'Jl. Gatot Subroto Kav. 12, Jakarta Selatan',
            'Jl. Thamrin No. 8, Medan',
            'Jl. Pahlawan No. 45, Surabaya',
            'Jl. Malioboro No. 1, Yogyakarta'
        ];

        for ($i = 0; $i < 50; $i++) {
            $jumlah = rand(1, 5); // Jumlah pembelian 1-5
            $hargaIkan = 25000; // Harga ikan acak
            $ongkir = 10000; // Ongkir acak
            $date = Carbon::now()->format('dmy');
            $orderCount = Pembelian::with('ikan')->with('user')->whereDate('created_at', Carbon::now())->orderBy('id', 'desc')->count() + 1;
            $kode = "OR-" . $date . "-" . str_pad($orderCount, 5, '0', STR_PAD_LEFT);

            Pembelian::create([
                'id_user' => $userIds[array_rand($userIds)],
                'id_ikan' => $ikanIds[array_rand($ikanIds)],
                'kode_order' => $kode,
                'jumlah' => $jumlah,
                'total_harga' => ($hargaIkan * $jumlah) + $ongkir,
                'alamat' => $alamatContoh[array_rand($alamatContoh)],
                'no_telpon' => '08' . rand(100000000, 999999999), // Nomor telepon Indonesia
                'metode_pembayaran' => fake()->randomElement(['Transfer Bank', 'COD']),
                'ongkir' => $ongkir,
                'batas_pembayaran' => Carbon::now()->addDays(rand(1, 3)),
                'status_order' => 'Selesai',
                'status_pembayaran' => fake()->randomElement(['Pembayaran Ditempat (COD)', 'Selesai'])
            ]);
        }

        // pembayaran
        // Ambil semua kode_order dari tabel pembelian
        $kodeOrders = Pembelian::pluck('kode_order')->toArray();

        // Generate 50 data pembayaran
        foreach ($kodeOrders as $kodeOrder) {
            Pembayaran::create([
                'kode_order' => $kodeOrder, // Kode order dari tabel pembelian
                'bukti_pembayaran' => 'images/bukti/' . Str::random(10) . '.jpg',
                'tanggal_pembayaran' => Carbon::now()->subDays(rand(0, 5)),
                'tanggal_order' => Carbon::now()->subDays(rand(1, 10)),
                'status' => 'selesai',
            ]);
        }


        // admin
        DB::table('admins')->insert([
            [
                'username' => 'admin',
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]
        ]);
    }
}
