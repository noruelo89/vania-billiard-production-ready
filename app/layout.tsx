export const metadata = {
  metadataBase: new URL(process.env.NEXT_PUBLIC_SITE_URL || 'https://vania-billiard-website-rouge.vercel.app'),
  title: {
    default: 'Vania Billiard | Kurator Meja Billiard Premium',
    template: '%s | Vania Billiard',
  },
  description: 'Kurator meja billiard premium untuk rumah, villa, kantor, cafe, dan ruang usaha di Indonesia.',
  openGraph: {
    title: 'Vania Billiard | Kurator Meja Billiard Premium',
    description: 'Katalog meja billiard, konsultasi ruang, dan simulator layout untuk kebutuhan residential maupun B2B.',
    url: '/',
    siteName: 'Vania Billiard',
    images: ['/assets/images/hero-bg.webp'],
    locale: 'id_ID',
    type: 'website',
  },
  robots: {
    index: true,
    follow: true,
  },
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return children;
}
