{ ... }:
{
  config.opts = {
    swapfile = false;

    shiftwidth = 2;
    tabstop = 2;
    expandtab = true;

    number = true;
    relativenumber = true;

    cursorline = true;
    signcolumn = "yes";

    foldmethod = "expr";
    foldexpr = "nvim_treesitter#foldexpr()";
    foldenable = false;

    updatetime = 300;
    timeoutlen = 400;
  };
}
