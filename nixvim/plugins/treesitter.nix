{ config, ... }:
{
  config.plugins.treesitter = {
    enable = true;

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
      blade
      html
      css
      javascript
      typescript
      sql
      markdown
    ];

    settings = {
      indent.enable = true;
      highlight.enable = true;
    };
  };
}
