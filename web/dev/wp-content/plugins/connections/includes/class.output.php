<?php

class cnOutput extends cnEntry
{
	/**
	 * Echos the 'Entry Sized' image.
	 *
	 * @deprecated since 0.7.2.0
	 */
	public function getCardImage()
	{
		$this->getImage();
	}

	/**
	 * Echos the 'Profile Sized' image.
	 *
	 * @deprecated since 0.7.2.0
	 */
	public function getProfileImage()
	{
		$this->getImage( array( 'image' => 'photo' , 'preset' => 'profile' ) );
	}

	/**
	 * Echos the 'Thumbnail Sized' image.
	 *
	 * @deprecated since 0.7.2.0
	 */
	public function getThumbnailImage()
	{
		$this->getImage( array( 'image' => 'photo' , 'preset' => 'thumbnail' ) );
	}

	/**
	 * Echos the logo image.
	 *
	 * @deprecated since 0.7.2.0
	 */
	public function getLogoImage( $atts = array() )
	{
		global $connections;

		/*
		 * Set some defaults so the result resembles how the previous rendered.
		 */
		/*$atts['image'] = 'logo';
		$atts['height'] = $connections->options->getImgLogoY();
		$atts['width'] = $connections->options->getImgLogoX();
		$atts['zc'] = 3;
		$this->getImage( $atts );*/
		$this->getImage( array( 'image' => 'logo' ) );
	}

	/**
	 * Echo or return the image/logo if associated in a HTML hCard compliant string.
	 *
	 * Accepted option for the $atts property are:
	 * 	image (string) Select the image to display. Valid values are photo || logo
	 * 	preset (string) Select one of the predefined image sizes Must be used in conjunction with the 'image' option. Valid values are thumbnail || entry || profile
	 * 	fallback (array) Object to be shown when there is no image or logo.
	 * 		type (string) Fallback type. Valid values are; none || default || block
	 * 		string (string) The string used with the block fallback
	 * 		height (int) Block height. [Required if a image custom size was set.]
	 * 		width (int) Block width.
	 * 	height (int) Override the values saved in the settings. [Required if providing custom size.]
	 * 	width (int) Override the values saved in the settings.
	 * 	zc (int) Crop format
	 * 		0 Resize to Fit specified dimensions (no cropping)
	 * 		1 Crop and resize to best fit the dimensions (default behaviour)
	 * 		2 Resize proportionally to fit entire image into specified dimensions, and add borders if required
	 * 		3 Resize proportionally adjusting size of scaled image so there are no borders gaps
	 * 	before (string) HTML to output before the image
	 * 	after (string) HTML to after before the image
	 * 	style (array) Customize an inline stlye tag for the image or the placeholder block. Array format key == attribute; value == value.
	 * 	return (bool) Return or echo the string. Default is to echo.
	 *
	 * NOTE: If only the height or width was set for a custom image size, the opposite image dimension must be set for
	 * the fallback block. This does not apply if the fallback is the default image.
	 *
	 * @todo Enable support for a default image to be set.
	 *
	 * @param array $atts [optional]
	 * @return string
	 */
	public function getImage( $suppliedAtts = array() )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
		$defaultAtts = array( 'image' => 'photo',
							  'preset' => 'entry',
							  'fallback' => array( 'type' => 'none',
							  					   'string' => '',
												   'height' => 0,
												   'width' => 0
												 ),
							  'height' => 0,
							  'width' => 0,
							  'zc' => 2,
							  'before' => '',
							  'after' => '',
							  'style' => array(),
							  'return' => FALSE
							);

		$atts = $this->validate->attributesArray( $defaultAtts , $suppliedAtts );
		if ( isset($suppliedAtts['fallback']) && is_array($suppliedAtts['fallback']) ) $atts['fallback'] = $this->validate->attributesArray( $defaultAtts['fallback'] , $suppliedAtts['fallback'] );
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		global $connections;
		$displayImage = FALSE;
		$style = array();
		$tag = array();
		$anchorStart = '';
		$anchorEnd = '</a>';
		$out = '';

		/*
		 * The $atts key that are not image tag attributes.
		 */
		$nonAtts = array( 'image' , 'preset' , 'fallback' , 'image_size' , 'zc' , 'before' , 'after' , 'return' );

		( ! empty($atts['height']) || ! empty($atts['width']) ) ? $customSize = TRUE : $customSize = FALSE;

		switch ( $atts['image'] )
		{
			case 'photo':
				if ( $this->getImageLinked() && $this->getImageDisplay() )
				{
					$displayImage = TRUE;
					$atts['class'] = 'photo';
					$atts['alt'] = 'Photo of ' . $this->getName();
					$atts['title'] = 'Photo of ' . $this->getName();

					if ( $customSize )
					{
						$atts['src'] = WP_CONTENT_URL . '/plugins/connections/includes/timthumb/timthumb.php?src=' .
									   CN_IMAGE_BASE_URL . $this->getImageNameOriginal() .
									   ( ( empty($atts['height'] ) ) ? '' : '&amp;h=' . $atts['height'] ) .
									   ( ( empty($atts['width'] ) ) ? '' : '&amp;w=' . $atts['width'] ) .
									   ( ( empty($atts['zc'] ) ) ? '' : '&amp;zc=' . $atts['zc'] );
					}
					else
					{
						switch ( $atts['preset'])
						{
							case 'entry':
								$atts['image_size'] = @getimagesize( CN_IMAGE_PATH . $this->getImageNameCard() );
								$atts['src'] = CN_IMAGE_BASE_URL . $this->getImageNameCard();
								break;
							case 'profile':
								$atts['image_size'] = @getimagesize( CN_IMAGE_PATH . $this->getImageNameProfile() );
								$atts['src'] = CN_IMAGE_BASE_URL . $this->getImageNameProfile();
								break;
							case 'thumbnail':
								$atts['image_size'] = @getimagesize( CN_IMAGE_PATH . $this->getImageNameThumbnail() );
								$atts['src'] = CN_IMAGE_BASE_URL . $this->getImageNameThumbnail();
								break;
							default:
								$atts['image_size'] = @getimagesize( CN_IMAGE_PATH . $this->getImageNameCard() );
								$atts['src'] = CN_IMAGE_BASE_URL . $this->getImageNameCard();
								break;
						}

						if ( $atts['image_size'] !== FALSE )
						{
							$atts['width'] = $atts['image_size'][0];
							$atts['height'] = $atts['image_size'][1];
						}
					}
				}

				/*
				 * Create the link for the image if one was assigned.
				 */
				$links = $this->getLinks( array( 'image' => TRUE ) );

				if ( ! empty($links) )
				{
					$link = $links[0];

					$anchorStart = '<a href="' . $link->url . '"' . ( ( empty($link->target) ? '' : ' target="' . $link->target . '"' ) ) . ( ( empty($link->followString) ? '' : ' rel="' . $link->followString . '"' ) ) . '>';
				}

			break;

			case 'logo':
				if ( $this->getLogoLinked() && $this->getLogoDisplay() )
				{
					$displayImage = TRUE;
					$atts['class'] = 'logo';
					$atts['alt'] = 'Logo for ' . $this->getName();
					$atts['title'] = 'Logo for ' . $this->getName();

					if ( $customSize )
					{
						$atts['src'] = WP_CONTENT_URL . '/plugins/connections/includes/timthumb/timthumb.php?src=' .
									   CN_IMAGE_BASE_URL . $this->getLogoName() .
									   ( (empty($atts['height']) ) ? '' : '&amp;h=' . $atts['height'] ) .
									   ( (empty($atts['width']) ) ? '' : '&amp;w=' . $atts['width'] ) .
									   ( (empty($atts['zc']) ) ? '' : '&amp;zc=' . $atts['zc'] );
					}
					else
					{
						$atts['src'] = CN_IMAGE_BASE_URL . $this->getLogoName();
						$atts['image_size'] = @getimagesize( CN_IMAGE_PATH . $this->getLogoName() );

						if ( $atts['image_size'] !== FALSE )
						{
							$atts['width'] = $atts['image_size'][0];
							$atts['height'] = $atts['image_size'][1];
						}
					}
				}

				/*
				 * Create the link for the image if one was assigned.
				 */
				$links = $this->getLinks( array( 'logo' => TRUE ) );

				if ( ! empty($links) )
				{
					$link = $links[0];

					$anchorStart = '<a href="' . $link->url . '"' . ( ( empty($link->target) ? '' : ' target="' . $link->target . '"' ) ) . ( ( empty($link->followString) ? '' : ' rel="' . $link->followString . '"' ) ) . '>';
				}

			break;
		}

