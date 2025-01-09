<?php
/**
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
 */

if (!defined('_PS_VERSION_')) { exit; }
class Ets_mls_defines {
	public $context;
	/**
	 * @var Ets_multilayerslider
	 */
	public $module;

	public function __construct($module = null)
	{
		if (!(is_object($module)) || !$module) {
			$module = Module::getInstanceByName('ets_multilayerslider');
		}
		$this->module = $module;
		$context = Context::getContext();
		$this->context = $context;
	}

	public static function l($string)
	{
		return Translate::getModuleTranslation('ets_multilayerslider', $string, pathinfo(__FILE__, PATHINFO_FILENAME));
	}
	
	public static function getConfigs() {
		return array(
			'form' => array(
				'legend' => array(
					'title' => self::l('Configuration'),
					'icon' => 'icon-AdminAdmin'
				),
				'input' => array(),
				'submit' => array(
					'title' => self::l('Save'),
				),
				'name' => 'config'
			),
			'configs' => array(
				'ETS_MLS_SLIDER_TYPE' => array(
					'type' => 'select',
					'label' => self::l('Slider type'),
					'name' => 'ETS_MLS_HOOK_TO',
					'options' => array(
						'query' => array(
							array(
								'id_option' =>'auto',
								'name'=>self::l('Auto size'),
							),
							array(
								'id_option' =>'boxed',
								'name'=>self::l('Boxed'),
							),
							array(
								'id_option' =>'full',
								'name'=>self::l('Full width'),
							),
						),
						'id' => 'id_option',
						'name' => 'name'
					),
					'default' => 'auto',
				),
				'ETS_MLS_HOOK_TO' => array(
					'type' => 'select',
					'label' => self::l('Hook to'),
					'name' => 'ETS_MLS_HOOK_TO',
					'options' => array(
						'query' => array(
							array(
								'id_option' =>'default',
								'name'=>self::l('Default hook'),
							),
							array(
								'id_option' =>'customhook',
								'name'=>self::l('Custom hook'),
							),
						),
						'id' => 'id_option',
						'name' => 'name'
					),
					'default' => 'default',
					'desc' => self::l('Put {hook h=\'displayMLS\'} on your template tpl file where you want the slider displays'),
				),
				'ETS_MLS_SLIDER_BACKGROUND' => array(
					'type' => 'color',
					'label' => self::l('Slider background color'),
					'default'=> '#ffffff',
					'validate' => 'isColor',
				),
				'ETS_MLS_SLIDER_BUTTON_COLOR' => array(
					'type' => 'color',
					'label' => self::l('Slider buttons color'),
					'default'=> '#ec4249',
					'validate' => 'isColor',
				),
				'ETS_MLS_WIDTH_SLIDE' => array(
					'type' => 'text',
					'label' => self::l('Slide width'),
					'default'=> 1170,
					'suffix' => 'px',
					'required' => true,
					'validate' => 'isUnsignedInt',
				),
				'ETS_MLS_HEIGHT_SLIDE' => array(
					'type' => 'text',
					'label' => self::l('Slide height'),
					'default'=> 450,
					'suffix' => 'px',
					'required' => true,
					'validate' => 'isUnsignedInt',
				),
				'ETS_MLS_MOVE_IN' => array(
					'type' => 'text',
					'label' => self::l('Move in'),
					'default'=> 1000,
					'suffix' => 'ms',
					'required' => true,
					'validate' => 'isUnsignedInt',
					'desc' => self::l('Time for a slide to move in the slider'),
				),
				'ETS_MLS_MOVE_OUT' => array(
					'type' => 'text',
					'label' => self::l('Move out'),
					'default'=> 500,
					'suffix' => 'ms',
					'required' => true,
					'validate' => 'isUnsignedInt',
					'desc' => self::l('Time for a slide to move out of the slider'),
				),
				'ETS_MLS_STAND_DURATION' => array(
					'type' => 'text',
					'label' => self::l('Stand duration'),
					'default'=> 5000,
					'suffix' => 'ms',
					'validate' => 'isUnsignedInt',
					'required' => true,
					'desc' => self::l('Stand duration of a slide on the slider.'),
				),
				'ETS_MLS_AUTO_PLAY' => array(
					'label' => self::l('Auto play'),
					'type' => 'switch',
					'default' => 1,
					'values' => array(
						array(
							'label' => self::l('Yes'),
							'id' => 'slide_enabled_1',
							'value' => 1,
						),
						array(
							'label' => self::l('No'),
							'id' => 'slide_enabled_0',
							'value' => 0,
						)
					),
				),
				'ETS_MLS_ENABLE_RUNNING_BAR' => array(
					'label' => self::l('Enable running status bar'),
					'type' => 'switch',
					'default' => 1,
					'values' => array(
						array(
							'label' => self::l('Yes'),
							'id' => 'slide_enabled_1',
							'value' => 1,
						),
						array(
							'label' => self::l('No'),
							'id' => 'slide_enabled_0',
							'value' => 0,
						)
					),
				),
				'ETS_MLS_PAUSE_ON_HOVER' => array(
					'label' => self::l('Pause when hover'),
					'type' => 'switch',
					'default' => 1,
					'values' => array(
						array(
							'label' => self::l('Yes'),
							'id' => 'slide_enabled_1',
							'value' => 1,
						),
						array(
							'label' => self::l('No'),
							'id' => 'slide_enabled_0',
							'value' => 0,
						)
					),
				),
				'ETS_MLS_LOOP' => array(
					'label' => self::l('Loop'),
					'type' => 'switch',
					'default' => 1,
					'values' => array(
						array(
							'label' => self::l('Yes'),
							'id' => 'slide_enabled_1',
							'value' => 1,
						),
						array(
							'label' => self::l('No'),
							'id' => 'slide_enabled_0',
							'value' => 0,
						)
					),
				),
				'ETS_MLS_ENABLE_LOADING_ICON' => array(
					'label' => self::l('Display loading icon'),
					'type' => 'switch',
					'default' => 1,
					'values' => array(
						array(
							'label' => self::l('Yes'),
							'id' => 'slide_enabled_1',
							'value' => 1,
						),
						array(
							'label' => self::l('No'),
							'id' => 'slide_enabled_0',
							'value' => 0,
						)
					),
				),
				'ETS_MLS_ENABLE_NEXT_PREV' => array(
					'label' => self::l('Enable "Next"/"Prev" button'),
					'type' => 'switch',
					'default' => 1,
					'values' => array(
						array(
							'label' => self::l('Yes'),
							'id' => 'slide_enabled_1',
							'value' => 1,
						),
						array(
							'label' => self::l('No'),
							'id' => 'slide_enabled_0',
							'value' => 0,
						)
					),
				),
				'ETS_MLS_ENABLE_PAGINATION' => array(
					'label' => self::l('Enable slider pagination buttons'),
					'type' => 'switch',
					'default' => 1,
					'values' => array(
						array(
							'label' => self::l('Yes'),
							'id' => 'slide_enabled_1',
							'value' => 1,
						),
						array(
							'label' => self::l('No'),
							'id' => 'slide_enabled_0',
							'value' => 0,
						)
					),
				),
				'ETS_MLS_CUSTOM_CSS' => array(
					'type' => 'textarea',
					'label' => self::l('Custom CSS'),
					'desc' => self::l('Custom color codes available').': [bg_color], [button_color]',
				),
			),
		);
	}

