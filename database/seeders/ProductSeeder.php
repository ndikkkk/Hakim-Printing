<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['product_code' => 'GS-000', 'name' => 'Classic Vintage Floral', 'description' => 'Latar krem dengan ornamen bunga klasik dan dedaunan biru kecokelatan. Tampil sangat membumi dan tradisional.', 'price' => rand(1100, 1300), 'image' => 'GS000.jpeg'],
            ['product_code' => 'GS-001', 'name' => 'Minimalist Anthurium', 'description' => 'Bersih dan modern dengan dominasi ruang kosong (white space), daun tropis gelap, dan bunga anthurium/calla lily putih.', 'price' => rand(1100, 1300), 'image' => 'GS001.jpeg'],
            ['product_code' => 'GS-002', 'name' => 'Floral Marble Gold', 'description' => 'Latar bertekstur marmer dengan aksen bunga krisan/peony warna pink dan garis tepi daun berwarna emas yang memberikan kesan mewah.', 'price' => rand(1100, 1300), 'image' => 'GS002.jpeg'],
            ['product_code' => 'GS-003', 'name' => 'Grey Feather Minimalist', 'description' => 'Latar abu-abu redup dipadukan dengan ilustrasi bulu, rumput kering, dan dedaunan halus. Sangat rapi dan elegan.', 'price' => rand(1100, 1300), 'image' => 'GS003.jpeg'],
            ['product_code' => 'GS-004', 'name' => 'Blush Geometric Boho', 'description' => 'Kombinasi bentuk geometris (hexagonal) bernuansa rose gold dengan rumput pampas di atas latar pink pucat.', 'price' => rand(1100, 1300), 'image' => 'GS004.jpeg'],
            ['product_code' => 'GS-005', 'name' => 'Dark Rustic Wood', 'description' => 'Latar belakang penuh tekstur serat kayu, dihiasi bunga bernuansa gelap dan burung kecil. Sangat kuat nuansa rustic-nya.', 'price' => rand(1100, 1300), 'image' => 'GS005.jpeg'],
            ['product_code' => 'GS-006', 'name' => 'Blue Tropical Monstera', 'description' => 'Nuansa biru pastel dengan cipratan cat air, daun palem/monstera tropis, dan sentuhan siluet dedaunan warna emas.', 'price' => rand(1100, 1300), 'image' => 'GS006.jpeg'],
            ['product_code' => 'GS-007', 'name' => 'Hummingbird Brush Stroke', 'description' => 'Estetik dan artistik dengan sapuan kuas (brush stroke) cokelat tebal, bunga mawar peach, dan ilustrasi burung kolibri terbang.', 'price' => rand(1100, 1300), 'image' => 'GS007.jpeg'],
            ['product_code' => 'GS-008', 'name' => 'Brown Brush Strokes', 'description' => 'Aksen sapuan kuas tebal berwarna cokelat dengan elemen dedaunan kering, memberikan kesan artsy dan rustic.', 'price' => rand(1100, 1300), 'image' => 'GS008.jpeg'],
            ['product_code' => 'GS-009', 'name' => 'Indigo Peacock', 'description' => 'Sangat mencolok dengan ilustrasi burung merak utuh yang detail, latar cat air biru indigo pekat, dan ornamen kipas lipat bergaya oriental.', 'price' => rand(1100, 1300), 'image' => 'GS009.jpeg'],
            ['product_code' => 'GS-010', 'name' => 'Green Geometric Envelope', 'description' => 'Desain model amplop vertikal dengan sapuan cat air hijau pekat, dedaunan botani tropis, dan bingkai geometris emas.', 'price' => rand(1100, 1300), 'image' => 'GS010.jpeg'],
            ['product_code' => 'GS-011', 'name' => 'Blue Pampas & Bird', 'description' => 'Latar biru muda pastel yang dihiasi rumput pampas, dedaunan kering, dan ilustrasi burung kecil. Elegan dan natural.', 'price' => rand(1100, 1300), 'image' => 'GS011.jpeg'],
            ['product_code' => 'GS-012', 'name' => 'Geometric Blue Pampas', 'description' => 'Kombinasi kontras modern dari garis geometris tajam berwarna emas dengan rumput pampas liar dan sapuan cat air biru.', 'price' => rand(1100, 1300), 'image' => 'GS012.jpeg'],
            ['product_code' => 'GS-013', 'name' => 'Royal Blue Floral', 'description' => 'Desain lipat diagonal dengan penutup wax seal tiruan. Didominasi ilustrasi bunga biru tua yang mewah dan aksen gold foil.', 'price' => rand(1100, 1300), 'image' => 'GS013.jpeg'],
            ['product_code' => 'GS-014', 'name' => 'Boho Rustic Leaves', 'description' => 'Elemen daun palem kering dan ilalang dengan palet warna earthy. Visual yang sangat mentah dan menyatu dengan alam.', 'price' => rand(1100, 1300), 'image' => 'GS014.jpeg'],
            ['product_code' => 'GS-015', 'name' => 'Emerald Gold Wash', 'description' => 'Orientasi horizontal dengan blok warna hijau zamrud (emerald) cat air yang pekat, dipadu taburan debu emas (gold dust).', 'price' => rand(1100, 1300), 'image' => 'GS015.jpeg'],
            ['product_code' => 'GS-016', 'name' => 'Peach Rustic Wood', 'description' => 'Potongan tepi bergelombang (die-cut). Latar warna peach/terracotta dengan elemen rumput pampas dan ilustrasi irisan batang kayu. Sangat boho-chic.', 'price' => rand(1100, 1300), 'image' => 'GS016.jpeg'],
            ['product_code' => 'GS-017', 'name' => 'Diamond Cutout Minimalist', 'description' => 'Fitur unik berupa lubang berbentuk belah ketupat di sampul depan untuk menampilkan inisial. Visual botanical redup yang minimalis.', 'price' => rand(1100, 1300), 'image' => 'GS017.jpeg'],
            ['product_code' => 'GS-018', 'name' => 'Tropical Greenery Arch', 'description' => 'Daun monstera dan tanaman tropis berpadu dengan lingkaran geometris emas. Menghasilkan nuansa tropis yang segar dan bersih.', 'price' => rand(1100, 1300), 'image' => 'GS018.jpeg'],
            ['product_code' => 'GS-019', 'name' => 'Boho Feather Wreath', 'description' => 'Potongan sampul melengkung asimetris. Menggunakan bingkai melingkar dari ranting dan bulu burung bergaya bohemian.', 'price' => rand(1100, 1300), 'image' => 'GS019.jpeg'],
            ['product_code' => 'GS-020', 'name' => 'Mustard Tropical Arch', 'description' => 'Desain modern dengan ruang blok melengkung (arch) berwarna kuning mustard solid, dihiasi ilustrasi daun tropis kering.', 'price' => rand(1100, 1300), 'image' => 'GS020.jpeg'],
            ['product_code' => 'GS-021', 'name' => 'Delicate Botanical', 'description' => 'Minimalis dan bersih. Fokus pada white space dengan sketsa ranting tipis, bunga kecil, dan siluet burung. Terkesan ringan.', 'price' => rand(1100, 1300), 'image' => 'GS021.jpeg'],
            ['product_code' => 'GS-022', 'name' => 'Pampas & Birds', 'description' => 'Latar belakang pastel dengan kombinasi rumput pampas kering dan ilustrasi burung kecil yang mendetail.', 'price' => rand(1100, 1300), 'image' => 'GS022.jpeg'],
            ['product_code' => 'GS-023', 'name' => 'Gold Brush Monochrome', 'description' => 'Kontras tegas antara elemen bunga bernuansa monokromatik (abu-abu) dengan sapuan kuas tebal (brush stroke) berwarna emas mentereng.', 'price' => rand(1100, 1300), 'image' => 'GS023.jpeg'],
            ['product_code' => 'GS-024', 'name' => 'Exotic Parrot Floral', 'description' => 'Menggabungkan ilustrasi bunga bergaya sketsa hitam-putih dengan burung nuri biru di atas latar cat air keabuan. Eksotis dan tidak biasa.', 'price' => rand(1100, 1300), 'image' => 'GS024.jpeg'],
            ['product_code' => 'GS-025', 'name' => 'Mint Wax Seal', 'description' => 'Desain layout menyerupai amplop terbuka dengan aksen stempel lilin (wax seal) merah dan ornamen bunga kering.', 'price' => rand(1100, 1300), 'image' => 'GS025.jpeg'],
            ['product_code' => 'GS-026', 'name' => 'Peacock Elegance', 'description' => 'Sangat spesifik dengan ilustrasi bulu burung merak yang mencolok, dipadukan bingkai geometris emas dan latar hijau cat air.', 'price' => rand(1100, 1300), 'image' => 'GS026.jpeg'],
            ['product_code' => 'GS-027', 'name' => 'Earthy Bohemian', 'description' => 'Kental dengan nuansa boho. Menampilkan ornamen bulu, bunga kapas, dedaunan kering, dan aksen irisan batang kayu (wood slice).', 'price' => rand(1100, 1300), 'image' => 'GS027.jpeg'],
            ['product_code' => 'GS-028', 'name' => 'Minimalist Foliage', 'description' => 'Desain bersih dengan fokus pada siluet dedaunan perak yang elegan di sudut frame.', 'price' => rand(1100, 1300), 'image' => 'GS028.jpeg'],
            ['product_code' => 'GS-029', 'name' => 'Classic Bronze Floral', 'description' => 'Ornamen bunga klasik dengan bingkai geometris berwarna tembaga yang memberikan kesan mewah.', 'price' => rand(1100, 1300), 'image' => 'GS029.jpeg'],
            ['product_code' => 'GS-030', 'name' => 'Soft Watercolor Pink', 'description' => 'Ilustrasi bunga cat air berwarna merah muda lembut dengan font script yang romantis.', 'price' => rand(1100, 1300), 'image' => 'GS030.jpeg'],
            ['product_code' => 'GS-031', 'name' => 'Golden Botanical', 'description' => 'Perpaduan garis emas (gold line art) dedaunan dengan latar belakang bersih, sangat modern.', 'price' => rand(1100, 1300), 'image' => 'GS031.jpeg'],
            ['product_code' => 'GS-032', 'name' => 'Vintage Rose', 'description' => 'Menggunakan ilustrasi mawar mekar penuh yang memberikan kesan klasik dan abadi.', 'price' => rand(1100, 1300), 'image' => 'GS032.jpeg'],
            ['product_code' => 'GS-033', 'name' => 'Tropical Greenery', 'description' => 'Fokus pada daun monstera dan palem hijau tua, cocok untuk konsep outdoor atau summer.', 'price' => rand(1100, 1300), 'image' => 'GS033.jpeg'],
            ['product_code' => 'GS-034', 'name' => 'Daisy Bouquet', 'description' => 'Bentuk unik (die-cut) menyerupai buket bunga Daisy kuning. Sangat ceria dan tidak konvensional.', 'price' => rand(1100, 1300), 'image' => 'GS034.jpeg'],
            ['product_code' => 'GS-035', 'name' => 'Dusty Blue Elegance', 'description' => 'Aksen cat air biru redup dengan bingkai bunga melingkar (wreath) yang elegan.', 'price' => rand(1100, 1300), 'image' => 'GS035.jpeg'],
            ['product_code' => 'GS-036', 'name' => 'Peach Blossom', 'description' => 'Ilustrasi bunga persik yang tersebar merata di sisi tepi, memberikan kesan penuh dan ramai.', 'price' => rand(1100, 1300), 'image' => 'GS036.jpeg'],
            ['product_code' => 'GS-037', 'name' => 'Rustic Earthy Tone', 'description' => 'Elemen bunga kering dengan latar belakang warna bumi (terracotta/cokelat), sangat estetik.', 'price' => rand(1100, 1300), 'image' => 'GS037.jpeg'],
            ['product_code' => 'GS-038', 'name' => 'Oriental Zen', 'description' => 'Mengadopsi gaya Jepang dengan ilustrasi gunung, matahari, dan bunga Sakura/Peony.', 'price' => rand(1100, 1300), 'image' => 'GS038.jpeg'],
        ];

        foreach ($products as $item) {
            Product::create([
                'product_code' => $item['product_code'],
                'name' => $item['name'],
                'price' => $item['price'],
                'description' => $item['description'],
                'image' => $item['image'],
            ]);
        }
    }
}
