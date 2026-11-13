{ pkgs, ... }:
{
  config.extraPackages = with pkgs; [
    # Core tools
    ripgrep
    fd

    # Node ecosystem
    nodejs
    prettier
    # intelephense
    # blade-formatter

    # PHP
    php83
    phpstan
    php83Packages.php-cs-fixer

    # TUI Apps
    lazygit
    htop
    lf
    bottom           # Alternative to htop
    fzf              # Fuzzy finder
  ];
}
