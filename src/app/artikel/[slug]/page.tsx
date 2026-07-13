import { notFound } from "next/navigation";
import { PageShell } from "@/components/layout/PageShell";
import { Button } from "@/components/ui/Button";
import { articles } from "@/data/articles";
import { buildPageMetadata } from "@/lib/seo";

interface ArticlePageProps {
  params: Promise<{ slug: string }>;
}

export function generateStaticParams() {
  return articles.map((article) => ({ slug: article.slug }));
}

export async function generateMetadata({ params }: ArticlePageProps) {
  const { slug } = await params;
  const article = articles.find((item) => item.slug === slug);
  if (!article) return {};
  return buildPageMetadata({
    title: article.title,
    description: article.metaDescription,
    path: `/artikel/${article.slug}`,
  });
}

function renderMarkdownLite(content: string) {
  return content
    .split("\n")
    .map((line) => line.trim())
    .filter(Boolean)
    .map((line, index) => {
      if (line.startsWith("## ")) {
        return <h2 key={index} className="mt-10 font-serif text-3xl text-text">{line.replace("## ", "")}</h2>;
      }
      if (line.startsWith("### ")) {
        return <h3 key={index} className="mt-7 font-serif text-2xl text-text">{line.replace("### ", "")}</h3>;
      }
      if (line.startsWith("- ")) {
        return <p key={index} className="text-sm leading-relaxed text-text-muted">- {line.replace("- ", "")}</p>;
      }
      if (line.startsWith("|")) {
        return <pre key={index} className="overflow-x-auto border border-border-subtle bg-surface p-3 text-xs text-text-muted">{line}</pre>;
      }
      return <p key={index} className="text-base leading-8 text-text-muted">{line}</p>;
    });
}

export default async function ArticleDetailPage({ params }: ArticlePageProps) {
  const { slug } = await params;
  const article = articles.find((item) => item.slug === slug);
  if (!article) notFound();

  return (
    <PageShell eyebrow={article.category} title={article.title} description={article.metaDescription}>
      <article className="max-w-3xl space-y-4">
        <p className="font-mono text-xs uppercase tracking-[0.18em] text-text-muted">
          Updated {article.publishedAt} · {article.readTime} menit baca · Reviewer: Vania Billiard
        </p>
        <div className="border-y border-border-subtle py-6">
          <h2 className="font-serif text-2xl text-text">Key takeaways</h2>
          <p className="mt-3 text-sm leading-relaxed text-text-muted">
            Gunakan artikel ini sebagai panduan awal. Untuk rekomendasi produk final, layout, ongkir, pemasangan, dan quotation, lanjutkan konsultasi.
          </p>
        </div>
        <div className="space-y-4">{renderMarkdownLite(article.content)}</div>
        <div className="mt-10 flex flex-col gap-3 sm:flex-row">
          <Button href="/simulator-ruangan">Cek Ruangan</Button>
          <Button href="/meja-billiard" variant="secondary">Lihat Meja</Button>
        </div>
      </article>
    </PageShell>
  );
}
