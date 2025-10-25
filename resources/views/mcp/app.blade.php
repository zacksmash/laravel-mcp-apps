@use('Illuminate\Support\Facades\Vite')
@use('Illuminate\Support\Facades\File')

@if(Vite::useHotFile(public_path('/hot-mcp'))->isRunningHot())
    @vite(['resources/mcp-ui/app.ts'])
    <div id="app"></div>
@else
    @php
        $script = Vite::useBuildDirectory('build/mcp')->content('resources/mcp-ui/app.ts');
        $manifest = File::json(public_path('build/mcp/manifest.json'));
        $css = File::get(public_path('build/mcp/' . $manifest['resources/mcp-ui/app.ts']['css'][0]));
    @endphp
    <div id="app"></div>
    @if($css)<style>{!! $css !!}</style>@endif
    @if($script)<script type="module">{!! $script !!}</script>@endif
@endif
