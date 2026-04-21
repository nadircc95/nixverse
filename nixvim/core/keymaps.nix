{ ... }:
{
  config.keymaps = [
    {
      key = "<c-n>";
      action = "<cmd>NvimTreeToggle<cr>";
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
      key = "<c-l>";
      action = "<c-w>l";
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

    {
      key = "<leader>f";
      action = "<cmd>lua vim.lsp.buf.format({ async = true })<cr>";
    }

    # Tambahkan keybinding untuk TUI apps (via toggleterm floating)
    # {
    #   mode = "n";
    #   key = "<leader>gg";
    #   action = "<cmd>ToggleTerm cmd='lazygit'<CR>";
    #   options.desc = "Open LazyGit";
    # }

    {
      mode = "n";
      key = "<leader>gg";
      action = "<cmd>lua _LAZYGIT_TOGGLE()<CR>";
      options = {
        desc = "Open LazyGit";
        silent = true;
      };
    }

    {
      mode = "n";
      key = "<leader>gs";
      action = "<cmd>ToggleTerm cmd='htop'<CR>";
      options.desc = "Open System Monitor (htop)";
    }

    {
      mode = "n";
      key = "<leader>gf";
      action = "<cmd>ToggleTerm cmd='lf'<CR>";
      options.desc = "Open File Manager (lf)";
    }

    {
      mode = "n";
      key = "<leader>gy";
      action = "<cmd>ToggleTerm cmd='lazydocker'<CR>";
      options.desc = "Open LazyDocker";
    }

    # Terminal Mode Keybindings
    {
      mode = "t";
      key = "<Esc>";
      action = "<C-\\><C-n>";
      options.desc = "Exit Terminal Mode";
    }

    {
      mode = "t";
      key = "<C-q>";
      action = "<C-\\><C-n>";
      options.desc = "Exit Terminal Mode (Ctrl+q)";
    }

    {
      mode = "n";
      key = "<leader>za";
      action = "<cmd>lua require('ufo').toggleFold()<CR>";
      options.desc = "Toggle Fold";
    }

  ];
}
