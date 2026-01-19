{ inputs, ... }: { perSystem = { system, ... }: 
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
      ];
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
	  view.width = 25;
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
