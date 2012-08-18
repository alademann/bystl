<?php

class cnGeo
{
	private $googleMapURL = 'http://maps.googleapis.com/maps/api/geocode/%s?address=%s&sensor=false';
	private $output = 'json';
	private $provider = 'google';
	
	public function __construct()
	{
		//@todo Set provider based on option
	}
	
	public function geocode( $address , $options = array() )
	{
		$result = new stdClass();
		
		if ( is_array($address) ) $address = (object) $address;
		
		switch ( $this->provider )
		{
			case 'google':
				
				$addr = array();
				$geo = array();
				
				if ( ! empty($address->line_1) ) $addr[] = trim($address->line_1);
				if ( ! empty($address->line_2) ) $addr[] = trim($address->line_2);
				if ( ! empty($address->line_3) ) $addr[] = trim($address->line_3);
				if ( ! empty($address->city) ) $addr[] = trim($address->city);
				if ( ! empty($address->state) ) $addr[] = trim($address->state);
				if ( ! empty($address->zipcode) ) $addr[] = trim($address->zipcode);
				if ( ! empty($address->country) ) $addr[] = trim($address->country);
				
				// Convert the array to a string for the URL
				$addrString = implode( ',' , $addr );
				
				// Remove non alpha numeric chars such as extra spaces and replace w/ a plus.
				//$addr = preg_replace("[^A-Za-z0-9]", '+', $addr );
				$addrString = urlencode( utf8_encode( str_replace(' ', '+', $addrString) ) );
				
				$getResult = file_get_contents( sprintf($this->googleMapURL , $this->output , $addrString ) );
				
				if ( $getResult )
				{
					$jsonResult = json_decode( $getResult );
					
					if ( $jsonResult->{'status'} === 'OK' )
					{
						$result->latitude = $jsonResult->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
						$result->longitude = $jsonResult->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
					}
				}
				
			break;
			
			case 'osm':
				
			break;
		}
		
		return $result;
	}
}

?>