{ inputs, ... }: {
    flake.nixosConfigurations = let inherit (inputs) nixpkgs nixos-wsl; in {
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
	  ({pkgs,...}: {
	    environment.systemPackages = [
	      inputs.self.packages.${pkgs.stdenv.system}.nvim
	    ];
	  })
	];
      };
    };
}