	/**
	 * @param int|string|null $item_id
	 * @return array
	 */
	public static function getSliders($item_id) {
		return array(
			'form' => array(
				'legend' => array(
					'title' => $item_id ? self::l('Edit slide') : self::l('Add slide'),
				),
				'input' => array(),
				'submit' => array(
					'title' => self::l('Save'),
				),
				'name' => 'slide',
				'connect_to' => 'layer',
			),
			'configs' => array(
				'title' => array(
					'label' => self::l('Title'),
					'type' => 'text',
					'required' => true,
					'lang' => true,
				),
				'image' => array(
					'label' => self::l('Background image'),
					'type' => 'file',
					'desc' => sprintf(self::l('Accepted formats: jpg, jpeg, png, gif, webp. Limit: %sMb.'), Configuration::get('PS_ATTACHMENT_MAXIMUM_SIZE'))
				),
				'repeat_x' => array(
					'label' => self::l('Repeat X'),
					'type' => 'switch',
					'default' => 0,
					'values' => array(
						array(
							'label' => self::l('Yes'),
							'id' => 'repeat_x_1',
							'value' => 1,
						),
						array(
							'label' => self::l('No'),
							'id' => 'repeat_x_0',
							'value' => 0,
						)
					),
				),
				'repeat_y' => array(
					'label' => self::l('Repeat Y'),
					'type' => 'switch',
					'default' => 0,
					'values' => array(
						array(
							'label' => self::l('Yes'),
							'id' => 'repeat_y_1',
							'value' => 1,
						),
						array(
							'label' => self::l('No'),
							'id' => 'repeat_y_0',
							'value' => 0,
						)
					),
				),
				'backgroud_color' => array(
					'label' => self::l('Backgroud color'),
					'type' => 'color',
					'validate' => 'isColor',
					'default' => '#f5f5f5',
				),
				'animation_in' => array(
					'label' => self::l('Animation in'),
					'type' => 'select',
					'class' => 'ybc_slide_animation',
					'options' => array(
						'query' => self::getSlideAnimationIn(),
						'id' => 'id_option',
						'name' => 'name'
					),
					'desc' => self::l('Transition effect when the slide move into the slider area'),
					'default' => 'fadeIn',
				),
				'animation_out' => array(
					'label' => self::l('Animation out'),
					'type' => 'select',
					'class' => 'ybc_slide_animation',
					'options' => array(
						'query' => self::getSlideAnimationOut(),
						'id' => 'id_option',
						'name' => 'name'
					),
					'desc' => self::l('Transition effect when the slide move out of the slider area'),
					'default' => 'fadeOut',
				),
				'custom_class' => array(
					'label' => self::l('Custom CSS class'),
					'type' => 'text',
				),
				'sort_order' => array(
					'label' => self::l('Sort order'),
					'type' => 'sort_order',
					'required' => true,
					'default' => 1,
					'order_group' => false,
				),
				'enabled' => array(
					'label' => self::l('Enabled'),
					'type' => 'switch',
					'default' => 1,
					'values' => array(
						array(
							'label' => self::l('Yes'),
							'id' => 'slide_enabled_1',
							'value' => 1,
						),
						array(
							'label' => self::l('No'),
							'id' => 'slide_enabled_0',
							'value' => 0,
						)
					),
				),
			),
		);
	}

