{ ... }:
{
  config.opts = {
    # swapfile = false;
    #
    # shiftwidth = 2;
    # tabstop = 2;
    # expandtab = true;
    #
    # number = true;
    # relativenumber = true;
    #
    # cursorline = true;
    # signcolumn = "yes";
    #
    # foldmethod = "expr";
    # foldexpr = "nvim_treesitter#foldexpr()";
    # foldenable = false;
    #
    # updatetime = 300;
    # timeoutlen = 400;

    # UI
    number = true;                    # Line numbers
    relativenumber = true;            # Relative line numbers
    cursorline = true;                # Highlight current line
    cursorcolumn = false;             # Highlight current column
    signcolumn = "yes";               # Always show sign column
    colorcolumn = "80,120";           # Show column guides
    
    # Indentation
    shiftwidth = 2;
    tabstop = 2;
    expandtab = true;                 # Use spaces instead of tabs
    autoindent = true;
    smartindent = true;
    
    # Search
    ignorecase = true;                # Case-insensitive search
    smartcase = true;                 # Smart case matching
    hlsearch = true;                  # Highlight search results
    incsearch = true;                 # Incremental search
    
    # Folding
    foldmethod = "indent";            # or "expr", "syntax"
    foldenable = true;                # Enable folding by default
    foldlevel = 99;                   # Open all folds on start
    
    # Performance
    swapfile = false;
    backup = false;
    undofile = true;                  # Persistent undo
    updatetime = 300;
    timeoutlen = 400;
    
    # Behavior
    hidden = true;                    # Keep buffer when switching
    splitbelow = true;                # Split below current window
    splitright = true;                # Split right of current window
    mouse = "a";                       # Enable mouse support
    clipboard = "unnamedplus";        # System clipboard
  };

  config.extraConfigLua = ''
    -- 1. Deteksi filetype
    vim.filetype.add({
      pattern = { ['.*%.blade%.php'] = 'blade' },
    })

    -- Terminal & Interactive
    vim.opt.termguicolors = true
    vim.g.inccommand = "split"

    local artisan = require("toggleterm.terminal").Terminal:new({
      cmd = "bash",
      direction = "vertical",
      hidden = true,
      env = {
        PS1 = "\\w $ ",
      },
      size = function() return math.floor(vim.o.columns * 0.4) end,
      on_open = function(term)
        vim.bo[term.bufnr].modifiable = true
        vim.cmd("startinsert!")
        vim.keymap.set("t", "<C-q>", function()
          term:close()
        end, { noremap = true, silent = true, buffer = term.bufnr })
        vim.keymap.set("n", "<C-q>", function()
          term:close()
        end, { noremap = true, silent = true, buffer = term.bufnr })
      end,
    })
    function _ARTISAN_TOGGLE()
      artisan:toggle()
    end

    -- Helper: buat float terminal dengan Esc-Esc untuk close
    local function make_float_term(cmd)
      return require("toggleterm.terminal").Terminal:new({
        cmd = cmd,
        direction = "float",
        hidden = true,
        float_opts = {
          border = "curved",
          width = function() return vim.o.columns end,
          height = function() return vim.o.lines end,
        },
        on_open = function(term)
          -- Esc-Esc untuk close (aman untuk program interaktif)
          vim.keymap.set("t", "<C-q>", function()
            term:close()
          end, { noremap = true, silent = true, buffer = term.bufnr })

          vim.keymap.set("n", "<C-q>", function()
            term:close()
          end, { noremap = true, silent = true, buffer = term.bufnr })
        end,
      })
    end

    local lazygit    = make_float_term("lazygit")
    local htop       = make_float_term("htop")
    local lf         = make_float_term("lf")
    local lazydocker = make_float_term("lazydocker")

    function _LAZYGIT_TOGGLE()    lazygit:toggle()    end
    function _HTOP_TOGGLE()       htop:toggle()       end
    function _LF_TOGGLE()         lf:toggle()         end
    function _LAZYDOCKER_TOGGLE() lazydocker:toggle() end

    -- 2. Daftarkan parser PHP untuk Blade
    vim.api.nvim_create_autocmd({ "BufRead", "BufNewFile" }, {
      pattern = "*.blade.php",
      callback = function()
        vim.treesitter.start(0, "php")
        vim.cmd("setlocal syntax=php")
      end,
    })

    -- 3. Tambahkan Query Injection untuk Blade di memori
    local query = [[
      ((text) @injection.content
       (#set! injection.combined)
       (#set! injection.language "html"))
    ]]
    pcall(require("vim.treesitter.query").set, "php", "injections", query)
  '';
}
