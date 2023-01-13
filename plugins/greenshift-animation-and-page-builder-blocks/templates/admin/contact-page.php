<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="wrap gspb_welcome_div_container">
    <style>
        .wrap {
            background: white;
            max-width: 900px;
            margin: 2.5em auto;
            border: 1px solid #dbdde2;
            box-shadow: 0 10px 20px #ececec;
            text-align: center
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
            max-width: 500px;
            margin: 0 auto 30px auto
        }

        .gs-intro-video iframe {
            box-shadow: 10px 10px 20px rgb(0 0 0 / 15%);
        }

        .gs-intro-video {
            margin-bottom: 15px
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

        .wrap .fs-notice {
            margin: 0 25px 25px 25px !important
        }

        .wrap .fs-plugin-title {
            display: none !important
        }

        .gridrows {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px
        }

        .gridrows div {
            padding: 20px;
            border: 1px solid #e4eff9;
            background: #f3f8ff;
            font-size: 16px
        }

        .gridrows div a {
            text-decoration: none
        }

        .gs-padd {
            padding: 25px
        }
    </style>
    <h1><?php esc_html_e("Contact Us", 'greenshift-animation-and-page-builder-blocks'); ?></h1>
    <div class="gs-padd">
        <p><img src="<?php echo GREENSHIFT_DIR_URL . 'libs/logo_300.png'; ?>" height="100" width="100" /></p>
        <p class="gs-introtext"><?php esc_html_e("Thank you for using Greenshift. For any bug report, please, contact us ", 'greenshift-animation-and-page-builder-blocks'); ?> <a href="https://shop.greenshiftwp.com/contact-us/" target="_blank"><?php esc_html_e("through the contact form", 'greenshift-animation-and-page-builder-blocks'); ?></a> <?php esc_html_e("if you need private support or via ", 'greenshift-animation-and-page-builder-blocks'); ?> <a href="https://wordpress.org/support/plugin/greenshift-animation-and-page-builder-blocks/" target="_blank"><?php esc_html_e("Ticket system on Wordpress.org", 'greenshift-animation-and-page-builder-blocks'); ?></a></p>
    </div>
</div>