	/**
	 * @param int|string|null $itemId
	 * @param int|string|null $id_slide
	 * @return array
	 */
	public static function getLayers($itemId, $id_slide) {
		$isMultiLayoutExist = self::multiLayoutExist();
		$layers = array(
			'form' => array(
				'legend' => array(
					'title' => $itemId ? self::l('Edit layer') : self::l('Add layer'),
				),
				'input' => array(),
				'submit' => array(
					'title' => self::l('Save'),
				),
				'name' => 'layer',
				'parent' => 'slide',
			),
			'configs' => array(
				'layer_type' => array(
					'type' => 'select',
					'label' => self::l('Layer type'),
					'name' => 'layer_type',
					'options' => array(
						'query' => array(
							array(
								'id_option' =>'text',
								'name'=>self::l('Text/HTML'),
							),
							array(
								'id_option' =>'text_background',
								'name'=>self::l('Text with background'),
							),
							array(
								'id_option' =>'button',
								'name'=>self::l('Button'),
							),
							array(
								'id_option' =>'link',
								'name'=>self::l('Link'),
							),
							array(
								'id_option' =>'image',
								'name'=>self::l('Image'),
							),
						),
						'id' => 'id_option',
						'name' => 'name'
					),
					'default' => 'text',
				),
				'image' =>array(
					'type' => 'file',
					'label' => self::l('Image'),
					'hide_delete' => true,
					'showRequired' => true,
					'desc' => sprintf(self::l('Accepted formats: jpg, jpeg, png, gif, webp. Limit: %sMb.'), Configuration::get('PS_ATTACHMENT_MAXIMUM_SIZE'))
				),
				'content_layer'=>array(
					'type'=>'textarea',
					'label'=>self::l('Text content'),
					'lang'=>true,
					'showRequired' => true,
				),
				'width' => array(
					'label' => self::l('Image width'),
					'type' => 'text',
					'suffix' => 'px',
					'validate' => 'isUnsignedInt',
					'desc' => self::l('Leave blank to use default image width'),
				),
				'height' => array(
					'label' => self::l('Image height'),
					'type' => 'text',
					'suffix' => 'px',
					'validate' => 'isUnsignedInt',
					'desc' => self::l('Leave blank to use default image height'),
				),
				'link'=>array(
					'type'=>'text',
					'label'=>self::l('Link'),
					'lang'=>true,
					'showRequired' => true,
					'validate' => 'isLink',
				),
				'font_family' => array(
					'label' => self::l('Font family'),
					'type' => 'select',
					'options' => array(
						'query' => self::getGoogleFonts(),
						'id' => 'id_option',
						'name' => 'name'
					),
					'desc' => self::l('Use default font of your theme or select a Google font from the list'),
				),
				'font_size' => array(
					'label' => self::l('Font size'),
					'type' => 'text',
					'default' => 30,
					'suffix' => 'px',
					'validate' => 'isFloat',
				),
				'font_weight' => array(
					'label' => self::l('Font weight'),
					'type' => 'radio',
					'default' => 'normal',
					'values' => array(
						array(
							'label' => self::l('Normal'),
							'id' => 'font_weight_1',
							'value' => 'normal',
						),
						array(
							'label' => self::l('Bold'),
							'id' => 'font_weight_0',
							'value' => 'bold',
						)
					),
				),
				'text_transform' => array(
					'label' => self::l('Text transform'),
					'type' => 'radio',
					'default' => 'none',
					'values' => array(
						array(
							'label' => self::l('None'),
							'id' => 'text_transform_1',
							'value' => 'none',
						),
						array(
							'label' => self::l('Uppercase'),
							'id' => 'text_transform_0',
							'value' => 'uppercase',
						),
						array(
							'label' => self::l('Lowercase'),
							'id' => 'text_transform_2',
							'value' => 'lowercase',
						),
					),
				),
				'text_decoration' => array(
					'label' => self::l('Text decoration'),
					'type' => 'radio',
					'default' => 'none',
					'values' => array(
						array(
							'label' => self::l('None'),
							'id' => 'text_decoration_1',
							'value' => 'none',
						),
						array(
							'label' => self::l('Underline'),
							'id' => 'text_decoration_2',
							'value' => 'underline',
						),
						array(
							'label' => self::l('Overline'),
							'id' => 'text_decoration_3',
							'value' => 'overline',
						),
						array(
							'label' => self::l('Line-through'),
							'id' => 'text_decoration_4',
							'value' => 'line-through',
						),
					),
				),
				'text_color' => array(
					'label' => self::l('Text color'),
					'type' => 'color',
					'validate' => 'isColor',
					'default' => '#222222',
				),
				'background_color' => array(
					'label' => self::l('Background color'),
					'type' => 'color',
					'validate' => 'isColor',
					'default' => '#F3F3F3',
				),
				'padding' => array(
					'label' => self::l('Padding'),
					'type' => 'text',
					'default' => '5px 10px',
					'desc' => self::l('Standard CSS padding value format. Eg: 5px 10px 15px 20px,10px 5px, 5px...'),
				),
				'box_radius' => array(
					'label' => self::l('Box radius'),
					'type' => 'text',
					'default' => 20,
					'suffix' => 'px',
					'validate' => 'isUnsignedInt',
				),
				'background_opacity' => array(
					'label' => self::l('Background opacity'),
					'type' => 'text',
					'validate' => 'isUnsignedFloat',
					'default' => 1,
					'desc' => self::l('From 0-1, Eg: 0.5, 0.8, 1...'),
				),
				'id_slide' => array(
					'label' => self::l('Slide'),
					'type' => 'hidden',
					'default' => $id_slide ? $id_slide : ($itemId ? $itemId : ''),
					'required' => true,
					'validate' => 'isUnsignedInt',
				),
				'top' => array(
					'label' => self::l('Top').($isMultiLayoutExist ? ' ('.self::l('LTR').')' :  ''),
					'type' => 'text',
					'suffix' => 'px',
					'default' => 50,
					'required' => true,
					'validate' => 'isFloat',
					'desc' => $isMultiLayoutExist ? self::l('The distance to slide top edge on LTR layout') : self::l('The distance to slide top edge'),
				),
				'left' => array(
					'label' => self::l('Left').($isMultiLayoutExist ? ' ('.self::l('LTR').')' :  ''),
					'type' => 'text',
					'suffix' => 'px',
					'default' => 50,
					'required' => true,
					'validate' => 'isFloat',
					'desc' => $isMultiLayoutExist ? self::l('The distance to slide left edge on LTR layout') : self::l('The distance to slide left edge'),
				),
				'top_right' =>array(
					'label'=>self::l('Top (RTL)'),
					'type' => 'text',
					'suffix' => 'px',
					'default' => 50,
					'required' => true,
					'validate' => 'isFloat',
					'desc' => self::l('The distance to slide top edge on RTL layout'),
				),
				'right' =>array(
					'label'=>self::l('Right (RTL)'),
					'type' => 'text',
					'suffix' => 'px',
					'validate' => 'isFloat',
					'default' => 50,
					'required' => true,
					'desc' => self::l('The distance to slide right edge on RTL layout'),
				),
				'animation_in' => array(
					'label' => self::l('Animation in'),
					'type' => 'select',
					'class' => 'ybc_slide_animation',
					'options' => array(
						'query' => self::getAnimationIn(),
						'id' => 'id_option',
						'name' => 'name'
					),
					'desc' => self::l('Transition effect when the layer moves in its slide'),
					'default' => 'fadeIn',
				),
				'start_delay' => array(
					'label' => self::l('Delay in'),
					'type' => 'text',
					'suffix' => 'ms',
					'validate' => 'isUnsignedInt',
					'required' => true,
					'default' => 0,
					'desc' => self::l('The delay time for the layer to start moving in its slide'),
				),
				'move_in' => array(
					'label' => self::l('Move in'),
					'type' => 'text',
					'suffix' => 'ms',
					'validate' => 'isUnsignedInt',
					'required' => true,
					'default' => 1000,
					'desc' => self::l('The duration for the layer to move in its slide'),
				),
				'animation_out' => array(
					'label' => self::l('Animation out'),
					'type' => 'select',
					'class' => 'ybc_slide_animation',
					'options' => array(
						'query' => self::getAnimationOut(),
						'id' => 'id_option',
						'name' => 'name'
					),
					'desc' => self::l('Transition effect when the layer moves out of its slide'),
					'default' => 'fadeOut',
				),
				'stand_duration' => array(
					'label' => self::l('Delay out'),
					'type' => 'text',
					'suffix' => 'ms',
					'validate' => 'isUnsignedInt',
					'required' => true,
					'default' => 0,
					'desc' => self::l('The delay time for the layer to start moving out of its slide'),
				),
				'move_out' => array(
					'label' => self::l('Move out'),
					'type' => 'text',
					'suffix' => 'ms',
					'validate' => 'isUnsignedInt',
					'required' => true,
					'default' => 500,
					'desc' => self::l('The duration for the layer to move out of its slide'),
				),
				'sort_order' => array(
					'label' => self::l('Sort order'),
					'type' => 'sort_order',
					'required' => true,
					'default' => 1,
					'order_group' => 'id_slide',
				),
			),
		);

		if(!$isMultiLayoutExist)
		{
			unset($layers['configs']['top_right']);
			unset($layers['configs']['right']);
		}

		return $layers;
	}

