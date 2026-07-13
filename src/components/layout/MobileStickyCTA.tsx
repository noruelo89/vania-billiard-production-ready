import { Button } from "@/components/ui/Button";
import { waConsultationLink } from "@/lib/whatsapp";

export function MobileStickyCTA() {
  return (
    <div className="fixed inset-x-0 bottom-0 z-30 border-t border-border-subtle bg-bg/92 p-3 backdrop-blur-xl lg:hidden">
      <div className="grid grid-cols-2 gap-2">
        <Button href="/simulator-ruangan" variant="secondary" size="sm" className="text-[10px]">
          Cek Ruangan
        </Button>
        <Button href={waConsultationLink()} external variant="whatsapp" size="sm" className="text-[10px]">
          WhatsApp
        </Button>
      </div>
    </div>
  );
}
