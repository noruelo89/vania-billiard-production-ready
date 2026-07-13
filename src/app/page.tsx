import { Navbar } from "@/components/layout/Navbar";
import { Footer } from "@/components/layout/Footer";
import { FloatingWA } from "@/components/layout/FloatingWA";
import { MobileStickyCTA } from "@/components/layout/MobileStickyCTA";
import { Hero } from "@/components/sections/Hero";
import { NeedSelector } from "@/components/sections/NeedSelector";
import { TrustTicker } from "@/components/sections/TrustTicker";
import { QuickAssessment } from "@/components/sections/QuickAssessment";
import { ToolsOverview } from "@/components/sections/ToolsOverview";
import { FeaturedTables } from "@/components/sections/FeaturedTables";
import { WhyChooseVania } from "@/components/sections/WhyChooseVania";
import { AccessoriesCategories } from "@/components/sections/AccessoriesCategories";
import { GalleryPreview } from "@/components/sections/GalleryPreview";
import { ShippingProof } from "@/components/sections/ShippingProof";
import { ArticlesPreview } from "@/components/sections/ArticlesPreview";
import { FAQPreview } from "@/components/sections/FAQPreview";
import { FinalCTA } from "@/components/sections/FinalCTA";

export default function Home() {
  return (
    <>
      <Navbar />
      <main>
        <Hero />
        <TrustTicker />
        <NeedSelector />
        <QuickAssessment />
        <ToolsOverview />
        <FeaturedTables />
        <WhyChooseVania />
        <AccessoriesCategories />
        <GalleryPreview />
        <ShippingProof />
        <ArticlesPreview />
        <FAQPreview />
        <FinalCTA />
      </main>
      <Footer />
      <MobileStickyCTA />
      <FloatingWA />
    </>
  );
}
