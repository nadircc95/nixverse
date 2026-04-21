{ inputs, ... }:
{
  perSystem =
    { system, pkgs, ... }:
    let
      nvim = import ./nixvim/default.nix {
        inherit inputs system pkgs;
      };
    in
    {
      packages.nvim = nvim;
    };
}
