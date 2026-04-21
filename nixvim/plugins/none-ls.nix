{ pkgs, ... }:
{
  config.plugins.none-ls = {
    enable = true;

    sources.formatting = {
      nixfmt.enable = true;
      nixfmt.package = pkgs.nixfmt;
    };
  };
}
