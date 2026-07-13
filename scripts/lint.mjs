import { readdir, readFile } from "node:fs/promises";
import path from "node:path";

const root = process.cwd();
const targets = ["src", "docs"];
const extensions = new Set([".ts", ".tsx", ".md", ".css"]);
const errors = [];

async function walk(dir) {
  const entries = await readdir(dir, { withFileTypes: true });

  for (const entry of entries) {
    const fullPath = path.join(dir, entry.name);

    if (entry.isDirectory()) {
      await walk(fullPath);
      continue;
    }

    if (!extensions.has(path.extname(entry.name))) {
      continue;
    }

    const content = await readFile(fullPath, "utf8");
    const lines = content.split("\n");

    lines.forEach((line, index) => {
      if (/\s+$/.test(line)) {
        errors.push(`${path.relative(root, fullPath)}:${index + 1} trailing whitespace`);
      }
    });
  }
}

for (const target of targets) {
  await walk(path.join(root, target));
}

if (errors.length > 0) {
  console.error(errors.join("\n"));
  process.exit(1);
}

console.log("lint baseline passed");
