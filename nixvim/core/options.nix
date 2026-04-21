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

    -- 2. Daftarkan parser PHP untuk Blade (Kunci Utama Warna)
    -- Kita beritahu Neovim: "Kalau ada file Blade, pakai logika PHP/HTML"
    vim.api.nvim_create_autocmd({ "BufRead", "BufNewFile" }, {
      pattern = "*.blade.php",
      callback = function()
        vim.treesitter.start(0, "php") 
        vim.cmd("setlocal syntax=php")
      end,
    })

    -- 3. Tambahkan Query Injection langsung di memori
    local query = [[
      ((text) @injection.content
       (#set! injection.combined)
       (#set! injection.language "html"))
    ]]

    -- Pastikan parser php sudah dimuat dulu sebelum set query
    pcall(require("vim.treesitter.query").set, "php", "injections", query)
  '';
}
