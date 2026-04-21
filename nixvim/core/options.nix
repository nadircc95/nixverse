{ ... }:
{
  config.opts = {
    swapfile = false;

    shiftwidth = 2;
    tabstop = 2;
    expandtab = true;

    number = true;
    relativenumber = true;

    cursorline = true;
    signcolumn = "yes";

    foldmethod = "expr";
    foldexpr = "nvim_treesitter#foldexpr()";
    foldenable = false;

    updatetime = 300;
    timeoutlen = 400;
  };

  config.extraConfigLua = ''
    -- 1. Deteksi filetype
    vim.filetype.add({
      pattern = { ['.*%.blade%.php'] = 'blade' },
    })

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
