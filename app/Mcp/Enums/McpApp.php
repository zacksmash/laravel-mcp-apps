<?php

namespace App\Mcp\Enums;

class McpApp
{
    const OPEN_AI_OUTPUT_TEMPLATE = 'openai/outputTemplate';

    const OPEN_AI_WIDGET_ACCESSIBLE = 'openai/widgetAccessible';

    const OPEN_AI_TOOL_INVOKING = 'openai/toolInvocation/invoking';

    const OPEN_AI_TOOL_INVOKED = 'openai/toolInvocation/invoked';

    const OPEN_AI_RESULT_CAN_PRODUCE_WIDGET = 'openai/resultCanProduceWidget';

    const OPEN_AI_WIDGET_DESCRIPTION = 'openai/widgetDescription';

    const OPEN_AI_WIDGET_PREFERS_BORDER = 'openai/widgetPrefersBorder';

    const OPEN_AI_WIDGET_CSP = 'openai/widgetCSP';

    const OPEN_AI_WIDGET_DOMAIN = 'openai/widgetDomain';

    const OPEN_AI_LOCALE = 'openai/locale';

    const OPEN_AI_USER_AGENT = 'openai/userAgent';

    const OPEN_AI_USER_LOCATION = 'openai/userLocation';

    const OPEN_AI_MIME_TYPE = 'text/html+skybridge';

    // MCP Apps Spec
    const RESOURCE_URI = 'ui/resourceUri';

    const MIME_TYPE = 'text/html+mcp';
}
