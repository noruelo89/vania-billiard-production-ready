const tickerItems = [
  "Ruang rumah",
  "Venue komersial",
  "Custom request",
  "Pengiriman nasional",
  "Pemasangan terarah",
  "Aksesoris pendukung",
  "Artikel ukuran meja",
  "Lead ID WhatsApp",
];

export function TrustTicker() {
  const loop = [...tickerItems, ...tickerItems];

  return (
    <section className="relative overflow-hidden border-y border-border-subtle bg-[#050505] py-5">
      <div className="pointer-events-none absolute inset-y-0 left-0 z-10 w-24 bg-gradient-to-r from-[#050505] to-transparent md:w-44" />
      <div className="pointer-events-none absolute inset-y-0 right-0 z-10 w-24 bg-gradient-to-l from-[#050505] to-transparent md:w-44" />
      <div className="absolute left-5 top-1/2 z-20 hidden -translate-y-1/2 bg-[#050505] pr-6 md:block">
        <p className="font-mono text-[10px] font-bold uppercase tracking-[0.28em] text-copper">Decision path</p>
      </div>
      <div className="ticker-track flex items-center gap-10 pl-8 opacity-75 md:gap-16 md:pl-64">
        {loop.map((item, index) => (
          <span key={`${item}-${index}`} className="whitespace-nowrap font-serif text-base uppercase tracking-[0.18em] text-text md:text-xl">
            {item}
          </span>
        ))}
      </div>
    </section>
  );
}
