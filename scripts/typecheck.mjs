import { readFile, readdir } from "node:fs/promises";
import path from "node:path";
import ts from "typescript";

const root = process.cwd();
const sourceRoots = ["src"];
const extensions = new Set([".ts", ".tsx"]);
const diagnostics = [];

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

    const source = await readFile(fullPath, "utf8");
    const result = ts.transpileModule(source, {
      fileName: fullPath,
      reportDiagnostics: true,
      compilerOptions: {
        jsx: ts.JsxEmit.ReactJSX,
        module: ts.ModuleKind.ESNext,
        target: ts.ScriptTarget.ES2020,
        strict: true,
        isolatedModules: true,
      },
    });

    for (const diagnostic of result.diagnostics || []) {
      if (diagnostic.category === ts.DiagnosticCategory.Error) {
        const message = ts.flattenDiagnosticMessageText(diagnostic.messageText, "\n");
        diagnostics.push(`${path.relative(root, fullPath)}: ${message}`);
      }
    }
  }
}

for (const sourceRoot of sourceRoots) {
  await walk(path.join(root, sourceRoot));
}

if (diagnostics.length > 0) {
  console.error(diagnostics.join("\n"));
  process.exit(1);
}

console.log("typecheck baseline passed");
