<?php  
 
require_once vc_path_dir('SHORTCODES_DIR', 'vc-posts-grid.php');
class WPBakeryShortCode_ENGO_Frontpageposts_default extends WPBakeryShortCode_VC_Posts_Grid {

}
class WPBakeryShortCode_ENGO_Frontpageposts extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Frontpageposts2 extends WPBakeryShortCode_VC_Posts_Grid {

}


class WPBakeryShortCode_ENGO_Frontpageposts3 extends WPBakeryShortCode_VC_Posts_Grid {

}


 class WPBakeryShortCode_ENGO_Frontpageposts4 extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Frontpageposts9 extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Frontpageposts12 extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Frontpageposts13 extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Frontpageposts14 extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Timelinepost extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Categoriespost extends WPBakeryShortCode_VC_Posts_Grid {

}


class WPBakeryShortCode_ENGO_Timeline extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Listpost extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Gridposts extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Megablogs extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Megaposts extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_slideshoengost extends WPBakeryShortCode_VC_Posts_Grid {

}

class WPBakeryShortCode_ENGO_Counter extends WPBakeryShortCode {

	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->jsCssScripts();
	}

	public function jsCssScripts() {

		wp_register_style('counterup_js',NAUTICA_THEME_URI.'/js/jquery.counterup.min.js',array(),false,true);
	 
	}
}

 

class WPBakeryShortCode_ENGO_Frontpageblog extends WPBakeryShortCode_VC_Posts_Grid {}

/**
 * Elements
 */
class WPBakeryShortCode_Engo_featuredbox  extends WPBakeryShortCode {}
class WPBakeryShortCode_Engo_pricing 	 extends WPBakeryShortCode {}
class WPBakeryShortCode_Engo_inforbox 	 extends WPBakeryShortCode {}
/**
 * Themes
 */
class WPBakeryShortCode_Engo_title_heading   extends WPBakeryShortCode {}
class WPBakeryShortCode_Engo_Team extends WPBakeryShortCode {}
class WPBakeryShortCode_Engo_team_list extends WPBakeryShortCode {}
class WPBakeryShortCode_Engo_verticalmenu extends WPBakeryShortCode {}
class WPBakeryShortCode_Engo_horizontal_menu extends WPBakeryShortCode {}
class WPBakeryShortCode_Engo_interactive_banner extends WPBakeryShortCode {}
