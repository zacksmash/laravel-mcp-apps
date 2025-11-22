<?php

namespace App\Mcp\Enums;

class OpenAI
{
    const OUTPUT_TEMPLATE = 'openai/outputTemplate';

    const WIDGET_ACCESSIBLE = 'openai/widgetAccessible';

    const TOOL_INVOKING = 'openai/toolInvocation/invoking';

    const TOOL_INVOKED = 'openai/toolInvocation/invoked';

    const RESULT_CAN_PRODUCE_WIDGET = 'openai/resultCanProduceWidget';

    const WIDGET_DESCRIPTION = 'openai/widgetDescription';

    const WIDGET_PREFERS_BORDER = 'openai/widgetPrefersBorder';

    const WIDGET_CSP = 'openai/widgetCSP';

    const WIDGET_DOMAIN = 'openai/widgetDomain';

    const LOCALE = 'openai/locale';

    const USER_AGENT = 'openai/userAgent';

    const USER_LOCATION = 'openai/userLocation';

    const MIME_TYPE = 'text/html+skybridge';
}