		/*
		 * Add to the inline style the user supplied styles.
		 */
		foreach ( (array) $atts['style'] as $attr => $value )
		{
			if ( ! empty($value) ) $style[] = "$attr: $value";
		}

		if ( $displayImage )
		{
			foreach ( $atts as $attr => $value)
			{
				if ( ! empty($value) && ! in_array( $attr , $nonAtts ) ) $tag[] = "$attr=\"$value\"";
			}

			//if ( ! empty($atts['height']) ) $style[] = 'height: ' . $atts['height'] . 'px';
			//if ( ! empty($atts['width']) ) $style[] = 'width: ' . $atts['width'] . 'px';

			$out = '<span class="cn-image-style" style="display: inline-block;"><span class="cn-image">' . ( ( empty($anchorStart) ) ? '' : $anchorStart ) . '<img ' . implode(' ', $tag) . ' />' . ( ( empty($anchorStart) ) ? '' : $anchorEnd ) . '</span></span>';
		}
		else
		{
			if ( $customSize )
			{
				/*
				 * Set the size to the supplied custom. The fallback custom size would take priority if it has been supplied.
				 */
				// ( empty( $atts['fallback']['height'] ) ) ? $style[] = 'height: ' . $atts['height'] . 'px' : $style[] = 'height: ' . $atts['fallback']['height'] . 'px';
				// ( empty( $atts['fallback']['width'] ) ) ? $style[] = 'width: ' . $atts['width'] . 'px' : $style[] = 'width: ' . $atts['fallback']['width'] . 'px';
			}
			else
			{
				/*
				 * If a custom size was not set, use the dimensions saved in the settings.
				 */
				switch ( $atts['image'] )
				{
					case 'photo':

						switch ( $atts['preset'])
						{
							case 'entry':
								//$style[] = 'height: ' . $connections->options->getImgEntryY() . 'px';
								//$style[] = 'width: ' . $connections->options->getImgEntryX() . 'px';
								break;
							case 'profile':
								//$style[] = 'height: ' . $connections->options->getImgProfileY() . 'px';
								//$style[] = 'width: ' . $connections->options->getImgProfileX() . 'px';
								break;
							case 'thumbnail':
								$style[] = 'height: ' . $connections->options->getImgThumbY() . 'px';
								$style[] = 'width: ' . $connections->options->getImgThumbX() . 'px';
								break;
							default:
								//$style[] = 'height: ' . $connections->options->getImgEntryY() . 'px';
								//$style[] = 'width: ' . $connections->options->getImgEntryX() . 'px';
								break;
						}

						break;

					case 'logo':
						$style[] = 'height: ' . $connections->options->getImgLogoY() . 'px';
						$style[] = 'width: ' . $connections->options->getImgLogoX() . 'px';
						break;
				}
			}

			switch ( $atts['fallback']['type'] )
			{
				case 'block':
					$style[] = 'display: inline-block';

					( empty( $atts['fallback']['string'] ) ) ? $string = '' : $string = '<p>' . $atts['fallback']['string'] . '</p>';

					$out = '<span class="cn-image-style" style="display: inline-block;"><span class="cn-image-none"' . ( ( empty($style) ) ? '' : ' style="' . implode('; ', $style) . ';"') . '>' . $string . '</span></span>';

					break;

				case 'default':
					/*
					 * @TODO Enable support for a default image to be set.
					 * NOTE: Use switch for image type to allow a default image for both the image and logo.
					 */
					break;
			}
		}

		/*
		 * Return or echo the string.
		 */
		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	/**
	 * Echo or return the entry name in a HTML hCard compliant string.
	 *
	 * Accepted options for the $atts property are:
	 * 	format (string) Tokens for the parts of the name.
	 * 		Permitted Tokens:
	 * 			%prefix%
	 * 			%first%
	 * 			%middle%
	 * 			%last%
	 * 			%suffix%
	 * 	before (string) HTML to output before an address.
	 * 	after (string) HTML to after before an address.
	 * 	return (bool) Return or echo the string. Default is to echo.
	 *
	 * Example:
	 * 	If an entry is an individual this would return their name as Last Name, First Name
	 *
	 * 	$this->getName( array( 'format' => '%last%, %first% %middle%' ) );
	 *
	 * NOTE: If an entry is a organization/family, this will return the organization/family name instead
	 * 		 ignoring the format attribute because it does not apply.
	 *
	 * @param array $atts [optional]
	 * @return string
	 */
	public function getNameBlock( $suppliedAtts = array() )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
		$defaultAtts = array( 'format' => '%prefix% %first% %middle% %last% %suffix%',
							  'before' => '',
							  'after' => '',
							  'return' => FALSE
							);

		$atts = $this->validate->attributesArray($defaultAtts, $suppliedAtts);
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		$search = array('%prefix%', '%first%', '%middle%', '%last%', '%suffix%');
		$replace = array();
		$honorificPrefix = $this->getHonorificPrefix();
		$first = $this->getFirstName();
		$middle = $this->getMiddleName();
		$last = $this->getLastName();
		$honorificSuffix = $this->getHonorificSuffix();

		switch ( $this->getEntryType() )
		{
			case 'individual':
				( empty($honorificPrefix) ) ? $replace[] = '' : $replace[] = '<span class="honorific-prefix">' . $honorificPrefix . '</span>';

				( empty($first) ) ? $replace[] = '' : $replace[] = '<span class="given-name">' . $first . '</span>';

				( empty($middle) ) ? $replace[] = '' : $replace[] = '<span class="additional-name">' . $middle . '</span>';

				( empty($last) ) ? $replace[] = '' : $replace[] = '<span class="family-name">' . $last . '</span>';

				( empty($honorificSuffix) ) ? $replace[] = '' : $replace[] = '<span class="honorific-suffix">' . $honorificSuffix . '</span>';

				$out = '<a href="'.strtolower($first).'-'.strtolower($last).'"><span class="fn n">' . str_ireplace( $search, $replace, $atts['format'] ) . '</a></span>';
			break;

			case 'organization':
				$out = '<span class="org fn">' . $this->getOrganization() . '</span>';
			break;

			case 'family':
				$out = '<span class="fn n"><span class="family-name">' . $this->getFamilyName() . '</span></span>';
			break;

			default:
				( empty($honorificPrefix) ) ? $replace[] = '' : $replace[] = '<span class="honorific-prefix">' . $honorificPrefix . '</span>';

				( empty($first) ) ? $replace[] = '' : $replace[] = '<span class="given-name">' . $first . '</span>';

				( empty($middle) ) ? $replace[] = '' : $replace[] = '<span class="additional-name">' . $middle . '</span>';

				( empty($last) ) ? $replace[] = '' : $replace[] = '<span class="family-name">' . $last . '</span>';

				( empty($honorificSuffix) ) ? $replace[] = '' : $replace[] = '<span class="honorific-suffix">' . $honorificSuffix . '</span>';

				$out = '<span class="fn n">' . str_ireplace( $search, $replace, $atts['format'] ) . '</span>';
			break;
		}

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	public function getSingleNameBlock( $suppliedAtts = array() )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
		$defaultAtts = array( 'format' => '%prefix% %first% %middle% %last% %suffix%',
							  'before' => '',
							  'after' => '',
							  'return' => FALSE
							);

