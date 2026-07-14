import { getProductById } from '../../lib/db-products';
import { htmlResponse, renderDetail } from '../../lib/legacy-render';

export const dynamic = 'force-dynamic';

export async function GET(request: Request) {
  const url = new URL(request.url);
  const product = await getProductById(Number(url.searchParams.get('id') || 1));
  return htmlResponse(renderDetail(product));
}
