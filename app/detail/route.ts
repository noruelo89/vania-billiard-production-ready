import { htmlResponse, renderDetail } from '../../lib/legacy-render';

export const dynamic = 'force-dynamic';

export function GET(request: Request) {
  const url = new URL(request.url);
  return htmlResponse(renderDetail(url.searchParams.get('id')));
}
