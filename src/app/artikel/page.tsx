import { PageShell } from "@/components/layout/PageShell";
import { ArticleCard } from "@/components/ui/ArticleCard";
import { articles } from "@/data/articles";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Artikel Billiard",
  description: "Panduan ukuran meja, ruangan, usaha billiard, perawatan, material, dan aksesoris.",
  path: "/artikel",
});

export default function ArtikelPage() {
  return (
    <PageShell
      eyebrow="Artikel"
      title="Panduan sebelum membeli meja billiard."
      description="Konten SEO dan AI Search readiness untuk menjawab pertanyaan calon pembeli sebelum konsultasi."
    >
      <div className="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
        {articles.map((article) => <ArticleCard key={article.id} article={article} />)}
      </div>
    </PageShell>
  );
}
