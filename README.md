# nix configuration

## command 

* Nix Verse Rebuild 
```bash
sudo nixos-rebuild switch --flake github:nadircc95/nixverse#nadir-wsl
```

## WSL

```bash
wsl --list
wsl --install --from-file <NAME.wsl> --name <WSL_distro_name> 
```

## Membuat file WSL

Jalankan dari root repository untuk membuat file WSL berdasarkan konfigurasi lokal
`nadir-wsl`:

```bash

# dari nixverse github
sudo nix run github:nadircc95/nixverse#nixosConfigurations.nadir-wsl.config.system.build.tarballBuilder <NAME.wsl>
# dari nix local
sudo nix run .#nixosConfigurations.nadir-wsl.config.system.build.tarballBuilder
```

Tanpa nama output, builder menghasilkan `nixos.wsl` di direktori saat ini.
Untuk menentukan nama file, berikan nama beserta ekstensi `.wsl`:

```bash
sudo nix run .#nixosConfigurations.nadir-wsl.config.system.build.tarballBuilder -- nadirnix-new.wsl
```

Jika ingin menggunakan versi terbaru dari semua input flake yang dikunci di
`flake.lock`, perbarui input terlebih dahulu:

```bash
nix flake update
sudo nix run .#nixosConfigurations.nadir-wsl.config.system.build.tarballBuilder
```

Setelah file selesai dibuat, import ke WSL dari PowerShell (ganti nama/path sesuai
kebutuhan):

```powershell
wsl --install --from-file .\nixos.wsl --name nadir-wsl
```

## Apply Configuration

```bash
sudo nixos-rebuild switch --flake .#nadir-wsl
```

## NVIM

```bash
nix run .#nvim # local build
nix run github:nadircc95/nixverse#nvim # remote run
```

Di Vim, ada beberapa cara cepat untuk pindah baris:

### **Navigasi Baris Dasar**

| Perintah | Deskripsi |
|----------|-----------|
| `j` | Baris bawah (1 baris) |
| `k` | Baris atas (1 baris) |
| `G` | Jump ke akhir file |
| `gg` | Jump ke awal file |
| `<number>G` | Jump ke baris spesifik (misal: `50G` → ke baris 50) |
| `<Ctrl+G>` | Lihat nomor baris saat ini |

### **Navigasi Lebih Cepat**

| Perintah | Deskripsi |
|----------|-----------|
| `{` | Jump ke paragraph sebelumnya |
| `}` | Jump ke paragraph berikutnya |
| `%` | Jump ke matching bracket |
| `*` | Jump ke kata berikutnya yang sama |
| `#` | Jump ke kata sebelumnya yang sama |
| `H` | Jump ke top of screen |
| `M` | Jump ke middle of screen |
| `L` | Jump ke bottom of screen |

### **Dengan Jumlah (Count)**

- `5j` → Pindah 5 baris bawah
- `10k` → Pindah 10 baris atas
- `20G` → Jump ke baris 20
- `5<Ctrl+D>` → Scroll down 5 "pages"
- `5<Ctrl+U>` → Scroll up 5 "pages"

### **Pencarian (Paling Cepat!)**

| Perintah | Deskripsi |
|----------|-----------|
| `/<text>` | Cari text dan jump ke baris itu |
| `?<text>` | Cari text ke atas |
| `n` | Next match |
| `N` | Previous match |

**Contoh:** Di file Anda sekarang, ingin ke `apiTransactionStorage()`?
- Tekan `/apiTransactionStorage` lalu `Enter`
- Vim langsung jump ke function itu!

### **Di NixVim - Custom Keybinding (Opsional)**

Bisa tambah di keymaps.nix:

```nix
{
  mode = "n";
  key = "<leader>gt";
  action = "<cmd>terminal lf<CR>";
  options.desc = "Go to Line";
}

# Atau lebih simple, gunakan built-in Neovim
{
  mode = "n";
  key = "<leader>g";
  action = "<cmd>Telescope builtin<CR>";
  options.desc = "Fuzzy Find (Telescope)";
}
```

### **TL;DR - Shortcut Paling Efektif**
1. **`<number>G`** - Jump ke baris spesifik (misal: `42G`)
2. **`/<text>`** - Cari dan jump
3. **`gg`** / **`G`** - Awal/akhir file
4. **`Ctrl+F`** - Sudah ada keybinding untuk Telescope

Coba `42G` untuk jump ke baris 42, atau `/function` untuk cari function dengan cepat! 🚀


### replace '){' to ') {' 
```bash
:args app/Http/Controllers/**/*.php
:argdo %s/){/) {/g | update
```

### replace ) :type to :type {
```bash
:args app/Http/Controllers/**/*.php
:argdo %s/)\s*:\s*\([^{]*\)\n\s*{/) :\1 {/g | update
```

### replace '( enter{' to '( {'
```bash
:args app/Http/Controllers/**/*.php
:argdo %s/)\n\s*{/) {/g | update
```

### undo semua files di args list
```bash 
:args app/Http/Controllers/**/*.php
:argdo undo | update
```


```bash

# Membersihkan Generasi Lama NixOS (Garbage Collection)
sudo nix-collect-garbage -d
```