	/**
	 * @return array[]
	 */
	public static function getAnimationOut() {
		return array(
			array(
				'id_option' => 'bounce',
				'name' => self::l('Bounce')
			),
			array(
				'id_option' => 'flash',
				'name' => self::l('Flash')
			),
			array(
				'id_option' => 'pulse',
				'name' => self::l('Pulse')
			),
			array(
				'id_option' => 'rubberBand',
				'name' => self::l('RubberBand')
			),
			array(
				'id_option' => 'shake',
				'name' => self::l('Shake')
			),
			array(
				'id_option' => 'swing',
				'name' => self::l('Swing')
			),
			array(
				'id_option' => 'tada',
				'name' => self::l('Tada')
			),
			array(
				'id_option' => 'wobble',
				'name' => self::l('Wobble')
			),
			array(
				'id_option' => 'jello',
				'name' => self::l('Jello')
			),
			array(
				'id_option' => 'bounceOut',
				'name' => self::l('Bounce out')
			),
			array(
				'id_option' => 'bounceOutDown',
				'name' => self::l('Bounce out down')
			),
			array(
				'id_option' => 'bounceOutLeft',
				'name' => self::l('Bounce out left')
			),
			array(
				'id_option' => 'bounceOutRight',
				'name' => self::l('Bounce out right')
			),
			array(
				'id_option' => 'bounceOutUp',
				'name' => self::l('Bounce out up')
			),
			array(
				'id_option' => 'fadeOut',
				'name' => self::l('Fade out')
			),
			array(
				'id_option' => 'fadeOutDown',
				'name' => self::l('Fade out Down')
			),
			array(
				'id_option' => 'fadeOutDownBig',
				'name' => self::l('Fade out down big')
			),
			array(
				'id_option' => 'fadeOutLeft',
				'name' => self::l('Fade out left')
			),
			array(
				'id_option' => 'fadeOutLeftBig',
				'name' => self::l('Fade out left big')
			),
			array(
				'id_option' => 'fadeOutRight',
				'name' => self::l('Fade out right')
			),
			array(
				'id_option' => 'fadeOutRightBig',
				'name' => self::l('Fade out right big')
			),
			array(
				'id_option' => 'fadeOutUp',
				'name' => self::l('Fade out up')
			),
			array(
				'id_option' => 'fadeOutUpBig',
				'name' => self::l('Fade out up big')
			),
			array(
				'id_option' => 'flip',
				'name' => self::l('Flip')
			),
			array(
				'id_option' => 'flipOutX',
				'name' => self::l('Flip out X')
			),
			array(
				'id_option' => 'flipOutY',
				'name' => self::l('Flip out Y')
			),
			array(
				'id_option' => 'lightSpeedOut',
				'name' => self::l('Light speed out')
			),
			array(
				'id_option' => 'rotateOut',
				'name' => self::l('Rotate out')
			),
			array(
				'id_option' => 'rotateOutDownLeft',
				'name' => self::l('Rotate out down left')
			),
			array(
				'id_option' => 'rotateOutDownRight',
				'name' => self::l('Rotate out down right')
			),
			array(
				'id_option' => 'rotateOutUpLeft',
				'name' => self::l('Rotate out up left')
			),
			array(
				'id_option' => 'rotateOutUpRight',
				'name' => self::l('Rotate out up right')
			),
			array(
				'id_option' => 'rotateZoomOut',
				'name' => self::l('Rotate Zoom Out')
			),
			array(
				'id_option' => 'rotateYOutLeft',
				'name' => self::l('Rotate OutLeft')
			),
			array(
				'id_option' => 'rotateXOutRight',
				'name' => self::l('Rotate Out Right')
			),
			array(
				'id_option' => 'rotateXOutTop',
				'name' => self::l('Rotate X Out top')
			),
			array(
				'id_option' => 'rotateXOutBottom',
				'name' => self::l('Rotate X Out Bottom')
			),
			array(
				'id_option' => 'rotateZOutLeft',
				'name' => self::l('Rotate Z Out Left')
			),
			array(
				'id_option' => 'rotateZOutRight',
				'name' => self::l('Rotate Z Out right')
			),
			array(
				'id_option' => 'zoomOutFlipVert',
				'name' => self::l('Zoom Out Flip Vert')
			),
			array(
				'id_option' => 'zoomOutFlipHoriz',
				'name' => self::l('Zoom Out Flip Horiz')
			),
			array(
				'id_option' => 'slideOutUp',
				'name' => self::l('Slide out up')
			),
			array(
				'id_option' => 'slideOutDown',
				'name' => self::l('Slide out down')
			),
			array(
				'id_option' => 'slideOutLeft',
				'name' => self::l('Slide out left')
			),
			array(
				'id_option' => 'slideOutRight',
				'name' => self::l('Slide out right')
			),
			array(
				'id_option' => 'slideOutCrossRightBottom',
				'name' => self::l('Slide out cross right bottom')
			),
			array(
				'id_option' => 'slideOutCrossRightTop',
				'name' => self::l('Slide out cross right top')
			),
			array(
				'id_option' => 'slideOutCrossLeftBottom',
				'name' => self::l('Slide out cross left bottom')
			),
			array(
				'id_option' => 'slideOutCrossLeftTop',
				'name' => self::l('Slide out cross left top')
			),
			array(
				'id_option' => 'zoomOut',
				'name' => self::l('Zoom out')
			),
			array(
				'id_option' => 'zoomOutDown',
				'name' => self::l('Zoom out down')
			),

			array(
				'id_option' => 'zoomOutLeft',
				'name' => self::l('Zoom out left')
			),
			array(
				'id_option' => 'zoomOutRight',
				'name' => self::l('Zoom out right')
			),
			array(
				'id_option' => 'zoomOutUp',
				'name' => self::l('Zoom out up')
			),
			array(
				'id_option' => 'hinge',
				'name' => self::l('Hinge')
			),
			array(
				'id_option' => 'rollOut',
				'name' => self::l('Roll out')
			),

		);
	}

