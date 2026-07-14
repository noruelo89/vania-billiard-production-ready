import { PrismaClient, type Category, type Product as PrismaProduct } from '@prisma/client';
import { products as fallbackProducts, type Product } from './legacy-data';

const globalForPrisma = globalThis as unknown as { prisma?: PrismaClient };

export const prisma = globalForPrisma.prisma ?? new PrismaClient();

if (process.env.NODE_ENV !== 'production') globalForPrisma.prisma = prisma;

type ProductWithCategory = PrismaProduct & { category?: Category | null };

function toLegacyProduct(product: ProductWithCategory): Product {
  return {
    id: product.id,
    nama_produk: product.name,
    deskripsi: product.description,
    harga: product.price,
    gambar: product.image,
    nama_kategori: product.category?.name || 'Produk',
    tipe_pengiriman: product.category?.shippingType || 'Paket Aman',
  };
}

export async function getProducts(options: { featuredOnly?: boolean; limit?: number } = {}): Promise<Product[]> {
  if (!process.env.DATABASE_URL) {
    return typeof options.limit === 'number' ? fallbackProducts.slice(0, options.limit) : fallbackProducts;
  }

  try {
    const products = await prisma.product.findMany({
      where: options.featuredOnly ? { isFeatured: true } : undefined,
      include: { category: true },
      orderBy: { id: 'desc' },
      take: options.limit,
    });
    return products.map(toLegacyProduct);
  } catch (error) {
    console.warn('Falling back to static products:', error);
    return typeof options.limit === 'number' ? fallbackProducts.slice(0, options.limit) : fallbackProducts;
  }
}

export async function getProductById(id: number): Promise<Product> {
  const fallback = fallbackProducts.find((product) => product.id === id) || fallbackProducts[0];
  if (!process.env.DATABASE_URL) return fallback;

  try {
    const product = await prisma.product.findUnique({ where: { id }, include: { category: true } });
    return product ? toLegacyProduct(product) : fallback;
  } catch (error) {
    console.warn('Falling back to static product:', error);
    return fallback;
  }
}
