{ inputs, ... }: { perSystem = { system, pkgs, ... }: 
  let 
    nixvimLib = inputs.nixvim.lib.${system};
  nixvim' = inputs.nixvim.legacyPackages.${system};
  nixvimModule = {
    inherit system;
    module = {
      config.opts.shiftwidth = 2;
      config.keymaps = [
      {
	action = "<cmd>NvimTreeToggle<cr>";
	key = "<c-n>";
	options.silent = true;
      }
      {
	action = "<c-w>l";
	key = "<c-l>";
      }
      {
	action = "<c-w>h";
	key = "<c-h>";
      }
      {
	action = "<c-w>j";
	key = "<c-j>";
      }
      {
	action = "<c-w>k";
	key = "<c-k>";
      }	
      {
	action = "<cmd>Telescope<cr>";
	key = "<c-f>";
      }
      {
	action = "<cmd>resize -2<cr>";
	key = "<m-Up>";
      }
      {
	action = "<cmd>resize +2<cr>";
	key = "<m-Down>";
      }
      {
	action = "<cmd>vertical resize -2<cr>";
	key = "<m-Left>";
      }
      {
	action = "<cmd>vertical resize +2<cr>";
	key = "<m-Right>";
      }

      ];
      # config.lazyload.settings.cmd = "Telescope";
      config.extraPackages = [
	pkgs.ripgrep
      ];
      config.plugins.web-devicons.enable = true;
      # config.plugins.mini-icons.enable = true;
      config.plugins.telescope = {
	enable = true;
	keymaps.ff.options.desc = "Find by files";
	keymaps.ff.action = "find_files";

	keymaps.fF.options.desc = "Find by words";
	keymaps.fF.action = "live_grep";

	keymaps."f'".options.desc = "Find by string";
	keymaps."f'".action = "grep_string";

	keymaps.fb.options.desc = "Find by current buffers";
	keymaps.fb.action = "buffers";

	keymaps.fB.options.desc = "Find fuzz by current buffers";
	keymaps.fB.action = "current_buffer_fuzzy_find";

	keymaps.fh.options.desc = "Find by help tags";
	keymaps.fh.action = "help_tags";

	keymaps.fc.options.desc = "Find by colorscheme";
	keymaps.fc.action = "colorscheme";

	keymaps.fC.options.desc = "Find by highlights";
	keymaps.fC.action = "highlights";
      };
      config.colorschemes.vscode.enable = true;
      config.colorschemes.vscode.settings = {
	color_overrides = {
	  vscLineNumber = "#FFFFFF";
	};
	italic_comments = true;
	italic_inlayhints = true;
	terminal_colors = true;
	transparent = true;
	underline_links = true;
      };
      config.plugins.nvim-tree = {
	enable = true;
	settings = {
	  view.side = "left";
	  view.width = 60;
	  filters.dotfiles = true;
	  git.enable = true;
	};
      };
    };
    extraSpecialArgs = {};
  };
  nvim = nixvim'.makeNixvimWithModule nixvimModule;
  in {
    packages.nvim = nvim;
  };
		 }
