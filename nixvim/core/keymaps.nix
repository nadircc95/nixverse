{ ... }:
{
  config.keymaps = [
    {
      key = "<c-n>";
      action = "<cmd>NvimTreeToggle<cr>";
    }

    { key = "<c-h>"; action = "<c-w>h"; }
    { key = "<c-j>"; action = "<c-w>j"; }
    { key = "<c-k>"; action = "<c-w>k"; }
    { key = "<c-l>"; action = "<c-w>l"; }

    {
      key = "<leader>f";
      action = "<cmd>lua vim.lsp.buf.format({ async = true })<cr>";
    }
  ];
}
