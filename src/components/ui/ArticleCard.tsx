import { Button } from "@/components/ui/Button";
import type { Article } from "@/data/articles";

export function ArticleCard({ article }: { article: Article }) {
  return (
    <article className="flex h-full flex-col border border-border-subtle bg-surface p-5 transition-colors hover:border-copper/50">
      <p className="font-mono text-[10px] uppercase tracking-[0.2em] text-copper">{article.category}</p>
      <h3 className="mt-3 font-serif text-2xl font-semibold leading-tight text-text">{article.title}</h3>
      <p className="mt-3 flex-1 text-sm leading-relaxed text-text-muted">{article.excerpt}</p>
      <p className="mt-5 text-xs uppercase tracking-[0.16em] text-text-muted">{article.readTime} menit baca</p>
      <Button href={`/artikel/${article.slug}`} variant="outline" size="sm" className="mt-4">Baca Artikel</Button>
    </article>
  );
}
