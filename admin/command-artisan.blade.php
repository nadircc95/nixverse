@extends('admin.layouts.base')

@section('title', "Artisan Command Center")

@include('admin.layouts.script_logic')

@section('content')

@can('super')

<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold flex items-center gap-2">
                <i class="fas fa-terminal text-green-400"></i>
                Artisan Command Center
            </h1>
            <p class="text-gray-400 text-sm">Execute domain & system commands safely.</p>
        </div>
        <span class="px-3 py-1 bg-green-900/30 text-green-400 text-xs rounded-full border border-green-800">
            <i class="fas fa-server me-1"></i> Connected: {{ config('app.env') }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="space-y-4">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider">
                <i class="fas fa-bolt me-1"></i> Quick Actions
            </h2>
            <div class="flex flex-col gap-2">
                @php
                    $commands = [
                        ['label' => 'Optimize Clear', 'cmd' => 'optimize:clear', 'icon' => 'fa-zap', 'color' => 'blue'],
                        ['label' => 'Migrate Database', 'cmd' => 'migrate', 'icon' => 'fa-database', 'color' => 'yellow'],
                        ['label' => 'Generate Domain', 'cmd' => 'make:domain', 'icon' => 'fa-layer-group', 'color' => 'purple'],
                        ['label' => 'Clear Logs', 'cmd' => 'logs:clear', 'icon' => 'fa-trash-alt', 'color' => 'red'],
                        ['label' => 'Stock Audit', 'cmd' => 'stock:audit', 'icon' => 'fa-clipboard-check', 'color' => 'green'],
                    ];
                @endphp

                @foreach($commands as $item)
                <button 
                    onclick="runCommand('{{ $item['cmd'] }}')"
                    class="flex items-center gap-3 p-3 rounded-lg bg-gray-800 border border-gray-700 hover:border-{{ $item['color'] }}-500 transition-all group text-left"
                >
                    <i class="fas {{ $item['icon'] }} text-{{ $item['color'] }}-400 w-5 text-center"></i>
                    <span class="text-sm font-medium">{{ $item['label'] }}</span>
                </button>
                @endforeach
            </div>

            <div class="mt-4">
                <label class="text-xs text-gray-500 mb-2 block uppercase tracking-tighter">Custom Command</label>
                <div class="relative">
                    <input type="text" id="customCmd" placeholder="e.g. cache:clear" 
                        class="w-full bg-gray-800 border border-gray-700 rounded-lg p-3 pr-12 text-sm text-gray-200 focus:outline-none focus:ring-1 focus:ring-green-500">
                    <button onclick="runCommand(document.getElementById('customCmd').value)"
                        class="absolute right-2 top-2 p-2 bg-gray-700 hover:bg-gray-600 rounded text-green-400 transition-colors">
                        <i class="fas fa-play"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="bg-black rounded-xl border border-gray-800 overflow-hidden flex flex-col h-[550px] shadow-2xl">
                <div class="bg-gray-800/50 px-4 py-2 flex items-center justify-between border-b border-gray-800">
                    <div class="flex gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    </div>
                    <span id="statusText" class="text-[10px] font-mono text-gray-500 uppercase font-bold tracking-widest">
                        <i class="fas fa-circle me-1 text-[8px]"></i> Idle
                    </span>
                </div>
                
                <div id="terminalBody" class="p-6 font-mono text-sm overflow-y-auto flex-1 scrollbar-thin scrollbar-thumb-gray-700 whitespace-pre-wrap">
                    <div class="text-green-400"><i class="fas fa-chevron-right me-2"></i>ready_to_execute_command...</div>
                </div>
            </div>
            
            <div class="mt-4 flex justify-between items-center">
                <p class="text-[10px] text-gray-600 font-mono italic">Note: Table borders might require wider screen.</p>
                <button onclick="clearTerminal()" class="text-xs text-gray-500 hover:text-white transition-colors flex items-center gap-2">
                    <i class="fas fa-eraser"></i> Clear Console
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
// Di dalam script_add
async function runCommand(command) {
    if(!command) return;

    const terminal = document.getElementById('terminalBody');
    const status = document.getElementById('statusText');
    
    // UI Feedback
    status.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Streaming...';
    status.className = "text-[10px] font-mono text-yellow-500 uppercase font-bold tracking-widest";
    terminal.innerHTML += `<div class="mt-4 text-blue-400 font-bold border-t border-gray-800 pt-4"><i class="fas fa-terminal me-2"></i>php artisan ${command}</div>`;

    // Buat Koneksi SSE
    const response = await fetch(`/admin/execute-command?command=${encodeURIComponent(command)}`);
    const contentType = response.headers.get("content-type");

    if (contentType && contentType.indexOf("application/json") !== -1) {
        const data = await response.json();
        terminal.innerHTML += `<div class="text-red-500">${data.output}</div>`;

        status.innerHTML = '<i class="fas fa-circle me-1 text-[8px]"></i> Idle';
        status.className = "text-[10px] font-mono text-yellow-500 uppercase font-bold tracking-widest";
        return;
    } 
    const source = new EventSource(`/admin/execute-command?command=${encodeURIComponent(command)}`);

    source.onmessage = function(event) {
        const data = JSON.parse(event.data);
        
        if (data.output) {
            // Append output secara langsung
            const pre = document.createElement('pre');
            pre.className = "text-gray-300 font-mono leading-relaxed inline"; // inline agar tidak banyak baris kosong
            pre.innerText = data.output;
            terminal.appendChild(pre);
            
            // Auto scroll
            terminal.scrollTop = terminal.scrollHeight;
        }

        if (data.done) {
            source.close(); // Tutup koneksi jika sudah selesai
            status.innerHTML = '<i class="fas fa-check-circle me-1"></i> Success';
            status.className = "text-[10px] font-mono text-green-500 uppercase font-bold tracking-widest";
        }
    };

    source.onerror = function(err) {
        console.error("EventSource failed:", err);
        source.close();
        status.innerHTML = '<i class="fas fa-times-circle me-1"></i> Connection Closed';
        status.className = "text-[10px] font-mono text-red-500 uppercase font-bold tracking-widest";
    };
}
function clearTerminal() {
    document.getElementById('terminalBody').innerHTML = '<div class="text-green-400"><i class="fas fa-chevron-right me-2"></i>console_cleared</div>';
}
</script>

<!-- <script>
    async function runCommand(command) {
        if(!command) return;

        const terminal = document.getElementById('terminalBody');
        const status = document.getElementById('statusText');
        
        // Reset status to Executing
        status.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Executing...';
        status.className = "text-[10px] font-mono text-yellow-500 uppercase font-bold tracking-widest";

        // Tambahkan baris input ke terminal
        terminal.innerHTML += `<div class="mt-4 text-blue-400 font-bold border-t border-gray-800 pt-4"><i class="fas fa-terminal me-2 text-xs"></i>php artisan ${command}</div>`;
        terminal.scrollTop = terminal.scrollHeight;

        try {
            const response = await fetch('/admin/execute-command', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ command: command })
            });

            const data = await response.json();
            
            // Render output dengan <pre> agar tabel Artisan rapi
            terminal.innerHTML += `<pre class="text-gray-300 mt-2 font-mono leading-relaxed bg-gray-900/50 p-2 rounded">${data.output}</pre>`;
            
            status.innerHTML = '<i class="fas fa-check-circle me-1"></i> Success';
            status.className = "text-[10px] font-mono text-green-500 uppercase font-bold tracking-widest";

        } catch (error) {
            terminal.innerHTML += `<div class="text-red-500 mt-2 font-bold"><i class="fas fa-exclamation-triangle me-2"></i>[Error] Execution failed.</div>`;
            status.innerHTML = '<i class="fas fa-times-circle me-1"></i> Failed';
            status.className = "text-[10px] font-mono text-red-500 uppercase font-bold tracking-widest";
        }

        // Auto scroll ke bawah
        terminal.scrollTo({
            top: terminal.scrollHeight,
            behavior: 'smooth'
        });
    }

    function clearTerminal() {
        document.getElementById('terminalBody').innerHTML = '<div class="text-green-400"><i class="fas fa-chevron-right me-2"></i>console_cleared</div>';
    }
</script> -->

@endcan
@endpush