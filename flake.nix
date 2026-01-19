{
  description = "Nix Config Personal";

  inputs = {
    nixpkgs.url = "github:nixos/nixpkgs?ref=nixos-unstable";
    nixos-wsl.url = "github:nix-community/nixos-wsl/main";

  };

  outputs = { self, nixpkgs, nixos-wsl }: {
    nixosConfigurations = {
      nadir-wsl = nixpkgs.lib.nixosSystem {
	system = "x86_64-linux";
	modules = [
	  nixos-wsl.nixosModules.default
	  {
	    system.stateVersion = "25.11";
	    wsl.enable = true;
	    wsl.defaultUser = "nadir";

	    nix.settings.experimental-features = [
	      "nix-command"
	      "flakes"
	    ];
	  }
	];
      };
    };

  };
}
