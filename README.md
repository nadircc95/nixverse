# nix configuration

## command 

* Nix Verse Rebuild 
```console
sudo nixos-rebuild switch --flake github:nadircc95/nixverse#nadir-wsl
```

## WSL

```console
wsl --list
wsl --install --from-file <NAME.wsl> --name <WSL_distro_name> 
```

## Building wsl os

```console
sudo nix run github:nadircc95/nixverse#nixosConfigurations.nadir-wsl.config.system.build.tarballBuilder <NAME.wsl>
```

## Apply Configuration

```console
sudo nixos-rebuild switch --flake .#nadir-wsl
```

## NVIM

```console
nix run .#nvim # local build
nix run github:nadircc95/nixverse#nvim # remote run
```


