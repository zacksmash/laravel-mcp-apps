@use('Illuminate\Support\Facades\Vite')
@use('Illuminate\Support\Facades\File')

@if(Vite::isRunningHot())
    @vite(['resources/mcp-ui/app.ts'])
@else
    @php
        $script = Vite::useBuildDirectory('build/mcp')->content('resources/mcp-ui/app.ts');
        $manifest = File::json(public_path('build/mcp/manifest.json'));
        $css = File::get(public_path('build/mcp/' . $manifest['resources/mcp-ui/app.ts']['css'][0]));
    @endphp

    @if($script)
        <script type="module">{!! $script !!}</script>
    @endif

    @if($css)
        <style>{!! $css !!}</style>
    @endif
@endif
<div id="app"></div>
