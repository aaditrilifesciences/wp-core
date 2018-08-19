<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     EngoTheme Team <engotheme@gmail.com >
 * @copyright  Copyright (C) 2015  engotheme.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.engotheme.com
 * @support  http://www.engotheme.com/support/
 */
if(!class_exists('Engotheme_Widget')){
	
abstract class Engotheme_Widget extends WP_Widget{

	protected $widgetName='';
	/**
	 * this method check overriding layout path in current template
	 */
	public function renderLayout($layout='default' ){  
		$output='';
		$tpl = ENGO_THEME_PLUGIN_THEMER_WIDGET_TEMPLATES .'widgets/'.$this->widgetName.'/'.$layout.'.php';
		$tpl_default = ENGO_THEME_PLUGIN_THEMER_DIR .'templates/widgets/' .$this->widgetName.'/'.$layout.'.php';
  
		if(  is_file($tpl) ){
			return( $tpl );
		}else if( is_file($tpl_default) ){
			return( $tpl_default );
		}
		return  ENGO_THEME_PLUGIN_THEMER_DIR .'templates/widgets/no-layout.php';
	}

	public function selectLayout(){
		$tml_default 	= glob(ENGO_THEME_PLUGIN_THEMER_DIR.'templates/widgets/' .$this->widgetName.'/*.php');
		$tml_new 		= glob(ENGO_THEME_PLUGIN_THEMER_WIDGET_TEMPLATES .'widgets/'.$this->widgetName.'/*.php');
		$layout = array_merge($tml_default,$tml_new);
		foreach ($layout as $key => $value) {
			$layout[$key] = basename($value,'.php');
		}
		$layout = array_unique($layout);
		return $layout;
	}

}
}