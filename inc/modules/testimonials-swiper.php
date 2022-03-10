<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes;
use Elementor\Repeater;
use Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class CTWP_Widget_Testimonials_Swiper extends Widget_Base
{

    public function get_name()
    {
        return 'ctwp-testimonials-swiper';
    }

    public function get_categories()
    {
        return ['ctwp-elements'];
    }

    public function get_title()
    {
        return __('Ctwp Testimonials Swiper', 'ctwp-elements');
    }

    public function get_icon()
    {
        return 'eicon-testimonial-carousel';
    }

    public function get_keywords()
    {
        return ['image', 'photo', 'visual', 'box'];
    }

    public function get_script_depends() {
       return [ 'swiper' ];
    }

    public function get_style_depends() {
       return [ 'swiper' ];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_testimonials',
            [
                'label' => __('Testimonials', 'ctwp-elements'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'content',
            [
                'label' => __('Content', 'ctwp-elements'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter your description', 'ctwp-elements'),
                'default' => __('Dolor sit amet, consectetur adipisicing elit, sed do eiusmod por incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exeion ullamco laboris nisi ut aliquip ex ea commodo conseat. Duis aute irure dolr.', 'ctwp-elements'),
                'separator' => 'none',
                'show_label' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => __('Name', 'ctwp-elements'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('By Laura', 'ctwp-elements'),
                'default' => __('By Laura', 'ctwp-elements'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __('Description', 'ctwp-elements'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('( Laura Rolls-Royce )', 'ctwp-elements'),
                'default' => __('( Laura Rolls-Royce )', 'ctwp-elements'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __('Choose Image', 'ctwp-elements'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'testimonials_link',
            [
                'label' => __( 'Link', 'ctwp-elements' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-post-link.com', 'elementor' ),
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => __('', 'ctwp-elements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'content' => __('Dolor sit amet, consectetur adipisicing elit, sed do eiusmod por incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exeion ullamco laboris nisi ut aliquip ex ea commodo conseat. Duis aute irure dolr.', 'ctwp-elements'),
                        'name' => __('By Laura', 'ctwp-elements'),
                        'description' => __('( Laura Rolls-Royce )', 'ctwp-elements'),
                        'testimonials_link' => __('#', 'ctwp-elements'),
                    ],
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'swiper_settings',
            [
                'label' => __('Swiper', 'ctwp-elements'),
            ]
        );
        $this->add_control(
            'style',
            [
                'label' => __('Stype', 'ctwp-elements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style-1' => __('Default', 'ctwp-elements'),
                    'style-2' => __('Sync', 'ctwp-elements'),
                ],
                'default' => 'style-1',
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'add_class_unique',
            [
                'label' => __('Class', 'ctwp-elements'),
                'type' => Controls_Manager::TEXT,
                'frontend_available' => true,
            ]
        );
        $this->add_responsive_control(
            'slides_per_view',
            [
                'label' => __('Slides Per View', 'ctwp-elements'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 1,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'condition' => [
                    'style' => 'style-1',
                ],
            ]
        );
        $this->add_control(
            'pagination',
            [
                'label' => __('Show Pagination', 'ctwp-elements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'no' => __('No', 'ctwp-elements'),
                    'yes' => __('Yes', 'ctwp-elements'),
                ],
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'navigation',
            [
                'label' => __('Show Navigation', 'ctwp-elements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'no' => __('No', 'ctwp-elements'),
                    'yes' => __('Yes', 'ctwp-elements'),
                ],
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'icon_button_next',
            [
                'label' => __( 'Icon Button Next', 'ctwp-elements'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
            ]
        );

        $this->add_control(
            'icon_button_prev',
            [
                'label' => __( 'Icon Button Pvev', 'ctwp-elements'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
            ]
        );

        $this->end_controls_section();

        $this->_register_controls_style();
    }

    protected function _register_controls_style() {
        $this->start_controls_section(
            'image_tab_style',
            [
                'label' => __('Image', 'ctwp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => __( 'Style', 'ctwp-elements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_style',
            [
                'label' => __('Style', 'ctwp-elements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => __('Circle', 'ctwp-elements'),
                    'square' => __('Square', 'ctwp-elements'),
                ],
                'default' => 'circle',
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => __( 'Width', 'ctwp-elements'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '.elementor-ctwp_testimonials-wrapper .image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => __( 'Height', 'ctwp-elements'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-ctwp_testimonials-wrapper .image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_spacing_bottom',
            [
                'label' => __( 'Image Spacing', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '.elementor-ctwp_testimonials-wrapper.style-1 .image' => 'margin: 0 auto {{SIZE}}{{UNIT}} auto;',
                    '.elementor-ctwp_testimonials-wrapper.style-2 .image' => 'margin: {{SIZE}}{{UNIT}} auto 0 auto;',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'box_text_style',
            [
                'label' => __('Box Text', 'ctwp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __( 'Content', 'ctwp-elements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'box_text_padding',
            [
                'label' => __( 'Padding', 'ctwp-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '.elementor-ctwp_testimonials-wrapper .box-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'content_align',
            [
                'label' => __( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'elementor' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '.elementor-ctwp_testimonials-wrapper .box-text .text' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left'
            ]
        );

        $this->add_responsive_control(
            'content_spacing_bottom',
            [
                'label' => __( 'Content Spacing', 'ctwp-elements'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '.elementor-ctwp_testimonials-wrapper.style-1 .box-text .content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '.elementor-ctwp_testimonials-wrapper.style-2 .box-text .content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __( 'Color', 'ctwp-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.elementor-ctwp_testimonials-wrapper .box-text .content p' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_1,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-ctwp_testimonials-wrapper .box-text .content p',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => __( 'Name', 'ctwp-elements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => __( 'Color', 'ctwp-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.elementor-ctwp_testimonials-wrapper .box-text .name-description h5' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_1,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .elementor-ctwp_testimonials-wrapper .box-text .name-description h5',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'ctwp-elements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'ctwp-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '.elementor-ctwp_testimonials-wrapper .box-text .name-description p' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_1,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '.elementor-ctwp_testimonials-wrapper .box-text .name-description p',
                'scheme' => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();?>

        <div class="ctwp_testimonials-wrapper <?php echo $settings['add_class_unique'] != '' ? $settings['add_class_unique'] : '' ?>" data-style="<?php echo $settings['style']; ?>">
        
            <?php if ($settings['style']=='style-2'): ?>
            
            <?php else: ?>
            <div <?php echo $settings['slides_per_view_mobile'] ? 'data-limit-mobile='.$settings['slides_per_view_mobile'].' ' : ''; echo $settings['slides_per_view_tablet'] ? 'data-limit-tablet='.$settings['slides_per_view_tablet'] . ' ' : '';echo $settings['slides_per_view'] ? 'data-limit-desktop='.$settings['slides_per_view'] . ' ' : '' ?> class="elementor-ctwp_testimonials-wrapper swiper swiper-container <?php echo $settings['style']; ?>">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['testimonials'] as $item) : ?>
                        <div class="swiper-slide">
                            <div class="col-inner">
                                <div class="box-image">
                                    <div class="image">
                                        <?php if (!empty($item['testimonials_link']['url'])){ ?>
                                        <a 
                                           href="<?php echo esc_html__($item['testimonials_link']['url'], 'ctwp-elements') ?>">
                                            <?php } ?>
                                            <div class="img <?php echo $settings['image_style']; ?>" style="background-image: url('<?php echo esc_url($item['image']['url']) ?>')"></div>
                                            <?php if (!empty($item['testimonials_link']['url'])){ ?>
                                        </a>
                                    <?php } ?>
                                    </div>
                                </div>
                                <div class="box-text">
                                    <div class="text">
                                        <div class="name-description">
                                            <h5><?php echo esc_html__($item['name'],'ctwp-elements') ?></h5>
                                            <p><?php echo esc_html__($item['description'],'ctwp-elements') ?></p>
                                        </div>
                                        <div class="content">
                                            <p><?php echo esc_html__($item['content'],'ctwp-elements') ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if ($settings['pagination']=='yes'): ?>
                    <div class="swiper-pagination"></div>
                <?php endif ?>
                <?php if ($settings['navigation']=='yes'): ?>
                    <div class="swiper-button-prev">
                        <?php
                        $data = $settings['icon_button_prev'];
                        if (!empty($data['value'])) {
                            $img = $data['value']['url'];
                            echo '<img src="'.$img.'" alt="Date">';
                        }
                        ?>
                    </div>
                    <div class="swiper-button-next">
                        <?php
                        $data = $settings['icon_button_next'];
                        if (!empty($data['value'])) {
                            $img = $data['value']['url'];
                            echo '<img src="'.$img.'" alt="Date">';
                        }
                        ?>
                    </div>
                <?php endif ?>
            </div>
            <?php endif ?>  
        </div>                      
<?php
    }

   
}
\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new CTWP_Widget_Testimonials_Swiper());