{ ... }:
{
  plugins.toggleterm = {
    enable = true;
    settings = {
      direction = "float";
      float_opts = {
        border = "curved";
        winblend = 3;
      };
      open_mapping = "<C-\\>";
      insert_mappings = true;
      terminal_mappings = true;
      persist_size = true;
      close_on_exit = true;
    };
  };
}
