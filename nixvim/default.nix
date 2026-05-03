{ inputs, system, pkgs, ... }:

let
  nixvim = inputs.nixvim.legacyPackages.${system};
in
nixvim.makeNixvim {

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
    ./plugins/render-markdown.nix
    ./plugins/none-ls.nix
    ./plugins/toggleterm.nix
    ./plugins/git.nix

    ./languages/php.nix
    ./extras/packages.nix
  ];
}
