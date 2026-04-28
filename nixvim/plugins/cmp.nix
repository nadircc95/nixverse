{ ... }:
{
  config.plugins = {
    cmp = {
      enable = true;
      autoEnableSources = true;

      settings = {
        mapping = {
# Move down with Tab
          "<Tab>" = "cmp.mapping.select_next_item()";
# Move up with Shift+Tab
          "<S-Tab>" = "cmp.mapping.select_prev_item()";
# Select with Enter
          "<CR>" = "cmp.mapping.confirm({ select = true })";
# Select with Ctrl+y (Standard Vim)
          "<C-y>" = "cmp.mapping.confirm({ select = true })";
        };

        experimental.ghost_text = true;

        sources = [
          { name = "nvim_lsp"; }
          { name = "buffer"; }
          { name = "path"; }
        ];
      };
    };

    luasnip.enable = true;
  };
}
