{ pkgs, ... }:
{
  config.plugins.none-ls = {
    enable = true;

    sources = {
      formatting = {
        nixfmt = {
          enable = true;
          package = pkgs.nixfmt;
        };
      };
    };
  };
}