		$atts = $this->validate->attributesArray($defaultAtts, $suppliedAtts);
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		$search = array('%prefix%', '%first%', '%middle%', '%last%', '%suffix%');
		$replace = array();
		$honorificPrefix = $this->getHonorificPrefix();
		$first = $this->getFirstName();
		$middle = $this->getMiddleName();
		$last = $this->getLastName();
		$honorificSuffix = $this->getHonorificSuffix();

		switch ( $this->getEntryType() )
		{
			case 'individual':
				( empty($honorificPrefix) ) ? $replace[] = '' : $replace[] = '<span class="honorific-prefix">' . $honorificPrefix . '</span>';

				( empty($first) ) ? $replace[] = '' : $replace[] = '<span class="given-name">' . $first . '</span>';

				( empty($middle) ) ? $replace[] = '' : $replace[] = '<span class="additional-name">' . $middle . '</span>';

				( empty($last) ) ? $replace[] = '' : $replace[] = '<span class="family-name">' . $last . '</span>';

				( empty($honorificSuffix) ) ? $replace[] = '' : $replace[] = '<span class="honorific-suffix">' . $honorificSuffix . '</span>';

				$out = '<span class="fn n">' . str_ireplace( $search, $replace, $atts['format'] ) . '</span>';
			break;

			case 'organization':
				$out = '<span class="org fn">' . $this->getOrganization() . '</span>';
			break;

			case 'family':
				$out = '<span class="fn n"><span class="family-name">' . $this->getFamilyName() . '</span></span>';
			break;

			default:
				( empty($honorificPrefix) ) ? $replace[] = '' : $replace[] = '<span class="honorific-prefix">' . $honorificPrefix . '</span>';

				( empty($first) ) ? $replace[] = '' : $replace[] = '<span class="given-name">' . $first . '</span>';

				( empty($middle) ) ? $replace[] = '' : $replace[] = '<span class="additional-name">' . $middle . '</span>';

				( empty($last) ) ? $replace[] = '' : $replace[] = '<span class="family-name">' . $last . '</span>';

				( empty($honorificSuffix) ) ? $replace[] = '' : $replace[] = '<span class="honorific-suffix">' . $honorificSuffix . '</span>';

				$out = '<span class="fn n">' . str_ireplace( $search, $replace, $atts['format'] ) . '</span>';
			break;
		}

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	/**
	 * Returns the Entry's full first and last name.
	 *
	 * NOTE: If an entry is a organization/family, this will return the organization/family name instead
	 * 		 ignoring the format attribute because it does not apply.
	 *
	 * @deprecated since 0.7.2.0
	 * @return string
	 */
    public function getFullFirstLastNameBlock()
    {
        return $this->getNameBlock( array('format' => '%prefix% %first% %middle% %last% %suffix%', 'return' => TRUE) );
    }

	/**
	 * Returns the Entry's full first and last name with the last name first.
	 *
	 * NOTE: If an entry is a organization/family, this will return the organization/family name instead
	 * 		 ignoring the format attribute because it does not apply.
	 *
	 * @deprecated since 0.7.2.0
	 * @return string
	 */
    public function getFullLastFirstNameBlock()
    {
    	return $this->getNameBlock( array('format' => '%last%, %first% %middle%', 'return' => TRUE) );
    }

	/**
	 * Echos the family members of the family entry type.
	 *
	 * @deprecated since 0.7.1.0
	 * @return string
	 */
	public function getConnectionGroupBlock()
	{
		$this->getFamilyMemberBlock();
	}

	/**
	 * Echos the family members of the family entry type.
	 */
	public function getFamilyMemberBlock()
	{
		if ( $this->getFamilyMembers() )
		{
			global $connections;

			foreach ($this->getFamilyMembers() as $key => $value)
			{
				$relation = new cnEntry();
				$relation->set($key);
				echo '<span><strong>' . $connections->options->getFamilyRelation($value) . ':</strong> ' . $relation->getFullFirstLastName() . '</span><br />' . "\n";
				unset($relation);
			}
		}
	}

	/**
	 * Echo or return the entry's title in a HTML hCard compliant string.
	 *
	 * Accepted options for the $atts property are:
	 * 	before (string) HTML to output before an address.
	 * 	after (string) HTML to after before an address.
	 * 	return (bool) Return string if set to TRUE instead of echo string.
	 *
	 * @param (array) $suppliedAttr Accepted values as noted above.
	 * @param (bool) $cached Returns the cached address data rather than querying the db.
	 * @return string
	 */
	public function getTitleBlock( $suppliedAtts = array() )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
		$defaultAtts = array( 'before' => '',
							  'after' => '',
							  'return' => FALSE
							);

		$atts = $this->validate->attributesArray($defaultAtts, $suppliedAtts);
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		$out = '';
		$title = $this->getTitle();

