{ lib, ... }:
{
  config.plugins.toggleterm = {
    enable = true;
    settings = {
      direction = "float";
      open_mapping = lib.nixvim.mkRaw ''[[<C-\>]]'';
      insert_mappings = true;
      terminal_mappings = true;
      persist_size = true;
      close_on_exit = true;
      float_opts = {
        border = "curved";
        winblend = 3;
      };
    };
  };
}
