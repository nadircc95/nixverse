{ pkgs, ... }:
{
  config.extraPackages = with pkgs; [
    # Core tools
    ripgrep
    fd

    # Node ecosystem
    nodejs
    nodePackages.prettier
    # nodePackages.intelephense
    # nodePackages.blade-formatter

    # PHP
    php83
    php83Packages.phpstan
    php83Packages.php-cs-fixer
  ];
}
