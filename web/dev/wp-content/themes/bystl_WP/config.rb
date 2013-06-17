# =================================================
#   Compass Sass Configuration File
#
#     CONFIG REFERENCE: http://bit.ly/mdB26R
# =================================================

# =================================================
#   ASSET STRUCTURE     
# =================================================

  http_path = "/"
  css_dir = "/" #has to be like this for a wordpress theme, and the sheet must be named "style.css"
  fonts_dir = "/fonts"
  sass_dir = "sass"
  images_dir = "img"
  javascripts_dir = "js"

# =================================================
#     output_style options:
#       :expanded :nested :compact :compressed
# =================================================

  # THIS IS CALLED WHEN ANT RUNS WITH buildtype-dev
  # $ compass compile -e development --force
  if environment != :production
    output_style = :expanded
    line_comments = true
    # give us all the info
    disable_warnings = false
    sass_options = {:quiet => false}
  end

  # THIS IS CALLED WHEN ANT RUNS WITH buildtype-deploy
  # $ compass compile -e production --force
  if environment == :production 
    # keep the build output nice and clean
    output_style = :compressed
    line_comments = false
    # give us all the info
    disable_warnings = false
    sass_options = {:quiet => false}
  end

  # Enable relative paths to assets
  # via compass helper functions:
    relative_assets = true

  # disable the asset cache buster
    asset_cache_buster :none

# =================================================
#   CUSTOM SASS FUNCTIONS
# =================================================

  module Sass::Script::Functions
  # BEGIN SASS FUNCTIONS

    #output a new hexidecimal string
    def hex_str(decimal)
      Sass::Script::String.new("%02x" % decimal)
    end

    #output a hexidecimal string for Internet Explorer's Alpha Filter Hacks
    def ie_hex_str(color)
      assert_type color, :Color
      alpha = (color.alpha * 255).round.to_s(16).rjust(2, '0')
      Sass::Script::String.new("##{alpha}#{color.send(:hex_str)[1..-1]}".upcase)
    end
    declare :ie_hex_str, [:color]

    # Inspects the unit of the number, returning the number only
    # @param string [String] The number to inspect
    # @return [Literal] The number without its unit
    def value(string)
      Sass::Script::Number.new(string.value)
    end
    declare :value, [:number]


  # END SASS FUNCTIONS
  end

# =================================================
#   UTILITIES / SUPPORT
# =================================================

  # Support for repeating-linear-gradient: http://bit.ly/Odh24F
  Compass::BrowserSupport.add_support('repeating-linear-gradient', 'webkit', 'moz', 'o', 'ms')

