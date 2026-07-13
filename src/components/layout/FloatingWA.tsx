"use client";

import { useState } from "react";
import { WA, waAccessoriesLink, waConsultationLink } from "@/lib/whatsapp";

export function FloatingWA() {
  const [open, setOpen] = useState(false);

  return (
    <>
      {/* Floating button — bigger bottom on mobile to clear hero CTAs */}
      <button
        type="button"
        onClick={() => setOpen(!open)}
        className="fixed bottom-20 right-5 lg:bottom-6 lg:right-6 z-40 w-12 h-12 lg:w-16 lg:h-16 bg-wa text-white rounded-full shadow-2xl shadow-wa/30 flex items-center justify-center hover:scale-110 active:scale-95 transition-transform"
        aria-label="Hubungi kami via WhatsApp"
        aria-expanded={open}
      >
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
          <path d="M12 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.832-1.438A9.955 9.955 0 0012 22c5.523 0 10-4.477 10-10S17.523 2 12 2zm0 18a7.96 7.96 0 01-4.11-1.13l-.29-.174-2.87.85.85-2.87-.174-.29A7.96 7.96 0 014 12c0-4.41 3.59-8 8-8s8 3.59 8 8-3.59 8-8 8z" />
        </svg>
      </button>

      {/* Popover choices */}
      {open && (
        <>
          <div
            className="fixed inset-0 z-30 bg-bg/30 backdrop-blur-sm"
            onClick={() => setOpen(false)}
            aria-hidden="true"
          />
          <div
            className="fixed bottom-[5.5rem] right-5 lg:bottom-28 lg:right-6 z-40 w-72 bg-bg border border-border-subtle shadow-2xl"
            role="dialog"
            aria-label="Pilih WhatsApp"
          >
            <div className="p-4 border-b border-border-subtle">
              <p className="font-mono text-[11px] uppercase tracking-[0.2em] text-copper mb-1">
                WhatsApp Vania
              </p>
              <p className="font-serif text-lg font-medium">Pilih konsultasi</p>
            </div>
            <div className="p-2">
              <a
                href={waConsultationLink()}
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-start gap-3 p-3 hover:bg-surface transition-colors"
              >
                <div className="w-10 h-10 bg-copper/10 border border-copper/30 flex items-center justify-center text-copper shrink-0">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <rect x="3" y="9" width="18" height="11" rx="1" />
                    <path d="M3 9V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v4" />
                  </svg>
                </div>
                <div className="flex-1 min-w-0">
                  <p className="font-medium text-sm leading-tight mb-1">
                    Konsultasi Meja Billiard
                  </p>
                  <p className="text-xs text-text-muted">{WA.displayMeja}</p>
                </div>
              </a>
              <a
                href={waAccessoriesLink()}
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-start gap-3 p-3 hover:bg-surface transition-colors"
              >
                <div className="w-10 h-10 bg-wa/10 border border-wa/30 flex items-center justify-center text-wa shrink-0">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="9" />
                    <circle cx="12" cy="12" r="3" />
                  </svg>
                </div>
                <div className="flex-1 min-w-0">
                  <p className="font-medium text-sm leading-tight mb-1">
                    Tanya Aksesoris
                  </p>
                  <p className="text-xs text-text-muted">{WA.displayAksesoris}</p>
                </div>
              </a>
            </div>
            <button
              type="button"
              onClick={() => setOpen(false)}
              className="w-full p-3 border-t border-border-subtle text-xs font-mono uppercase tracking-wider text-text-muted hover:text-text transition-colors"
            >
              Tutup
            </button>
          </div>
        </>
      )}
    </>
  );
}
