import type React from "react";

type ResultTone = "comfortable" | "limited" | "warning" | "neutral";

const toneClasses: Record<ResultTone, string> = {
  comfortable: "border-wa/40 bg-wa/10 text-wa",
  limited: "border-copper/40 bg-copper/10 text-copper",
  warning: "border-red-400/40 bg-red-400/10 text-red-200",
  neutral: "border-border-subtle bg-surface text-text",
};

export function ResultPanel({
  eyebrow,
  title,
  description,
  tone = "neutral",
  children,
}: {
  eyebrow?: string;
  title: string;
  description?: string;
  tone?: ResultTone;
  children?: React.ReactNode;
}) {
  return (
    <section className={`border p-5 shadow-xl ${toneClasses[tone]}`} aria-live="polite">
      {eyebrow ? (
        <p className="mb-2 font-mono text-[11px] uppercase tracking-[0.2em] opacity-80">{eyebrow}</p>
      ) : null}
      <h3 className="font-serif text-2xl font-semibold text-text">{title}</h3>
      {description ? <p className="mt-2 text-sm leading-relaxed text-text-muted">{description}</p> : null}
      {children ? <div className="mt-5 text-text">{children}</div> : null}
    </section>
  );
}
