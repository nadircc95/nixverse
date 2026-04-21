{ ... }:
{
  plugins.toggleterm = {
    enable = true;
    direction = "float";
    openMapping = "<C-\\>";
    insertMappings = true;
    terminalMappings = true;
    persistSize = true;
    closeOnExit = true;
    floatOpts = {
      border = "curved";
      winblend = 3;
    };
  };
}
