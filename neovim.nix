{ inputs, ... }:
{
  perSystem =
    { system, pkgs, ... }:
    let
      nixvimLib = inputs.nixvim.lib.${system};
      nixvim' = inputs.nixvim.legacyPackages.${system};
      nixvimModule =
        { config, pkgs, ... }:
        {

          ###### OPTIONS (VIM CORE) ######
          config.opts = {
            shiftwidth = 2;
            tabstop = 2;
            expandtab = true;

            number = true; # absolute line number
            relativenumber = true; # relative line number

            cursorline = true;
            signcolumn = "yes";

            foldmethod = "expr";
            foldexpr = "nvim_treesitter#foldexpr()";
            foldenable = false;
          };

          config.globals = {
            mapleader = " ";
            maplocalleader = " ";
          };

          ###### KEYMAPS ######
          config.keymaps = [
            {
              key = "<c-n>";
              action = "<cmd>NvimTreeToggle<cr>";
              options.silent = true;
            }
            {
              key = "<c-l>";
              action = "<c-w>l";
            }
            {
              key = "<c-h>";
              action = "<c-w>h";
            }
            {
              key = "<c-j>";
              action = "<c-w>j";
            }
            {
              key = "<c-k>";
              action = "<c-w>k";
            }

            {
              key = "<c-f>";
              action = "<cmd>Telescope<cr>";
            }

            {
              key = "<m-Up>";
              action = "<cmd>resize -2<cr>";
            }
            {
              key = "<m-Down>";
              action = "<cmd>resize +2<cr>";
            }
            {
              key = "<m-Left>";
              action = "<cmd>vertical resize -2<cr>";
            }
            {
              key = "<m-Right>";
              action = "<cmd>vertical resize +2<cr>";
            }

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
            {
              mode = "n";
              key = "<leader>mp";
              action = "<cmd>MarkdownPreviewToggle<CR>";
              options.desc = "Toggle Markdown Preview";
            }
            {
              mode = "n";
              key = "<leader>mr";
              action = "<cmd>RenderMarkdownToggle<CR>";
              options.desc = "Toggle Render Markdown";
            }

            # Format buffer saat ini
            {
              mode = "n";
              key = "<leader>f";
              action = "<cmd>lua vim.lsp.buf.format({ async = true })<cr>";
              options.desc = "Format buffer";
            }

          ];

          ###### EXTRA PACKAGES ######
          config.extraPackages = [
            pkgs.tree-sitter
            pkgs.ripgrep
            pkgs.nodejs
          ];

          config.extraPlugins = [ ];

          config.plugins.render-markdown = {
            # enable = true;
          };

          config.plugins.none-ls = {
            enable = true;
            sources.formatting = {
              nixfmt.enable = true; # Menggunakan nixfmt-rfc-style
              nixfmt.package = pkgs.nixfmt;
              # atau
              # alejandra.enable = true;
            };
          };
          config.plugins.cmp = {
            enable = true;
            autoEnableSources = true;
            settings = {

              experimental = {
                ghost_text = true;
              };

              sources = [
                { name = "nvim_lsp"; }
                { name = "path"; }
                { name = "buffer"; }
              ];

              mapping = {
                "<CR>" = "cmp.mapping.confirm({ select = true })";
                "<Tab>" = # lua
                  ''
                    cmp.mapping(function(fallback)
                      if cmp.visible() then
                        cmp.select_next_item()
                      else
                        fallback()
                      end
                    end, { "i", "s" })
                  '';
                "<S-Tab>" = # lua
                  ''
                    cmp.mapping(function(fallback)
                      if cmp.visible() then
                        cmp.select_prev_item()
                      else
                        fallback()
                      end
                    end, { "i", "s" })
                  '';
              };
            };
          };
          config.plugins.lsp = {
            enable = true;
            servers.nixd.enable = true;
            keymaps.lspBuf = {
              "gd" = "definition";
              "gD" = "declaration";
              "gr" = "references";
              "gi" = "implementation";
              "K" = "hover";
              "<leader>rn" = "rename";
              "<leader>ca" = "code_action";
            };
          };

          ###### MARKDOWN PREVIEW ######
          config.plugins.markdown-preview = {
            enable = true;

            settings = {
              auto_start = 0;
              auto_close = 1;
              refresh_slow = 0;
              open_to_the_world = 0;
              open_ip = "127.0.0.1";
              browser = "";
              echo_preview_url = 1;
            };
          };

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

          ###### TREESITTER ######
          config.plugins.treesitter = {

            enable = true;

            folding = {
              enable = true;
            };

            nixGrammars = true;
            nixvimInjections = true;

            grammarPackages = with config.plugins.treesitter.package.builtGrammars; [
              lua
              vim
              vimdoc
              bash
              json
              yaml
              toml
              php
              php_only
              phpdoc
              html
              css
              javascript
              typescript
              sql
              markdown
            ];

            settings = {
              indent = {
                enable = true;
              };

              highlight = {
                enable = true;
              };

              incremental_selection = {
                enable = true;
                keymaps = {
                  init_selection = "gnn";
                  node_incremental = "grn";
                  node_decremental = "grm";
                  scope_incremental = "grc";
                };
              };
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

      nvim = nixvim'.makeNixvimWithModule {
        inherit pkgs system;
        module = nixvimModule;
      };
    in
    {
      packages.nvim = nvim;
    };
}
