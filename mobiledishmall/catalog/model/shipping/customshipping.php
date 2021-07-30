<?php
class ModelShippingCustomShipping extends Model {
	function getQuote($address) {

	    $costs= $this->getCosts( $address['country_id'], $address['zone_id']); 
	    
	    $this->language->load('shipping/customshipping');

		$method_data = array();
		
		//GET The Shop Home Country
		$homecountry=$this->config->get('config_country_id');
		
		//SET The Shipping Text Tile based on Country
		if ($homecountry==$address['country_id']){
			$module_title=$this->language->get('text_title_domestic');
		}else{
			$module_title=$this->language->get('text_title_int');
		}
		
			
		if (is_array($costs)) {
	    
		    foreach ($this->cart->getProducts() as $product) {
		        if ($product['shipping']) {
		        	if ($homecountry==$address['country_id']){
			        	$ccost[] = array(
								'product_id'=> $product['product_id'],
								'ship_base'   => $product['jan'],
								'qty' 	    => $product['quantity'],
								'ship_add'    => $product['isbn']
							);	
		        	}else{
			        	$ccost[] = array(
								'product_id'=> $product['product_id'],
								'ship_base'   => $product['length'],
								'qty' 	    => $product['quantity'],
								'ship_add'    => $product['width']
							);
		        	}
		        }
		    }
		    
		  $quote_data = array();  
		    
		  for($k=0;$k<count($costs);$k++) {

				$total = 0;
			    $prev_base = 0;
				$prev_addtl = 0;
				$flag=1;

				$s_base = $costs[$k]['first'];
				$s_addtl =$costs[$k]['next'];
				$s_taxclass=$costs[$k]['tax_class_id'];
				$s_title = $costs[$k]['text'];
				
		//	$this->log->write($costs[$k]['first'] . '-----' . $costs[$k]['next']);
			    
			    for($i=0;$i<count($ccost);$i++) {
			    	
			       	$p_base=$ccost[$i]['ship_base'];
			       	$p_addtl=$ccost[$i]['ship_add'];
			    	    	
			    	if ($p_base > $prev_base || $i==0) {
						$total += ( $i > 0 ? -$prev_base-$s_base + $prev_addtl + $s_addtl : 0 ) + $p_base + $s_base + (($ccost[$i]['qty'] - 1) * ($p_addtl + $s_addtl));
						$prev_base = $p_base;
						$prev_addtl = $p_addtl;
					} else {
						$total += (($p_addtl + $s_addtl) * $ccost[$i]['qty']);
					}
			    }
		    
		    	$freeshippingtext='';
		    	//Enable to show Free Shipping if cost is zero
		    	if ($this->config->get('customshipping_free_text')==1){
		    		if ($total==0) $freeshippingtext=' '.$this->language->get('text_free');
		    	}
		    	
		    	$maxcost = $this->config->get('customshipping_max_cost');
		    	
		    	if ($maxcost > 0) {
		    		if ($total < $maxcost) {
		    	
						$quote_data['customshipping'.$k] = array(
			        		'code'         => 'customshipping.customshipping'.$k,
			        		'title'        => $s_title . $freeshippingtext,
			        		'cost'         => $total, 
			        		'tax_class_id' => $s_taxclass,
							'text'         => $this->currency->format( $this->tax->calculate($total, $s_taxclass, $this->config->get('config_tax')))
			      		);
		    		}
		    	}
		}

      		$method_data = array(
        		'code'       => 'customshipping',
        		'title'      => $module_title,
        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('customshipping_sort_order'),
        		'error'      => false
      		);
		}
	
		return $method_data;
	}
	
	protected function getCosts($country_id, $zone_id)
	{
		$homecountry=$this->config->get('config_country_id');
	    $customshipping_cost = $this->config->get('customshipping_cost');
	    
	    // Step One Find Rates Specific to Country/Zone match both i.e. UKRAINE/Rivne
	    
	    $rates_query=array();
	    $fixedzone=false;
	    $fixedcountry=false;
	    
	    foreach($customshipping_cost as $csrate)
	    {
	        
	        if ($csrate['country_id'] == $country_id && $csrate['zone_id'] == $zone_id )
	        {
	            $rates_query []= array(
	        		'text'       	=> $csrate['text'],
	        		'country_id'    => $csrate['country_id'],
	        		'zone_id'       => $csrate['zone_id'],
					'tax_class_id'  => $csrate['tax_class_id'],
					'first' 		=> $csrate['first'],				
	        		'next'      	=> $csrate['next']
	      		);
	         $fixedzone=true;   
	            
	        }
       
	    }
	    
	    // Step Two Find rates Specific to Country for All Zones if not found rate for specific zone i.e. UKRAINE/All Zones
	    //if ($czc['country_id'] == $country_id && ($czc['zone_id'] == $zone_id || $czc['zone_id'] == 0) )
	    
	    if ($fixedzone==false){
	    
		    foreach($customshipping_cost as $csrate)
		    {
		        if ($csrate['country_id'] == $country_id && $csrate['zone_id'] == 0 )
		        {
	            	$rates_query []= array(
		        		'text'       	=> $csrate['text'],
		        		'country_id'    => $csrate['country_id'],
		        		'zone_id'       => $csrate['zone_id'],
						'tax_class_id'  => $csrate['tax_class_id'],
						'first' 		=> $csrate['first'],				
		        		'next'      	=> $csrate['next']
	      			);
		      		$fixedcountry=true;
		        }
	       
		    }
	    }
	    
	    // Step Three Country Specific Rate Not Found, Find and Apply Universal Int Rates Except Home Country
	    
	    if ($fixedcountry==false && $fixedzone==false){
		    foreach($customshipping_cost as $csrate)
		    {
	             if ($csrate['country_id'] == 0 && $country_id !=$homecountry ){	
		            $rates_query []= array(
		        		'text'       	=> $csrate['text'],
		        		'country_id'    => $csrate['country_id'],
		        		'zone_id'       => $csrate['zone_id'],
						'tax_class_id'  => $csrate['tax_class_id'],
						'first' 		=> $csrate['first'],				
		        		'next'      	=> $csrate['next']
		      		);
	            }
		    }
	    }
	  //  $this->session->data['testshipping_methods'] =$rates_query;
	  //  $this->session->data['fixedcountry']=$fixedcountry;
	  //  $this->session->data['fixedzone']=$fixedzone;
	    return $rates_query;
	    
	    
	    //return null; 
	}
	
}
?>