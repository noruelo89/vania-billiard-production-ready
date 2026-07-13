import { Button } from "@/components/ui/Button";
import { type Accessory, categoryLabels } from "@/data/accessories";
import { formatRupiah } from "@/data/products";
import { waAccessoriesLink } from "@/lib/whatsapp";

export function AccessoryCard({ accessory }: { accessory: Accessory }) {
  return (
    <article className="flex h-full flex-col border border-border-subtle bg-surface p-5 transition-colors hover:border-copper/50">
      <p className="font-mono text-[10px] uppercase tracking-[0.2em] text-copper">
        {categoryLabels[accessory.category]}
      </p>
      <h3 className="mt-3 font-serif text-2xl font-semibold text-text">{accessory.name}</h3>
      <p className="mt-3 flex-1 text-sm leading-relaxed text-text-muted">{accessory.shortDescription}</p>
      <ul className="mt-4 space-y-2 text-sm text-text-muted">
        {accessory.highlights.slice(0, 3).map((item) => <li key={item}>- {item}</li>)}
      </ul>
      <div className="mt-5 border-t border-border-subtle pt-5">
        <p className="font-serif text-2xl font-semibold text-copper">
          {accessory.price ? formatRupiah(accessory.price) : "Tanya stok"}
        </p>
        <p className="mt-1 text-xs uppercase tracking-[0.16em] text-text-muted">{accessory.stockStatus}</p>
        <div className="mt-4 grid gap-2 sm:grid-cols-2">
          <Button href={`/aksesoris/${accessory.slug}`} variant="outline" size="sm">Detail</Button>
          <Button href={waAccessoriesLink(accessory.name)} external variant="whatsapp" size="sm">Tanya Stok</Button>
        </div>
      </div>
    </article>
  );
}