	/**
	 * @return array[]
	 */
	public static function getAnimationIn() {
		return array(
			array(
				'id_option' => 'bounce',
				'name' => self::l('Bounce')
			),
			array(
				'id_option' => 'flash',
				'name' => self::l('Flash')
			),
			array(
				'id_option' => 'pulse',
				'name' => self::l('Pulse')
			),
			array(
				'id_option' => 'rubberBand',
				'name' => self::l('RubberBand')
			),
			array(
				'id_option' => 'shake',
				'name' => self::l('Shake')
			),
			array(
				'id_option' => 'swing',
				'name' => self::l('Swing')
			),
			array(
				'id_option' => 'tada',
				'name' => self::l('Tada')
			),
			array(
				'id_option' => 'wobble',
				'name' => self::l('Wobble')
			),
			array(
				'id_option' => 'jello',
				'name' => self::l('Jello')
			),
			array(
				'id_option' => 'bounceIn',
				'name' => self::l('Bounce in')
			),
			array(
				'id_option' => 'bounceInDown',
				'name' => self::l('Bounce in down')
			),
			array(
				'id_option' => 'bounceInLeft',
				'name' => self::l('Bounce in left')
			),
			array(
				'id_option' => 'bounceInRight',
				'name' => self::l('Bounce in right')
			),
			array(
				'id_option' => 'bounceInUp',
				'name' => self::l('Bounce in up')
			),
			array(
				'id_option' => 'fadeIn',
				'name' => self::l('Fade in')
			),
			array(
				'id_option' => 'fadeInDown',
				'name' => self::l('Fade in Down')
			),
			array(
				'id_option' => 'fadeInDownBig',
				'name' => self::l('Fade in down big')
			),
			array(
				'id_option' => 'fadeInLeft',
				'name' => self::l('Fade in left')
			),
			array(
				'id_option' => 'fadeInLeftBig',
				'name' => self::l('Fade in left big')
			),
			array(
				'id_option' => 'fadeInRight',
				'name' => self::l('Fade in right')
			),
			array(
				'id_option' => 'fadeInRightBig',
				'name' => self::l('Fade in right big')
			),
			array(
				'id_option' => 'fadeInUp',
				'name' => self::l('Fade in up')
			),
			array(
				'id_option' => 'fadeInUpBig',
				'name' => self::l('Fade in up big')
			),
			array(
				'id_option' => 'flip',
				'name' => self::l('Flip')
			),
			array(
				'id_option' => 'flipInX',
				'name' => self::l('Flip in X')
			),
			array(
				'id_option' => 'flipInY',
				'name' => self::l('Flip in Y')
			),
			array(
				'id_option' => 'lightSpeedIn',
				'name' => self::l('Light speed in')
			),
			array(
				'id_option' => 'rotateIn',
				'name' => self::l('Rotate in')
			),
			array(
				'id_option' => 'rotateInDownLeft',
				'name' => self::l('Rotate in down left')
			),
			array(
				'id_option' => 'rotateInDownRight',
				'name' => self::l('Rotate in down right')
			),
			array(
				'id_option' => 'rotateInUpLeft',
				'name' => self::l('Rotate in up left')
			),
			array(
				'id_option' => 'rotateInUpRight',
				'name' => self::l('Rotate in up right')
			),

			array(
				'id_option' => 'rotateZoomIn',
				'name' => self::l('Rotate Zoom In')
			),
			array(
				'id_option' => 'rotateYInLeft',
				'name' => self::l('Rotate In Left')
			),
			array(
				'id_option' => 'rotateXInRight',
				'name' => self::l('Rotate In Right')
			),
			array(
				'id_option' => 'rotateXInTop',
				'name' => self::l('Rotate X In top')
			),
			array(
				'id_option' => 'rotateZInLeft',
				'name' => self::l('Rotate Z In Left')
			),
			array(
				'id_option' => 'rotateZInRight',
				'name' => self::l('Rotate Z In right')
			),
			array(
				'id_option' => 'zoomInFlipVert',
				'name' => self::l('Zoom In Flip Vert')
			),
			array(
				'id_option' => 'zoomInFlipHoriz',
				'name' => self::l('Zoom In Flip Horiz')
			),

			array(
				'id_option' => 'slideInUp',
				'name' => self::l('Slide in up')
			),
			array(
				'id_option' => 'slideInDown',
				'name' => self::l('Slide in down')
			),
			array(
				'id_option' => 'slideInLeft',
				'name' => self::l('Slide in left')
			),
			array(
				'id_option' => 'slideInRight',
				'name' => self::l('Slide in right')
			),
			array(
				'id_option' => 'slideInCrossRightBottom',
				'name' => self::l('Slide in cross right bottom')
			),
			array(
				'id_option' => 'slideInCrossRightTop',
				'name' => self::l('Slide in cross right top')
			),
			array(
				'id_option' => 'slideInCrossLeftBottom',
				'name' => self::l('Slide in cross left bottom')
			),
			array(
				'id_option' => 'slideInCrossLeftTop',
				'name' => self::l('Slide in cross left top')
			),
			array(
				'id_option' => 'zoomIn',
				'name' => self::l('Zoom in')
			),
			array(
				'id_option' => 'zoomInDown',
				'name' => self::l('Zoom in down')
			),
			array(
				'id_option' => 'zoomInLeft',
				'name' => self::l('Zoom in left')
			),
			array(
				'id_option' => 'zoomInRight',
				'name' => self::l('Zoom in right')
			),
			array(
				'id_option' => 'zoomInUp',
				'name' => self::l('Zoom in up')
			),
			array(
				'id_option' => 'hinge',
				'name' => self::l('Hinge')
			),
			array(
				'id_option' => 'rollIn',
				'name' => self::l('RollIn')
			),
		);
	}

	/**
	 * @return array|mixed
	 */
	public static function getGoogleFonts() {

		$googleFonts[] = array(
			'id_option' => '',
			'name' => self::l('THEME DEFAULT FONT'),
		);
		if($fonts = json_decode(Tools::file_get_contents(dirname(__FILE__).'/../data/google-font-list.json'),true))
		{
			foreach($fonts as $font)
			{
				$temp = array(
					'id_option' => $font['family'],
					'name' => $font['family'],
				);
				$googleFonts[] = $temp;
			}
		}
		$googleFonts = json_decode(Tools::file_get_contents(dirname(__FILE__).'/../data/google-fonts.json'),true);
		if(!$googleFonts)
		{
			$googleFonts = array(
				array(
					'id_option' => '',
					'name' => self::l('THEME DEFAULT FONT'),
				),
				array(
					'id_option' => 'Arial',
					'name' => 'Arial',
				),
				array(
					'id_option' => 'Times new roman',
					'name' => 'Times new roman',
				),
			);
		}

		return $googleFonts;
	}

