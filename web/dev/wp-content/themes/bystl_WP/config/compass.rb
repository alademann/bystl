# Require any additional compass plugins here.
require "rgbapng"

# Set this to the root of your project when deployed:
http_path = "/"
css_dir = "/" #has to be like this for a wordpress theme, and the sheet must be named "style.css"
fonts_dir = "fonts"
sass_dir = "sass"
images_dir = "img"
javascripts_dir = "js"

# You can select your preferred output style here (can be overridden via the command line):
# output_style = :expanded or :nested or :compact or :compressed
# use $ compass compile -e production --force to produce compressed css files for production.
	output_style = (environment == :production) ? :compact : :expanded	

# To enable relative paths to assets via compass helper functions. Uncomment:
 relative_assets = true

# To disable debugging comments that display the original location of your selectors. Uncomment:
# line_comments = false




# If you prefer the indented syntax, you might want to regenerate this
# project again passing --syntax sass, or you can uncomment this:
# preferred_syntax = :sass
# and then run:
# sass-convert -R --from scss --to sass includes/sass scss && rm -rf sass && mv scss sass

module Sass::Script::Functions
  def hex(decimal)
    Sass::Script::String.new("%02x" % decimal)
  end

	def ie_hex_str(color)
    assert_type color, :Color
    alpha = (color.alpha * 255).round.to_s(16).rjust(2, '0')
		Sass::Script::String.new("##{alpha}#{color.send(:hex_str)[1..-1]}".upcase)	
	end     
  declare :ie_hex_str, [:color]

end