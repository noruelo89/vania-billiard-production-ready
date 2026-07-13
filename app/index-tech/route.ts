import { htmlResponse, renderLegacyPage } from '../../lib/legacy-render';

export const dynamic = 'force-static';

export function GET() {
  return htmlResponse(renderLegacyPage('index-tech.php'));
}
