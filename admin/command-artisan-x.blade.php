@extends('admin.layouts.base')

@section('title', "")

@include('admin.layouts.script_logic')

@section('content')

@can('super')

<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold flex items-center gap-2">
                <i data-lucide="terminal" class="text-green-400"></i>
                Artisan Command Center
            </h1>
            <p class="text-gray-400 text-sm">Execute domain & system commands safely.</p>
        </div>
        <span class="px-3 py-1 bg-green-900/30 text-green-400 text-xs rounded-full border border-green-800">
            Connected: {{ config('app.env') }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="space-y-4">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Quick Actions</h2>
            <div class="flex flex-col gap-2">
                @php
                    $commands = [
                        ['label' => 'Optimize Clear', 'cmd' => 'optimize:clear', 'icon' => 'zap', 'color' => 'blue'],
                        ['label' => 'Migrate Database', 'cmd' => 'migrate', 'icon' => 'database', 'color' => 'yellow'],
                        ['label' => 'Generate Domain', 'cmd' => 'make:domain', 'icon' => 'layers', 'color' => 'purple'],
                        ['label' => 'Clear Logs', 'cmd' => 'logs:clear', 'icon' => 'trash-2', 'color' => 'red'],
                        ['label' => 'Stock Audit', 'cmd' => 'stock:audit', 'icon' => 'trash-2', 'color' => 'red'],
                    ];
                @endphp

                @foreach($commands as $item)
                <button 
                    onclick="runCommand('{{ $item['cmd'] }}')"
                    class="flex items-center gap-3 p-3 rounded-lg bg-gray-800 border border-gray-700 hover:border-{{ $item['color'] }}-500 transition-all group text-left"
                >
                    <i data-lucide="{{ $item['icon'] }}" class="w-4 h-4 text-{{ $item['color'] }}-400"></i>
                    <span class="text-sm font-medium">{{ $item['label'] }}</span>
                </button>
                @endforeach
            </div>

            <div class="mt-6">
                <label class="text-xs text-gray-500 mb-2 block">Custom Command</label>
                <div class="relative">
                    <input type="text" id="customCmd" placeholder="e.g. cache:clear" 
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg p-3 pr-12 text-sm focus:outline-none focus:ring-1 focus:ring-green-500">
                    <button onclick="runCommand(document.getElementById('customCmd').value)"
                        class="absolute right-2 top-2 p-1 bg-gray-700 hover:bg-gray-600 rounded text-green-400">
                        <i data-lucide="play" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="bg-black rounded-xl border border-gray-800 overflow-hidden flex flex-col h-[500px]">
                <div class="bg-gray-800/50 px-4 py-2 flex items-center justify-between border-b border-gray-800">
                    <div class="flex gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-red-500/20 border border-red-500/40"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500/20 border border-yellow-500/40"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500/20 border border-green-500/40"></div>
                    </div>
                    <span id="statusText" class="text-[10px] font-mono text-gray-500 italic">Idle</span>
                </div>
                
                <div id="terminalBody" class="p-6 font-mono text-sm overflow-y-auto flex-1 scrollbar-thin scrollbar-thumb-gray-700 whitespace-pre-wrap">
                    <div class="text-green-400">$ ready_to_execute_command...</div>
                </div>
            </div>
            
            <div class="mt-4 flex justify-end">
                <button onclick="clearTerminal()" class="text-xs text-gray-500 hover:text-white flex items-center gap-1">
                    <i data-lucide="eraser" class="w-3 h-3"></i> Clear Console
                </button>
            </div>
        </div>
    </div>
</div>

@endcan

@endsection

@push('script_add')
@can('super')

<script>
    lucide.createIcons();

    async function runCommand(command) {
        if(!command) return;

        const terminal = document.getElementById('terminalBody');
        const status = document.getElementById('statusText');
        
        status.innerText = 'Executing...';
        status.classList.add('text-yellow-500');

        // Tambahkan baris baru di terminal
        terminal.innerHTML += `<div class="mt-4 text-blue-400 text-xs"># php artisan ${command}</div>`;
        terminal.scrollTop = terminal.scrollHeight;

        try {
            // Gunakan fetch ke Route Laravel Anda
            const response = await fetch('/admin/execute-command', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ command: command })
            });

            const data = await response.json();
            
            // Tampilkan output dari Artisan
            terminal.innerHTML += `<pre class="text-gray-300 mt-1 font-mono">${data.output}</pre>`;
            // terminal.innerHTML += `<div class="text-gray-300 mt-1 whitespace-pre-wrap">${data.output}</div>`;
            
            status.innerText = 'Success';
            status.classList.replace('text-yellow-500', 'text-green-500');

        } catch (error) {
            terminal.innerHTML += `<div class="text-red-500 mt-1 uppercase font-bold text-xs">[Error] Connection failed.</div>`;
            status.innerText = 'Failed';
            status.classList.replace('text-yellow-500', 'text-red-500');
        }

        terminal.scrollTop = terminal.scrollHeight;
    }

    function clearTerminal() {
        document.getElementById('terminalBody').innerHTML = '<div class="text-green-400">$ console_cleared</div>';
    }
</script>

@endcan
@endpush

