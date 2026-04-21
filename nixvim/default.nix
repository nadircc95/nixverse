{ inputs, system, pkgs, ... }:

let
  nixvimLib = inputs.nixvim.lib.${system};
in
nixvimLib.makeNixvimWithModule {
  inherit pkgs system;

  module = {
    imports = [
      ./core/options.nix
      ./core/globals.nix
      ./core/keymaps.nix

      ./plugins/cmp.nix
      ./plugins/lsp.nix
      ./plugins/telescope.nix
      ./plugins/treesitter.nix
      ./plugins/ui.nix
      ./plugins/filetree.nix
      ./plugins/markdown.nix
      ./plugins/none-ls.nix

      ./languages/php.nix

      ./extras/packages.nix
    ];
  };
}
