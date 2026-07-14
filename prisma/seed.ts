import { PrismaClient } from '@prisma/client';
import fs from 'node:fs';
import path from 'node:path';

const prisma = new PrismaClient();

const products = [
  {
    name: 'Abimanyu Gen 5',
    slug: 'abimanyu-gen-5',
    description: 'Meja billiard turnamen premium dengan konstruksi solid, slate presisi, dan finishing kurator untuk ruang eksklusif.',
    price: 28500000,
    image: 'abimanyu_gen5.webp',
    category: 'Meja Turnamen',
    shippingType: 'Kargo Khusus',
    featured: true,
  },
  {
    name: 'Meja Billiard 8FT',
    slug: 'meja-billiard-8ft',
    description: 'Dimensi profesional 8 kaki untuk arena, lounge, dan hunian premium dengan kebutuhan permainan serius.',
    price: 24000000,
    image: 'meja_8ft.webp',
    category: 'Meja Premium',
    shippingType: 'Instalasi Presisi',
    featured: true,
  },
  {
    name: 'Simonis Cloth',
    slug: 'simonis-cloth',
    description: 'Kain meja billiard kualitas turnamen untuk laju bola stabil dan pengalaman bermain yang konsisten.',
    price: 4500000,
    image: 'simonis_cloth.webp',
    category: 'Aksesoris',
    shippingType: 'Paket Aman',
    featured: true,
  },
  {
    name: 'Shaft Predator',
    slug: 'shaft-predator',
    description: 'Shaft performa tinggi untuk kontrol bola yang lebih akurat dan respons pukulan profesional.',
    price: 6500000,
    image: 'shaft_predator.webp',
    category: 'Cue & Shaft',
    shippingType: 'Paket Aman',
    featured: true,
  },
];

function slugify(value: string) {
  return value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
}

async function seedShippingRates() {
  const csvPath = path.join(process.cwd(), 'data', 'ongkir.csv');
  if (!fs.existsSync(csvPath)) return;

  const lines = fs.readFileSync(csvPath, 'utf8').split(/\r?\n/);
  let province = '';
  for (const line of lines.slice(1)) {
    const [no, rawProvince, city, priceLabel] = line.split(',').map((item) => item?.trim() || '');
    if (!no && !rawProvince && !city) continue;
    if (rawProvince) province = rawProvince;
    if (!province || !city) continue;
    await prisma.shippingRate.upsert({
      where: { province_city: { province, city } },
      update: { priceLabel },
      create: { province, city, priceLabel },
    });
  }
}

async function main() {
  for (const item of products) {
    const category = await prisma.category.upsert({
      where: { slug: slugify(item.category) },
      update: { name: item.category, shippingType: item.shippingType },
      create: { name: item.category, slug: slugify(item.category), shippingType: item.shippingType },
    });

    await prisma.product.upsert({
      where: { slug: item.slug },
      update: {
        name: item.name,
        description: item.description,
        price: item.price,
        image: item.image,
        isFeatured: item.featured,
        categoryId: category.id,
      },
      create: {
        name: item.name,
        slug: item.slug,
        description: item.description,
        price: item.price,
        image: item.image,
        isFeatured: item.featured,
        categoryId: category.id,
      },
    });
  }

  await seedShippingRates();
}

main()
  .then(async () => prisma.$disconnect())
  .catch(async (error) => {
    console.error(error);
    await prisma.$disconnect();
    process.exit(1);
  });
