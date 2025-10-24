## Laravel MCP Apps Starter Kit

Laravel starter for building Model Context Protocol (MCP) Servers and OpenAI-compatible Apps using the official [`laravel/mcp`](https://github.com/laravel/mcp) package.

### Quick Start
Clone and bootstrap:

```bash
git clone https://github.com/zacksmash/laravel-mcp-apps.git
cd laravel-mcp-apps
composer setup
```

That `composer setup` script will: install PHP deps, copy example env if missing, generate app key, run migrations, and install Node deps.

### Development

Start the standard laravel app build
```bash
composer dev
```

Start the MCP dev process and open MCPJam to inspect MCP Server
```bash
composer dev:mcp
```

### MCP App Build
Custom build config lives in `vite.mcp.config.ts`. Source TypeScript for Apps & tools lives under `resources/mcp-ui`. Build artifacts land in `public/build` (or configured out dir) and are referenced by MCP server resource definitions in `app/Mcp/Resources`.

### License
MIT
