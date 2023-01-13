<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
?>
<?php $licenses = greenshift_edd_check_all_licenses(); ?>
<div class="wrap gspb_welcome_div_container">
    <style>
        .wrap {
            background: white;
            max-width: 1060px;
            margin: 2.5em auto;
            border: 1px solid #dbdde2;
            box-shadow: 0 10px 20px #ececec;
        }

        .wrap .notice,
        .wrap .error {
            display: none !important;
        }

        .wrap h2 {
            font-size: 1.5em;
            margin-bottom: 1em;
            font-weight: bold
        }

        .gs-introtext {
            font-size: 14px;
            overflow: hidden;
            margin: 15px auto 0 auto
        }

        .wrap h1 {
            text-align: left;
            padding: 15px 20px;
            margin: -1px -1px 0 -1px;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 0 3px 8px rgb(0 0 0 / 5%);
        }


        .gs-padd {
            overflow: hidden;
        }

        #gspb_addons .gspb-cards-list {
            list-style: none;
        }

        #gspb_addons .gspb-cards-list .gspb-card {
            float: left;
            height: 152px;
            width: 310px;
            padding: 0;
            margin: 0 0 30px 30px;
            font-size: 14px;
            list-style: none;
            border: 1px solid #ddd;
            position: relative;
        }

        #gspb_addons .gspb-cards-list .gspb-card .gspb-inner {
            background-color: #fff;
            overflow: hidden;
            height: 100%;
            position: relative;
        }

        #gspb_addons .gspb-cards-list .gspb-card .gspb-inner>ul {
            -moz-transition: all, 0.15s;
            -o-transition: all, 0.15s;
            -ms-transition: all, 0.15s;
            -webkit-transition: all, 0.15s;
            transition: all, 0.15s;
            left: 0;
            right: 0;
            top: 0;
            position: absolute;
        }

        #gspb_addons .gspb-cards-list .gspb-card .gspb-inner>ul>li {
            list-style: none;
            line-height: 18px;
            padding: 0 15px;
            width: 100%;
            display: block;
            box-sizing: border-box;
        }

        #gspb_addons .gspb-cards-list .gspb-card .gspb-inner .gspb-card-banner {
            padding: 0;
            margin: 0;
            display: block;
            height: 100px;
            background-repeat: repeat-x;
            background-size: 100% 100%;
            transition: all, 0.15s;
        }

        .gspb-badge {
            position: absolute;
            top: 10px;
            right: 0;
            background: #71ae00;
            color: white;
            text-transform: uppercase;
            padding: 5px 10px;
            border-radius: 3px 0 0 3px;
            font-weight: bold;
            border-right: 0;
            box-shadow: 0 2px 1px -1px rgb(0 0 0 / 30%);
        }

        #gspb_addons .gspb-cards-list .gspb-card .gspb-inner .gspb-title {
            margin: 10px 0 0 0;
            height: 18px;
            overflow: hidden;
            color: #000;
            white-space: nowrap;
            text-overflow: ellipsis;
            font-weight: bold;
        }

        #gspb_addons .gspb-cards-list .gspb-card .gspb-inner .gspb-offer {
            font-size: 0.9em;
        }

        #gspb_addons .gspb-cards-list .gspb-card .gspb-inner .gspb-description {
            background-color: #f9f9f9;
            padding: 10px 15px 100px 15px;
            border-top: 1px solid #eee;
            margin: 0 0 10px 0;
            color: #777;
        }

        #gspb_addons .gspb-cards-list .gspb-card .gspb-inner .gspb-cta .button,
        #gspb_addons .gspb-cards-list .gspb-card .gspb-inner .gspb-cta .button-group {
            position: absolute;
            top: 112px;
            right: 10px;
            min-height: 20px;
            line-height: 30px;
            background: #2184f9;
        }

        @media screen and (min-width: 960px) {
            #gspb_addons .gspb-cards-list .gspb-card:hover .gspb-inner ul {
                top: -100px;
            }

            #gspb_addons .gspb-cards-list .gspb-card:hover .gspb-inner .gspb-title,
            #gspb_addons .gspb-cards-list .gspb-card:hover .gspb-inner .gspb-offer {
                color: #29abe1;
            }

            #gspb_addons .gspb-cards-list .gspb-card:hover .gspb-inner .gspb-title,
            #gspb_addons .gspb-cards-list .gspb-card:hover .gspb-inner .gspb-offer {
                color: #29abe1;
            }
        }
    </style>
    <h1><?php esc_html_e("Addons", 'greenshift-animation-and-page-builder-blocks'); ?></h1>
    <div class="gs-padd">
        <div class="gs-introtext" id="gspb_addons">
            <ul class="gspb-cards-list">
                <li class="gspb-card gspb-addon" data-slug="greenshiftgsap">
                    <div class="gspb-inner">
                        <ul>
                            <li class="gspb-card-banner" style="background-image: url('//s3-us-west-2.amazonaws.com/freemius/plugins/9741/card_banner.png');">
                                <?php $is_active = ((!empty($licenses['all_in_one']) && $licenses['all_in_one'] == 'valid') || (!empty($licenses['gsap_addon']) && $licenses['gsap_addon'] == 'valid') || (!empty($licenses['all_in_one_design']) && $licenses['all_in_one_design'] == 'valid')) ? true : false;?>
                                <?php if (($is_active || defined('REHUB_ADMIN_DIR')) && defined('GREENSHIFTGSAP_DIR_URL')) : ?>
                                    <span class="gspb-badge">Active</span>
                                <?php endif; ?>
                            </li>
                            <!-- <li class="gspb-tag"></li> -->
                            <li class="gspb-title">Advanced Animations</li>
                            <li class="gspb-offer">
                                <span class="gspb-price">$19.99</span>
                            </li>
                            <li class="gspb-description">Add motion and animations like on top awwarded sites without code knowledge <br><br>
                            <a class="gspb-buttonbox" href="https://greenshiftwp.com/block-gallery/#animation" target="_blank" rel="noopener">Details and Demo</a>
                            </li>
                            <li class="gspb-cta"><a class="button button-primary" href="https://shop.greenshiftwp.com/downloads/advanced-animation-addon/" target="_blank"><?php esc_html_e("Buy Now", "greenshift-animation-and-page-builder-blocks"); ?></a></li>
                        </ul>
                    </div>
                </li>
                <li class="gspb-card gspb-addon" data-slug="greenshiftquery">
                    <div class="gspb-inner">
                        <ul>
                            <li class="gspb-card-banner" style="background-image: url('//s3-us-west-2.amazonaws.com/freemius/plugins/10066/card_banner.png');"></li>
                            <?php $is_active = ((!empty($licenses['all_in_one']) && $licenses['all_in_one'] == 'valid') || (!empty($licenses['query_addon']) && $licenses['query_addon'] == 'valid') || (!empty($licenses['all_in_one_design']) && $licenses['all_in_one_design'] == 'valid') || (!empty($licenses['all_in_one_seo']) && $licenses['all_in_one_seo'] == 'valid')) ? true : false;?>
                            <?php if ($is_active && defined('GREENSHIFTQUERY_DIR_URL')) : ?>
                                <span class="gspb-badge">Active</span>
                            <?php endif; ?>
                            <li class="gspb-title">Greenshift Query</li>
                            <li class="gspb-offer">
                                <span class="gspb-price">$19.99</span>
                            </li>
                            <li class="gspb-description">Custom templates, dynamic content, listings, grid, taxonomy blocks<br><br>
                            <a class="gspb-buttonbox" href="https://greenshiftwp.com/block-gallery/#query" target="_blank" rel="noopener">Details and Demo</a></li>
                            <li class="gspb-cta"><a class="button button-primary" href="https://shop.greenshiftwp.com/downloads/query-addon/" rel="noopener" target="_blank"><?php esc_html_e("Buy Now", "greenshift-animation-and-page-builder-blocks"); ?></a></li>
                        </ul>
                    </div>
                </li>
                <li class="gspb-card gspb-addon" data-slug="greenshiftseo">
                    <div class="gspb-inner">
                        <ul>
                            <li class="gspb-card-banner" style="background-image: url('//s3-us-west-2.amazonaws.com/freemius/plugins/10102/card_banner.png');"></li>
                            <?php $is_active = (((!empty($licenses['all_in_one']) && $licenses['all_in_one'] == 'valid') || (!empty($licenses['seo_addon']) && $licenses['seo_addon'] == 'valid') || (!empty($licenses['all_in_one_seo']) && $licenses['all_in_one_seo'] == 'valid') )) ? true : false;?>
                            <?php if ($is_active && defined('GREENSHIFTSEO_DIR_URL')) : ?>
                                <span class="gspb-badge">Active</span>
                            <?php endif; ?>
                            <li class="gspb-title">Seo and Marketing Addon</li>
                            <li class="gspb-offer">
                                <span class="gspb-price">$29.99</span>
                            </li>
                            <li class="gspb-description">Special mobile and seo optimized blocks which can help to earn money<br><br>
                            <a class="gspb-buttonbox" href="https://greenshiftwp.com/block-gallery/#seo" target="_blank" rel="noopener">Details and Demo</a></li>
                            <li class="gspb-cta"><a class="button button-primary" href="https://shop.greenshiftwp.com/downloads/marketing-and-seo-addon/" target="_blank"><?php esc_html_e("Buy Now", "greenshift-animation-and-page-builder-blocks"); ?></a></li>
                        </ul>
                    </div>
                </li>
                <li class="gspb-card gspb-addon" data-slug="greenshiftchart">
                    <div class="gspb-inner">
                        <ul>
                            <li class="gspb-card-banner" style="background-image: url('//s3-us-west-2.amazonaws.com/freemius/plugins/10835/card_banner.png');"></li>
                            <?php $is_active = (((!empty($licenses['all_in_one']) && $licenses['all_in_one'] == 'valid') || (!empty($licenses['chart_addon']) && $licenses['chart_addon'] == 'valid') )) ? true : false;?>

                            <?php if ($is_active && defined('GSCBN_VERSION')) : ?>
                                <span class="gspb-badge">Active</span>
                            <?php endif; ?>
                            <li class="gspb-title">Greenshift Chart</li>
                            <li class="gspb-offer">
                                <span class="gspb-price">$9.50</span>
                            </li>
                            <li class="gspb-description">Do you want to improve visual hierarchy and presentation in your content<br><br>
                            <a class="gspb-buttonbox" href="https://greenshiftwp.com/block-gallery/#chart" target="_blank" rel="noopener">Details and Demo</a></li>
                            <li class="gspb-cta"><a class="button button-primary" href="https://shop.greenshiftwp.com/downloads/greenshift-chart-plugin/" rel="noopener" target="_blank"><?php esc_html_e("Buy Now", "greenshift-animation-and-page-builder-blocks"); ?></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>