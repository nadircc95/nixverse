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

            wsl.useWindowsDriver = true; # Opsional, membantu integrasi driver jika diperlukan
            systemd.services.docker.wantedBy = [ "multi-user.target" ];

            nixpkgs.config.allowUnfree = true;

            nix.settings.experimental-features = [
              "nix-command"
              "flakes"
            ];
          }
          (
            { pkgs, ... }:
            {
              # --- Tambahkan 2 baris ini ---
              virtualisation.docker.enable = true;
              users.users.nadir.extraGroups = [ "docker" ];

              programs.direnv.enable = true;
              programs.direnv.nix-direnv.enable = true;
              programs.nix-ld.enable = true;

              services.openssh.enable = true;
              programs.ssh.startAgent = true;

              # Menghubungkan direktori SSL universal & sertifikat SSL untuk Node/OpenSSL
              environment.variables = {
                SSL_CERT_FILE = "/etc/ssl/certs/ca-certificates.crt";
                SSL_CERT_DIR = "/etc/ssl/certs";
                NODE_EXTRA_CA_CERTS = "/etc/ssl/certs/ca-certificates.crt";
              };

              environment.systemPackages = [
                inputs.self.packages.${pkgs.stdenv.system}.nvim
                pkgs.git
                pkgs.direnv

                pkgs.wget
                pkgs.curl
                pkgs.intelephense
                pkgs.gh
                pkgs.cacert              # Menyediakan CA bundle untuk SSL/TLS

                # --- CLI Tools Global ---
                pkgs.github-copilot-cli # Copilot CLI terinstall global di WSL

                # --- Tools Reverse Engineering ---
                pkgs.ghidra             # <--- Tambahkan baris ini di sini
              ];
            }
          )
        ];
      };
    };
}