		if ( ! empty($title) )
		{
			$out .= '<span class="title">' . $title . '</span>';
		}
		else
		{
			return '';
		}

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	/**
	 * Echo or return the entry's organization and/or departartment in a HTML hCard compliant string.
	 *
	 * Accepted options for the $atts property are:
	 * 	before (string) HTML to output before an address.
	 * 	after (string) HTML to after before an address.
	 * 	return (bool) Return string if set to TRUE instead of echo string.
	 *
	 * @param (array) $suppliedAttr Accepted values as noted above.
	 * @param (bool) $cached Returns the cached address data rather than querying the db.
	 * @return string
	 */
	public function getOrgUnitBlock( $suppliedAtts = array() )
	{
		$out = '';
		$org = $this->getOrganization();
		$dept = $this->getDepartment();

		/*
		 * // START -- Set the default attributes array. \\
		 */
		$defaultAtts = array( 'before' => '',
							  'after' => '',
							  'return' => FALSE
							);

		$atts = $this->validate->attributesArray($defaultAtts, $suppliedAtts);
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		if ( ! empty($org) || ! empty($dept) )
		{
			$out .= '<span class="org">';
			if ( ! empty($org) ) $out .= '<span class="organization-name"' . ( ( $this->getEntryType() == 'organization' ) ? ' style="display: none;"' : '' ) . '>' . $org . '</span>';
			if ( ! empty($dept) ) $out .= '<span class="organization-unit">' . $dept . '</span>';
			$out .= '</span>';
		}
		else
		{
			return '';
		}

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	/**
	 * Return the entry's organization and/or departartment in a HTML hCard compliant string.
	 *
	 * @deprecated since 0.7.2.0
	 */
	public function getOrganizationBlock()
	{
		return $this->getOrgUnitBlock( array( 'return' => TRUE ) );
	}

	/**
	 * Return the entry's organization and/or departartment in a HTML hCard compliant string.
	 *
	 * @deprecated since 0.7.2.0
	 */
	public function getDepartmentBlock()
	{
		return $this->getOrgUnitBlock( array( 'return' => TRUE ) );
	}

	/**
	 * Echo or return the entry's contact name in a HTML string.
	 *
	 * Accepted options for the $atts property are:
	 * 	format (string) Tokens for the parts of the name.
	 * 		Permitted Tokens:
	 * 			%label%
	 * 			%first%
	 * 			%last%
	 * 	label (string) The label to be displayed for the contact name.
	 * 	before (string) HTML to output before an address.
	 * 	after (string) HTML to after before an address.
	 * 	return (bool) Return or echo the string. Default is to echo.
	 *
	 * @param array $atts [optional]
	 * @return string
	 */
	public function getContactNameBlock( $suppliedAtts = array() )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
		$defaultAtts = array( 'format' => '%label%: %first% %last%',
							  'label' => 'Contact',
							  'before' => '',
							  'after' => '',
							  'return' => FALSE
							);

		$atts = $this->validate->attributesArray($defaultAtts, $suppliedAtts);
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		$search = array('%label%','%first%', '%last%');
		$replace = array();
		$first = $this->getContactFirstName();
		$last = $this->getContactLastName();

		if ( empty($first) && empty($last) ) return '';

		( empty($first) && empty($last) ) ? $replace[] = '' : $replace[] = '<span class="contact-label">' . $atts['label'] . '</span>';

		( empty($first) ) ? $replace[] = '' : $replace[] = '<span class="contact-given-name">' . $first . '</span>';

		( empty($last) ) ? $replace[] = '' : $replace[] = '<span class="contact-family-name">' . $last . '</span>';

		$out = '<span class="contact-name">' . str_ireplace( $search, $replace, $atts['format'] ) . '</span>';

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	/**
	 * Echo or return the entry's addresses in a HTML hCard compliant string.
	 *
	 * Accepted options for the $atts property are:
	 * 	preferred (bool) Retrieve the preferred entry address.
	 * 	type (array) || (string) Retrieve specific address types.
	 * 		Permitted Types:
	 * 			home
	 * 			work
	 * 			school
	 * 			other
	 * 	city (array) || (string) Retrieve addresses in a specific city.
	 * 	state (array) || (string) Retrieve addresses in a specific state..
	 * 	zipcode (array) || (string) Retrieve addresses in a specific zipcode.
	 * 	country (array) || (string) Retrieve addresses in a specific country.
	 * 	coordinates (array) Retrieve addresses in with specific coordinates. Both latitude and longitude must be supplied.
	 * 	format (string) The tokens to use to display the address block parts.
	 * 		Permitted Tokens:
	 * 			%label%
	 * 			%line1%
	 * 			%line2%
	 * 			%line3%
	 * 			%city%
	 * 			%state%
	 * 			%zipcode%
	 * 			%country%
	 * 			%geo%
	 * 	before (string) HTML to output before the addresses.
	 * 	after (string) HTML to after before the addresses.
	 * 	return (bool) Return string if set to TRUE instead of echo string.
	 *
	 * @param (array) $suppliedAttr Accepted values as noted above.
	 * @param (bool) $cached Returns the cached address rather than querying the db.
	 * @return string
	 */
	public function getAddressBlock( $suppliedAttr = array() , $cached = TRUE )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
			$defaultAttr['preferred'] = NULL;
			$defaultAttr['type'] = NULL;
			$defaultAttr['city'] = NULL;
			$defaultAttr['state'] = NULL;
			$defaultAttr['zipcode'] = NULL;
			$defaultAttr['country'] = NULL;
			$defaultAttr['coordinates'] = array();
			//$defaultAttr['format'] = '%label%|%line1%|%line2%|%line3%|%city%, %state%  %zipcode%|%geo%';
			$defaultAttr['format'] = '%label% %line1% %line2% %line3% %city%, %state%  %zipcode% %country%';
			$defaultAttr['before'] = '';
			$defaultAttr['after'] = '';
			$defaultAttr['return'] = FALSE;

			$atts = $this->validate->attributesArray($defaultAttr, $suppliedAttr);
			$atts['id'] = $this->getId();
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		$out = '';
		$addresses = $this->getAddresses( $atts , $cached );
		$search = array('%label%' , '%line1%' , '%line2%' , '%line3%' , '%city%' , '%state%' , '%zipcode%' , '%country%' , '%geo%');

		if ( empty($addresses) ) return '';

		$out .= '<span class="address-block">';

		foreach ($addresses as $address)
		{
			$replace = array();

			$out .= "\n" . '<span class="adr">';

				( empty($address->name) ) ? $replace[] = '' : $replace[] = '<span class="address-name">' . $address->name . '</span>';
				( empty($address->line_1) ) ? $replace[] = '' : $replace[] = '<span class="street-address">' . $address->line_1 . '</span>';
				( empty($address->line_2) ) ? $replace[] = '' : $replace[] = '<span class="street-address">' . $address->line_2 . '</span>';
				( empty($address->line_3) ) ? $replace[] = '' : $replace[] = '<span class="street-address">' . $address->line_3 . '</span>';

				( empty($address->city) ) ? $replace[] = '' : $replace[] = '<span class="locality">' . $address->city . '</span>';
				( empty($address->state) ) ? $replace[] = '' : $replace[] = '<span class="region">' . $address->state . '</span>';
				( empty($address->zipcode) ) ? $replace[] = '' : $replace[] = '<span class="postal-code">' . $address->zipcode . '</span>';

				( empty($address->country) ) ? $replace[] = '' : $replace[] = '<span class="country-name">' . $address->country . '</span>';

				if ( ! empty($address->latitude) || ! empty($address->longitude) )
				{
					 $replace[] = '<span class="geo">' .
					 	( ( empty($address->latitude) ) ? '' : '<span class="latitude" title="' . $address->latitude . '"><span class="cn-label">Latitude: </span>' . $address->latitude . '</span>' ) .
						( ( empty($address->longitude) ) ? '' : '<span class="longitude" title="' . $address->longitude . '"><span class="cn-label">Longitude: </span>' . $address->longitude . '</span>' ) .
						'</span>';
				}

				$out .= str_ireplace( $search , $replace , $atts['format'] );

				// Set the hCard Address Type.
				$out .= $this->gethCardAdrType($address->type);

			$out .= '</span>' . "\n";
		}

		$out .= '</span>';

		//$out = str_ireplace( array('|||||||||' , '||||||||' ,'|||||||' ,'||||||' ,'|||||' ,'||||' ,'|||' ,'||' ,'|') , '<br>' , $out );

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	/**
	 * Echo or return a <div> with the entry's address within the HTML5 data- attribute. To be used for
	 * placing a Google Map in with the jQuery goMap plugin.
	 *
	 * NOTE: wp_enqueue_script('jquery-gomap-min') must called before use, otherwise just an empty div will be diaplayed.
	 *
	 * Accepted options for the $atts property are:
	 * 	preferred (bool) Retrieve the preferred entry address.
	 * 	type (array) || (string) Retrieve specific address types.
	 * 		Permitted Types:
	 * 			home
	 * 			work
	 * 			school
	 * 			other
	 * 	static (bool) Query map via the Google Static Maps API
	 * 	maptype (string) Valid types are: HYBRID, ROADMAP, SATELLITE, TERRAIN
	 * 	zoom (int) Sets the zoom level.
	 * 	height (int) Specifiy the div height in px.
	 * 	width (int) Specifiy the div widdth in px.
	 * 	coordinates (array) Retrieve addresses in with specific coordinates. Both latitude and longitude must be supplied.
	 * 	before (string) HTML to output before the addresses.
	 * 	after (string) HTML to after before the addresses.
	 * 	return (bool) Return string if set to TRUE instead of echo string.
	 *
	 * @TODO Add support for the Google Maps API Premier client id.
	 *
	 * @param (array) $suppliedAttr Accepted values as noted above.
	 * @param (bool) $cached Returns the cached address rather than querying the db.
	 * @return string
	 */
	public function getMapBlock( $suppliedAttr = array() , $cached = TRUE )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
			$defaultAttr['preferred'] = NULL;
			$defaultAttr['type'] = NULL;
			$defaultAttr['static'] = FALSE;
			$defaultAttr['maptype'] = 'ROADMAP';
			$defaultAttr['zoom'] = 13;
			$defaultAttr['height'] = 400;
			$defaultAttr['width'] = 400;
			$defaultAttr['before'] = '';
			$defaultAttr['after'] = '';
			$defaultAttr['return'] = FALSE;

			$atts = $this->validate->attributesArray($defaultAttr, $suppliedAttr);
			$atts['id'] = $this->getId();
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		$out = '';
		$attr = array();
		$geo = array();

		// Limit the map type to one of the valid types to prevent user error.
		$permittedMapTypes = array( 'HYBRID', 'ROADMAP', 'SATELLITE', 'TERRAIN' );
		$atts['maptype'] = strtoupper( $atts['maptype'] );
		if ( ! in_array( $atts['maptype'] , $permittedMapTypes ) ) $atts['maptype'] = 'ROADMAP';

		// Limit the user specified zoom level to between 0 and 21
		if ( ! in_array( $atts['zoom'] , range(0, 21) ) ) $atts['zoom'] = 13;

		// Ensure the requested map size does not exceed the permitted sizes permitted by the Google Static Maps API
		if ( $atts['static'] ) $atts['width'] = ( $atts['width'] <= 640 ) ? $atts['width'] : 640;
		if ( $atts['static'] ) $atts['height'] = ( $atts['height'] <= 640 ) ? $atts['height'] : 640;

		$addresses = $this->getAddresses( $atts , $cached );

		if ( empty($addresses) ) return '';

		if ( ! empty($addresses[0]->line_one) ) $addr[] = $addresses[0]->line_one;
		if ( ! empty($addresses[0]->line_two) ) $addr[] = $addresses[0]->line_two;
		if ( ! empty($addresses[0]->city) ) $addr[] = $addresses[0]->city;
		if ( ! empty($addresses[0]->state) ) $addr[] = $addresses[0]->state;
		if ( ! empty($addresses[0]->zipcode) ) $addr[] = $addresses[0]->zipcode;

		if ( ! empty($addresses[0]->latitude) && ! empty($addresses[0]->longitude) )
		{
			$geo['latitude'] = $addresses[0]->latitude;
			$geo['longitude'] = $addresses[0]->longitude;
		}

		if ( empty($addr) && empty($geo) ) return '';

		if ( $atts['static'] )
		{
			$attr['center'] = ( empty($geo) ) ? implode( ', ' , $addr ) : implode( ',' , $geo );
			$attr['markers'] = $attr['center'];
			//$attr['size'] = $atts['width'] . 'x' . $atts['height'];
			$attr['maptype'] = $atts['maptype'];
			$attr['zoom'] = $atts['zoom'];
			//$attr['scale'] = 2;
			$attr['format'] = 'png';
			$attr['sensor'] = 'false';

			$out .= '<span class="cn-image-style" style="display: inline-block;"><span class="cn-image">';
			$out .= '<img class="map" title="' . $attr['center'] . '" alt="' . $attr['center'] . 'src="http://maps.googleapis.com/maps/api/staticmap?' . http_build_query( $attr , '' , '&amp;' ) . '"/>';
			$out .= '</span></span>';
		}
		else
		{
			$attr[] = 'id="map-' . $this->getRuid() . '"';
			$attr[] = 'data-address="' . implode(', ', $addr) .'"';
			if ( ! empty($geo['latitude']) ) $attr[] = 'data-latitude="' . $geo['latitude'] .'"';
			if ( ! empty($geo['longitude']) ) $attr[] = 'data-longitude="' . $geo['longitude'] .'"';
			$attr[] = 'data-maptype="' . $atts['maptype'] .  '"';
			$attr[] = 'data-zoom="' . $atts['zoom'] .  '"';

			$out = '<div ' . implode(' ', $attr) . '></div>';
		}

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	/**
	 * Echo or return the entry's phone numbers in a HTML hCard compliant string.
	 *
	 * Accepted options for the $atts property are:
	 * 	preferred (bool) Retrieve the preferred entry phone number.
	 * 	type (array) || (string) Retrieve specific phone number types.
	 * 		Permitted Types:
	 * 			homephone
	 * 			homefax
	 * 			cellphone
	 * 			workphone
	 * 			workfax
	 * 	format (string) The tokens to use to display the phone number block parts.
	 * 		Permitted Tokens:
	 * 			%label%
	 * 			%number%
	 * 	before (string) HTML to output before the phone numbers.
	 * 	after (string) HTML to after before the phone numbers.
	 * 	return (bool) Return string if set to TRUE instead of echo string.
	 *
	 * @param (array) $suppliedAttr Accepted values as noted above.
	 * @param (bool) $cached Returns the cached data rather than querying the db.
	 * @return string
	 */
	public function getPhoneNumberBlock( $suppliedAttr = array() , $cached = TRUE )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
			$defaultAttr['preferred'] = NULL;
			$defaultAttr['type'] = NULL;
			$defaultAttr['format'] = '%label%: %number%';
			$defaultAttr['before'] = '';
			$defaultAttr['after'] = '';
			$defaultAttr['return'] = FALSE;

			$atts = $this->validate->attributesArray($defaultAttr, $suppliedAttr);
			$atts['id'] = $this->getId();
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		$out = '';
		$phoneNumbers = $this->getPhoneNumbers( $atts , $cached );
		$search = array('%label%' , '%number%');

		if ( empty($phoneNumbers) ) return '';

		$out .= '<span class="phone-number-block">';

		foreach ( $phoneNumbers as $phone )
		{
			$replace = array();

			$out .= "\n" . '<span class="tel">';

				( empty($phone->name) ) ? $replace[] = '' : $replace[] = '<span class="phone-name">' . $phone->name . '</span>';
				( empty($phone->number) ) ? $replace[] = '' : $replace[] = '<span class="value">' . $phone->number . '</span>';

				$out .= str_ireplace( $search , $replace , $atts['format'] );

				// Set the hCard Phone Number Type.
				$out .= $this->gethCardTelType($phone->type);

			$out .= '</span>' . "\n";
		}

		$out .= '</span>';

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	/**
	 * Returns the entry's telephone type in a HTML hCard compliant string.
	 *
	 * @url http://microformats.org/wiki/hcard-cheatsheet
	 * @param (string) $data
	 * @return string
	 */
	public function gethCardTelType($data)
    {
        switch ($data)
		{
			case 'home':
				$type = '<span class="type" style="display: none;">home</span>';
				break;
			case 'homephone':
				$type = '<span class="type" style="display: none;">home</span>';
				break;
			case 'homefax':
				$type = '<span class="type" style="display: none;">home</span><span class="type" style="display: none;">fax</span>';
				break;
			case 'cell':
				$type = '<span class="type" style="display: none;">cell</span>';
				break;
			case 'cellphone':
				$type = '<span class="type" style="display: none;">cell</span>';
				break;
			case 'work':
				$type = '<span class="type" style="display: none;">work</span>';
				break;
			case 'workphone':
				$type = '<span class="type" style="display: none;">work</span>';
				break;
			case 'workfax':
				$type = '<span class="type" style="display: none;">work</span><span class="type" style="display: none;">fax</span>';
				break;
			case 'fax':
				$type = '<span class="type" style="display: none;">work</span><span class="type" style="display: none;">fax</span>';
				break;
		}

		return $type;
    }

	/**
	 * Returns the entry's address type in a HTML hCard compliant string.
	 *
	 * @url http://microformats.org/wiki/adr-cheatsheet#Properties_.28Class_Names.29
	 * @param (string) $data
	 * @return string
	 */
	public function gethCardAdrType($adrType)
    {
        switch ($adrType)
		{
			case 'home':
				$type = '<span class="type" style="display: none;">home</span>';
				break;
			case 'work':
				$type = '<span class="type" style="display: none;">work</span>';
				break;
			case 'school':
				$type = '<span class="type" style="display: none;">postal</span>';
				break;
			case 'other':
				$type = '<span class="type" style="display: none;">postal</span>';
				break;

			default:
				$type = '<span class="type" style="display: none;">postal</span>';
				break;
		}

		return $type;
    }

	/**
	 * Echo or return the entry's email addresses in a HTML hCard compliant string.
	 *
	 * Accepted options for the $atts property are:
	 * 	preferred (bool) Retrieve the preferred entry email address.
	 * 	type (array) || (string) Retrieve specific email address types.
	 * 		Permitted Types:
	 * 			personal
	 * 			work
	 * 	format (string) The tokens to use to display the email address block parts.
	 * 		Permitted Tokens:
	 * 			%label%
	 * 			%address%
	 * 	before (string) HTML to output before the email addresses.
	 * 	after (string) HTML to after before the email addresses.
	 * 	return (bool) Return string if set to TRUE instead of echo string.
	 *
	 * @param (array) $suppliedAttr Accepted values as noted above.
	 * @param (bool) $cached Returns the cached data rather than querying the db.
	 * @return string
	 */
	public function getEmailAddressBlock( $suppliedAttr = array() , $cached = TRUE )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
			$defaultAttr['preferred'] = NULL;
			$defaultAttr['type'] = NULL;
			$defaultAttr['format'] = '%label%: %address%';
			$defaultAttr['before'] = '';
			$defaultAttr['after'] = '';
			$defaultAttr['return'] = FALSE;

			$atts = $this->validate->attributesArray($defaultAttr, $suppliedAttr);
			$atts['id'] = $this->getId();
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		$out = '';
		$emailAddresses = $this->getEmailAddresses( $atts , $cached );
		$search = array('%label%' , '%address%');

		if ( empty($emailAddresses) ) return '';

		$out .= '<span class="email-address-block">';

		foreach ( $emailAddresses as $email)
		{
			$replace = array();

			$out .= "\n" . '<span class="email">';

				( empty($email->name) ) ? $replace[] = '' : $replace[] = '<span class="email-name">' . $email->name . '</span>';
				( empty($email->address) ) ? $replace[] = '' : $replace[] = '<a class="value" href="mailto:' . $email->address . '">' . $email->address . '</a>';

				$out .= str_ireplace( $search , $replace , $atts['format'] );

				// Set the hCard Email Address Type.
				$out .= '<span class="type" style="display: none;">INTERNET</span>';

			$out .= '</span>' . "\n";
		}

		$out .= '</span>';

		// This filter is required to allow the ROT13 encyption plugin to function.
		$out = apply_filters('cn_output_email_addresses', $out);

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	/**
	 * Echo or return the entry's IM network IDs in a HTML hCard compliant string.
	 *
	 * Accepted options for the $atts property are:
	 * 	preferred (bool) Retrieve the preferred entry IM network.
	 * 	type (array) || (string) Retrieve specific IM network types.
	 * 		Permitted Types:
	 * 			aim
	 * 			yahoo
	 * 			jabber
	 * 			messenger
	 * 			skype
	 * 	format (string) The tokens to use to display the IM network block parts.
	 * 		Permitted Tokens:
	 * 			%label%
	 * 			%id%
	 * 	before (string) HTML to output before the IM networks.
	 * 	after (string) HTML to after before the IM networks.
	 * 	return (bool) Return string if set to TRUE instead of echo string.
	 *
	 * @url http://microformats.org/wiki/hcard-examples#New_Types_of_Contact_Info
	 * @param (array) $suppliedAttr Accepted values as noted above.
	 * @param (bool) $cached Returns the cached data rather than querying the db.
	 * @return string
	 */
	public function getImBlock( $suppliedAttr = array() , $cached = TRUE )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
			$defaultAttr['preferred'] = NULL;
			$defaultAttr['type'] = NULL;
			$defaultAttr['format'] = '%label%: %id%';
			$defaultAttr['before'] = '';
			$defaultAttr['after'] = '';
			$defaultAttr['return'] = FALSE;

			$atts = $this->validate->attributesArray($defaultAttr, $suppliedAttr);
			$atts['id'] = $this->getId();
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		$out = '';
		$networks = $this->getIm( $atts , $cached );
		$search = array('%label%' , '%id%');

		if ( empty($networks) ) return '';

		$out .= '<span class="im-network-block">';

		foreach ( $networks as $network )
		{
			$replace = array();

			$out .= "\n" . '<span class="im-network">';

				( empty($network->name) ) ? $replace[] = '' : $replace[] = '<span class="im-name">' . $network->name . '</span>';

				switch ( $network->type )
				{
					case 'aim':
						( empty($network->id) ) ? $replace[] = '' : $replace[] = '<a class="url im-id" href="aim:goim?screenname=' . $network->id . '">' . $network->id . '</a>';
						break;

					case 'yahoo':
						( empty($network->id) ) ? $replace[] = '' : $replace[] = '<a class="url im-id" href="ymsgr:sendIM?' . $network->id . '">' . $network->id . '</a>';
						break;

					case 'jabber':
						( empty($network->id) ) ? $replace[] = '' : $replace[] = '<span class="im-id">' . $network->id . '</span>';
						break;

					case 'messenger':
						( empty($network->id) ) ? $replace[] = '' : $replace[] = '<a class="url im-id" href="msnim:chat?contact=' . $network->id . '">' . $network->id . '</a>';
						break;

					case 'skype':
						( empty($network->id) ) ? $replace[] = '' : $replace[] = '<a class="url im-id" href="skype:' . $network->id . '?chat">' . $network->id . '</a>';
						break;

					case 'icq':
						( empty($network->id) ) ? $replace[] = '' : $replace[] = '<a class="url im-id" type="application/x-icq" href="http://www.icq.com/people/cmd.php?uin=' . $network->id . '&action=message">' . $network->id . '</a>';
						break;

					default:
						( empty($network->id) ) ? $replace[] = '' : $replace[] = '<span class="im-id">' . $network->id . '</span>';
						break;
				}

				$out .= str_ireplace( $search , $replace , $atts['format'] );

			$out .= '</span>' . "\n";
		}

		$out .= '</span>';

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	/**
	 * Echo or return the entry's social media network IDs in a HTML hCard compliant string.
	 *
	 * Accepted options for the $atts property are:
	 * 	preferred (bool) Retrieve the preferred entry social media network.
	 * 	type (array) || (string) Retrieve specific social media network types.
	 * 		Permitted Types:
	 * 			delicious
	 * 			cdbaby
	 * 			facebook
	 * 			flickr
	 * 			itunes
	 * 			linked-in
	 * 			mixcloud
	 * 			myspace
	 * 			podcast
	 * 			reverbnation
	 * 			rss
	 * 			technorati
	 * 			twitter
	 * 			soundcloud
	 * 			youtube
	 * 	format (string) The tokens to use to display the social media block parts.
	 * 		Permitted Tokens:
	 * 			%title%
	 * 			%url%
	 * 			%icon%
	 * 	style (string) The icon style to be used.
	 * 		Permitted Styles:
	 * 			wpzoom
	 * 		Permitted Sizes:
	 * 			16
	 * 			24
	 * 			32
	 * 			48
	 * 			64
	 * 	size (int) The icon size to be used.
	 * 	before (string) HTML to output before the social media networks.
	 * 	after (string) HTML to after before the social media networks.
	 * 	return (bool) Return string if set to TRUE instead of echo string.
	 *
	 * @url http://microformats.org/wiki/hcard-examples#Site_profiles
	 * @param (array) $suppliedAttr Accepted values as noted above.
	 * @param (bool) $cached Returns the cached data rather than querying the db.
	 * @return string
	 */
	public function getSocialMediaBlock( $suppliedAttr = array() , $cached = TRUE )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
			$defaultAttr['preferred'] = NULL;
			$defaultAttr['type'] = NULL;
			$defaultAttr['format'] = '%icon%';
			$defaultAttr['style'] = 'wpzoom';
			$defaultAttr['size'] = 32;
			$defaultAttr['before'] = '';
			$defaultAttr['after'] = '';
			$defaultAttr['return'] = FALSE;

			$atts = $this->validate->attributesArray($defaultAttr, $suppliedAttr);
			$atts['id'] = $this->getId();
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		$out = '';
		$networks = $this->getSocialMedia( $atts , $cached );
		$search = array('%label%' , '%url%' , '%icon%');

		$iconStyles = array('wpzoom');
		$iconSizes = array(16, 24, 32, 48, 64);

		/*
		 * Ensure the supplied icon style and size are valid, if not reset to the default values.
		 */
		( in_array($atts['style'], $iconStyles) ) ? $iconStyle = $atts['style'] : $iconStyle = 'wpzoom';
		( in_array($atts['size'], $iconSizes) ) ? $iconSize = $atts['size'] : $iconSize = 32;

		if ( empty($networks) ) return '';

		$out = '<span class="social-media-block">';

		foreach ( $networks as $network )
		{
			$replace = array();
			$iconClass = array();

			/*
			 * Create the icon image class. This array will implode to a string.
			 */
			$iconClass[] = $network->type;
			$iconClass[] = $iconStyle;
			$iconClass[] = 'sz-' . $iconSize;

			$out .= "\n" . '<span class="social-media-network">';

				$replace[] = '<a class="url ' . $network->type . '" href="' . $network->url . '" target="_blank" title="' . $network->name . '">' . $network->name . '</a>';

				$replace[] = '<a class="url ' . $network->type . '" href="' . $network->url . '" target="_blank" title="' . $network->name . '">' . $network->url . '</a>';

				$replace[] = '<a class="url ' . $network->type . '" href="' . $network->url . '" target="_blank" title="' . $network->name . '"><image class="' . implode(' ', $iconClass) . '" src="' . CN_URL . '/images/icons/' . $iconStyle . '/' . $iconSize . '/' . $network->type . '.png" height="' . $iconSize . 'px" width="' . $iconSize . 'px"/></a>';

				$out .= str_ireplace( $search , $replace , $atts['format'] );

			$out .= '</span>' . "\n";
		}

		$out .= '</span>';

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	/**
	 * Return the entry's websites in a HTML hCard compliant string.
	 *
	 * @deprecated since 0.7.2.0
	 */
	public function getWebsiteBlock()
	{
		/*
		 * Set some defaults so the result resembles how the previous rendered.
		 */
		return $this->getLinkBlock( array( 'format' => '%label%: %url%' , 'type' => array('personal', 'website') , 'return' => TRUE ) );
	}

	/**
	 * Echo or return the entry's links in a HTML hCard compliant string.
	 *
	 * Accepted options for the $atts property are:
	 * 	preferred (bool) Retrieve the preferred entry link.
	 * 	type (array) || (string) Retrieve specific link types.
	 * 		Permitted Types:
	 * 			website
	 * 			blog
	 * 	format (string) The tokens to use to display the phone number block parts.
	 * 		Permitted Tokens:
	 * 			%label%
	 * 			%title%
	 * 			%url%
	 * 			%image%
	 * 	label (string) The label to be displayed for the links.
	 * 	size (string) The valid image sizes. Valid values are: mcr || tny || vsm || sm || lg || xlg
	 * 	before (string) HTML to output before the social media networks.
	 * 	after (string) HTML to after before the social media networks.
	 * 	return (bool) Return string if set to TRUE instead of echo string.
	 *
	 * @url http://microformats.org/wiki/hcard-examples#Site_profiles
	 * @param (array) $suppliedAttr Accepted values as noted above.
	 * @param (bool) $cached Returns the cached data rather than querying the db.
	 * @return string
	 */
	public function getLinkBlock( $suppliedAttr = array() , $cached = TRUE )
	{
		/*
		 * // START -- Set the default attributes array. \\
		 */
			$defaultAttr['preferred'] = NULL;
			$defaultAttr['type'] = NULL;
			$defaultAttr['format'] = '%title%';
			$defaultAttr['label'] = NULL;
			$defaultAttr['size'] = 'lg';
			$defaultAttr['before'] = '';
			$defaultAttr['after'] = '';
			$defaultAttr['return'] = FALSE;

			$atts = $this->validate->attributesArray($defaultAttr, $suppliedAttr);
			$atts['id'] = $this->getId();
		/*
		 * // END -- Set the default attributes array if not supplied. \\
		 */

		$out = '';
		$links = $this->getLinks( $atts , $cached );
		$search = array('%label%' , '%title%' , '%url%' , '%image%');

		if ( empty($links) ) return '';

		$out .= '<span class="link-block">';

		foreach ( $links as $link )
		{
			$replace = array();
			$imgBlock = '';
			$queryURL = '';
			$imageTag ='';

			$out .= "\n" . '<span class="link ' . $link->type . '">';

				if ( empty( $atts['label'] ) )
				{
					( empty($link->name) ) ? $replace[] = '' : $replace[] = '<span class="link-name">' . $link->name . '</span>';
				}
				else
				{
					$replace[] = '<span class="link-name">' . $atts['label'] . '</span>';
				}


				( empty($link->title) ) ? $replace[] = '' : $replace[] = '<a class="url" href="' . $link->url . '"' . ( ( empty($link->target) ? '' : ' target="' . $link->target . '"' ) ) . ( ( empty($link->followString) ? '' : ' rel="' . $link->followString . '"' ) ) . '>' . $link->title . '</a>';
				( empty($link->url) ) ? $replace[] = '' : $replace[] = '<a class="url" href="' . $link->url . '"' . ( ( empty($link->target) ? '' : ' target="' . $link->target . '"' ) ) . ( ( empty($link->followString) ? '' : ' rel="' . $link->followString . '"' ) ) . '>' . $link->url . '</a>';

				/*if ( $atts['image'] )
				{*/
					//

					// Set the image size; These string values match the valid size for http://www.shrinktheweb.com
					switch ( $atts['size'] )
					{
						case 'mcr':
							$width = 75;
							$height = 56;
							break;

						case 'tny':
							$width = 90;
							$height = 68;
							break;

						case 'vsm':
							$width = 100;
							$height = 75;
							break;

						case 'sm':
							$width = 120;
							$height = 90;
							break;

						case 'lg':
							$width = 200;
							$height = 150;
							break;

						case 'xlg':
							$width = 320;
							$height = 240;
							break;
					}

					if ( $this->validate->url( $link->url , FALSE ) == 1 )
					{
						// Create the query the WordPress for the webshot to be displayed.
						$queryURL = 'http://s.wordpress.com/mshots/v1/' . urlencode($link->url) . '?w=' . $width;
						$imageTag = '<img class="screenshot" alt="' . esc_attr($link->url) . '" src="' . $queryURL . '" />';

						$imgBlock .= '<span class="cn-image-style" style="display: inline-block;"><span class="cn-image">';
						$imgBlock .= '<a class="url" href="' . $link->url . '"' . ( ( empty($link->target) ? '' : ' target="' . $link->target . '"' ) ) . ( ( empty($link->followString) ? '' : ' rel="' . $link->followString . '"' ) ) . '>' . $imageTag . '</a>';
						$imgBlock .= '</span></span>';

						$replace[] = $imgBlock;
					}
					else
					{
						$replace[] = '';
					}
				/*}
				else
				{
					$replace[] = '';
				}*/


				$out .= str_ireplace( $search , $replace , $atts['format'] );

			$out .= '</span>' . "\n";
		}

		$out .= '</span>';

		if ( $atts['return'] ) return ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
		echo ( "\n" . ( empty( $atts['before'] ) ? '' : $atts['before'] ) ) . $out . ( ( empty( $atts['after'] ) ? '' : $atts['after'] ) ) . "\n";
	}

	public function getBirthdayBlock( $format = 'F jS' )
	{
		//NOTE: The vevent span is for hCalendar compatibility.
		//NOTE: The second birthday span [hidden] is for hCard compatibility.
		//NOTE: The third span series [hidden] is for hCalendar compatibility.
		if ($this->getBirthday()) $out = "\n" . '<div class="vevent"><span class="birthday"><strong>Birthday:</strong> <abbr class="dtstart" title="' . $this->getBirthday('Ymd') .'">' . $this->getBirthday($format) . '</abbr></div>' .
										 '<span class="bday" style="display:none">' . $this->getBirthday('Y-m-d') . '</span>' .
										 '<span class="summary" style="display:none">Birthday - ' . $this->getFullFirstLastName() . '</span> <span class="uid" style="display:none">' . $this->getBirthday('YmdHis') . '</span> </span>' . "\n";

		if ( !isset($out) || empty($out) ) $out = '';

		return $out;
	}

	public function getAnniversaryBlock( $format = 'F jS' )
	{
		//NOTE: The vevent span is for hCalendar compatibility.
		if ($this->getAnniversary()) $out = "\n" . '<div class="vevent"><span class="anniversary"><strong>Anniversary:</strong> <abbr class="dtstart" title="' . $this->getAnniversary('Ymd') . '">' . $this->getAnniversary($format) . '</abbr></div>' .
											'<span class="summary" style="display:none">Anniversary - ' . $this->getFullFirstLastName() . '</span> <span class="uid" style="display:none">' . $this->getAnniversary('YmdHis') . '</span> </span>' . "\n";

		if ( !isset($out) || empty($out) ) $out = '';

		return $out;
	}

	/**
	 * Echo or returns the entry Notes.
	 *
	 * Registers the global $wp_embed because the run_shortcode method needs
	 * to run before the do_shortcode function for the [embed] shortcode to fire
	 *
	 * @TODO Add support for the $atts array.
	 * @return string
	 */
	public function getNotesBlock( $suppliedAttr = array() )
	{
		global $wp_embed;
		$notes = $wp_embed->run_shortcode( $this->getNotes() );

		return "\n" . '<div class="note">' . do_shortcode( $notes ) . '</div>' . "\n";
	}

	/**
	 * Echo or returns the entry Bio.
	 *
	 * Registers the global $wp_embed because the run_shortcode method needs
	 * to run before the do_shortcode function for the [embed] shortcode to fire
	 *
	 * @TODO Add support for the $atts array.
	 * @return string
	 */
	public function getBioBlock( $suppliedAttr = array() )
	{
		global $wp_embed;
		$bio = $wp_embed->run_shortcode( $this->getBio() );

		return "\n" . '<div class="bio">' . do_shortcode( $bio ) . '</div>' . "\n";
	}

	public function getBioExcerptBlock( $suppliedAttr = array() )
	{
		global $wp_embed;
		$bio = $wp_embed->run_shortcode( $this->getExcerpt() );

		return "\n" . '<div class="bio">' . do_shortcode( $bio ) . '</div>' . "\n";
	}

	/**
	 * Displays the category list in a HTML list or custom format
	 *
	 * @TODO: Implement $parents.
	 *
	 * Accepted option for the $atts property are:
	 * 		list == string -- The list type to output. Accepted values are ordered || unordered.
	 * 		separator == string -- The category separator.
	 * 		before == string -- HTML to output before the category list.
	 *  	after == string -- HTML to output after the category list.
	 * 		label == string -- String to display after the before attribute but before the category list.
	 * 		parents == bool -- Display the parents
	 * 		return == TRUE || FALSE -- Return string if set to TRUE instead of echo string.
	 *
	 * @param array $atts [optional]
	 * @return string
	 */
	public function getCategoryBlock($atts = NULL)
	{
		$defaultAtts = array('list' => 'unordered',
							 'separator' => NULL,
							 'before' => NULL,
							 'after' => NULL,
							 'label' => 'Categories: ',
							 'parents' => FALSE,
							 'return' => FALSE
							);

		$atts = $this->validate->attributesArray($defaultAtts, (array) $atts);

		$out = '';
		$categories = $this->getCategory();

		if ( empty($categories) ) return NULL;

		if ( !empty($atts['before']) ) $out .= $atts['before'];

		if ( !empty($atts['label']) ) $out .= '<span class="cn_category_label">' . $atts['label'] . '</span>';

		if ( empty($atts['separator']) )
		{
			$atts['list'] === 'unordered' ? $out .= '<ul class="cn_category_list">' : $out .= '<ol class="cn_category_list">';

			foreach ($categories as $category)
			{
				$out .= '<li class="cn_category" id="cn_category_' . $category->term_id . '">' . $category->name . '</li>';
			}

			$atts['list'] === 'unordered' ? $out .= '</ul>' : $out .= '</ol>';
		}
		else
		{
			$i = 0;

			foreach ($categories as $category)
			{
				$out .= '<span class="cn_category" id="cn_category_' . $category->term_id . '">' . $category->name . '</span>';

				$i++;
				if ( count($categories) > $i ) $out .= $atts['separator'];
			}
		}

		if ( !empty($atts['after']) ) $out .= $atts['after'];

		if ( $atts['return'] ) return $out;

		echo $out;
	}

	/**
	 * Displays the category list for use in the class tag.
	 *
	 * @param bool $return [optional] Return instead of echo.
	 * @return string
	 */
	public function getCategoryClass($return = FALSE)
	{
		$categories = $this->getCategory();

		if ( empty($categories) ) return NULL;

		foreach ($categories as $category)
		{
			$out[] = $category->slug;
		}

		if ($return) return implode(' ', $out);

		echo implode(' ', $out);

	}

	public function getRevisionDateBlock()
	{
		return '<span class="rev">' . date('Y-m-d', strtotime($this->getUnixTimeStamp())) . 'T' . date('H:i:s', strtotime($this->getUnixTimeStamp())) . 'Z' . '</span>' . "\n";
	}

	public function getLastUpdatedStyle()
	{
		$age = (int) abs( time() - strtotime( $this->getUnixTimeStamp() ) );
		if ( $age < 657000 )	// less than one week: red
			$ageStyle = ' color:red; ';
		elseif ( $age < 1314000 )	// one-two weeks: maroon
			$ageStyle = ' color:maroon; ';
		elseif ( $age < 2628000 )	// two weeks to one month: green
			$ageStyle = ' color:green; ';
		elseif ( $age < 7884000 )	// one - three months: blue
			$ageStyle = ' color:blue; ';
		elseif ( $age < 15768000 )	// three to six months: navy
			$ageStyle = ' color:navy; ';
		elseif ( $age < 31536000 )	// six months to a year: black
			$ageStyle = ' color:black; ';
		else						// more than one year: don't show the update age
			$ageStyle = ' display:none; ';
		return $ageStyle;
	}

	public function returnToTopAnchor()
	{
		return '<a href="#cn-top" title="Return to top."><img src="' . WP_PLUGIN_URL . '/connections/images/uparrow.gif" alt="Return to Top"/></a>';
	}

}

?>