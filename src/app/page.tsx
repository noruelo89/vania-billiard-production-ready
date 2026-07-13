import { Navbar } from "@/components/layout/Navbar";
import { Footer } from "@/components/layout/Footer";
import { FloatingWA } from "@/components/layout/FloatingWA";
import { MobileStickyCTA } from "@/components/layout/MobileStickyCTA";
import { Hero } from "@/components/sections/Hero";
import { TrustBadges } from "@/components/sections/TrustBadges";
import { BigQuote } from "@/components/sections/BigQuote";
import { FeaturedTables } from "@/components/sections/FeaturedTables";
import { TableSelectionGuide } from "@/components/sections/TableSelectionGuide";
import { SimulatorTeaser } from "@/components/sections/SimulatorTeaser";
import { AccessoriesCategories } from "@/components/sections/AccessoriesCategories";
import { WhyChooseVania } from "@/components/sections/WhyChooseVania";
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
        <TrustBadges />
        <BigQuote />
        <FeaturedTables />
        <TableSelectionGuide />
        <SimulatorTeaser />
        <AccessoriesCategories />
        <WhyChooseVania />
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