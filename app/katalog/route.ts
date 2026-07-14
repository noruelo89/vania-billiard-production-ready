import { getProducts } from '../../lib/db-products';
import { htmlResponse, renderLegacyPage } from '../../lib/legacy-render';

export const dynamic = 'force-dynamic';

export async function GET() {
  const products = await getProducts();
  return htmlResponse(renderLegacyPage('katalog.php', products));
}
