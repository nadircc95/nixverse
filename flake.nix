{
  description = "Nix Config Personal";

  inputs = {
    nixpkgs.url = "github:nixos/nixpkgs?ref=nixos-unstable";
    nixos-wsl.url = "github:nix-community/nixos-wsl/main";
    flake-parts.url = "github:hercules-ci/flake-parts";
    nixvim.url = "github:nix-community/nixvim";
  };

  outputs = { flake-parts, ... }@inputs: 
    flake-parts.lib.mkFlake {inherit inputs;} {
      systems = [
	"x86_64-linux"
	"aarch64-linux"
	"x86_64-darwin"
	"aarch64-darwin"
      ];

      imports = [
	./wsl.nix
	./neovim.nix
      ];
    }
  ; 
}