	/**
	 * @return array[]
	 */
	public static function getSlideAnimationOut() {
		return array(
			array(
				'id_option' => 'fadeOut',
				'name' => self::l('Fade out')
			),
			array(
				'id_option' => 'fadeOutDown',
				'name' => self::l('Fade out Down')
			),
			array(
				'id_option' => 'fadeOutDownBig',
				'name' => self::l('Fade out down big')
			),
			array(
				'id_option' => 'fadeOutLeft',
				'name' => self::l('Fade out left')
			),
			array(
				'id_option' => 'fadeOutLeftBig',
				'name' => self::l('Fade out left big')
			),
			array(
				'id_option' => 'fadeOutRight',
				'name' => self::l('Fade out right')
			),
			array(
				'id_option' => 'fadeOutRightBig',
				'name' => self::l('Fade out right big')
			),
			array(
				'id_option' => 'fadeOutUp',
				'name' => self::l('Fade out up')
			),
			array(
				'id_option' => 'fadeOutUpBig',
				'name' => self::l('Fade out up big')
			),
			array(
				'id_option' => 'flipOutX',
				'name' => self::l('Flip out X')
			),
			array(
				'id_option' => 'flipOutY',
				'name' => self::l('Flip out Y')
			),
			array(
				'id_option' => 'lightSpeedOut',
				'name' => self::l('Light speed out')
			),
			array(
				'id_option' => 'rotateOut',
				'name' => self::l('Rotate out')
			),
			array(
				'id_option' => 'rotateOutDownLeft',
				'name' => self::l('Rotate out down left')
			),
			array(
				'id_option' => 'rotateOutDownRight',
				'name' => self::l('Rotate out down right')
			),
			array(
				'id_option' => 'rotateOutUpLeft',
				'name' => self::l('Rotate out up left')
			),
			array(
				'id_option' => 'rotateOutUpRight',
				'name' => self::l('Rotate out up right')
			),
			array(
				'id_option' => 'rotateZoomOut',
				'name' => self::l('Rotate Zoom Out')
			),
			array(
				'id_option' => 'rotateYOutLeft',
				'name' => self::l('Rotate OutLeft')
			),
			array(
				'id_option' => 'rotateXOutRight',
				'name' => self::l('Rotate Out Right')
			),
			array(
				'id_option' => 'rotateXOutTop',
				'name' => self::l('Rotate X Out top')
			),
			array(
				'id_option' => 'rotateXOutBottom',
				'name' => self::l('Rotate X Out Bottom')
			),
			array(
				'id_option' => 'rotateZOutLeft',
				'name' => self::l('Rotate Z Out Left')
			),
			array(
				'id_option' => 'rotateZOutRight',
				'name' => self::l('Rotate Z Out right')
			),
			array(
				'id_option' => 'zoomOutFlipVert',
				'name' => self::l('Zoom Out Flip Vert')
			),
			array(
				'id_option' => 'zoomOutFlipHoriz',
				'name' => self::l('Zoom Out Flip Horiz')
			),
			array(
				'id_option' => 'slideOutUp',
				'name' => self::l('Slide out up')
			),
			array(
				'id_option' => 'slideOutDown',
				'name' => self::l('Slide out down')
			),
			array(
				'id_option' => 'slideOutLeft',
				'name' => self::l('Slide out left')
			),
			array(
				'id_option' => 'slideOutRight',
				'name' => self::l('Slide out right')
			),
			array(
				'id_option' => 'slideOutCrossRightBottom',
				'name' => self::l('Slide out cross right bottom')
			),
			array(
				'id_option' => 'slideOutCrossRightTop',
				'name' => self::l('Slide out cross right top')
			),
			array(
				'id_option' => 'slideOutCrossLeftBottom',
				'name' => self::l('Slide out cross left bottom')
			),
			array(
				'id_option' => 'slideOutCrossLeftTop',
				'name' => self::l('Slide out cross left top')
			),
			array(
				'id_option' => 'zoomOut',
				'name' => self::l('Zoom out')
			),
			array(
				'id_option' => 'zoomOutDown',
				'name' => self::l('Zoom out down')
			),

			array(
				'id_option' => 'zoomOutLeft',
				'name' => self::l('Zoom out left')
			),
			array(
				'id_option' => 'zoomOutRight',
				'name' => self::l('Zoom out right')
			),
			array(
				'id_option' => 'zoomOutUp',
				'name' => self::l('Zoom out up')
			),
			array(
				'id_option' => 'rollOut',
				'name' => self::l('Roll out')
			),

		);
	}

	/**
	 * @return array[]
	 */
	public static function getSlideAnimationIn() {
		return array(
			array(
				'id_option' => 'fadeIn',
				'name' => self::l('Fade in')
			),
			array(
				'id_option' => 'fadeInDown',
				'name' => self::l('Fade in Down')
			),
			array(
				'id_option' => 'fadeInDownBig',
				'name' => self::l('Fade in down big')
			),
			array(
				'id_option' => 'fadeInLeft',
				'name' => self::l('Fade in left')
			),
			array(
				'id_option' => 'fadeInLeftBig',
				'name' => self::l('Fade in left big')
			),
			array(
				'id_option' => 'fadeInRight',
				'name' => self::l('Fade in right')
			),
			array(
				'id_option' => 'fadeInRightBig',
				'name' => self::l('Fade in right big')
			),
			array(
				'id_option' => 'fadeInUp',
				'name' => self::l('Fade in up')
			),
			array(
				'id_option' => 'fadeInUpBig',
				'name' => self::l('Fade in up big')
			),
			array(
				'id_option' => 'flipInX',
				'name' => self::l('Flip in X')
			),
			array(
				'id_option' => 'flipInY',
				'name' => self::l('Flip in Y')
			),
			array(
				'id_option' => 'lightSpeedIn',
				'name' => self::l('Light speed in')
			),
			array(
				'id_option' => 'rotateIn',
				'name' => self::l('Rotate in')
			),
			array(
				'id_option' => 'rotateInDownLeft',
				'name' => self::l('Rotate in down left')
			),
			array(
				'id_option' => 'rotateInDownRight',
				'name' => self::l('Rotate in down right')
			),
			array(
				'id_option' => 'rotateInUpLeft',
				'name' => self::l('Rotate in up left')
			),
			array(
				'id_option' => 'rotateInUpRight',
				'name' => self::l('Rotate in up right')
			),

			array(
				'id_option' => 'rotateZoomIn',
				'name' => self::l('Rotate Zoom In')
			),
			array(
				'id_option' => 'rotateYInLeft',
				'name' => self::l('Rotate In Left')
			),
			array(
				'id_option' => 'rotateXInRight',
				'name' => self::l('Rotate In Right')
			),
			array(
				'id_option' => 'rotateXInTop',
				'name' => self::l('Rotate X In top')
			),
			array(
				'id_option' => 'rotateZInLeft',
				'name' => self::l('Rotate Z In Left')
			),
			array(
				'id_option' => 'rotateZInRight',
				'name' => self::l('Rotate Z In right')
			),
			array(
				'id_option' => 'zoomInFlipVert',
				'name' => self::l('Zoom In Flip Vert')
			),
			array(
				'id_option' => 'zoomInFlipHoriz',
				'name' => self::l('Zoom In Flip Horiz')
			),

			array(
				'id_option' => 'slideInUp',
				'name' => self::l('Slide in up')
			),
			array(
				'id_option' => 'slideInDown',
				'name' => self::l('Slide in down')
			),
			array(
				'id_option' => 'slideInLeft',
				'name' => self::l('Slide in left')
			),
			array(
				'id_option' => 'slideInRight',
				'name' => self::l('Slide in right')
			),
			array(
				'id_option' => 'slideInCrossRightBottom',
				'name' => self::l('Slide in cross right bottom')
			),
			array(
				'id_option' => 'slideInCrossRightTop',
				'name' => self::l('Slide in cross right top')
			),
			array(
				'id_option' => 'slideInCrossLeftBottom',
				'name' => self::l('Slide in cross left bottom')
			),
			array(
				'id_option' => 'slideInCrossLeftTop',
				'name' => self::l('Slide in cross left top')
			),
			array(
				'id_option' => 'zoomIn',
				'name' => self::l('Zoom in')
			),
			array(
				'id_option' => 'zoomInDown',
				'name' => self::l('Zoom in down')
			),
			array(
				'id_option' => 'zoomInLeft',
				'name' => self::l('Zoom in left')
			),
			array(
				'id_option' => 'zoomInRight',
				'name' => self::l('Zoom in right')
			),
			array(
				'id_option' => 'zoomInUp',
				'name' => self::l('Zoom in up')
			),
			array(
				'id_option' => 'rollIn',
				'name' => self::l('Roll in')
			),
		);
	}

