{ inputs, ... }:
{
  perSystem = { system, pkgs, ... }:
    let
    nixvimLib = inputs.nixvim.lib.${system};
  nixvim' = inputs.nixvim.legacyPackages.${system};

  nixvimModule = {
    inherit system;

    module = {
###### OPTIONS (VIM CORE) ######
      config.opts = {
        shiftwidth = 2;
        tabstop = 2;
        expandtab = true;

        number = true;          # absolute line number
          relativenumber = true;  # relative line number

          cursorline = true;
        signcolumn = "yes";
      };

###### KEYMAPS ######
      config.keymaps = [
      {
        key = "<c-n>";
        action = "<cmd>NvimTreeToggle<cr>";
        options.silent = true;
      }
      { key = "<c-l>"; action = "<c-w>l"; }
      { key = "<c-h>"; action = "<c-w>h"; }
      { key = "<c-j>"; action = "<c-w>j"; }
      { key = "<c-k>"; action = "<c-w>k"; }

      {
        key = "<c-f>";
        action = "<cmd>Telescope<cr>";
      }

      { key = "<m-Up>";    action = "<cmd>resize -2<cr>"; }
      { key = "<m-Down>";  action = "<cmd>resize +2<cr>"; }
      { key = "<m-Left>";  action = "<cmd>vertical resize -2<cr>"; }
      { key = "<m-Right>"; action = "<cmd>vertical resize +2<cr>"; }

      {
        mode = "n";
        key = "<leader>fe";
        action = ":let f=findfile('.env','.;') | if empty(f) | echo 'No .env found' | else | execute 'edit '..f | endif<CR>";
        options.desc = "Edit nearest .env (safe)";
      }

      {
        mode = "n";
        key = "<leader>er";
        action = ":let f=findfile('.envrc','.;') | if empty(f) | echo 'No .envrc found' | else | execute 'edit '..f | endif<CR>";
        options.desc = "Edit nearest .envrc (safe)";
      }
      ];

###### EXTRA PACKAGES ######
      config.extraPackages = [
        pkgs.ripgrep
      ];

###### TELESCOPE ######
      config.plugins.telescope = {
        enable = true;

        settings.defaults = {
          hidden = true;
          no_ignore = true;
          no_ignore_parent = true;
          follow = true;

          file_ignore_patterns = [
            "node_modules"
              "vendor"
              ".git"
              ".tmp"
              ".direnv"
          ];
        };

###### TELESCOPE KEYMAPS ######
        keymaps.ff = {
          action = "find_files";
          options.desc = "Find files (include hidden)";
        };

        keymaps.fF = {
          action = "live_grep";
          options.desc = "Find by words";
        };

        keymaps."f'" = {
          action = "grep_string";
          options.desc = "Find by string";
        };

        keymaps.fb = {
          action = "buffers";
          options.desc = "Find buffers";
        };

        keymaps.fB = {
          action = "current_buffer_fuzzy_find";
          options.desc = "Fuzzy current buffer";
        };

        keymaps.fh = {
          action = "help_tags";
          options.desc = "Find help";
        };

        keymaps.fc = {
          action = "colorscheme";
          options.desc = "Find colorscheme";
        };

        keymaps.fC = {
          action = "highlights";
          options.desc = "Find highlights";
        };
      };



###### UI ######
      config.plugins.web-devicons.enable = true;

      config.colorschemes.vscode = {
        enable = true;
        settings = {
          italic_comments = true;
          italic_inlayhints = true;
          terminal_colors = true;
          transparent = true;
          underline_links = true;

          color_overrides = {
            vscLineNumber = "#FFFFFF";
          };
        };
      };

###### FILE TREE ######
      config.plugins.nvim-tree = {
        enable = true;
        settings = {
          view = {
            side = "left";
            width = 60;
          };
          filters.dotfiles = true;
          git.enable = true;
        };
      };
    };

    extraSpecialArgs = {};
  };

  nvim = nixvim'.makeNixvimWithModule nixvimModule;
  in
  {
    packages.nvim = nvim;
  };
}

