<?php 
if( class_exists("WPBakeryShortCode") ){
	/*
	 *
	 */
	class WPBakeryShortCode_ENGO_Tabs_Products extends WPBakeryShortCode {

		public function getListQuery( $atts ){ 
			$this->atts  = $atts; 
			$list_query = array();
			$types = explode(',', $this->atts['show_tab']);
			foreach ($types as $type) {
				$list_query[$type] = $this->getTabTitle($type);
			}


			return $list_query;
		}

		public function getTabTitle($type){ 
			switch ($type) {
				case 'recent':
					return array('title'=>esc_html__('Latest Products', 'nautica'),'title_tab'=>esc_html__('New Arrival', 'nautica'));
				case 'featured_product':
					return array('title'=>esc_html__('Featured Products', 'nautica'),'title_tab'=>esc_html__('Most Wanted', 'nautica'));
				case 'top_rate':
					return array('title'=> esc_html__('Top Rated Products', 'nautica'),'title_tab'=>esc_html__('Top Rated', 'nautica'));
				case 'best_selling':
					return array('title'=>esc_html__('BestSeller Products', 'nautica'),'title_tab'=>esc_html__('Best Seller', 'nautica'));
				case 'on_sale':
					return array('title'=>esc_html__('Special Products', 'nautica'),'title_tab'=>esc_html__('Special', 'nautica'));
			}
		}
	}

	/**
	 *
	 */
	 class WPBakeryShortCode_Engo_product_deals extends WPBakeryShortCode {}

	 /**
	  *
	  */
	 class WPBakeryShortCode_Engo_timing_deals extends WPBakeryShortCode {}

	 
	class WPBakeryShortCode_Engo_productcategory extends WPBakeryShortCode {}
	class WPBakeryShortCode_Engo_productcategory_index extends WPBakeryShortCode {}


	class WPBakeryShortCode_Engo_category_filter extends WPBakeryShortCode {}

	class WPBakeryShortCode_Engo_products extends WPBakeryShortCode {}
	 

	class WPBakeryShortCode_Engo_category_list extends WPBakeryShortCode {}
	class WPBakeryShortCode_Engo_special_product_categories extends WPBakeryShortCode {}
	class WPBakeryShortCode_Engo_productcats_tabs extends WPBakeryShortCode {}
	class WPBakeryShortCode_br_productcats_normal extends WPBakeryShortCode {}

	class WPBakeryShortCode_Engo_custom_deals extends WPBakeryShortCode {}
	class WPBakeryShortCode_Engo_product_intro extends WPBakeryShortCode {}
	class WPBakeryShortCode_Engo_pageable_container_sections extends WPBakeryShortCode{}


 }