	/**
	 * @return bool
	 */
	public static function multiLayoutExist()
	{
		$cache_id = 'ets_mls_defines_multiLayoutExist';
		if (!Cache::isStored($cache_id)) {
			$res = Db::getInstance()->getRow("SELECT id_lang FROM "._DB_PREFIX_."lang WHERE is_rtl=0 AND active=1") && Db::getInstance()->getRow("SELECT id_lang FROM "._DB_PREFIX_."lang WHERE is_rtl=1 AND active=1");
			Cache::store($cache_id, $res);
			return $res;
		} else {
			return Cache::retrieve($cache_id);
		}
	}

	/**
	 * @return bool
	 */
	public static function installDatabases() {
		return
			Db::getInstance()->execute("
                CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."ets_mls_slide` ( 
                `id_slide` INT(11) NOT NULL AUTO_INCREMENT ,
                `image` TEXT NOT NULL , 
                `repeat_x` INT(1) NOT NULL , 
                `repeat_y` INT(1) NOT NULL , 
                `sort_order` INT(11) NOT NULL , 
                `backgroud_color` VARCHAR(222) NOT NULL , 
                `custom_class` VARCHAR(100) DEFAULT NULL,
                `enabled` INT(1) NOT NULL , 
                `animation_in` VARCHAR(222) NOT NULL , 
                `animation_out` VARCHAR(222) NOT NULL , 
                PRIMARY KEY (`id_slide`)) ENGINE = " . _MYSQL_ENGINE_ . " DEFAULT CHARSET=UTF8
            ")
			&& Db::getInstance()->execute("
                CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."ets_mls_slide_lang` (
                  `id_slide` int(11) NOT NULL,
                  `id_lang` int(11) NOT NULL,
                  `title` varchar(500) NOT NULL
                ) ENGINE = " . _MYSQL_ENGINE_ . " DEFAULT CHARSET=UTF8
            ")
			&& Db::getInstance()->execute("
                CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."ets_mls_layer` ( 
                `id_layer` INT(11) NOT NULL AUTO_INCREMENT , 
                `id_slide` INT(11) NOT NULL , 
                `layer_type` VARCHAR(40) NOT NULL , 
                `font_size` FLOAT(10,2) NOT NULL ,
                `text_color` VARCHAR(40) NOT NULL, 
                `background_color` VARCHAR(40) NOT NULL,                
                `background_opacity` FLOAT(10,2) NOT NULL ,
                `font_family` VARCHAR(100) NOT NULL,
                `font_weight` VARCHAR(100) NOT NULL,
                `text_decoration` VARCHAR(100) NOT NULL,
                `text_transform` VARCHAR(100) NOT NULL,
                `padding` VARCHAR(100) NOT NULL, 
                `box_radius` INT(11) DEFAULT NULL,
                `top` FLOAT(10,2) NOT NULL , 
                `left` FLOAT(10,2) NOT NULL , 
                `right` FLOAT(10,2) NOT NULL,
                `top_right` FLOAT(10,2) NOT NULL,
                `animation_in` VARCHAR(100) NOT NULL, 
                `animation_out` VARCHAR(100) NOT NULL,                
                `width` VARCHAR(100) DEFAULT NULL,
                `height` VARCHAR(100) DEFAULT NULL,
                `sort_order` INT(11),
                `move_in` INT(11) NOT NULL , 
                `move_out` INT(11) NOT NULL ,
                `stand_duration` INT(11) NOT NULL ,
                `start_delay` INT(11) NOT NULL ,
                `image` varchar(222) not null,
                PRIMARY KEY (`id_layer`)) ENGINE = " . _MYSQL_ENGINE_ . " DEFAULT CHARSET=UTF8
            ")
			&&Db::getInstance()->execute("
                CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."ets_mls_layer_lang` (
                  `id_layer` int(11) NOT NULL,
                  `id_lang` int(11) NOT NULL,
                  `content_layer` text NOT NULL,
                  `link` text
                ) ENGINE = " . _MYSQL_ENGINE_ ." DEFAULT CHARSET=UTF8
            ");
	}

	/**
	 * @return bool
	 */
	public static function uninstallDb()
	{
		return
			Db::getInstance()->execute("DROP TABLE IF EXISTS "._DB_PREFIX_."ets_mls_slide")
			&&Db::getInstance()->execute("DROP TABLE IF EXISTS "._DB_PREFIX_."ets_mls_slide_lang")
			&& Db::getInstance()->execute("DROP TABLE IF EXISTS "._DB_PREFIX_."ets_mls_layer")
			&& Db::getInstance()->execute("DROP TABLE IF EXISTS "._DB_PREFIX_."ets_mls_layer_lang");
	}


