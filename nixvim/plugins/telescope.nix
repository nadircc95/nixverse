{ ... }:
{
  config.plugins.telescope = {
    enable = true;

    keymaps = {
      ff.action = "find_files";
      fF.action = "live_grep";
      fb.action = "buffers";
    };
  };
}
