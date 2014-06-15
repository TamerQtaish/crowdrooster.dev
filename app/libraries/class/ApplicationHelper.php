<?php

class ApplicationHelper {	

    public function test()
	{
		echo '<p>test</p>';
	}
		
	//clean variable data (single value) using selected params
	//created by YM (30/05/2014), last updated by YM (30/05/2014)
	//example usage 1: $final = DataCleanse ($testvar, 'type = string; action = limit_length(20); case = lowercase; characters = alphanumeric; default = null');
	//example usage 2: $final = DataCleanse ($testvar, 'type = number; action = limit_length(10); format = integer; min_value = 0; max_value = 9999; default = 0');
	public function DataCleanse($data, $params)
	{
		//trim data string first
		$data = trim($data);
		
		//get into proper property/setting key->value array format
		$params = explode (';', $params);
		foreach( $params as $element )
		{
			list($key, $value) = explode("=", $element);     
			$key = trim($key);
			$value = trim($value);
			$settings[$key] = $value;
		};

		
		//was text length limit specified?
		if ( array_key_exists('action', $settings) )
		{
			if (strpos( $settings['action'], 'limit_length') !== FALSE)
			{
				//limit length depending on value in between brackets
				$data = substr($data, 0, $this->GetInbetweenStrings( $settings['action'], '(', ')' ) );
			}; 
		};	
		
		//what type of data is it?
		switch ( $settings['type'] )
		{ 
			case 'string':
				
				//was case formatting specified?
				if ( array_key_exists('case', $settings) )
				{
					switch ( $settings['case'] )
					{
						case 'lowercase':
							$data = strtolower($data);
							break;
							
						case 'uppercase':
							$data = strtoupper($data);
							break;
							
						default:
							break;
					};
				}
				
				//was characters filtering specified?
				if ( array_key_exists('characters', $settings) )
				{
					switch ( $settings['characters'] )
					{
						case 'alphanumeric':
							$data = preg_replace(array('/[^[:alnum:]]/', '/(\s+|\-{2,})/'), array('', '-'), $data);
							break;
							
						case 'alpha':
							$data = preg_replace("/[^a-zA-Z]+/", '', $data);
							break;
							
						case 'numeric':
							$data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
							break;						
							
						default:
							break;
					};			
				};			
				break;
				
			case 'number':
			
				//was a format filtering specified?
				if ( array_key_exists('format', $settings) )
				{
					switch ( $settings['format'] )
					{
						case 'integer':
							$data = intval($data);
							break;
							
						case 'decimal':			
							$data = number_format($data, 2, '.', '');						
							break;
							
						case 'float':
							$data = floatval($data);
							break;
					}
				}		
			
				//was a minimum range filtering specified?
				if ( array_key_exists('min_value', $settings) )
				{
					if ( $data < $settings['min_value'] )
					{
						$data = $settings['min_value'];
					};
				}
				
				//was a maximum range filtering specified?
				if ( array_key_exists('max_value', $settings) )
				{
					if ( $data > $settings['max_value'] )
					{
						$data = $settings['max_value'];
					};
				}			
				break;				
		};
		
		//if final value is null or empty, then set it as default
		if ($data == NULL || $data == '')
		{
			//was a default specified?
			if ( array_key_exists('default', $settings) )
			{
				$data = $settings['default'];
			};
		};
		
		return $data;
	}


	// grabs the text between two identifying substrings in a string.
	public function GetInbetweenStrings($input_string, $left_string, $right_string) 
	{
	  $il = strpos($input_string,$left_string,0)+strlen($left_string);
	  $ir = strpos($input_string,$right_string,$il);
	  return substr($input_string,$il,($ir-$il));
	}

	//convert object to an array
	public function ObjectToArray ($object) 
	{
		if(!is_object($object) && !is_array($object))
			return $object;

		return array_map('ObjectToArray', (array) $object);
	}	
}