{ inputs, ... }:
{
  flake.nixosConfigurations =
    let
      inherit (inputs) nixpkgs nixos-wsl;
    in
    {
      nadir-wsl = nixpkgs.lib.nixosSystem {
        system = "x86_64-linux";
        modules = [
          nixos-wsl.nixosModules.default
          {
            system.stateVersion = "25.11";
            wsl.enable = true;
            wsl.defaultUser = "nadir";
            wsl.wslConf.network.hostname = "nadirnix";

            nixpkgs.config.allowUnfree = true;

            nix.settings.experimental-features = [
              "nix-command"
              "flakes"
            ];
          }
          (
            { pkgs, ... }:
            {
              programs.direnv.enable = true;
              programs.direnv.nix-direnv.enable = true;
              programs.nix-ld.enable = true;

              services.openssh.enable = true;
              programs.ssh.startAgent = true;

              environment.systemPackages = [
                inputs.self.packages.${pkgs.stdenv.system}.nvim
                pkgs.git
                pkgs.direnv

                pkgs.wget
                pkgs.curl
                pkgs.nodePackages.intelephense
                pkgs.gh
              ];
            }
          )
        ];
      };
    };
}
