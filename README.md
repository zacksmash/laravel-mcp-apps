## Laravel MCP Apps Starter Kit

Laravel starter for building Model Context Protocol (MCP) Servers and OpenAI-compatible Apps using the official [`laravel/mcp`](https://github.com/laravel/mcp) package.

This starter also includes the standard Laravel Vue starter kit, with Passport installed for using OAuth with your MCP server.

### Quick Start

Clone and bootstrap:

```bash
git clone https://github.com/zacksmash/laravel-mcp-apps.git
cd laravel-mcp-apps
composer setup
```

That `composer setup` script will: install PHP deps, copy example env if missing, generate app key, run migrations, and install Node deps.

### Development

Start the MCP dev process and open MCPJam to inspect MCP Server

```bash
composer dev:mcp
```

This will open the MCPJam inspector, (click the x in the top-right corner of the splash screen to view the dashboard). Next, click "Import JSON" and paste the following MCP Server Config:

```json
{
    "mcpServers": {
        "Laravel-mcp-apps": {
            "type": "sse",
            "url": "http://laravel-mcp-apps.test/mcp"
        }
    }
}
```

Now, you can visit the "Tools" section, click on the `weather-tool`, then click "Execute". You should see a fully working example MCP app that's ready to be deployed to ChatGPT as a custom connector! 🎉

This app includes an example of some of the functions and features of the OpenAI window API, using the built in Vue composables.

### MCP App Build

Custom build config lives in `vite.mcp.config.ts`. Source TypeScript for Apps & tools lives under `resources/mcp`. Build artifacts land in `public/build` and are referenced by the view template in `resources/views/mcp/app.blade.php`.

A few extensions to the Laravel MCP package have been made in `app/Mcp/..`, to make the required meta fields avaialble. Hopefully, these will be first-party in the future and can be removed!

### License

MIT
