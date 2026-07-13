export type Product = {
  id: number;
  nama_produk: string;
  deskripsi: string;
  harga: number;
  gambar: string;
  nama_kategori: string;
  tipe_pengiriman: string;
};

export const products: Product[] = [
  { id: 1, nama_produk: 'Abimanyu Gen 5', deskripsi: 'Meja billiard turnamen premium dengan konstruksi solid, slate presisi, dan finishing kurator untuk ruang eksklusif.', harga: 28500000, gambar: 'abimanyu_gen5.webp', nama_kategori: 'Meja Turnamen', tipe_pengiriman: 'Kargo Khusus' },
  { id: 2, nama_produk: 'Meja Billiard 8FT', deskripsi: 'Dimensi profesional 8 kaki untuk arena, lounge, dan hunian premium dengan kebutuhan permainan serius.', harga: 24000000, gambar: 'meja_8ft.webp', nama_kategori: 'Meja Premium', tipe_pengiriman: 'Instalasi Presisi' },
  { id: 3, nama_produk: 'Simonis Cloth', deskripsi: 'Kain meja billiard kualitas turnamen untuk laju bola stabil dan pengalaman bermain yang konsisten.', harga: 4500000, gambar: 'simonis_cloth.webp', nama_kategori: 'Aksesoris', tipe_pengiriman: 'Paket Aman' },
  { id: 4, nama_produk: 'Shaft Predator', deskripsi: 'Shaft performa tinggi untuk kontrol bola yang lebih akurat dan respons pukulan profesional.', harga: 6500000, gambar: 'shaft_predator.webp', nama_kategori: 'Cue & Shaft', tipe_pengiriman: 'Paket Aman' },
];

export function rupiah(value: number) {
  return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(value);
}
