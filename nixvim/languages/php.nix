{ ... }:
{
  config.plugins.efmls-configs = {
    enable = true;

    languages.php = {
      linter = "phpstan";
      formatter = "php_cs_fixer";
    };
  };
}
