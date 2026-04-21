{ pkgs, ... }:
{
  config.plugins.lsp = {
    enable = true;

    servers = {
      nixd.enable = true;

      intelephense = {
        enable = true;
        package = null;
        cmd = [ "intelephense" "--stdio" ];
      };
    };

    keymaps.lspBuf = {
      "gd" = "definition";
      "gr" = "references";
      "K" = "hover";
      "<leader>rn" = "rename";
    };
  };
}
