import assert from "node:assert/strict";
import { readFile } from "node:fs/promises";

const siteConfig = await readFile("src/config/site.ts", "utf8");
const businessConfig = await readFile("src/config/business.ts", "utf8");
const robots = await readFile("src/app/robots.ts", "utf8");
const sitemap = await readFile("src/app/sitemap.ts", "utf8");
const whatsapp = await readFile("src/lib/whatsapp.ts", "utf8");

assert.match(siteConfig, /shouldIndex = appEnvironment === "production"/);
assert.match(businessConfig, /6282241545326/);
assert.match(businessConfig, /6285182306565/);
assert.match(robots, /disallow: "\/"/);
assert.match(sitemap, /if \(!shouldIndex\)/);
assert.match(whatsapp, /Kode konsultasi/);

console.log("test baseline passed");