	public static function deleteDatabaseWhenImport() {
		/** @var Ets_multilayerslider $module */
		$module = Module::getInstanceByName('ets_multilayerslider');
		$module->_clearCacheWhenUpdateLayer();
		$module->_clearCacheWhenUpdateSlide();
		Db::getInstance()->execute("DELETE FROM "._DB_PREFIX_."ets_mls_layer_lang");
		Db::getInstance()->execute("DELETE FROM "._DB_PREFIX_."ets_mls_layer");
		Db::getInstance()->execute("DELETE FROM "._DB_PREFIX_."ets_mls_slide_lang");
		Db::getInstance()->execute("DELETE FROM "._DB_PREFIX_."ets_mls_slide");
	}

	public static function clearUploadedImages()
	{
		if(@file_exists(_PS_ETS_MLS_IMG_DIR_) && ($files = glob(_PS_ETS_MLS_IMG_DIR_.'*')))
		{
			foreach($files as $file)
				if(@file_exists($file) && strpos($file,'index.php')===false)
					@unlink($file);
		}
	}

	/**
	 * @return array
	 */
	public static function trans() {
		return array(
			'required_text' => self::l('is required'),
			'data_saved' => self::l('Saved'),
			'unkown_error' => self::l('Unknown error happens'),
			'object_empty' => self::l('Object is empty'),
			'field_not_valid' => self::l('Field is not valid'),
			'file_too_large' => self::l('Upload file cannot be large than 100MB'),
			'file_existed' => self::l('File name already exists. Try to rename the file and upload again'),
			'can_not_upload' => self::l('Cannot upload file'),
			'upload_error_occurred' => self::l('An error occurred during the image upload process.'),
			'image_deleted' => self::l('Image deleted'),
			'item_deleted' => self::l('Item deleted'),
			'cannot_delete' => self::l('Cannot delete the item due to an unknown technical problem'),
			'invalid_text' => self::l('is invalid'),

			'content_required_text' => self::l('Text content is required'),
			'link_required_text' => self::l('Link is required'),
			'image_required_text' => self::l('Image is required'),
			'layer_type_not_valid' => self::l('Layer type is not valid'),
		);
	}


	public static function maxLayerOut($id_slide)
	{
		$cache_id = 'ets_mls_defines_maxLayerOut_' . ($id_slide ? $id_slide : 0);
		if (!Cache::isStored($cache_id)) {
			$res = (int)Db::getInstance()->getValue("SELECT max(move_out+stand_duration) FROM "._DB_PREFIX_."ets_mls_layer WHERE id_slide=".(int)$id_slide);
			Cache::store($cache_id, $res);
			return $res;
		} else {
			return Cache::retrieve($cache_id);
		}
	}



	public static function getSlides($active=false,$id_slide = false,$id_lang = false)
	{
		$slides = Db::getInstance()->executeS('
            select s.*,sl.title 
            FROM '._DB_PREFIX_.'ets_mls_slide s 
            LEFT JOIN '._DB_PREFIX_.'ets_mls_slide_lang sl on (s.id_slide =sl.id_slide and sl.id_lang='.($id_lang ? (int)$id_lang : (int)Context::getContext()->language->id).')
            WHERE 1 '.($active ? ' AND s.enabled=1' : '').($id_slide ? ' AND s.id_slide='.(int)$id_slide : '').' 
            ORDER BY s.sort_order');
		if($slides)
			foreach($slides as &$slide)
			{
				if($slide['image'])
					$slide['link_img'] = _PS_ETS_MLS_IMG_.$slide['image'];
				else
					$slide['link_img']='';
				$slide['layers'] = self::getDataLayers($slide['id_slide']);
				$slide['max_layer_in'] = self::maxLayerIn($slide['id_slide']);
				$slide['max_layer_out'] = Ets_mls_defines::maxLayerOut($slide['id_slide']);
			}
		if($id_slide && $slides)
			return $slides[0];
		return $slides;
	}

	public static function maxLayerIn($id_slide)
	{
		return (int)Db::getInstance()->getValue("SELECT max(move_in+start_delay) FROM "._DB_PREFIX_."ets_mls_layer WHERE id_slide=".(int)$id_slide);
	}

	public static function maxSlideTime()
	{
		return (int)Db::getInstance()->getValue("SELECT max(l.move_in+l.start_delay) FROM "._DB_PREFIX_."ets_mls_layer l JOIN "._DB_PREFIX_."ets_mls_slide s ON l.id_slide=s.id_slide WHERE s.enabled=1")
			+ (int)Db::getInstance()->getValue("SELECT max(l.move_out+l.stand_duration) FROM "._DB_PREFIX_."ets_mls_layer l JOIN "._DB_PREFIX_."ets_mls_slide s ON l.id_slide=s.id_slide WHERE s.enabled=1");
	}


	public static function getDataLayers($id_slide = false, $id_layer = false)
	{
		$layers = Db::getInstance()->executeS('
            SELECT l.*,ll.content_layer,ll.link 
            FROM '._DB_PREFIX_.'ets_mls_layer l 
            LEFT JOIN '._DB_PREFIX_.'ets_mls_layer_lang ll ON (l.id_layer=ll.id_layer and ll.id_lang='.(int)Context::getContext()->language->id.') 
            WHERE 1 '.($id_slide ? ' AND l.id_slide='.(int)$id_slide : '').($id_layer ? ' AND l.id_layer='.(int)$id_layer : '').' 
            ORDER BY l.sort_order'
		);
		if($layers)
			foreach($layers as &$layer)
			{
				$layer['link_image'] = _PS_ETS_MLS_IMG_.$layer['image'];
			}
		if($id_layer && $layers)
			return $layers[0];
		return $layers;
	}

	public static function getFonts() {
		return Db::getInstance()->executeS("SELECT DISTINCT font_family FROM "._DB_PREFIX_."ets_mls_layer");
	}

	public static function updatePositionLayer($layout, $data_top, $itemId, $data_left, $data_right) {
		if($layout=='ltr')
			$sql = 'UPDATE '._DB_PREFIX_.'ets_mls_layer SET `top`='.(float)$data_top.', `left`='.(float)$data_left.' WHERE id_layer='.(int)$itemId;
		else
			$sql = 'UPDATE '._DB_PREFIX_.'ets_mls_layer SET `top_right`='.(float)$data_top.', `right`='.(float)$data_right.' WHERE id_layer='.(int)$itemId;
		return Db::getInstance()->execute($sql);
	}
}