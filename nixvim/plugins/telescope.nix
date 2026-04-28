{ ... }:
{
  config.plugins.telescope = {
    enable = true;

    keymaps = {
      "<leader>ff" = {
        action = "find_files";
        options.desc = "Find files";
      };
      "<leader>fg" = {
        action = "live_grep";
        options.desc = "Live grep";
      };
      "<leader>fs" = {
        action = "current_buffer_fuzzy_find";
        options.desc = "Find text in active file";
      };
      "<leader>fb" = {
        action = "buffers";
        options.desc = "Find buffers";
      };
    };
  };
}
