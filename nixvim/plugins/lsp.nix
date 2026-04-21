{ pkgs, ... }:
{
  config.plugins.lsp = {
    enable = true;

    servers = {
      nixd.enable = true;

      intelephense.enable = true;
    };

    keymaps.lspBuf = {
      "gd" = "definition";
      "gr" = "references";
      "K" = "hover";
      "<leader>rn" = "rename";
    };
  };
}
